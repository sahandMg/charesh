@extends('masterUserHeader.body')
@section('content')
 <div class="container" style="direction: rtl;" id="app">

  <nav class="nav nav-pills nav-fill" style="padding-top: 50px;">
    <a class="nav-item nav-link active" href="#">اطلاعات پایه</a>
    <a class="nav-item nav-link disabled" href="#">اطلاعات مسابقه</a>
    <a class="nav-item nav-link disabled" href="#">قوانین</a>
    <a class="nav-item nav-link disabled" href="#">برنامه مسابقات</a>
    <a class="nav-item nav-link disabled" href="#">اطلاعات ثبت نام</a>
    <a class="nav-item nav-link disabled" href="#">راه های ارتباطی</a>
  </nav>

   <form style="padding-top: 20px;font-size: 20px;" method="POST" action="{{route('baseInfo')}}" enctype="multipart/form-data">
       <input type="hidden" name="_token" value="{{csrf_token()}}">

    <!-- ٍٍError message -->
     @if(count($errors->all()))
      <div class="alert alert-danger" role="alert">
          @foreach($errors->all() as $error)

              <li>{{$error}}</li>

              @endforeach
      </div>
    @endif

    <div class="form-group row">
      <label for="Name-input" class="col-2 col-form-label">نام مسابقه : </label>
      <div class="col-5">
       <input name="matchName" @input="check"   :style="style1" v-model="matchName" class="form-control" type="text" value="{{Request::old('matchName')}}" id="example-text-input">
     </div>
    </div>

    {{--<div class="form-group row">--}}
      {{--<label for="Name-input" class="col-2 col-form-label">آدرس (url) :  </label>--}}
      {{--<div class="col-5">--}}
       {{--<input name="url" @input="check"   :style="style2" v-model="url" class="form-control" type="text" value="{{Request::old('url')}}" id="example-text-input">--}}
     {{--</div>--}}
        {{--<label for="Name-input"  class="col-3 col-form-label" style="font-size: 25px;">/www.x.com  </label>--}}
    {{--</div>--}}

    <div class="form-group row" >
      <label for="Name-input" class="col-2 col-form-label">زمان پایان ثبت نام : </label>
      <div class="col-5">
       <input class="form-control" @input="check" :style="style4" v-model="endTime" name="endTime" type="number" min="1" value="{{Request::old('matchName')}}" placeholder="به روز وارد نمایید ، مثلا : 20 " id="example-text-input">
     </div>
    </div>

    <div class="form-group row">
           <label for="Name-input" class="col-2 col-form-label">تاریخ شروع مسابقه : </label>
           <div class="col-5">
               <input class="form-control" @input="check"  :style="style3" v-model="startTime" name="startTime" type="text" placeholder="yyyy/mm/dd" value="{{Request::old('startTime')}}" id="example-text-input">
           </div>
       </div>

  <div class="form-group row">
    <label for="InputFile" class="col-2 col-form-label">توضیحات : </label>
    <div class="col-5">
     <textarea class="form-control"  name="comment" id="summernote" rows="3"></textarea>
    </div>
   </div>

   <div class="form-group row">
    <label for="InputFile" class="col-2 col-form-label" style="font-size: 18px">عکس بنر مسابقه<p style="font-size: 16px">(1290px * 600px)</p></label>
    <div class="col-5">
     <input type="file" class="form-control-file" name="path" style="font-size:15px" id="exampleInputFile" aria-describedby="fileHelp">
    </div>
   </div>
       <a href="{{route('orgMatches',['orgName'=>$name->organize->name])}}"><button   type="button" class="btn btn-danger">انصراف</button></a>

       <button :disabled="next"  type="submit" class="btn btn-primary">ادامه</button>

  </form>
</div>

 <script>


 vm = new Vue({

 el:'#app',
 data:{

 matchName:'',
 url:'',
 startTime:'',
 endTime:'',
 comment:'',
 style1:{borderColor:'#d9d9d9',borderStyle:'solid'},
 style2:{borderColor:'#d9d9d9',borderStyle:'solid'},
 style3:{borderColor:'#d9d9d9',borderStyle:'solid'},
 style4:{borderColor:'#d9d9d9',borderStyle:'solid'},
 style5:{borderColor:'#d9d9d9',borderStyle:'solid'},
 next:true,


 },
 methods:{

 check:function () {


//     document.getElementsByClassName('nicEdit-main')[0].addEventListener('input',this.check)
//     this.comment = document.getElementsByClassName('nicEdit-main')[0].innerHTML
// console.log(this.comment)
 if(this.endTime.length > 0 && this.startTime.length > 0  && this.matchName.length > 0){

 this.next = false
 }else{

 this.next = true

 }


 },

 }

 })


 </script>


</div>

 <script type="text/javascript" src="{{URL::asset('js/bootstrap.js')}}"></script>
@endsection