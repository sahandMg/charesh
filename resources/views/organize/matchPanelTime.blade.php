@extends('masterUserHeader.body')
@section('content')

  <div class="row" style=" direction: rtl;">
    <!-- right menu -->
      <div class="Vnav">
          <ul>
              <li><a class="active" href="{{route('orgMatches')}}">پنل مدیریت</a></li>
              <li><a href="{{route('matchCreate')}}">مسابقه جدید</a></li>
              <li><a href="{{route('orgEdit')}}">ویرایش اطلاعات من</a></li>
              <li><a href="{{route('organizeAccount')}}">حساب من</a></li>
          </ul>
      </div>
  <!-- content -->
   <div class="container">
    <br>
       @include('masterOrganize.body',['tournament'=> $tournament,'route'=>$route])

       <br>

       @if(count($errors->all()))

           <div class="alert alert-danger" role="alert">


               @foreach($errors->all() as $error)

                   <li>{{$error}}</li>

               @endforeach
           </div>

       @endif


   @if(count(session('message')))

           <div class="alert alert-success" role="alert">

               <li>{{session('message')}}</li>

           </div>

       @endif


    <!-- Time Text Editor -->

        <form style="padding: 20px;" method="POST" action="{{route('challengeTime',['id'=>$tournament->id,'url'=>$tournament->code])}}">

                 <input type="hidden" name="_token" value="{{csrf_token()}}">



       <div class="card row" style=" box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);z-index: 0.5;padding: 20px;margin-top: 20px;">
        <textarea name="timeline" id="summernote" cols="30" rows="10"></textarea>
    </div>
            <br>
            <button type="submit" class="btn btn-primary"> ذخیره </button>
        </form>
   </div>


  </div> 



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

 {{--<script type="text/javascript" src="js/jquery-3.2.1.js"></script>--}}
 <script type="text/javascript" src="../../public/js/main.js"></script>
 <script type="text/javascript" src="../../public/js/bootstrap.js"></script>
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