@extends('masterHeader.body')
@section('content')



    <div class="container" style="direction: rtl;">

        <div class="row" style="padding: 20px;">
            <h3>همه مسابقه ها</h3>
            <a href="{{route('matchCreate')}}"  class="btn btn-primary mr-auto" style="height: 35px;">ایجاد مسابقه جدید</a>
        </div>

    </div>

    <div class="container" style="direction: rtl;" id="app">
        <div class="row">
            <!-- First -->
            @foreach($matches as $match)


                <div class="col-md-6 col-lg-4" style="padding-top: 10px;">
                    @if($match->canceled == 1)

                        <div class="box sample">

                            @else
                                <div>

                                    @endif
                    <div class="card" style=" box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);z-index: 0.5;">
                        <div>
                            <h4 class="card-title" style="padding-top: 10px;padding-right: 10px;padding-left: 10px;float: right;">مسابقه {{$match->matchName}}</h4>
                            <a href="{{route('organizeProfile',['id'=>$match->organize->slug])}}"> <img src="{{URL::asset('storage/images/'.$match->organize->logo_path)}}" class="rounded" height="35px" style="margin-top: 7px;margin-left: 5px; float: left;" > </a>
                            <div class="star-rating" title="{{$match->organize->rating*10}}%" style="padding-top: 13px;float: left;">
                                <div class="back-stars">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>

                                    <div class="front-stars" style="width: {{$match->organize->rating*10}}%">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>


                        @if($match->canceled == 1)
                            <img class="card-img-top rounded mx-auto" src="{{URL::asset('storage/images/'.$match->path)}}" alt="Responsive image" style="width: 100%;">
                        @else
                            <a href="{{route('matchRegistered',['id'=>$match->id,'matchName'=>$match->slug])}}"><img class="card-img-top rounded mx-auto" src="{{URL::asset('storage/images/'.$match->path)}}" alt="Responsive image" style="width: 100%;"></a>

                        @endif

                        <div class="bg-primary rounded" style="position: absolute;top:55px;right: 10px;color: white;padding: 2px;">
                            <p style="padding: 0px;margin: 0px;">{{$match->endTimeDays}} روز مانده </p>
                        </div>
                        <div class="card-block">
                            <div class="row" >
                                <span class="badge badge-default">{{$match->cost}} تومان</span>
                                <span class="badge badge-default">{{$match->mode}}</span>
                                {{--<span class="badge badge-default">{{$match->matchType}}</span>--}}
                                {{--<span class="badge badge-default">{{$match->attendType}}</span>--}}
                                {{--<span class="badge badge-default"> تعداد بلیط های باقی مانده {{$match->tickets - $match->sold}}</span>--}}

                            </div>
                            @if($match->endTime == 0 && $match->canceled == 0)

                                <a href="{{route('matchRegistered',['id'=>$match->id,'matchName'=>$match->slug ])}}" class="btn btn-danger">زمان ثبت نام به پایان رسید</a>

                            @elseif($match->tickets == $match->sold && $match->canceled == 0)
                                <a href="{{route('matchRegistered',['id'=>$match->id,'matchName'=>$match->slug ])}}" style="background:salmon;color:white;" class="btn">بلیط های مسابقه تمام شد!</a>


                            @elseif($match->canceled == 0)
                                <a href="{{route('matchRegistered',['id'=>$match->id,'matchName'=>$match->slug  ])}}" class="btn btn-success">ثبت نام</a>

                            @else
                            @endif
                        </div>
                        </div>
                    </div>
                </div>

            @endforeach

            {{--<div>{{$matches->links()}}</div>--}}






        </div>

        <br>
        <br>
        {{--<button @click = "view"  class="btn btn-primary">مشاهده موارد بیشتر</button>--}}
    </div>



    </div>

    {{--<script type="text/javascript" src="js/jquery-3.2.1.js"></script>--}}
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
    <script type="text/javascript" src="{{URL::asset('js/bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/main.js')}}"></script>

    {{--<script>--}}

        {{--new Vue({--}}

            {{--el:'#app',--}}
            {{--data:{--}}
                {{--matches:[''],--}}
                {{--show:false,--}}
            {{--},--}}
            {{--methods:{--}}

                {{--view:function () {--}}

                    {{--vm = this--}}
                    {{--axios.get( {!! json_encode(route('viewMore',['num'=>10]))!!}).then(function (response) {--}}


                        {{--vm.matches = response.data--}}
                        {{--console.log(response.data)--}}
                        {{--vm.show = true--}}

                    {{--})--}}


                {{--}--}}


            {{--}--}}


        {{--})--}}


    {{--</script>--}}


@endsection
