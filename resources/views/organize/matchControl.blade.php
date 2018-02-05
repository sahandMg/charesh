@extends('masterUserHeader.body')
@section('title')
    چارش | مسابقات من
@endsection

@section('content')

    @if(count(session('message')))
        <div class="alert alert-success ">
            {{session('message')}}
        </div>
    @endif
    <div class="wallDiv">
        <h4> تعداد کل بلیت هایی که در تمام مسابقات فروخته اید : <b><span id="counter">0</span></b> </h4>
    </div>
    <div class="tournoments">
        @foreach($matches as $match)
            @if($match->canceled == 1)
                <div class="tournomentSmall box sample">
                    @else
                        <div class="tournomentSmall">
                            @endif
                            <div class="tournomentSmallHeader">
                                <a href="{{route('organizeProfile',['id'=>$match->organize->slug])}}">
                                    <img src="{{URL::asset('storage/images/'.$match->organize->logo_path)}}">
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                </a>
                                <h6>مسابقه {{$match->matchName}}</h6>
                            </div>
                            <div class="bannerSM">
                                @if($match->canceled == 1)
                                    <img class="card-img-top rounded mx-auto" src="{{URL::asset('storage/images/'.$match->path)}}" alt="Responsive image" style="width: 100%;">
                                @else
                                    <a href="{{route('challengePanel',['id'=>$match->id,'matchName'=>$match->slug])}}" ><img class="card-img-top rounded mx-auto" src="{{URL::asset('storage/images/'.$match->path)}}" alt="Responsive image" style="width: 100%;"></a>
                                @endif
                                <div class="top-right">{{$match->endTimeDays}} روز مانده </div>
                            </div>
                            <div style="text-align: center">
                                <small> {{$match->cost}} تومان </small>
                                <small><i class="fa fa-calendar"></i> {{unserialize($match->startTime)[0]}} {{unserialize($match->startTime)[1]}} {{unserialize($match->startTime)[2]}} </small>
                                <small><i class="fa fa-address-card-o"></i> {{$match->mode}} </small>
                                @if($match->matchType == 'تیمی')
                                    <small><i class="fa fa-users"></i> {{$match->matchType}} </small>
                                @else
                                    <small><i class="fa fa-user"></i> {{$match->matchType}} </small>
                                @endif
                            </div>
                            @if( $match->canceled == 0)
                                <a href="{{route('challengePanel',['id'=>$match->id,'matchName'=>$match->slug])}}" class="btn btn-info" style="margin: auto;display: block;width:50%;margin-bottom: 1%; ">ورود به پنل مسابقه</a>
                            @else
                                <br>
                            @endif
                        </div>
                        @endforeach
                </div>
                <style>
                    .tournoments {
                        clear: both;
                        width: 100%;
                        margin: 0;
                    }
                    .wallDiv {
                        width: 95%;
                        height: auto;
                        margin: auto;
                        display: block;
                        margin-top: 7%;
                        margin-bottom: 2%;
                        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
                        transition: 0.3s;
                        border-radius: 5px;
                        background-color: white;
                        direction: rtl;
                        padding: 1%;
                    }
                    .wallDiv {
                        text-align: center;
                    }
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
                        font-size:40px;
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
                </style>
                <script async defer
                        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOUQbmEcxW09DMfiP8SR96YclW5S87qec&callback=myMap">
                </script>
                <script>
                    var temp = {!! json_encode($totalTickets) !!} ;
                    if(temp != 0) {
                        temp = 1000 ;
                    }
                    $({countNum: $('#counter').text()}).animate({countNum: {!! json_encode($totalTickets) !!}}, {
                        duration: temp,
                        easing:'linear',
                        step: function() {
                            $('#counter').text(Math.floor(this.countNum));
                        },
                        complete: function() {
                            $('#counter').text({!! json_encode($totalTickets) !!});
                        }
                    });
                </script>
@endsection
