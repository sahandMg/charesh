@extends('masterUserHeader.body')
@section('content')

    <div class="row" style=" direction: rtl;" id="app">
        <!— right menu —>
        <div class="col-2">
            <ul class="Vnav">
                <li><a class="active" href="{{route('orgMatches',['orgName'=>$name->organize->name])}}">پنل مدیریت</a></li>
                <li><a href="{{route('matchCreate')}}">مسابقه جدید</a></li>
                <li><a href="{{route('orgEdit',['orgName'=>$name->organize->name])}}">ﻭیرایش اطلاعات من</a></li>
                <li><a href="{{route('organizeAccount',['orgName'=>$name->organize->name])}}"> حساب من</a></li>
            </ul>
        </div>
        <!— content —>
        <div class="container col-8">
    <br>
       @include('masterOrganize.body',['tournament'=> $tournament,'route'=>$route])

       <br>
    <br>
    <!-- Send message -->
    <div class="card row" style=" box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);z-index: 0.5;padding: 20px;margin-top: 20px;">
            <h2>فرستادن پیام به شرکت کنندگان در مسابقه</h2>
        @if(count(session('message')))
        <div class="alert alert-success ">
            {{session('message')}}
        </div>
        @endif
     <form method="post" action="{{route('challengeMessage',['id'=>$tournament,'matchName'=>$tournament->matchName])}}">
         <input type="hidden" name="_token" value="{{csrf_token()}}">
         @if(count($errors->all()))
             <div class="alert alert-danger" role="alert">
                 @foreach($errors->all() as $error)

                     <li>{{$error}}</li>

                 @endforeach
             </div>

         @endif
         <textarea name="message" id="summernote" cols="100" rows="6"></textarea>

      <div class="form-group">
	      <div class="col-5">
              @if($tournament->matchType == 'تیمی')
              <select @change="check" v-model="mode" name="team" class="form-control form-control-lg" style="height: 35px;padding: 0px;padding-right: 5px;" id="mySelect">
              <option disabled>انتخاب ...</option>



              <option value="all">همه تیم ها</option>
               @foreach($teams as $team)
	             <option >{{$team->teamName}}</option>
                   @endforeach


                   </select>

                      @endif

                      @if($tournament->matchType == 'انفرادی')
                      <select @change="check" v-model="mode" name="user" class="form-control form-control-lg" style="height: 35px;padding: 0px;padding-right: 5px;" id="mySelect">
                      <option disabled>انتخاب ...</option>



                          <option value="all">همه شرکت کنندگان</option>

                          @for($i=0;$i<count($username);$i++)

                              <option >{{$username[$i]}}</option>

                              @endfor

                              </select>

                              @endif








	     </div>
    </div>
         <input type="submit" class="btn btn-primary" value="ارسال پیام">
     </form> 
    </div>
   </div>

  
  </div> 


  <script>
//      new Vue({
//      el:"#app",
//      data:{
//          list:['']
//
//      },
//          created:function () {
//
//          vm = this
//              axios.get('/get-teams').then(function (response) {
//
//                  vm.list = response.data
//          })
//          }
//      })
  </script>
  <style>
      .Vnav {
          margin-top: 20px;
          margin-right: 40px;
          box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
          z-index: 0.1;
          background-color: #f1f1f1;
          max-height: 200px;
          list-style-type: none;
          /*margin: 0;*/
          padding: 0;
          width: 200px;
          /*background-color: #f1f1f1;*/
      }


      .Vnav li a {
          display: block;
          color: #000;
          padding: 8px 16px;
          text-decoration: none;
      }

      .Vnav li.active {
          background-color: #008CBA;
          color: white;
      }

      .Vnav li a:hover:not(.active) {
          background-color: #555;
          color: white;
      }
  </style>

 {{--<script type="text/javascript" src="js/jquery-3.2.1.js"></script>--}}
    <script type="text/javascript" src="{{URL::asset('js/main.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/bootstrap.js')}}"></script>
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

  </script>

@endsection