@extends('masterUserHeader.body')
@section('content')
    <ul class="nav nav-tabs">

        <li class="disabled"><a href=""> اطلاعات ثبت نام </a></li>

        <li class="disabled"><a href=""> قوانین </a></li>
        <li class="disabled"><a href=""> اطلاعات مسابقه </a></li>
        <li class="active"><a href="">اطلاعات پایه</a></li>
    </ul>
 <div class="container" style="direction: rtl;width: 80%;" id="app">


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

    <div class="form-group">
           <label for="Name-input">تاریخ شروع مسابقه : </label>
           <div>
               <input style="float: right;margin-left: 1%;width: 30%;" type="number" min="1" max="31" class="form-control" @input="check"  :style="style3" v-model="startDay" placeholder="روز" name="startDay" type="text" value="" id="example-text-input">
               <select name="startMonth" v-model="startMonth" style="float: right;margin-left: 1%;width: 30%;" class="form-control" id="sel1">
                   <option>فروردین</option>
                   <option>اردیبهشت</option>
                   <option>خرداد</option>
                   <option>تیر</option>
                   <option>مرداد</option>
                   <option>شهریور</option>
                   <option>مهر</option>
                   <option>آبان</option>
                   <option>آذر</option>
                   <option>دی</option>
                   <option>بهمن</option>
                   <option>اسفند</option>
               </select>
               <select name="startYear" v-model="startYear" style="float: right;margin-left: 1%;width: 30%;" class="form-control" id="sel2">
                   <option>1396</option>
                   <option>1397</option>
               </select>
           </div>
       </div>
       <br>
  <div class="form-group">
    <label for="InputFile">توضیحات ضروری (تکمیل شود) : </label>
    <textarea class="form-control"  name="comment" id="summernote" rows="3"></textarea>
   </div>

   <div class="form-group row">
    <label for="InputFile" class="col-2 col-form-label" style="font-size: 18px">عکس بنر مسابقه<p style="font-size: 16px">(1290px * 600px)</p></label>
    <div class="col-5">
     <input type="file" class="form-control-file" name="path" style="font-size:15px" id="exampleInputFile" aria-describedby="fileHelp">
    </div>
   </div>
       <a href="{{url(\App\Url::where('token',csrf_token())->first()->pageUrl)}}"><button   type="button" class="btn btn-danger">انصراف</button></a>

       <button :disabled="next"  type="submit" class="btn btn-primary">ادامه</button>

  </form>
</div>

 <style>
        .nav-tabs li {
            width: 20%;
            font-size: 100%;
            font-weight: 400;
        }
        @media screen and (max-width: 800px) {
            .nav-tabs li {
                font-size: 80%;
                font-weight: 400;
            }
        }
        @media screen and (max-width: 600px) {
            .nav-tabs li {
                font-size: 50%;
                font-weight: 400;
            }
        }
    </style>


 <script>


 vm = new Vue({

 el:'#app',
 data:{

 matchName:'',
 url:'',
 startTime:'',
 endTime:'',
 comment:'',
     startDay:'',
     startMonth:'فروردین',
     startYear:'1396',

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
 if(this.endTime.length > 0 && this.startDay.length > 0 && this.startMonth.length > 0 && this.startYear.length > 0 &&  this.matchName.length > 0){

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