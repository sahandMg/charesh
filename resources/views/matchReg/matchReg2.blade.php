@extends($auth == 1 ? 'masterUserHeader.body' : 'masterHeader.body')
@section('content')
    @include('masterMatch.body',['tournament'=> $tournament,'route'=>$route])
<div class="container" style="direction: rtl;padding-top: 30px; overflow-x: hidden;" id="app" >
    <br>
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

    {{--  New Code  --}}
    <div class="tournoment">
        <div class="tournomentHeader">
            <a href="{{route('organizeProfile',['id'=>$org->name])}}">
                <img src="{{URL::asset('storage/images/'.$org->logo_path)}}">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
            </a>
            <h3> مسابقه {{$tournament->matchName}} </h3>
        </div>
        <div class="banner">
          <img src="{{URL::asset('storage/images/'.$tournament->path)}}">
            <div class="top-right" style="direction: rtl"> {{$tournament->endTimeDays}} روز مانده </div>
            <div class="top-left"><a href="" style="color: white;"><i class="fa fa-share-alt fa-4" aria-hidden="true"></i></a></div>
        </div>
        <div class="tournomentTag">
            @if($tournament->free == 'on')
                <small><i class="fa fa-usd"></i> رایگان  </small>


            @else

                <small><i class="fa fa-usd"></i> {{$tournament->cost}}  تومان </small>
            @endif

            <small><i class="fa fa-calendar"></i> {{$tournament->startTime}} </small>
            <small><i class="fa fa-address-card-o"></i> {{$tournament->mode}} </small>
        </div>
        <hr>
        <div class="tournomentDescription">
            {{--<h6>توضیحات</h6>--}}
            <p>{!!$tournament->comment!!}</p>
        </div>
        <hr>
        <div class="tournomentInfo">
            <div class="column">

                <h6> جوایز </h6>
                <p>{!!$tournament->prize!!}</p>
                {{--<p>نفر دوم 1 ملیون تومان</p>--}}
                {{--<p>نفر سوم 500 هزار تومان</p>--}}
                <hr>
                <div>
                    <div  class="column">
                        <h6> قوانین </h6>
                    <!--{{URL::asset('storage/pdfs/'.$tournament->rules)}}-->
                        <a href="{{URL::asset('storage/pdfs/'.$tournament->rules)}}" style="padding: 15px;"><i class="fa fa-file-pdf-o fa-lg" aria-hidden="true"></i></a>
                    </div>
                    <div  class="column">
                        <button class="btn btn-primary" onclick="document.getElementById('id01').style.display='block'" style="margin-top: 20px;"> ارتباط با برگزار کننده <i style="font-size: 125%;" class="fa fa-paper-plane" aria-hidden="true"></i></button>
                    </div>
                </div>
                <br>

            </div>
            <hr class="line">

              @if($tournament->mode == 'حضوری')
                <div class="column">
                 <h6> محل برگزاری </h6>
                 <p>{{$tournament->address}}</p>
                 <div id="map" class="googleMaps"></div>
                    <br>
                </div>
              @else
                  <style>
                      .column {
                          width: 90%;
                      }
                  </style>
                @endif
                <br>

        </div>
        <br>

        <div class="tournomentRegister">
            <hr>

            @if($tournament->endTime > 0 || $tournament->sold != $tournament->tickets )
                @if(Auth::check())

                    @if(count($users) > 0)
                        <a style="text-decoration: none"  href="{{route('generatePdf',['id'=>$tournament->id ,'matchName'=>$tournament->slug,'name'=>Auth::user()->slug])}}"> <button class="regButton"> دریافت نسخه pdf بلیط مسابقه </button></a>
                    @else
                        <a style="text-decoration: none" href="{{route('overView',['id'=>$tournament,'matchName'=>$tournament->matchName])}}"> <button class="regButton">ثبت نام </button></a>
                    @endif
                @else
                    <a style="text-decoration: none" href="{{route('login')}}"><button class="regButton"> برای شرکت در مسابقه ابتدا وارد شوید</button></a>
                @endif
            @else

                @if(Auth::check())

                    @if(count($users) > 0)
                        <a style="text-decoration: none"  href="{{route('generatePdf',['id'=>$tournament->id ,'matchName'=>$tournament->slug,'name'=>Auth::user()->slug])}}"> <button class="regButton"> دریافت نسخه pdf بلیط مسابقه </button></a>
                    @else
                        <a style="text-decoration: none" href="{{route('overView',['id'=>$tournament,'matchName'=>$tournament->matchName])}}"> <button class="regButton">ثبت نام </button></a>
                    @endif
                @endif

            @endif




        </div>
        <br>
        <br>
    </div>

</div>
<br>
<br>
{{--  Modal Form  --}}
<div id="id01" class="modal">

    <form class="modal-content animate" method="POST" action="{{route('userMessage',['id'=>$tournament->id])}}">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="imgcontainer">
            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
            <h4>ارتباط با برگزار کننده</h4>
            <!--<img src="img_avatar2.png" alt="Avatar" class="avatar">-->
        </div>
        <br>

        <div class="container1" style="direction: rtl;">
            <label><b>نام</b></label>
            <input type="text" placeholder="نام خود را وارد کنید" name="name" required>

            <label><b>ایمیل</b></label>
            <input  type="text" placeholder="ایمیل خود را وارد کنید" name="email" required>

            <div class="form-group ">
                <label> متن پیام </label>
                <textarea class="form-control"  id="summernote" name="message" rows="3"></textarea>
            </div>

            <button type="submit"  class="sendMessage"> ارسال پیام</button>
            <!--<label>-->
            <!--<input type="checkbox" checked="checked"> Remember me-->
            <!--</label>-->
        </div>

        <!--<div class="container" style="background-color:#f1f1f1">-->
        <!--<button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>-->
        <!--<span class="psw">Forgot <a href="#">password?</a></span>-->
        <!--</div>-->
    </form>
</div>

<style>
    .top-right {
        top: 90px;
    }
    @media screen and (max-width: 800px) {
        .top-right {
            top: 75px;
        }
        .top-left {
            top: 65px;
            left: 6px;
            padding: 2px;
            padding-left: 5px;
            padding-right: 5px;
            border-radius: 4px;
        }
    }
    @media screen and (max-width: 600px) {
        .top-right {
            top: 50px;
        }
        .top-left {
            top: 50px;
        }
    }
    .top-left {
        position: absolute;
        top: 80px;
        left: 10px;
        background-color: darkorange;
        padding: 4px;
        padding-left: 8px;
        padding-right: 8px;
        border-radius: 8px;
    }

    /* Full-width input fields */
    input[type=text], input[type=password] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

    /* Set a style for all buttons */
    .sendMessage {
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
    }

    .sendMessage:hover {
        opacity: 0.8;
    }

    /* Extra styles for the cancel button */
    /*.cancelbtn {*/
    /*width: auto;*/
    /*padding: 10px 18px;*/
    /*background-color: #f44336;*/
    /*}*/

    /* Center the image and position the close button */
    .imgcontainer {
        text-align: center;
        margin: 24px 0 12px 0;
        position: relative;
    }
    .container1 {
        padding: 16px;
    }

    span.psw {
        float: right;
        padding-top: 16px;
    }

    /* The Modal (background) */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        padding-top: 60px;
    }

    /* Modal Content/Box */
    .modal-content {
        background-color: #fefefe;
        margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
        border: 1px solid #888;
        width: 80%; /* Could be more or less, depending on screen size */
    }

    /* The Close Button (x) */
    .close {
        position: absolute;
        right: 25px;
        top: 0;
        color: #000;
        font-size: 35px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: red;
        cursor: pointer;
    }

    /* Add Zoom Animation */
    .animate {
        -webkit-animation: animatezoom 0.6s;
        animation: animatezoom 0.6s
    }

    @-webkit-keyframes animatezoom {
        from {-webkit-transform: scale(0)}
        to {-webkit-transform: scale(1)}
    }

    @keyframes animatezoom {
        from {transform: scale(0)}
        to {transform: scale(1)}
    }

    @media screen and (max-width: 800px) {
        .close {
            right: 25px;
            top: 0;
            font-size: 25px;
        }
        /* Full-width input fields */
        input[type=text], input[type=password] {
            width: 100%;
            padding: 6px 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
        }
        /* The Modal (background) */
        .modal {
            padding-top: 40px;
        }
    }
    @media screen and (max-width: 600px) {
        .close {
            right: 25px;
            top: 0;
            font-size: 15px;
        }
        /* Full-width input fields */
        input[type=text], input[type=password] {
            width: 100%;
            padding: 3px 5px;
            margin: 4px 0;
            border: 1px solid #ccc;
        }
        /* The Modal (background) */
        .modal {
            padding-top: 20px;
        }
    }
    /* Change styles for span and cancel button on extra small screens */
    @media screen and (max-width: 300px) {
        span.psw {
            display: block;
            float: none;
        }
    }

</style>

    {{--  End Code --}}
    {{--<div class="card" style="margin-top: 20px;box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);z-index:0;">--}}
     {{--<div>--}}
          {{--<h4 class="card-title" style="padding-top: 10px;padding-right: 10px;padding-left: 10px;float: right;">مسابقه {{$tournament->matchName}}</h4>--}}
         {{--<h4 class="card-title" style="padding-top: 10px;padding-right: 300px;padding-left: 10px;float:right;">تاریخ برگزاری {{$tournament->startTime}}</h4>--}}
         {{--<a href="{{route('organizeProfile',['id'=>$org->slug])}}"> <img src="{{URL::asset('storage/images/'.$org->logo_path)}}" class="rounded" height="35px" style="margin-top: 7px;margin-left: 5px; float: left;" > </a>--}}
          {{--<img src="storage/images/{{$img}}" class="rounded" height="35px" style="margin-top: 7px;margin-left: 5px; float: left;" >--}}
         {{--@if($tournament->endTime == 0)--}}
             {{--<div v-if="showFinishImage">--}}
                 {{--<img   class="card-img-top" src="storage/images/regfinish.png"  style="position: absolute;top: 59px;" >--}}

             {{--</div>--}}

         {{--@endif--}}

         {{--<div class="star-rating" title="{{$org->rating*10}}%" style="padding-top: 13px;float: left;">--}}
              {{--<div class="back-stars">--}}
                  {{--<i class="fa fa-star" aria-hidden="true"></i>--}}
                  {{--<i class="fa fa-star" aria-hidden="true"></i>--}}
                  {{--<i class="fa fa-star" aria-hidden="true"></i>--}}
                  {{--<i class="fa fa-star" aria-hidden="true"></i>--}}
                  {{--<i class="fa fa-star" aria-hidden="true"></i>--}}

                  {{--<div class="front-stars" style="width:{{$org->rating*10}}%">--}}
                      {{--<i class="fa fa-star" aria-hidden="true"></i>--}}
                      {{--<i class="fa fa-star" aria-hidden="true"></i>--}}
                      {{--<i class="fa fa-star" aria-hidden="true"></i>--}}
                      {{--<i class="fa fa-star" aria-hidden="true"></i>--}}
                      {{--<i class="fa fa-star" aria-hidden="true"></i>--}}
                  {{--</div>--}}
              {{--</div>--}}
          {{--</div>--}}
      {{--</div>--}}
      {{--<img class="card-img-top rounded" src="{{URL::asset('storage/images/'.$tournament->path)}}" alt="Card image cap" height="400px;">--}}
      {{--<div class="card-block">--}}
       {{--<div class="row" >--}}
           {{--<span class="badge badge-default">{{$tournament->cost}} تومان</span>--}}
           {{--<span class="badge badge-default">{{$tournament->mode}}</span>--}}
           {{--<span class="badge badge-default">{{$tournament->matchType}}</span>--}}
           {{--<span class="badge badge-default">{{$tournament->attendType}}</span>--}}
           {{--<span class="badge badge-default"> تعداد بلیط های باقی مانده {{$tournament->tickets - $tournament->sold}}</span>--}}

       {{--</div>--}}
          {{--<div class="clock" style="margin:2em;position: relative;left: 230px;"></div>--}}

          {{--<hr>--}}
       {{--<div class="row">--}}
         {{--<div class="col-8">--}}
          {{--<p class="card-text">{!!$tournament->comment!!}</p>--}}
         {{--</div>--}}
         {{--<div class="col-4">--}}
           {{--<p>{{$tournament->email}}</p>--}}
             {{--<p>{{$tournament->telegram}}</p>--}}

         {{--</div>--}}
       {{--</div>--}}

       {{--<hr>--}}
       {{--<div class="card-block">--}}
         {{--<div class="row">--}}
           {{--<div class="col-4">--}}
            {{--<h4>جوایز</h4>--}}
            {{--<br>--}}
             {{--<p style="padding-right: 10px;">{!!$tournament->prize!!}</p>--}}

               {{--<div>--}}
                   {{--<button  @click="copy" type="button" :class="LinkClass">@{{ message }}</button>--}}
                   {{--<input  id="myInput" style="width: 200px;direction: ltr" readonly type="search" v-model="copyLink" value="http://gameinja.com/{{$tournament->url}}">--}}
               {{--</div>--}}
           {{--</div>--}}
           {{--<div class="col-2">--}}
             {{--<h5>قوانین</h5>--}}
             {{--<a href="{{URL::asset('storage/pdfs/'.$tournament->rules)}}" style="padding: 15px;"><i class="fa fa-file-pdf-o fa-lg" aria-hidden="true"></i></a>--}}
           {{--</div>--}}
           {{--@if($tournament->mode == 'حضوری')--}}
             {{--<div class="col-6">--}}
                {{--<h4>محل برگزاری مسابقه</h4>--}}
                {{--<p>{{$tournament->address}}</p>--}}
               {{--<div id="map" style="width:100%;height: 250px;background-color: rgb(229, 227, 223)">--}}
               {{--</div>--}}
                {{--</div>--}}
            {{--@endif--}}


       {{--</div>--}}



            {{-- Check if user has NOT registered --}}
           {{--@if(count($users)== 0 && $auth == 1 && $tournament->endTime > 0 && $tournament->sold != $tournament->tickets)--}}
               {{-- Check single or team --}}
           {{--@if($tournament->matchType == "تیمی")--}}

    {{--<form style="padding-top: 20px;font-size: 20px;" method="post" action="{{route('matchRegister',['username'=>$name])}}" enctype="multipart/form-data">--}}
      {{--<input type="hidden" name="_token" value="{{csrf_token()}}">--}}

        {{--<H1>  مشخصات تیم</H1>--}}
      {{--<button type="button" onclick="removeInput()" class="btn btn-danger" style="margin: 10PX;">-</button>--}}
      {{--<button type="button" onclick="addInput()" class="btn btn-info" style="margin: 10PX;">+</button>--}}

      {{--<div class="form-group row">--}}
        {{--<label for="InputFile" class="col-4 col-form-label">لوگو تیم (100px * 100px) </label>--}}
        {{--<div class="col-6">--}}
          {{--<input name="logo" type="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">--}}
        {{--</div>--}}
      {{--</div>--}}

      {{--<div class="form-group row" id="in1">--}}
        {{--<label for="Name-input" class="col-2 col-form-label"> نام تیم</label>--}}
        {{--<div class="col-5">--}}
         {{--<input name="teamName" class="form-control" type="text" value="" id="example-text-input">--}}
       {{--</div>--}}
      {{--</div>--}}

        {{--@if($tournament->matchType == "تیمی")--}}
            {{--<div>--}}
                {{--<label for="InputFile" class="col-4 col-form-label" id="afterName">لوگو (100px * 100px) </label>--}}

                {{--<div class="col-6">--}}
                    {{--<br>--}}

                    {{--<input name="TeamLogo" type="file"   class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--@endif--}}
        {{--<input type="hidden" name="matchId" value="{{$tournament->id}}">--}}

        {{--<div class="form-group row" id="in2">--}}
        {{--<label for="Name-input" class="col-2 col-form-label"> 2 هم تیمی  </label>--}}
        {{--<div class="col-5">--}}
         {{--<input name="teammate2" class="form-control" type="text" value="" id="example-text-input">--}}
       {{--</div>--}}
      {{--</div>--}}

      {{--<div class="form-group row" id="in3">--}}
        {{--<label for="Name-input" class="col-2 col-form-label"> 3 هم تیمی </label>--}}
        {{--<div class="col-5">--}}
         {{--<input name="teammate3" class="form-control" type="text" id="example-text-input">--}}
       {{--</div>--}}
      {{--</div>   --}}
      {{--<!-- tozihate digee ke bargozar konnade mikhad -->--}}

        {{--<div class="form-group row" id="in1">--}}
            {{--<label for="Name-input" class="col-2 col-form-label">  سرگروه</label>--}}
            {{--<div class="col-5">--}}
                {{--<input name="teammate0" placeholder="نام کاربری" class="form-control" type="text" value="" id="example-text-input">--}}
            {{--</div>--}}
        {{--</div>--}}
      {{--<br>--}}
        {{--@if(count($tournament->moreInfo)>0)--}}
      {{--<div class="form-group">--}}
        {{--<label for="InputFile">{!!$tournament->moreInfo!!}</label>--}}
        {{--<br>--}}
        {{--<br>--}}

              {{--<h4>اطلاعات درخواست شده در قسمت پایین وارد کنید</h4>--}}
        {{--<div>--}}
         {{--<textarea name="additionalData" class="form-control" id="summernote" rows="10"></textarea>--}}
        {{--</div>--}}


       {{--</div>--}}
        {{--@endif--}}


        {{--<p style="color: red;">لطفا قبل از ثبت نام قوانین مسابقه را بطور کامل مطالعه کنید .</p>--}}
        {{--<p style="color:red;direction: rtl">لطفا پیش از ثبت نام،<a href="{{URL::asset('storage/pdfs/'.$tournament->rules)}}"> قوانین مسابقه </a>را به طور کامل مطالعه نمایید </p>--}}

        {{--<br>--}}
       {{--<button type="submit" class="btn btn-success" id="btnReg">ثبت نام</button>--}}



      {{--</form>--}}


               {{-- Single --}}
               {{--@else--}}

               {{--@if($tournament->endTime > 0)--}}

               {{--<form style="padding-top: 20px;font-size: 20px;" method="post" action="{{route('matchRegister',['username'=>$name])}}" enctype="multipart/form-data">--}}
                   {{--<input type="hidden" name="_token" value="{{csrf_token()}}">--}}




                   {{--<!-- tozihate digee ke bargozar konnade mikhad -->--}}
                   {{--<br>--}}

                   {{--<br>--}}
                   {{--<div class="form-group">--}}
                       {{--<label for="InputFile">{!!$tournament->moreInfo!!}</label>--}}
                       {{--<br>--}}
                       {{--<br>--}}
                       {{--@if(count($tournament->moreInfo)>0)--}}
                           {{--<h4>اطلاعات درخواست شده در متن زیر را نیز در پایین وارد کنید</h4>--}}
                           {{--<div>--}}
                               {{--<textarea id="summernote" name="additionalData" class="form-control" id="exampleTextarea" rows="10" placeholder="text editor"></textarea>--}}
                           {{--</div>--}}
                       {{--@endif--}}

                   {{--</div>--}}
                   {{--<br>--}}
                   {{--<input type="hidden" name="single" value="single">--}}
                   {{--<input type="hidden" name="name" value="{{$tournament->matchName}}">--}}
                   {{--<input type="hidden" name="id" value="{{$tournament->id}}">--}}
                   {{--<p style="color:red;direction: rtl">لطفا پیش از ثبت نام،<a href="{{URL::asset('storage/pdfs/'.$tournament->rules)}}"> قوانین مسابقه </a>را به طور کامل مطالعه نمایید </p>--}}
                   {{--<p style="color: red;">لطفا قبل از ثبت نام قوانین مسابقه رو بطور کامل مطالعه کنید .</p>--}}
                   {{--<button type="submit" class="btn btn-success" id="btnReg">ثبت نام</button>--}}

               {{--</form>--}}

                {{--@endif--}}
           {{--@endif--}}

               {{--@elseif(count($users) > 0)--}}

               {{--<a href="{{route('generatePdf',['id'=>$tournament->id ,'matchName'=>$tournament->slug,'name'=>Auth::user()->slug])}}">دریافت نسخه pdf بلیط مسابقه </a>--}}


           {{--@elseif($auth == 0)--}}
           {{--<a href="{{route('login')}}">برای شرکت در مسابقه ابتدا وارد شوید</a>--}}
        {{--@endif--}}
       {{--</div>--}}
    {{--</div>--}}



 {{--</div>--}}








<script src="{{URL::asset('js/flipclock.js')}}"></script>

<script>

    vm = new Vue({

        el:'#app',
        data:{
            list:[''],
            time:"",
            name:'',
            message:'',
            email:'',
            showFinishImage:false,
            id:'',
            team : false,
            link:'',
            count:4,
            username:'',
            copyLink:'',
            LinkClass:'btn btn-success'

        },

        created:function () {


                var j = 1
                    for(var i = 0 ; i< {!! json_encode($tournament->minMember) !!} ; i++) {



                            $('<div id="in' + i + '" class="form-group row">  <label for="Name-input" class="col-2 col-form-label">  هم تیمی ' + j  + '   </label><div class="col-5"> <input @input="checkInput"  name="teammate' + i + '" class="form-control" type="text"  id="number'+i+'">  </div></div>').insertBefore("#afterName");
//                        document.getElementById("in"+i).addEventListener("input", this.checkInput);
//                        document.getElementById("in"+i).getElementsByTagName('input')[0].addEventListener("blur", this.checkUser(i));


                    j++
                    }

//
            if({!! json_encode($tournament->endTime == 0) !!}) {

                this.showFinishImage = true

            }else {

                this.showFinishImage = false
            }


            if( {!! json_encode($tournament->matchType == "تیمی") !!}){

                this.team = true

            }

            var time = {!! json_encode($tournament->endTime) !!};
            var clock;

            $(document).ready(function() {

                // Grab the current date
                var currentDate = new Date();

                // Set some date in the future. In this case, it's always Jan 1
                var futureDate  = new Date(currentDate.getFullYear() + 1, 0, 1);

                // Calculate the difference in seconds between the future and current date
                var diff = Number(time);

                // Instantiate a coutdown FlipClock
                clock = $('.clock').FlipClock(diff, {
                    clockFace: 'DailyCounter',
                    countdown: true
                });
            });


            setTimeout(this.checkTime , 100)



        },
        methods:{


            copy:function () {


                copyText = document.getElementById("myInput");
                copyText.select();
                document.execCommand("Copy");
                this.LinkClass = 'btn btn-danger';
                this.message = 'لینک دعوت کپی شد'


            },


            checkTime:function() {



                var label = document.getElementsByClassName("flip-clock-label");

                for(var i=0 ; i< label.length ; i++){

                    label[i].innerHTML = ' '


                }
//
                var counters = document.getElementsByClassName("inn");


                for(var i=0 ; i< counters.length ; i++) {


                    if (counters[i].innerHTML > 0) {

                        var t = 1

                    }
                }

//                if(t == 0){
//
//                    this.showFinishImage = true
//
//                }

            }

        }
    })


</script>


 {{--<script type="text/javascript" src="js/jquery-3.2.1.js"></script>--}}
 {{--<script type="text/javascript" src="js/main.js"></script>--}}
 {{--<script type="text/javascript" src="js/bootstrap.js"></script>--}}
 <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOUQbmEcxW09DMfiP8SR96YclW5S87qec&callback=myMap">
 </script>
 <script>




 var g = {!! $tournament->minMember !!}

// var maxTeamMember = 5 ;
// var minTeamMember = 3 ;

 function addInput() {
  if(g < {!! json_encode($tournament->maxMember) !!})
  {
    g++;
      var s = g-1
      $('<div id="in' + g + '" class="form-group row">  <label for="Name-input" class="col-2 col-form-label">  هم تیمی ' + g  + '   </label><div class="col-5"> <input @iput="checkInput"   name="teammate' + s + '" class="form-control" type="text"  id="number'+g+'">  </div></div>').insertBefore("#afterName");
  } else {
    alert('حداکثر تعداد اعضای تیم ' + {!! json_encode($tournament->maxMember) !!} +' نفر می باشد.');
  }

 };

 function removeInput() {
  if ({!! json_encode($tournament->minMember) !!} < g) {
   $('#in' + g).remove();
   g--;
  }

 else {
    alert('حداقل تعداد اعضای تیم ' + {!! json_encode($tournament->minMember) !!} +' نفر می باشد.');
  }
     };





  function myMap() {
   var mapCanvas = document.getElementById("map");
  var myCenter = new google.maps.LatLng({!! json_encode($tournament->lat) !!},{!! json_encode($tournament->lng) !!});
  var mapOptions = {center: myCenter, zoom: 15};
  var map = new google.maps.Map(mapCanvas,mapOptions);
  var marker = new google.maps.Marker({
    position: myCenter,
    animation: google.maps.Animation.BOUNCE
  });
  marker.setMap(map);
  }
  </script>


@endsection
