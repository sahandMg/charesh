@extends('masterUserHeader.body')
@section('title')
    چارش | شرکت کنندگان مسابقه  {{$tournament->matchName}}
@endsection
@section('content')

    @include('masterOrganize.body',['tournament'=> $tournament,'route'=>$route])

    <div class="container">
        <div class="wallDiv">
            <div class="team" style="margin: auto;">
                {{--<img src="{{URL::asset('storage/images/'.$tournament->user->path)}}">--}}

            </div>


            @if(count($teams)>0)
                @foreach($teams as $team)
                    <div class="team">
                        <img class="card-img-top rounded" src="{{URL::asset('storage/images/'.$team->path)}}" alt="Card image cap" height="50px;">
                        <b>{{$team->teamName}}</b>
                    </div>
                    <div class="row" style="padding: 25px;float: left;direction: ltr;">


                    </div>
                    <div class="row" style="border: 2px solid;border-radius: 10px;">

                    <div class="col-5">
                    <p><strong>اعضای تیم   </strong></p>

                    @for($i=0 ; $i < count($team->groups);$i++)
                    <p>{{$team->groups[$i]->name}}</p>
                            @for($t=0 ; $t<count(unserialize($team->groups[0]->moreInfo)) ; $t++)

                                <p>{{unserialize($tournament->moreInfo)[$t]}}</p>
                                <p> {!! unserialize($team->groups[$t]->moreInfo)[$t] !!}</p>
                            @endfor

                    @endfor
                    </div>

                    </div>
                @endforeach
            @else

                @foreach($matches as $match)
                    <div class="team">
                        <img class="card-img-top rounded" src="{{URL::asset('storage/images/'.$match->user->path)}}" alt="Card image cap" height="50px;">

                    </div>
                    <div class="row" style="padding: 25px;float: left;direction: ltr;">


                    </div>
                    <div class="row" style="border: 2px solid;border-radius: 10px;">

                    <div class="col-5">
                    <p><strong> نام شرکت کننده </strong></p>

                    <p>{{$match->user->username}}</p>

                    </div>
                    <div class="col-7">
                    <p><strong>توضیحات</strong></p>

                        @for($t=0 ; $t<count(unserialize($match->moreInfo)) ; $t++)

                        <p>{{unserialize($tournament->moreInfo)[$t]}}</p>
                       <p> {!! unserialize($match->moreInfo)[$t] !!}</p>
                        @endfor
                    </div>
                    </div>
                @endforeach

            @endif

            {{-- اگر تیم بود --}}
            {{--<h4> اعضای تیم </h4>--}}
            {{--<p>محمد وطن دوست </p>--}}
            {{--<p>استیم : 32113546543</p>--}}
            {{--<p>محمد وطن دوست </p>--}}
            {{--<p>استیم : 32113546543</p>--}}
            {{-- اگر فرد بود --}}
            {{--<p>محمد وطن دوست </p>--}}
            {{--<p>استیم : 56456645665</p>--}}
        </div>
    </div>

    <style>
        p {
            text-align: justify;
        }
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
@endsection