@extends('masterUserHeader.body')
@section('content')

    {{--<div class="form-group" style="margin: auto">--}}
        {{--<label for="Name-input"> </label>--}}
        {{--<div>--}}
            {{--<span style="float: right; margin: 1%">فیلتر بر اساس مسابقات</span>--}}
            {{--<select name="startMonth" v-model="startMonth" style="float: right;margin-left: 1%;width: 30%;text-align: center" class="form-control" id="sel1">--}}
                {{--<option>حضوری</option>--}}
                {{--<option>آنلاین</option>--}}
                {{--<option>انفردی</option>--}}
                {{--<option>گروهی</option>--}}
                {{----}}
            {{--</select>--}}


        {{--</div>--}}
    {{--</div>--}}
    {{--<br>--}}
    {{--<br>--}}
    {{--<div class="container" style="direction: rtl;">--}}

    {{--<div class="row" style="padding: 20px;">--}}
    {{--<h3>همه مسابقه ها</h3>--}}
    {{--<a href="{{route('matchCreate')}}"  class="btn btn-primary mr-auto" style="height: 35px;">ایجاد مسابقه جدید</a>--}}
    {{--</div>--}}

    {{--</div>  --}}

    {{--<div class="container" style="direction: rtl;">--}}
    {{--<div class="row">--}}
    <!-- First -->

    <section class="tournoments" id="mainApp">

        @for($i=0;$i<count($matches);$i++)
            @if($matches[$i]->canceled == 1)
                <div class="tournomentSmall box sample">
                    @else
                        <div class="tournomentSmall">
                            @endif
                            <div class="tournomentSmallHeader">
                                <a href="{{route('organizeProfile',['id'=>$matches[$i]->organize->slug])}}">
                                    <img src="{{URL::asset('storage/images/'.$matches[$i]->organize->logo_path)}}">
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                </a>
                                <h6>مسابقه  {{$matches[$i]->matchName}}</h6>
                            </div>
                            <!--<a href="supplier/supplierName">d</a>-->
                            <!--<a href="tournoments/tournomentPage"> asdfsadfsdfa</a>-->
                            <div class="bannerSM">
                                @if($matches[$i]->canceled == 1)
                                    <img class="card-img-top rounded mx-auto" src="{{URL::asset('storage/images/'.$matches[$i]->path)}}" alt="Responsive image" style="width: 100%;">
                                @else
                                    <a href="{{route('matchRegistered',['id'=>$matches[$i]->id,'matchName'=>$matches[$i]->slug])}}"><img class="card-img-top rounded mx-auto" src="{{URL::asset('storage/images/'.$matches[$i]->path)}}" alt="Responsive image" style="width: 100%;"></a>
                                @endif

                                <div class="top-right">  {{$matches[$i]->endTimeDays}}   روز مانده</div>
                                <button class="top-left" style="color: white;" onclick="showModal({{$matches[$i]->id}})"><i class="fa fa-share-alt fa-4" aria-hidden="true"></i></button>
                            </div>
                            <div style="text-align: center">
                                @if($matches[$i]->cost == 0)
                                    <small><i class="fa fa-usd"></i>رایگان</small>
                                @else
                                    <small></i> {{$matches[$i]->cost}}  تومان </small>
                                @endif

                                <small><i class="fa fa-calendar"></i> {{unserialize($matches[$i]->startTime)[0]}} {{unserialize($matches[$i]->startTime)[1]}} {{unserialize($matches[$i]->startTime)[2]}} </small>
                                <small><i class="fa fa-address-card-o"></i> {{$matches[$i]->mode}} </small>
                                @if($matches[$i]->matchType == 'تیمی')
                                    <small><i class="fa fa-users"></i> {{$matches[$i]->matchType}} </small>
                                @else
                                    <small><i class="fa fa-user"></i> {{$matches[$i]->matchType}} </small>
                                @endif
                            </div>
                            <p hidden>{{$t = 0}}</p>
                            @foreach($registereds as $registered)

                                @if($registered->id == $matches[$i]->id && $matches[$i]->canceled == 0)
                                    <p hidden>{{$t++}}</p>
                                    <a style="background: orange;color: #1d1e1f;display: block;margin: auto;margin-bottom: 5px;width: 40%;" href="{{route('matchRegistered',['id'=>$matches[$i]->id , 'matchName'=>$matches[$i]->matchName ])}}" class="btn">جزییات مسابقه</a>

                                @endif

                            @endforeach

                            @if($t==0)


                                @if($matches[$i]->endTime == 0 && $matches[$i]->canceled == 0 )

                                    <a href="{{route('matchRegistered',['id'=>$matches[$i]->id , 'matchName'=>$matches[$i]->matchName ])}}" class="btn btn-danger">زمان ثبت نام به پایان رسید </a>

                                @elseif($matches[$i]->tickets == $matches[$i]->sold && $matches[$i]->canceled == 0)
                                    <a href="{{route('matchRegistered',['id'=>$matches[$i]->id , 'matchName'=>$matches[$i]->matchName ])}}" style="background:salmon;color:white;" class="btn">بلیط های مسابقه تمام شد!</a>


                                @elseif($matches[$i]->canceled == 0)
                                    <a href="{{route('matchRegistered',['id'=>$matches[$i]->id , 'matchName'=>$matches[$i]->matchName ])}}" class="regButton">ثبت نام</a>
                                @else
                                    <a class="regButton" style="visibility: hidden;">ثبت نام</a>
                                @endif
                            @endif



                        </div>
                @endfor
    </section>
    {{--@if($match->endTime == 0 && $match->canceled == 0)--}}

    {{--<a href="{{route('matchRegistered',['id'=>$match->id,'matchName'=>$match->matchName ])}}" class="btn btn-danger" style="text-align: center;margin: auto;">زمان ثبت نام به پایان رسید</a>--}}

    {{--@elseif($match->tickets == $match->sold && $match->canceled == 0)--}}
    {{--<a href="{{route('matchRegistered',['id'=>$match->id,'matchName'=>$match->matchName ])}}" style="background:salmon;color:white;margin: auto;text-align: center;" class="btn">بلیط های مسابقه تمام شد!</a>--}}


    {{--@elseif($match->canceled == 0)--}}
    {{--<a href="{{route('matchRegistered',['id'=>$match->id,'matchName'=>$match->matchName  ])}}" class="regButton">ثبت نام</a>--}}

    {{--@else--}}
    {{--@endif--}}
    {{--<div class="col-md-6 col-lg-4" style="padding-top: 10px;">--}}
    {{--@if($matches[$i]->canceled == 1)--}}

    {{--<div class="box sample">--}}

    {{--@else--}}
    {{--<div>--}}

    {{--@endif--}}


    {{--<div class="card" style=" box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);z-index: 0.5;">--}}
    {{--<div>--}}
    {{--<h4 class="card-title" style="padding-top: 10px;padding-right: 10px;padding-left: 10px;float: right;">مسابقه {{$matches[$i]->matchName}}</h4>--}}
    {{--<a href="{{route('organizeProfile',['id'=>$matches[$i]->organize->slug])}}"> <img src="{{URL::asset('storage/images/'.$matches[$i]->organize->logo_path)}}" class="rounded" height="35px" style="margin-top: 7px;margin-left: 5px; float: left;" > </a>--}}
    {{--<div class="star-rating" title="{{$matches[$i]->organize->rating*10}}%" style="padding-top: 13px;float: left;">--}}
    {{--<div class="back-stars">--}}
    {{--<i class="fa fa-star" aria-hidden="true"></i>--}}
    {{--<i class="fa fa-star" aria-hidden="true"></i>--}}
    {{--<i class="fa fa-star" aria-hidden="true"></i>--}}
    {{--<i class="fa fa-star" aria-hidden="true"></i>--}}
    {{--<i class="fa fa-star" aria-hidden="true"></i>--}}
    {{----}}
    {{--<div class="front-stars" style="width: {{$matches[$i]->organize->rating*10}}%">--}}
    {{--<i class="fa fa-star" aria-hidden="true"></i>--}}
    {{--<i class="fa fa-star" aria-hidden="true"></i>--}}
    {{--<i class="fa fa-star" aria-hidden="true"></i>--}}
    {{--<i class="fa fa-star" aria-hidden="true"></i>--}}
    {{--<i class="fa fa-star" aria-hidden="true"></i>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div> --}}
    {{--</div>--}}

    {{--@if($matches[$i]->canceled == 1)--}}
    {{--<img class="card-img-top rounded mx-auto" src="{{URL::asset('storage/images/'.$matches[$i]->path)}}" alt="Responsive image" style="width: 100%;">--}}
    {{--@else--}}
    {{--<a href="{{route('matchRegistered',['id'=>$matches[$i]->id,'matchName'=>$matches[$i]->slug])}}"><img class="card-img-top rounded mx-auto" src="{{URL::asset('storage/images/'.$matches[$i]->path)}}" alt="Responsive image" style="width: 100%;"></a>--}}
    {{--@endif--}}


    {{--<div class="bg-primary rounded" style="position: absolute;top:55px;right: 10px;color: white;padding: 2px;">--}}
    {{--<p style="padding: 0px;margin: 0px;">{{$matches[$i]->endTimeDays}} روز مانده </p>--}}
    {{--</div>--}}
    {{--<div class="card-block">--}}
    {{--<div class="row" >--}}
    {{--<span class="badge badge-default">{{$matches[$i]->cost}} تومان</span>--}}
    {{--<span class="badge badge-default">{{$matches[$i]->mode}}</span>--}}
    {{--<span class="badge badge-default">{{$matches[$i]->matchType}}</span>--}}
    {{--<span class="badge badge-default">{{$matches[$i]->attendType}}</span>--}}
    {{--<span class="badge badge-default"> تعداد بلیط های باقی مانده {{$match->tickets - $match->sold}}</span>--}}

    {{--</div>--}}

    {{--<p hidden>{{$t = 0}}</p>--}}
    {{--@foreach($registereds as $registered)--}}

    {{--@if($registered->id == $matches[$i]->id && $matches[$i]->canceled == 0)--}}
    {{--<p hidden>{{$t++}}</p>--}}
    {{--<a style="background: orange;color: #1d1e1f" href="{{route('matchRegistered',['id'=>$matches[$i]->id , 'matchName'=>$matches[$i]->slug])}}" class="btn">جزییات مسابقه</a>--}}

    {{--@endif--}}

    {{--@endforeach--}}

    {{--@if($t==0)--}}


    {{--@if($matches[$i]->endTime == 0 && $matches[$i]->canceled == 0 )--}}

    {{--<a href="{{route('matchRegistered',['id'=>$matches[$i]->id , 'matchName'=>$matches[$i]->slug ])}}" class="btn btn-danger">زمان ثبت نام به پایان رسید </a>--}}

    {{--@elseif($matches[$i]->tickets == $matches[$i]->sold && $matches[$i]->canceled == 0)--}}
    {{--<a href="{{route('matchRegistered',['id'=>$matches[$i]->id , 'matchName'=>$matches[$i]->slug ])}}" style="background:salmon;color:white;" class="btn">بلیط های مسابقه تمام شد!</a>--}}


    {{--@elseif($matches[$i]->canceled == 0)--}}
    {{--<a href="{{route('matchRegistered',['id'=>$matches[$i]->id , 'matchName'=>$matches[$i]->slug ])}}" class="btn btn-success">ثبت نام</a>--}}
    {{--@else--}}


    {{--@endif--}}
    {{--@endif--}}

    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}




    <!-- The Modal -->
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content" style="height: 80px;">
            <span class="close">&times;</span>
            <input  style="width: 50%;float: left" class="form-control" id="link" readonly type="search" >
            <button style="float: left;margin-left: 2%;margin-top: 5px;" class="btn btn-success" onclick="copyLink()"><i class="fa fa-files-o"></i></button>
        </div>
    </div>
    <script>
        function copyLink()
        {
            copyText = document.getElementById("link");
            copyText.select();
            document.execCommand("Copy");
        }
        // Get the modal
        var modal = document.getElementById('myModal');
        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];
        function showModal(id) {

            axios.get({!! json_encode(route('getLink'))!!}+'?id='+id).then(function (response) {


                $('#link').val({!! json_encode(route('home'))!!}+'/'+response.data.url)

            })


            modal.style.display = "block";
        }
        span.onclick = function() {
            modal.style.display = "none";
        }
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>


    {{--</div>--}}

    {{--</div>--}}

    <style>
        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content/Box */
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
        }

        /* The Close Button */
        .close {
            color: red;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: red;
            text-decoration: none;
            cursor: pointer;
        }
        /*.tournoments {*/
        /*position: relative;*/
        /*}*/
        .btn {
            font-size:125%;
            border: none;
            padding: 0px;
            padding-right: 15px;
            padding-left: 15px;
            margin-bottom: 5px;
        }
        .top-left {
            position: absolute;
            top: 15px;
            left: 10px;
            background-color: darkorange;
            padding: 4px;
            padding-left: 8px;
            padding-right: 8px;
            border-radius: 8px;
            border: none;
        }
        .top-left:hover {
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
            background-color:  #b36b00;
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
            .top-left {
                top: 15px;
                left: 6px;
                padding: 2px;
                padding-left: 5px;
                padding-right: 5px;
                border-radius: 4px;
            }
        }
        @media screen and (max-width: 800px) {
            div.box.sample:after
            {
                top:90px;
                left:90px;
                font-size:30px;
            }
            .top-left {
                top: 10px;
                left: 6px;
                padding: 2px;
                padding-left: 5px;
                padding-right: 5px;
                border-radius: 4px;
            }
        }
        @media screen and (max-width: 600px) {
            div.box.sample:after
            {
                top:80px;
                left:160px;
                font-size:30px;
            }
            .top-left {
                top: 15px;
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

@endsection

