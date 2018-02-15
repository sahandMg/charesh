@extends($auth == 1 ? 'masterUserHeader.body' : 'masterHeader.body')
@section('matchName')
     {{$tournament->matchName}}
@endsection

@section('title')
    چارش | {{$tournament->matchName}}
@endsection

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

                    {{--<a href="{{route('teamProfile',['matchName'=>$tournament->slug,'teamName'=>$player[$i]->username,'id'=>$tournament->id])}}">     <img style="border-radius: 5px;" src="{{URL::asset('storage/images/'.$player[$i]->path)}}"> </a>--}}
                    <img style="border-radius: 5px;" src="{{URL::asset('storage/images/'.$player[$i]->path)}}">
                    <b>{{$player[$i]->username}}</b>
                </div>
            @endfor
        @else
            @for($i=0 ; $i< count($team);$i++)
                <div class="team">
                    <a href="{{route('teamProfile',['matchName'=>$tournament->slug,'teamName'=>$team[$i]->teamName,'id'=>$tournament->id])}}"><img style="border-radius: 5px;" src="{{URL::asset('storage/images/'.$team[$i]->path)}}"></a>

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
            border-radius: 5px;
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
 <script type="text/javascript" src="js/bootstrap.js"></script>
@endsection