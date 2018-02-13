@extends('masterUserHeader.body')
@section('matchName')
    مسابقه {{$tournament->matchName}}
@endsection

@section('title')
    چارش | مسابقه  {{$tournament->matchName}}
@endsection

@section('content')
<div class="wallDiv" id="edit">
    @if(count($errors->all()))
        <div class="alert alert-danger" role="alert">

            {{--<li>{{session('message')}}</li>--}}
            @foreach($errors->all() as $error)

                <li>{{$error}}</li>

            @endforeach
        </div>
    @endif


    @if(count(session('message')))

        <div class="alert alert-success" role="alert">
            {{session('message')}}
        </div>
    @endif

        @if(count(session('RegError')))

            <div class="alert alert-danger" role="alert">
                {{session('RegError')}}
            </div>
        @endif

        @if(count(session('creditError')))

            <div class="alert alert-danger" role="alert">
                {{session('creditError')}} <span><a href="{{route('credit',['username'=>Auth::user()->slug])}}">افزایش اعتبار</a></span>
            </div>
        @endif


    <h3 style="direction: rtl">  ثبت نام در مسابقه {{$tournament->matchName}}</h3>

    <form style="width: 80%;margin: auto;" method="post"  enctype="multipart/form-data" action="{{route('matchRegister',['id'=>$tournament->id,'username'=>$name->username])}}">
    <!---->
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <br>

        @if($tournament->cost == 0)
            <h5>هزینه ثبت نام به ازای هر نفر : <b></b> رایگان</h5>
        @else
        <h5>هزینه ثبت نام به ازای هر نفر : <b>{{$tournament->cost}}</b> تومان</h5>
        @endif



        @if($tournament->matchType == 'تیمی')



            <h4>  مشخصات تیم را وارد کنید </h4>

            {{--<div class="form-group">--}}
                {{--<label>لوگو تیم (100px * 100px) : </label>--}}
                {{--<!--<div  style="float: right">-->--}}
                {{--<input name="logo" type="file" class="form-control-file"  aria-describedby="fileHelp">--}}
                {{--<!--</div>-->--}}
            {{--</div>--}}
            <div class="wrapperImageUpload">
                <div class="boxImageUpload">
                    <div class="js--image-preview" style=" background-image: url('{{URL::asset('images/100_100.jpg')}}'); "></div>
                    <div class="upload-options">
                        <label>
                            <input name="background_path" type="file" class="image-upload" aria-describedby="fileHelp" accept="image/*"  />
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label> نام تیم</label>
                <input name="teamName" class="form-control" type="text" value="{{Request::old('teamName')}}">
            </div>

            @for($i=1 ; $i<= $tournament->maxMember ; $i++)
            <div class="form-group ">
                <label>  نفر {{$i}}  </label>
                <input name="teammate{{$i}}" class="form-control" type="text" value="{{Request::old("teammate$i")}}">
                <br>
                @if(count($tournament->moreInfo)>0)

                    @for($p=0 ; $p<count(unserialize($tournament->moreInfo));$p++)
                        @if(unserialize($tournament->moreInfo)[$p]!= null)

                            <label for="InputFile">{!!unserialize($tournament->moreInfo)[$p]!!}</label>
                            <input type="text" class="form-control" name="info[{{$i}}][{{$p+1}}]" value="{{Request::old("info[$i][$p+1]")}}">
                            <br>
                        @endif
                    @endfor
                @endif


            </div>

            @endfor

            @for($t=0;$t<$tournament->subst;$t++)

            <div class="form-group">
                <label> نفر {{$t+$i}} (ذخیره) </label>
                <input name="subst[{{$t}}]" class="form-control" type="text" value="{{Request::old("subst[$t]")}}">
                <br>
                @if(count($tournament->moreInfo)>0)

                    @for($p=0 ; $p<count(unserialize($tournament->moreInfo));$p++)
                        @if(unserialize($tournament->moreInfo)[$p]!= null)

                            <label for="InputFile">{!!unserialize($tournament->moreInfo)[$p]!!}</label>
                            <input type="text" class="form-control" name="info[{{$t+$i}}][{{$p+1}}]" value="{{Request::old("info[$t+$i][$p+1]")}}" placeholder="{{unserialize($tournament->moreInfo)[$p]}}">
                            <br>
                        @endif
                    @endfor
                @endif
            </div>
            @endfor
            <!— tozihate digee ke bargozar konnade mikhad —>
            <input type="hidden" name="matchId" value="{{$tournament->id}}">
            <br>


            <p style="color:red;direction: rtl">لطفا پیش از ثبت نام،<a href="{{URL::asset('storage/pdfs/'.$tournament->rules)}}"> قوانین مسابقه </a>را به طور کامل مطالعه نمایید </p>
        <!---->
            <br>
            <button @click="hidden" v-show="!hide" type="submit" class="regButton" id="btnReg">ثبت نام</button>

            <button v-show="hide" class="regButton" id="btnReg" :disabled="true"><i class="fa fa-spinner fa-spin" ></i> در حال ارسال اطلاعات </button>

            <br>
    </form>
         @else
            <form style="padding-top: 20px;font-size: 20px;" method="post" action="{{route('matchRegister',['id'=>$tournament->id,'username'=>$name->username])}}" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{csrf_token()}}">

                <div class="form-group">
                    @if(count($tournament->moreInfo)>0)
                        <h5>اطلاعات درخواست شده توسط برگزار کننده را وارد کنید</h5>
                        @for($i=0 ; $i<count(unserialize($tournament->moreInfo));$i++)
                            @if(unserialize($tournament->moreInfo)[$i]!= null)

                            <label for="InputFile">{!!unserialize($tournament->moreInfo)[$i]!!}</label>
                            <input type="text" class="form-control" name="info[{{$i+1}}]" value="{{Request::old("info[$i+1]")}}" placeholder="{{unserialize($tournament->moreInfo)[$i]}}">
                            <br>
                             @endif
                        @endfor
                    @endif
                    {{--<br>--}}
                    {{--<br>--}}
                    {{--@if(count($tournament->moreInfo)>0)--}}
                        {{--<h4>اطلاعات درخواست شده در متن زیر را نیز در پایین وارد کنید</h4>--}}
                        {{--<div>--}}
                            {{--<textarea id="summernote" name="additionalData" class="form-control" id="exampleTextarea" rows="10" placeholder="text editor"></textarea>--}}
                        {{--</div>--}}
                    {{--@endif--}}

                </div>
                <br>
                <input type="hidden" name="single" value="single">
                <input type="hidden" name="name" value="{{$tournament->matchName}}">
                <input type="hidden" name="id" value="{{$tournament->id}}">



                <p style="color:red;direction: rtl">لطفا پیش از ثبت نام،<a href=""> قوانین مسابقه </a>را به طور کامل مطالعه نمایید </p>
            <!--{{URL::asset('storage/pdfs/'.$tournament->rules)}}-->
                <br>
                <button @click="hidden" v-show="!hide" type="submit" class="regButton" id="btnReg">ثبت نام</button>

                <button v-show="hide" class="regButton" id="btnReg" :disabled="true"><i class="fa fa-spinner fa-spin" ></i> در حال ارسال اطلاعات </button>

                <br>
            </form>

    @endif

        <!--<p style="color: red;">لطفا قبل از ثبت نام قوانین مسابقه را بطور کامل مطالعه کنید .</p>-->


</div>
<script>
    new Vue({

        el:'#edit',
        data:{
            hide:false
        },
        methods:{

            hidden:function () {
                this.hide = true
            }
        }

    })
</script>
<style>
.wallDiv {
width: 90%;
height: auto;
margin-left: 5%;
margin-top: 2%;
margin-bottom: 2%;
box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
transition: 0.3s;
border-radius: 5px; /* 5px rounded corners */
display: block;
background-color: white;
direction: rtl;
float: left;

}

.wallDiv h3 {
text-align: center;
font-weight: 400;
}
.wallDiv h4 {
font-weight: 500;
font-size: 150%;
}
.wallDiv h5 {
font-weight: 400;
font-size: 125%;
}

.regButton{
/*float: right;*/
border: 0;
border-radius: 5px;
text-align: center;
cursor: pointer;
font-size:150%;
font-weight: 400;
position: relative;
background-color: #33cc33;
border: none;
padding: 5px;
padding-right: 15px;
padding-left: 15px;
-webkit-transition-duration: 0.4s; /* Safari */
transition-duration: 0.4s;
text-decoration: none;
overflow: hidden;
color: white;
margin: 0 auto;
display: block;
margin-bottom: 5px;
width: 35%;
}

.regButton:hover{
background:#fff;
box-shadow:0px 2px 10px 5px #97B1BF;
color:#000;
}

.regButton:after {
content: "";
background: #4dff4d;
display: block;
position: absolute;
padding-top: 300%;
padding-left: 350%;
margin-left: -20px !important;
margin-top: -120%;
opacity: 0;
transition: all 0.8s
}

.regButton:active:after {
padding: 0;
margin: 0;
opacity: 1;
transition: 0s
}

@media screen and (max-width: 800px) {
.wallDiv h3 {
font-weight: 400;
}
.wallDiv h4 {
font-weight: 400;
font-size: 125%;
}
.wallDiv h5 {
font-weight: 300;
font-size: 100%;
}
label {
font-size: 90%;
}
}
@media screen and (max-width: 600px) {
.wallDiv h3 {
font-weight: 400;
font-size: 125%;
}
.wallDiv h4 {
font-weight: 400;
font-size: 100%;
}
.wallDiv h5 {
font-weight: 300;
font-size: 90%;
}
label {
font-size: 80%;
}
}
</style>
    @endsection