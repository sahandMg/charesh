@extends('masterUserHeader.body')
@section('content')

  <div class="row" style=" direction: rtl;" id="app">
    <!-- right menu -->
      <div class="Vnav">
          <ul>
              <li><a class="active" href="{{route('orgMatches',['orgName'=>$name->organize->slug])}}">پنل مدیریت</a></li>
              <li><a href="{{route('matchCreate')}}">مسابقه جدید</a></li>
              <li><a href="{{route('orgEdit',['orgName'=>$name->organize->slug])}}">ﻭیرایش اطلاعات من</a></li>
              <li><a href="{{route('organizeAccount',['orgName'=>$name->organize->slug])}}"> حساب من</a></li>
	</ul>
      </div>
  <!-- content -->
   <div class="container">

    <br>
       @include('masterOrganize.body',['tournament'=> $tournament,'route'=>$route])

       <br>
    <br>
<div v-if="select">
<center>

  <h3 style="padding: 30px;">نحوه برگزاری مسابقه</h3>


    <div class="sub-main">
        <a href="{{route('groupBracket',['id'=>$tournament->id,'matchName'=>$tournament->slug])}}"><button   class="button-one">  گروهی - حذفی</button></a>
    </div>

    <div class="sub-main">
        <a href="{{route('ElBracket2',['id'=>$tournament->id,'matchName'=>$tournament->slug])}}"><button   class="button-two">  حذفی</button></a>
    </div>

    <div class="sub-main">
        <a href="{{route('leagueBracket',['id'=>$tournament->id,'matchName'=>$tournament->slug])}}"><button class="button-three">لیگ</button></a>
   </div>

  </center>

    </div>
       {{-- group - elimination --}}




</div>


  </div>




  <script type="text/javascript" src="{{URL::asset('js/main.js')}}"></script>
  <script type="text/javascript" src="{{URL::asset('js/bootstrap.js')}}"></script>

  {{--<script>--}}
      {{--new Vue({--}}

          {{--el:"#app",--}}
          {{--data:{--}}

              {{--groupEl:false,--}}


          {{--},--}}

          {{--methods:{--}}


{{--//--}}
              {{--run:function () {--}}
{{--//alert('dsa')--}}
                  {{--if({!! json_encode($tournament->matchType) !!}  ==  'انفرادی')--}}
                  {{--{--}}
                    {{--alert('مسابقه، انفرادی می باشد')--}}

                      {{--this.groupEl = true--}}
                  {{--}--}}

              {{--},--}}


          {{--},--}}

          {{--created:function () {--}}



          {{--}--}}




      {{--})--}}
  {{--</script>--}}

  <style>
    .Vnav {
      margin-top: 20px;
      margin-right: 40px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 0.5;
      background-color: #f1f1f1;
      max-height: 200px;
    }

    .Vnav ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        width: 200px;
        background-color: #f1f1f1;

    }

    .Vnav li a {
        display: block;
        color: #000;
        padding: 8px 16px;
        text-decoration: none;
    }

    .Vnav li a.active {
        background-color: #008CBA;
        color: white;
    }

    .Vnav li a:hover:not(.active) {
        background-color: #555;
        color: white;
    }
  </style>
<style type="text/css">

button {
  color:#fff;
  text-align: center;
  padding: 20px;
}


.sub-main{
  /*width: 10%;*/
  margin:22px;
  /*float: left;*/
}

.button-three , .button-two , .button-one {
  text-align: center;
  cursor: pointer;
  font-size:24px;
}

/*Button Three*/
.button-three {
    position: relative;
    background-color: #f39c12;
    border: none;
    padding: 20px;
    width: 200px;
    text-align: center;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
    text-decoration: none;
    overflow: hidden;
}

.button-three:hover{
   background:#fff;
   box-shadow:0px 2px 10px 5px #97B1BF;
   color:#000;
}

.button-three:after {
    content: "";
    background: #f1c40f;
    display: block;
    position: absolute;
    padding-top: 300%;
    padding-left: 350%;
    margin-left: -20px !important;
    margin-top: -120%;
    opacity: 0;
    transition: all 0.8s
}

.button-three:active:after {
    padding: 0;
    margin: 0;
    opacity: 1;
    transition: 0s
}
/*Button two*/
.button-two {
    position: relative;
    background-color: #7999a9;
    border: none;
    padding: 20px;
    width: 200px;
    text-align: center;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
    text-decoration: none;
    overflow: hidden;
}

.button-two:hover{
   background:#fff;
   box-shadow:0px 2px 10px 5px #97B1BF;
   color:#000;
}

.button-two:after {
    content: "";
    background: #f1c40f;
    display: block;
    position: absolute;
    padding-top: 300%;
    padding-left: 350%;
    margin-left: -20px !important;
    margin-top: -120%;
    opacity: 0;
    transition: all 0.8s
}

.button-two:active:after {
    padding: 0;
    margin: 0;
    opacity: 1;
    transition: 0s
}
/*Button one*/
.button-one {
    position: relative;
    background-color: #353866;
    border: none;
    padding: 20px;
    width: 200px;
    text-align: center;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
    text-decoration: none;
    overflow: hidden;
}

.button-one:hover{
   background:#fff;
   box-shadow:0px 2px 10px 5px #97B1BF;
   color:#000;
}

.button-one:after {
    content: "";
    background: #f1c40f;
    display: block;
    position: absolute;
    padding-top: 300%;
    padding-left: 350%;
    margin-left: -20px !important;
    margin-top: -120%;
    opacity: 0;
    transition: all 0.8s
}

.button-one:active:after {
    padding: 0;
    margin: 0;
    opacity: 1;
    transition: 0s
}
</style>


 <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOUQbmEcxW09DMfiP8SR96YclW5S87qec&callback=myMap">
 </script>
 <script>



  function myMap() {
  var mapOptions = {
      center: new google.maps.LatLng(51.5, -0.12),
      zoom: 10,
      mapTypeId: google.maps.MapTypeId.HYBRID
  }
  var map = new google.maps.Map(document.getElementById("map"), mapOptions);
  }


  $({countNum: $('#counter').text()}).animate({countNum: 100}, {
    duration: 1000,
    easing:'linear',
    step: function() {
      $('#counter').text(Math.floor(this.countNum));
    },
    complete: function() {
      $('#counter').text("100");
    }
  });
  </script>



@endsection






