<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/vue/1.0.28/vue.js"></script>
            <script src="https://cdn.jsdelivr.net/vue.resource/1.2.1/vue-resource.min.js"></script>
           <script src="https://cdn.jsdelivr.net/lodash/4.17.4/lodash.js"></script>
            <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">--}}

    {{--<script type="text/javascript" src="../js/bundle.js"></script>--}}

    <title>بلیط مسابقه</title>

</head>
<body>

{{--<h1 style="text-align: center;direction: rtl">Challeng Bazaar ticket</h1>--}}
<div class="container">




    {{--<div>--}}
        {{--<img height="50" class="img-rounded img-responsive" src="{{URL::asset('images/Logo.png')}}" alt="">--}}
    {{--</div>--}}


    <img  style="position: absolute;top:20%;left:20%" width="50%" src="{{URL::asset('images/ticket.svg')}}" alt="">




    <div style="word-wrap: break-word;position: absolute;top:35%;left:60%;height: 28px;width:110px;">
    <h6  style="position: relative;top:-20px;direction: rtl;">{{$owner}}</h6>
    </div>
<div style="word-wrap: break-word;position: absolute;top:44%;left:60%;height: 30px;width:110px;">

    <h6  style="position:relative;top:-20px ;direction: rtl;">{{$name}}</h6>

</div>


    <h6 style="position: absolute;top:56%;left:64%;font-size: 14px">{{$time}}</h6>

    <h6  style="position: absolute;top:64%;left:63%;font-size: 14px;direction: rtl">  {{$cost}} تومان  </h6>

<div style="word-wrap: break-word;position: absolute;top:80%;left:19%;height: 80px;width:49%;">

    <h6 style="position: relative;top: -20px;direction: rtl">{!!  $tournament->moreInfo !!}</h6>

</div>

@if($tournament->mode == 'غیرحضوری')

        <h6  style="position: absolute;top:47%;left:64%;">غیرحضوری</h6>

@else
        <div style="position: absolute;width: 300px;height: 40px;top:53%;left:45%">
        <h6  style="direction: rtl;word-wrap: break-word; position: relative;top:-30px">{{$tournament->organize->address}}</h6>
        </div>

@endif


        {{--<h4 style="text-align: center;">شرکت کنندگان</h4>--}}
    <div style="position: absolute; top: 48%;left: 21%;display: inline-block;width: 20%;float:left;">

    @foreach($names as $part)
            <div  style="text-align: center;list-style: none;float: left;width: 50%;">
                {{$part}}

            </div>


    @endforeach

    </div>

        <div style="position: absolute;top: 30%;left: 28%">
       @php
           echo "<img src='data:image/png;base64," . $png . "'>";

       @endphp


        </div>

</div>
</body>
</html>
