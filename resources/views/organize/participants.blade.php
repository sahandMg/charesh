@extends('masterUserHeader.body')
@section('content')

    @include('masterOrganize.body',['tournament'=> $tournament,'route'=>$route])
  <div class="container">
    <div class="wallDiv">
       <h3> شرکت کنندگان</h3>
        <br>
        <a href="{{route('CheckList',['id'=>$tournament->id,'matchName'=>$tournament->slug])}}"><button class="btn btn-info">دریافت چک لیست شرکت کنندگان</button></a>
        <br>
        <br>
        @if(count($teams)>0)
          @foreach($teams as $team)
                <div class="team">
                    <img src="{{URL::asset('storage/images/'.$team->path)}}">
                    <b>{{$team->teamName}}</b>
                </div>
           {{--<div class="row" style="padding: 25px;float: left;direction: ltr;">--}}
            {{--<img class="card-img-top rounded" src="{{URL::asset('storage/images/'.$team->path)}}" alt="Card image cap" height="50px;">--}}
            {{--<h3 style="padding: 8px;"> {{$team->teamName}} </h3>--}}
           {{--</div>--}}
           {{--<div class="row" style="border: 2px solid;border-radius: 10px;">--}}

             {{--<div class="col-5">--}}
                 {{--<p><strong>اعضای تیم   </strong></p>--}}
                 {{--@for($i=0 ; $i < count($team->groups);$i++)--}}
               {{--<p>{{$team->groups[$i]->name}}</p>--}}
                    {{--@endfor--}}
              {{--</div>--}}
              {{--<div class="col-7">--}}
                 {{--<p><strong>توضیحات</strong></p>--}}
               {{--<p>{!!$team->match->moreInfo!!}</p>--}}
             {{--</div>--}}
           {{--</div>--}}
         @endforeach
        @else

            @foreach($matches as $match)
                <div class="team">
                    <img src="{{URL::asset('storage/images/'.$match->user->path)}}">
                    <b>{{$match->user->username}}</b>
                </div>
                {{--<div class="row" style="padding: 25px;float: left;direction: ltr;">--}}
                    {{--<img class="card-img-top rounded" src="{{URL::asset('storage/images/'.$match->user->path)}}" alt="Card image cap" height="50px;">--}}

                {{--</div>--}}
                {{--<div class="row" style="border: 2px solid;border-radius: 10px;">--}}

                    {{--<div class="col-5">--}}
                        {{--<p><strong> نام شرکت کننده </strong></p>--}}

                            {{--<p>{{$match->user->username}}</p>--}}

                    {{--</div>--}}
                    {{--<div class="col-7">--}}
                        {{--<p><strong>توضیحات</strong></p>--}}
                        {{--<p>{!!$match->moreInfo!!}</p>--}}
                    {{--</div>--}}
                {{--</div>--}}
            @endforeach

        @endif

    </div>
    <br>
    <br>


  
  </div> 



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
          padding: 1%;
          text-align: center;

      }
      .wallDiv h3 {
          text-align: center;
          font-weight: bold;
      }
      .team {
          width: 20%;
          float: left;
          direction: ltr;
          margin-bottom: 1%;
      }
      .team img {
          height: 100px;
          width: 100px;
      }
      .team b {
          font-weight: bold;
      }
      @media screen and (max-width: 1000px) {
          .team {
              width: 25%;
          }
          .team img {
              height: 80px;
              width: 80px;
          }
          .wallDiv h3 {

          }
      }

      @media screen and (max-width: 800px) {
          .team {
              width: 25%;
          }
          .team b {
              font-size: 100%;
          }
          .team img {
              height: 60px;
              width: 60px;
          }
          .wallDiv h3 {
              font-size: 150%;
          }
      }

      @media screen and (max-width: 600px) {
          .team {
              width: 50%;
          }
          .team img {
              height: 40px;
              width: 40px;
          }
          .wallDiv h3 {
              font-size: 100%;
          }
          .team b {
              font-size: 75%;
          }
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
