@extends($auth == 1 ? 'masterUserHeader.body' : 'masterHeader.body')
@section('location')
    @if($tournament->matchType == 'حضوری')

        <meta name="geo.region" content="IR-11" />
        <meta name="geo.placename" content="{{$tournament->city}}" />
        <meta name="geo.position" content="{{$tournament->lat}},{{$tournament->lng}}" />
        <meta name="ICBM" content="{{$tournament->lat}},{{$tournament->lng}}" />
    @endif
@endsection
@section('matchName')
    مسابقه {{$tournament->matchName}}
@endsection
@section('title')
    چارش | مسابقه  {{$tournament->matchName}}
@endsection
@section('content')
    @include('masterMatch.body',['tournament'=> $tournament,'route'=>$route])
     <div class="container">
        <div class="wallDiv">
            {{--@if(count($team)>0)--}}
                <div class="team">
                    <img src="{{URL::asset('storage/images/'.$team->path)}}"  style="border-radius: 4px;">
                    <h1 style="float: right;"> <b>{{$team->teamName}}</b> </h1>
                </div>
            <h2> اعضای تیم </h2>
            <hr>
                <div style="float: left;padding: 0;width: 100%;margin: 0;">
                   @for($i=0 ; $i < count($team->groups);$i++)
                        <div class="player">
                            <img style="border-radius: 5px;" src="{{URL::asset('images/userImage.jpg')}}">
                            <b>{{$team->groups[$i]->name}}</b>
                        </div>
                   @endfor
                </div>
            {{--@else--}}
                {{--<div class="team">--}}
                    {{--<img class="card-img-top rounded" src="{{URL::asset('storage/images/'.$match->user->path)}}" alt="Card image cap" height="100px;">--}}
                {{--</div>--}}
            {{--@endif--}}

        </div>
     </div>
    <style>
        .wallDiv {
            width: 95%;
            margin: auto;
            height: auto;
            margin-top: 2%;
            margin-bottom: 2%;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            transition: 0.3s;
            border-radius: 5px; /* 5px rounded corners */
            display: block;
            background-color: white;
            direction: rtl;
            padding: 1%;
            text-align: center;
            float: left;
        }
        .wallDiv h2 {
            text-align: center;
        }
        .team {
            width: 20%;
            direction: rtl;
            margin-bottom: 1%;
            margin: auto;
        }
        .team img {
            height: 100px;
            width: 100px;
            padding: 0;
            margin: 0;
        }
        .team h1 {
            font-weight: bold;
            /*padding: 0;*/
            /*margin: 0;*/
        }
        .player {
            width: 20%;
            direction: ltr;
            margin-bottom: 1%;
            float: left;
        }
        .player img {
            height: 50px;
            width: 50px;
        }
        .player b {
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
        }
        @media screen and (max-width: 800px) {
            .team {
                width: 25%;
            }
            .team h1 {
                font-size: 100%;
            }
            .team img {
                height: 60px;
                width: 60px;
            }
            .wallDiv h2 {
                font-size: 85%;
            }
            .player {
                width: 25%;
            }
        }

        @media screen and (max-width: 600px) {
            .team {
                width: 50%;
            }
            .team img {
                height: 45px;
                width: 45px;
            }
            .wallDiv h2 {
                font-size: 70%;
            }
            .team h1 {
                font-size: 75%;
            }
            .player {
                width: 50%;
            }
            .player img {
                height: 40px;
                width: 40px;
            }
        }
    </style>
@endsection