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
    <br>
    <!-- Send message -->
    <div class="card" style=" box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);z-index: 0.5;padding: 20px;margin-top: 20px;">

       <h2> شرکت کنندگان</h2>

        {{--Team--}}
        @if(count($teams)>0)
        @foreach($teams as $team)
          <div class="row" style="padding: 25px;float: left;direction: ltr;">
           <img class="card-img-top rounded" src="../../public/storage/images/{{$team->path}}" alt="Card image cap" height="50px;">
           <h3 style="padding: 8px;"> {{$team->teamName}} </h3>
          </div>
          <div class="row" style="border: 2px solid;border-radius: 10px;">

            <div class="col-5">
                <p><strong>اعضای تیم   </strong></p>
                @for($i=0 ; $i < count($team->groups);$i++)
              <p>{{$team->groups[$i]->name}}</p>
                    @endfor
            </div>
            <div class="col-7">
                <p><strong>توضیحات</strong></p>
              <p>{!!$team->match->moreInfo!!}</p>
            </div>
          </div>
        @endforeach

        {{--Single--}}
        @else

            @foreach($matches as $match)
                <div class="row" style="padding: 25px;float: left;direction: ltr;">
                    <img class="card-img-top rounded" src="../../public/storage/images/{{$match->user->path}}" alt="Card image cap" height="50px;">

                </div>
                <div class="row" style="border: 2px solid;border-radius: 10px;">

                    <div class="col-5">
                        <p><strong> نام شرکت کننده </strong></p>

                            <p>{{$match->user->username}}</p>

                    </div>
                    <div class="col-7">
                        <p><strong>توضیحات</strong></p>
                        <p>{!!$match->moreInfo!!}</p>
                    </div>
                </div>
            @endforeach

        @endif

    </div>
    <br>
    <br>
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