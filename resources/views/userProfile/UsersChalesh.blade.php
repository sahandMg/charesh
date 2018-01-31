@extends('masterUserHeader.body')
@section('content')
    <br>
    <br>
    <br>
    <div class="container" style="direction: rtl;">
        <!-- Tournoments -->
        <h3>چالش های من</h3>

        @if(count($matches))
            <section class="tournoments" id="app">
                @foreach($matches as $match)
                    @if($match->canceled == 1)
                        <div class="tournomentSmall box sample">
                            @else
                                <div class="tournomentSmall">
                                    @endif
                                    <div class="tournomentSmallHeader">
                                        <a href="{{route('organizeProfile',['id'=>$match->organize->name])}}">
                                            <img src="{{URL::asset('storage/images/'.$match->organize->logo_path)}}">
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                        </a>
                                        <h6>مسابقه  {{$match->matchName}}</h6>
                                    </div>
                                    <!--<a href="supplier/supplierName">d</a>-->
                                    <!--<a href="tournoments/tournomentPage"> asdfsadfsdfa</a>-->
                                    <div class="bannerSM">
                                        @if($match->canceled == 1)
                                            <img class="card-img-top rounded mx-auto" src="{{URL::asset('storage/images/'.$match->path)}}" alt="Responsive image" style="width: 100%;">
                                        @else
                                            <a href="{{route('matchRegistered',['id'=>$match->id,'matchName'=>$match->slug])}}"><img class="card-img-top rounded mx-auto" src="{{URL::asset('storage/images/'.$match->path)}}" alt="Responsive image" style="width: 100%;"></a>
                                        @endif
                                        <div class="top-right">  {{$match->endTimeDays}}   روز مانده</div>
                                    </div>
                                    <div style="text-align: center">
                                        <small><i class="fa fa-usd"></i> {{$match->cost}}  تومان </small>
                                        <small><i class="fa fa-calendar"></i> {{unserialize($match->startTime)[0]}} {{unserialize($match->startTime)[1]}} {{unserialize($match->startTime)[2]}} </small>
                                        <small><i class="fa fa-address-card-o"></i> {{$match->mode}} </small>
                                    </div>

                                    <p hidden>{{$t = 0}}</p>

                                    @if($t==0)




                                        {{--@if($match->canceled == 0)--}}
                                        {{--<a href="{{route('matchRegistered',['id'=>$match->id , 'matchName'=>$match->matchName ])}}" class="regButton">جزيیات مسابقه </a>--}}


                                        {{--@endif--}}
                                        @if( $match->canceled == 0)
                                            <a href="{{route('matchRegistered',['id'=>$match->id , 'matchName'=>$match->matchName ])}}" class="regButton">جزيیات مسابقه </a>
                                        @else
                                            <br>
                                        @endif
                                    @endif


                                    {{--@if($match->endTime == 0 && $match->canceled == 0)--}}

                                    {{--<a href="{{route('matchRegistered',['id'=>$match->id,'matchName'=>$match->matchName ])}}" class="btn btn-danger" style="text-align: center;margin: auto;">زمان ثبت نام به پایان رسید</a>--}}

                                    {{--@elseif($match->tickets == $match->sold && $match->canceled == 0)--}}
                                    {{--<a href="{{route('matchRegistered',['id'=>$match->id,'matchName'=>$match->matchName ])}}" style="background:salmon;color:white;margin: auto;text-align: center;" class="btn">بلیط های مسابقه تمام شد!</a>--}}


                                    {{--@elseif($match->canceled == 0)--}}
                                    {{--<a href="{{route('matchRegistered',['id'=>$match->id,'matchName'=>$match->matchName  ])}}" class="regButton">ثبت نام</a>--}}

                                    {{--@else--}}
                                    {{--@endif--}}
                                </div>
                        {{--<div class="col-md-6 col-lg-4" style="padding-top: 10px;">--}}
                        {{--@if($match->canceled == 1)--}}
                        {{--<div class="box sample">--}}
                        {{--@else--}}
                        {{--<div>--}}
                        {{--@endif--}}

                        {{--<div class="card" style=" box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);z-index: 0.5;">--}}

                        {{--<div>--}}
                        {{--<h4 class="card-title" style="padding-top: 10px;padding-right: 10px;padding-left: 10px;float: right;">مسابقه {{$match->matchName}}</h4>--}}
                        {{--<a href="{{route('organizeProfile',['id'=>$match->organize->slug])}}">   <img src="{{URL::asset('storage/images/'.$match->organize->logo_path)}}" class="rounded" height="35px" style="margin-top: 7px;margin-left: 5px; float: left;" > </a>--}}

                        {{--<div class="star-rating" title="{{$match->organize->rating*10}}%" style="padding-top: 13px;float: left;">--}}
                        {{--<div class="back-stars">--}}
                        {{--<i class="fa fa-star" aria-hidden="true"></i>--}}
                        {{--<i class="fa fa-star" aria-hidden="true"></i>--}}
                        {{--<i class="fa fa-star" aria-hidden="true"></i>--}}
                        {{--<i class="fa fa-star" aria-hidden="true"></i>--}}
                        {{--<i class="fa fa-star" aria-hidden="true"></i>--}}

                        {{--<div class="front-stars" style="width: {{$match->organize->rating*10}}%">--}}
                        {{--<i class="fa fa-star" aria-hidden="true"></i>--}}
                        {{--<i class="fa fa-star" aria-hidden="true"></i>--}}
                        {{--<i class="fa fa-star" aria-hidden="true"></i>--}}
                        {{--<i class="fa fa-star" aria-hidden="true"></i>--}}
                        {{--<i class="fa fa-star" aria-hidden="true"></i>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--@if($match->canceled == 0)--}}
                        {{--<a href="{{route('matchRegistered',['id'=>$match->id ,'matchName'=>$match->slug ])}}"><img class="card-img-top rounded mx-auto" src="{{URL::asset('storage/images/'.$match->path)}}" alt="Responsive image" style="width: 100%;"></a>--}}
                        {{--@else--}}

                        {{--<img class="card-img-top rounded mx-auto" src="{{URL::asset('storage/images/'.$match->path)}}" alt="Responsive image" style="width: 100%;">--}}
                        {{--@endif--}}

                        {{--<div class="bg-primary rounded" style="position: absolute;top:55px;right: 10px;color: white;padding: 2px;">--}}
                        {{--<p style="padding: 0px;margin: 0px;">{{$match->endTimeDays}} روز مانده </p>--}}
                        {{--</div>--}}
                        {{--<div class="card-block">--}}
                        {{--<div class="row" >--}}
                        {{--<span class="badge badge-default">{{$match->cost}} تومان</span>--}}
                        {{--<span class="badge badge-default">{{$match->mode}}</span>--}}
                        {{--<span class="badge badge-default">{{$match->matchType}}</span>--}}
                        {{--<span class="badge badge-default">{{$match->attendType}}</span>--}}
                        {{--<span class="badge badge-default"> تعداد بلیط های باقی مانده {{$match->tickets}}</span>--}}


                        {{--</div>--}}

                        {{--@if($match->canceled == 0)--}}
                        {{--<a style="background: orange;color: #1d1e1f" href="{{route('matchRegistered',['id'=>$match->id , 'matchName'=>$match->slug])}}" class="btn">جزییات مسابقه</a>--}}
                        {{--@endif--}}
                        {{--@if($match->endTime == 0)--}}

                        {{--<a href="challenge-register-{{$match->id}}-{{$match->matchName}}" class="btn btn-danger">تمام شد</a>--}}

                        {{--@else--}}
                        {{--<a href="challenge-register-{{$match->id}}-{{$match->matchName}}" class="btn btn-success">ثبت نام</a>--}}


                        {{--@endif--}}



                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        @endforeach
            </section>
        @else

            <h3 style="color:darkred;text-align: center;">شما در هیچ مسابقه ای شرکت نکرده اید</h3>

        @endif
        <br>
        <br>


    </div>


    {{--<script type="text/javascript" src="js/jquery-3.2.1.js"></script>--}}
    {{--<script type="text/javascript" src="{{URL::asset('js/main.js')}}"></script>--}}
    {{--<script type="text/javascript" src="{{URL::asset('js/bootstrap.js')}}"></script>--}}
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


        $({countNum: $('#counter').text()}).animate({countNum: 21000}, {
            duration: 1700,
            easing:'linear',
            step: function() {
                $('#counter').text(Math.floor(this.countNum));
            },
            complete: function() {
                $('#counter').text("17,000");
            }
        });
    </script>

    <style>


        div.box.sample:after
        {
            content:"مسابقه لغو شد";
            position:absolute;
            top:130px;
            left:60px;
            z-index:0.5;
            font-family:Arial,sans-serif;
            -webkit-transform: rotate(-45deg); /* Safari */
            -moz-transform: rotate(-45deg); /* Firefox */
            -ms-transform: rotate(-45deg); /* IE */
            -o-transform: rotate(-45deg); /* Opera */
            transform: rotate(-45deg);
            font-size:50px;
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
    </style>
@endsection
