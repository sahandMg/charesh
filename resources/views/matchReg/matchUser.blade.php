@extends($auth == 1 ? 'masterUserHeader.body' : 'masterHeader.body')
@section('content')
    @include('masterMatch.body',['tournament'=> $tournament,'route'=>$route])
  <div class="container">
    <div class="wallDiv">
        <br>
        <h3>شرکت کنندگان</h3>
        <br>
        @if($tournament->matchType == 'انفرادی')

            @for($i=0 ; $i< count($player);$i++)
                <div class="team">
                    <img src="{{URL::asset('storage/images/'.$player[$i]->path)}}">
                    <b>{{$player[$i]->username}}</b>
                </div>
            @endfor
        @else
            @for($i=0 ; $i< count($team);$i++)
                <div class="team">
                    <img src="{{URL::asset('storage/images/'.$team[$i]->path)}}">
                    <b>{{$team[$i]->teamName}}</b>
                </div>
            @endfor
        @endif

    </div>
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
{{--<div class="container" style="direction: rtl;padding-top: 30px;">--}}


   {{--<img src="{{URL::asset('images/participants.jpg')}}" style="margin: auto;display: block;margin-top: 2%;max-width: 80%;">--}}
   {{--<div class="row" style="padding-top: 30px;direction: ltr;width: 90%;margin: auto;">--}}


       {{--@if($tournament->matchType == 'انفرادی')--}}

           {{--@for($i=0 ; $i< count($player);$i++)--}}

            {{--<div class="row" style="padding: 25px;float: left;">--}}
              {{--<img class="card-img-top rounded" style="float: left;" src="{{URL::asset('storage/images/'.$player[$i]->path)}}" alt="Card image cap" >--}}
              {{--<h3 style="float: left;margin-top: 10px;"> {{$player[$i]->username}} </h3>--}}
              {{--</div>--}}
            {{--@endfor--}}

       {{--@else--}}

           {{--@for($i=0 ; $i< count($team);$i++)--}}
               {{--<div class="row wrapper" style="padding: 25px;float: left;">--}}
                   {{--<img class="card-img-top rounded" src="{{URL::asset('storage/images/'.$team[$i]->path)}}" alt="Card image cap" height="50px;">--}}
                   {{--<h3 style="padding: 8px;"> {{$team[$i]->teamName}} </h3>--}}
                   {{--<div class="tooltip" style="text-align: center;">--}}
                       {{--@for($t=0 ; $t<count($groupMem[$i]);$t++)--}}
                           {{--Mohammad , Ali , Sahand , Mohammad , Ali , Sahand--}}
                           {{--{{$groupMem[$i][$t]->name}},--}}
                       {{--@endfor--}}
                   {{--</div>--}}
               {{--</div>--}}

           {{--@endfor--}}

        {{--@endif--}}
   {{--</div>--}}
{{--</div>--}}












{{--<style type="text/css">--}}
  {{--.wrapper {--}}
{{--text-transform: uppercase;--}}
{{--cursor: help;--}}
{{--font-family: "Gill Sans", Impact, sans-serif;--}}
{{--font-size: 20px;--}}
{{--/*padding: 15px 20px;*/--}}
{{--position: relative;--}}
{{--/*text-align: center;*/--}}
{{--/*width: 500px;*/--}}
{{---webkit-transform: translateZ(0); /* webkit flicker fix */--}}
{{---webkit-font-smoothing: antialiased; /* webkit text rendering fix */--}}
{{--}--}}

{{--.wrapper .tooltip {--}}
{{--background: #1496bb;--}}
{{--bottom: 100%;--}}
{{--color: #fff;--}}
{{--display: block;--}}
{{--/*left: -20px;*/--}}
{{--margin-bottom: 0px;--}}
{{--opacity: 0;--}}
{{--padding: 5px;--}}
{{--pointer-events: none;--}}
{{--position: absolute;--}}
{{--width: 100%;--}}
{{---webkit-transform: translateY(5px);--}}
  {{---moz-transform: translateY(5px);--}}
  {{---ms-transform: translateY(5px);--}}
   {{---o-transform: translateY(5px);--}}
    {{--transform: translateY(5px);--}}
{{---webkit-transition: all .25s ease-out;--}}
  {{---moz-transition: all .25s ease-out;--}}
  {{---ms-transition: all .25s ease-out;--}}
   {{---o-transition: all .25s ease-out;--}}
    {{--transition: all .25s ease-out;--}}
{{---webkit-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);--}}
  {{---moz-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);--}}
  {{---ms-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);--}}
   {{---o-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);--}}
    {{--box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);--}}
{{--}--}}

{{--/* This bridges the gap so you can mouse into the tooltip without it disappearing */--}}
{{--.wrapper .tooltip:before {--}}
{{--/*bottom: -20px;*/--}}
{{--content: " ";--}}
{{--display: block;--}}
{{--height: 20px;--}}
{{--left: 0;--}}
{{--position: absolute;--}}
{{--width: 100%;--}}
{{--}--}}

{{--/* CSS Triangles - see Trevor's post */--}}
{{--.wrapper .tooltip:after {--}}
{{--border-left: solid transparent 10px;--}}
{{--border-right: solid transparent 10px;--}}
{{--border-top: solid #1496bb 10px;--}}
{{--bottom: -10px;--}}
{{--content: " ";--}}
{{--height: 0;--}}
{{--left: 50%;--}}
{{--margin-left: -13px;--}}
{{--position: absolute;--}}
{{--width: 0;--}}
{{--}--}}

{{--.wrapper:hover .tooltip {--}}
{{--opacity: 1;--}}
{{--pointer-events: auto;--}}
{{---webkit-transform: translateY(0px);--}}
  {{---moz-transform: translateY(0px);--}}
  {{---ms-transform: translateY(0px);--}}
   {{---o-transform: translateY(0px);--}}
    {{--transform: translateY(0px);--}}
{{--}--}}

{{--/* IE can just show/hide with no transition */--}}
{{--.lte8 .wrapper .tooltip {--}}
{{--display: none;--}}
{{--}--}}

{{--.lte8 .wrapper:hover .tooltip {--}}
{{--display: block;--}}
{{--}--}}
{{--</style>--}}
 <script type="text/javascript" src="js/bootstrap.js"></script>


@endsection