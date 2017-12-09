@extends($auth == 1 ? 'masterUserHeader.body' : 'masterHeader.body')
@section('content')


    <div class="container" style="direction: rtl;padding-top: 30px;">

        <div class="card-group" style="padding-top: 20px;">
            <div class="card">
                <img class="card-img-top" src="../../public/storage/images/{{$org->background_path}}" alt="Card image cap" height="400px;">
                <div class="rounded" style="position: absolute;top:350px;left: 45px;padding: 2px;">
                    <div class="star-rating" title="{{$org->rating*10}}%" style="margin-top: 40px;float: right;margin-left: 10px;">
                        <div class="back-stars">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>

                            <div class="front-stars" style="width: {{$org->rating*10}}%">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <img class="rounded" src="../../public/storage/images/{{$org->logo_path}}" alt="Card image cap" height="100px;" width="100px;">
                </div>
                <div class="card-block">
                    <h4 class="card-title" style="margin-right: 150px;">{{$org->name}}</h4>
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <label for="comment"><strong>توضیحات:</strong></label>
                            <p id="comment">{!! $org->comment !!}</p>
                            <label for="email"><strong>آدرس ایمیل:</strong> </label>
                            <p id="email">{{$org->email}}</p>
                            <label for="telegram"><strong>تلگرام:</strong></label>
                            <p id="telegram"> {{$org->telegram}} </p>
                            <label for="address"><strong>آدرس:</strong></label>
                            <p id="address">{{$org->address}}</p>
                        </div>

                        @if($org->lat != 0 && $org->lng != 0)
                        <div class="col-6">
                            <div id="map" style="width:100%;height: 250px; background:yellow;">
                            </div>
                        </div>
                        @endif

                    </div>
                    <hr>
                    <h3> مسابقات برگزار شده توسط {{$org->name}}</h3>
                    <div class="row">

                        @for($i=0 ; $i<count($org->tournaments);$i++)
                        <div class="col-md-6 col-lg-4" style="padding-top: 10px;">

                            @if($org->tournaments[$i]->canceled == 1)
                                <div class="box sample">

                                    @else
                                        <div>
                                            @endif

                            <div class="card" style=" box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);z-index: 0.5;">
                                <div>
                                    <h4 class="card-title" style="padding-top: 10px;padding-right: 10px;padding-left: 10px;float: right;"> {{$org->tournaments[$i]->matchName}}</h4>
                                    <a href=""><img src="../../public/storage/images/{{$org->logo_path}}" class="rounded" height="35px" style="margin-top: 7px;margin-left: 5px; float: left;" ></a>
                                    <div class="star-rating" title="70%" style="padding-top: 13px;float: left;">
                                        <div class="back-stars">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>

                                            <div class="front-stars" style="width: 60%">
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if($org->tournaments[$i]->canceled == 1)
                                    <img class="card-img-top rounded mx-auto" src="../../public/storage/images/{{$org->tournaments[$i]->path}}" alt="Responsive image" style="width: 100%;">
                                    @else
                                    <a href="{{route('matchRegistered',['id'=>$org->tournaments[$i]->id,'url'=>$org->tournaments[$i]->code])}}"><img class="card-img-top rounded mx-auto" src="../../public/storage/images/{{$org->tournaments[$i]->path}}" alt="Responsive image" style="width: 100%;"></a>
                                    @endif


                                <div class="bg-primary rounded" style="position: absolute;top:55px;right: 10px;color: white;padding: 2px;">
                                    <p style="padding: 0px;margin: 0px;">{{$org->tournaments[$i]->endTimeDays}} روز مانده </p>
                                </div>
                                <div class="card-block">
                                    <div class="row" >
                                        <span class="badge badge-default"> {{$org->tournaments[$i]->cost}}   تومان</span>
                                        <span class="badge badge-default">{{$org->tournaments[$i]->mode}}</span>
                                        <span class="badge badge-default">{{$org->tournaments[$i]->matchType}}</span>
                                        <span class="badge badge-default">{{$org->tournaments[$i]->attendType}}</span>
                                    </div>

                                    {{--<p hidden>{{$t = 0}}</p>--}}
                                    {{--@foreach($registereds as $registered)--}}
                                    {{----}}
                                        {{--@for($p=0 ; $p<count($matches); $p++)--}}
                                        {{----}}
                                        {{--@if($registered->id == $matches[$p]->id)--}}
                                            {{--<p hidden>{{$t++}}</p>--}}
                                            {{--<a style="background: orange;color: #1d1e1f" href="challenge-detail-{{$matches[$i]->id}}-{{$matches[$i]->matchName}}" class="btn">جزییات مسابقه</a>--}}

                                        {{--@endif--}}
                                    {{--@endfor--}}
                                    {{--@endforeach--}}

                                    {{--@if($t==0)--}}
                                        {{--@if($matches[$i]->endTime == 0)--}}

                                            {{--<a href="challenge-register-{{$matches[$i]->id}}-{{$matches[$i]->matchName}}" class="btn btn-danger">تمام شد</a>--}}

                                        {{--@else--}}
                                            {{--<a href="challenge-register-{{$matches[$i]->id}}-{{$matches[$i]->matchName}}" class="btn btn-success">ثبت نام</a>--}}


                                        {{--@endif--}}
                                    {{--@endif--}}

                                </div>

                                </div>
                            </div>


                        </div>
                        @endfor
                    </div>


                </div>
            </div>
        </div>

    </div>

    {{--<script type="text/javascript" src="../../public/js/jquery-3.2.1.js"></script>--}}
    <script type="text/javascript" src="../../public/js/main.js"></script>
    <script type="text/javascript" src="../../public/js/bootstrap.js"></script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOUQbmEcxW09DMfiP8SR96YclW5S87qec&callback=myMap">
    </script>
    <script>
        {{--function myMap() {--}}
            {{--var mapOptions = {--}}
                {{--center: new google.maps.LatLng({!! json_encode($org->lat) !!},{!! json_encode($org->lng) !!}),--}}
                {{--zoom: 10,--}}
                {{--mapTypeId: google.maps.MapTypeId.HYBRID--}}
            {{--}--}}
            {{--var map = new google.maps.Map(document.getElementById("map"), mapOptions);--}}
        {{--}--}}
        function myMap() {
            var mapCanvas = document.getElementById("map");
            var myCenter = new google.maps.LatLng({!! json_encode($org->lat) !!},{!! json_encode($org->lng) !!});
            var mapOptions = {center: myCenter, zoom: 15};
            var map = new google.maps.Map(mapCanvas,mapOptions);
            var marker = new google.maps.Marker({
                position: myCenter,
                animation: google.maps.Animation.BOUNCE
            });
            marker.setMap(map);
        }
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