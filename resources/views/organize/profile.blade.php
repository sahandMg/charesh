@extends($auth == 1 ? 'masterUserHeader.body' : 'masterHeader.body')
@section('title')
    چارش | پروفایل  {{$org->name}}
@endsection
@section('content')


    <div class="WallDiv">
        <div class="banner">
            <img src="{{URL::asset('storage/images/'.$org->background_path)}}" alt="{{$org->background_path}}">
        </div>
        <div class="supllierogo">
            <a href="#">
                <img src="{{URL::asset('storage/images/'.$org->logo_path)}}" alt="{{$org->logo_path}}">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
            </a>
            <h6>{{$org->name}}</h6>
        </div>
        <hr>
        <div class="description">
            <p>{!! $org->comment !!}</p>
        </div>
        <hr>
        <div class="tournoments">
            <h3 style="direction: rtl">مسابقات  {{$org->name}}  </h3>
            @for($i=0 ; $i<count($org->tournaments);$i++)
                @if($org->tournaments[$i]->canceled == 1)
                    <div class="tournomentSmall box sample">
                @else
                            <div class="tournomentSmall">
                @endif
                                <div class="tournomentSmallHeader">
                                    <a href="{{route('organizeProfile',['id'=>$org->name])}}">
                                        <img src="{{URL::asset('storage/images/'.$org->logo_path)}}" alt="{{$org->logo_path}}">
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                    </a>
                                    <h6>  {{$org->tournaments[$i]->matchName}}</h6>
                                </div>
                                <!--<a href="supplier/supplierName">d</a>-->
                                <!--<a href="tournoments/tournomentPage"> asdfsadfsdfa</a>-->
                                <div class="bannerSM">


                                    @if($org->tournaments[$i]->canceled == 1)
                                        <img class="card-img-top rounded mx-auto" src="{{URL::asset('storage/images/'.$matches[$i]->path)}}" alt="{{$matches[$i]->path}}" style="width: 100%;">
                                    @else
                                        <a href="{{route('matchRegistered',['id'=>$org->tournaments[$i]->id,'matchName'=>$org->tournaments[$i]->matchName])}}"><img src="{{URL::asset('storage/images/'.$org->tournaments[$i]->path)}}" alt="{{$org->tournaments[$i]->path}}"></a>
                                    @endif



                                    <div class="top-right">  {{$org->tournaments[$i]->endTimeDays}}   روز مانده</div>
                                    <div class="top-left"><a href="" style="color: white;"><i class="fa fa-share-alt fa-4" aria-hidden="true"></i></a></div>
                                </div>
                                <div style="text-align: center">
                                    @if($org->tournaments[$i]->cost == 0)
                                        <small><i class="fa fa-usd"></i>رایگان</small>
                                    @else
                                    <small><i class="fa fa-usd"></i> {{$org->tournaments[$i]->cost}}   تومان </small>
                                    @endif
                                    <small><i class="fa fa-calendar"></i> {{unserialize($org->tournaments[$i]->startTime)[0]}} {{unserialize($org->tournaments[$i]->startTime)[1]}} {{unserialize($org->tournaments[$i]->startTime)[2]}} </small>
                                    <small><i class="fa fa-address-card-o"></i> {{$org->tournaments[$i]->mode}} </small>
                                </div>
                                {{--@if($org->tournaments[$i]->endTime == 0 && $org->tournaments[$i]->canceled == 0)--}}
                                    {{--<a href="{{route('matchRegistered',['id'=>$org->tournaments[$i]->id,'matchName'=>$org->tournaments[$i]->matchName ])}}" class="btn btn-danger" style="text-align: center;margin: auto;display: block;width: 40%;">زمان ثبت نام به پایان رسید</a>--}}
                                {{--@elseif($org->tournaments[$i]->tickets == $org->tournaments[$i]->sold && $org->tournaments[$i]->canceled == 0)--}}
                                    {{--<a href="{{route('matchRegistered',['id'=>$org->tournaments[$i]->id,'matchName'=>$org->tournaments[$i]->matchName ])}}" style="background:salmon;color:white;margin: auto;text-align: center;display: block;width: 40%;" class="btn">بلیط های مسابقه تمام شد!</a>--}}
                                {{--@elseif($org->tournaments[$i]->canceled == 0)--}}
                                    {{--<a href="{{route('matchRegistered',['id'=>$org->tournaments[$i]->id,'matchName'=>$org->tournaments[$i]->matchName  ])}}" class="regButton">ثبت نام</a>--}}
                                {{--@else--}}
                                    {{--<br>--}}
                                {{--@endif--}}
                            </div>
                            @endfor
                    </div>
        </div>
        <br>
        <br>
    </div>

    <style>
        div.box
        {
            display:inline-block;
            vertical-align:top;
            position:relative;
        }
        div.box.sample:after
        {
            content:"مسابقه لغو شد";
            position:absolute;
            top:105px;
            left:95px;
            z-index:0.5;
            font-family:Arial,sans-serif;
            -webkit-transform: rotate(-45deg); /* Safari */
            -moz-transform: rotate(-45deg); /* Firefox */
            -ms-transform: rotate(-45deg); /* IE */
            -o-transform: rotate(-45deg); /* Opera */
            transform: rotate(-45deg);
            font-size:35px;
            color: #f09f0a;
            background:transparent;
            border:solid 4px #c00;
            padding:5px;
            border-radius:5px;
            zoom:1;
            filter:alpha(opacity=20);
            opacity:1;
            -webkit-text-shadow: 0 0 2px #c00;
            text-shadow: 0 0 2px #c00;
            box-shadow: 0 0 2px #c00;
        }
        @media screen and (max-width: 1000px) {
            div.box.sample:after
            {
                top:100px;
                left:60px;
                font-size:30px;
            }
        }
        @media screen and (max-width: 800px) {
            div.box.sample:after
            {
                top:90px;
                left:90px;
                font-size:30px;
            }
        }
        @media screen and (max-width: 600px) {
            div.box.sample:after
            {
                top:80px;
                left:160px;
                font-size:30px;
            }
        }
        @media screen and (max-width: 400px) {
            div.box.sample:after
            {
                top:60px;
                left:100px;
                font-size:25px;
            }
        }
        .WallDiv {
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            direction: rtl;
            background-color: white;
            border-radius: 5px;
            /*display: inline-block;*/
            width: 90%;
            margin: auto;
            /*position: relative;*/
            margin-top: 2%;
        }
        .banner {
            width: 100%;
        }
        .banner img {
            width: 100%;
            border-radius: 5px;
        }
        .banner a img {
            width: 100px;
            height: 100px;
        }

        .description {
            padding: 1%;
            text-align: justify;
            font-size: 150%;
        }

        .supllierogo {
            width: 100%;
            margin: 0;
            float: left;
            padding: 1%;
        }
        .supllierogo a img {
            border-radius: 5px;
            width: 45px;
            height: 45px;
            float: left;
            margin-left: 1%;
        }
        .supllierogo h6{
            float: right;
            margin: 0;
            padding: 10px;
            font-size: 200%;
            font-weight: 400;
        }
        .tournoments {
            clear: both;
            width: 100%;
            /*margin: auto;*/
            padding: 0;
            direction: ltr;
            text-align: center;
            /*margin-top: 5%;*/
        }
        .tournoments h3 {
            font-size: 200%;
        }
        /*---------- star rating ----------*/
        .checked {
            color: orange;
        }
        .supllierogo a span {
            margin-top: 19px;
            float: left;
        }

    </style>
@endsection