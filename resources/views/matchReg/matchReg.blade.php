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
<div class="container" style="direction: rtl;margin-top: 1%; overflow-x: hidden;" id="app" >
    @if(count($errors->all()))
        <div class="alert alert-danger" role="alert">
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </div>
    @endif
    @if(count(session('message')))
        <div class="alert alert-success" role="alert">
            {{session('message')}}
        </div>
    @endif
    <div class="tournoment">
        <div class="tournomentHeader">
            <a href="{{route('organizeProfile',['id'=>$org->name])}}">
                <img src="{{URL::asset('storage/images/'.$org->logo_path)}}" alt="{{$org->logo_path}}">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
            </a>
            <h2>  {{$tournament->matchName}} </h2>
        </div>
        <div class="banner">
          <img src="{{URL::asset('storage/images/'.$tournament->path)}}" alt="{{$tournament->path}}" >
            <div class="top-right" style="direction: rtl"> {{$tournament->endTimeDays}} روز مانده </div>
            <button class="top-left" style="color: white;" onclick="showModal({{$tournament->id}})"><i class="fa fa-share-alt fa-4" aria-hidden="true"></i></button>
        </div>
        <div class="tournomentTag">
            @if($tournament->cost == 0)
                <small><i class="fa fa-usd"></i> رایگان  </small>
            @else
                <small><i class="fa fa-usd"></i> {{$tournament->cost}}  تومان </small>
            @endif
                <small><i class="fa fa-calendar"></i> {{unserialize($tournament->startTime)[0]}} {{unserialize($tournament->startTime)[1]}} {{unserialize($tournament->startTime)[2]}} </small>
            <small><i class="fa fa-address-card-o"></i> {{$tournament->mode}} </small>
            @if($tournament->matchType == 'تیمی')
               <small><i class="fa fa-users"></i> {{$tournament->matchType}} </small>
            @else
               <small><i class="fa fa-user"></i> {{$tournament->matchType}} </small>
             @endif
        </div>
        <hr>
        <div class="tournomentDescription">
            <p>{!!$tournament->comment!!}</p>
        </div>
        <hr>
        <div class="tournomentInfo">
            <div class="column" >
                <h6> جوایز </h6>
                <p>{!!$tournament->prize!!}</p>
                <hr>
                <div>
                    <div  class="column">
                        <h6> قوانین </h6>
                        <a class="pdfFile" href="{{URL::asset('storage/pdfs/'.$tournament->rules)}}"><i class="fa fa-file-pdf-o fa-lg" aria-hidden="true"></i></a>
                    </div>
                    <div  class="column">
                        <button class="btn btn-primary" onclick="document.getElementById('id01').style.display='block'" style="margin-top: 20px;"> ارتباط با برگزار کننده <i style="font-size: 125%;" class="fa fa-paper-plane" aria-hidden="true"></i></button>
                    </div>
                </div>
                <br>
            </div>
            <hr class="line">
              @if($tournament->mode == 'حضوری')
                <div class="column">
                 <h6> محل برگزاری </h6>
                 <p>{{$tournament->address}}</p>
                 <div id="map" class="googleMaps"></div>
                    <br>
                </div>
              @else
                  <style>
                      .column {
                          width: 95%;
                      }
                  </style>
                @endif
                <br>
        </div>
        <br>
        <div class="tournomentRegister">
            <hr>


            @if($tournament->endTime > 0 && $tournament->sold != $tournament->tickets )
                @if(Auth::check())
                    @if(count($users) > 0)
                        <a style="text-decoration: none"  href="{{route('generatePdf',['id'=>$tournament->id ,'matchName'=>$tournament->slug,'name'=>Auth::user()->slug])}}"> <button class="regButton"> دریافت نسخه pdf بلیط مسابقه </button></a>
                    @else
                        <a style="text-decoration: none" href="{{route('overView',['id'=>$tournament,'matchName'=>$tournament->matchName])}}"> <button class="regButton">ثبت نام </button></a>
                    @endif
                @else
                    <a style="text-decoration: none" href="{{route('login')}}"><button class="regButton"> برای شرکت در مسابقه ابتدا وارد شوید</button></a>
                @endif
            @else
                @if(Auth::check())
                    @if(count($users) > 0)
                        <a style="text-decoration: none"  href="{{route('generatePdf',['id'=>$tournament->id ,'matchName'=>$tournament->slug,'name'=>Auth::user()->slug])}}"> <button class="regButton" id="pdfRecieve"> دریافت نسخه pdf بلیط مسابقه </button></a>
                        <style>
                            @media screen and (max-width: 800px) {
                                .regButton {
                                    font-size: 55%;
                                    width: 80%;
                                }
                            }
                        </style>

                    @endif
                @endif
            @endif


        </div>
        <br>
        <br>
    </div>

</div>
<br>
<br>
<div id="id01" class="modal">
    <form class="modal-content animate" method="POST" action="{{route('userMessage',['id'=>$tournament->id])}}">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="imgcontainer">
            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
            <h4>ارتباط با برگزار کننده</h4>
        </div>
        <br>
        <div class="container1" style="direction: rtl;">
           @if(!Auth::check())
            <label><b>نام</b></label>
            <input type="text" placeholder="نام خود را وارد کنید" name="name" required>
            <label><b>ایمیل</b></label>
            <input  type="text" placeholder="ایمیل خود را وارد کنید" name="email" required>
            @endif
            <div class="form-group ">
                <label> متن پیام </label>
                <textarea class="form-control"  id="summernote" name="message" rows="3"></textarea>
            </div>
            <button type="submit"  class="sendMessage"> ارسال پیام</button>
        </div>
    </form>
</div>
<div id="myModal" class="modal2">
        <div class="modal-content2" style="height: 80px;">
            <span class="close2">&times;</span>
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
        var modal = document.getElementById('myModal');
        var span = document.getElementsByClassName("close2")[0];
        function showModal(id) {
            modal.style.display = "block";
            axios.get({!! json_encode(route('getLink'))!!}+'?id='+id).then(function (response) {
                $('#link').val({!! json_encode(route('home'))!!}+'/'+response.data.url)
            })
        }
        span.onclick = function() {
            modal.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
<style>
    .modal2 {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0,0,0);
        background-color: rgba(0,0,0,0.4);
    }
    .modal-content2 {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }
    .close2 {
        color: red;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }
    .close2:hover,
    .close2:focus {
        color: red;
        text-decoration: none;
        cursor: pointer;
    }
    .top-right {
        top: 10px;
    }
    .top-left {
        position: absolute;
        top: 10px;
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
    @media screen and (max-width: 1000px) {
        .top-right {
            top: 10px;
        }
        .top-left {
            top: 10px;
        }
    }
    @media screen and (max-width: 800px) {
        .top-right {
            top: 10px;
        }
        .top-left {
            top: 10px;
            left: 6px;
            padding: 2px;
            padding-left: 4px;
            padding-right: 4px;
            border-radius: 4px;
        }
        .tournomentTag  {
            font-size: 90%;
        }
    }
    @media screen and (max-width: 600px) {
        .top-right {
            top: 5px;
        }
        .top-left {
            top: 5px;
        }
        .tournomentTag  {
            font-size: 85%;
        }
        .pdfFile {
           font-size: 75%;
        }
        .btn-primary {
            font-size: 50%;
            width: 40%;
        }
        .tournomentHeader h3 {
            font-size: 100%;
        }
    }
    input[type=text], input[type=password] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }
    .sendMessage {
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
    }
    .sendMessage:hover {
        opacity: 0.8;
    }
    .imgcontainer {
        text-align: center;
        margin: 24px 0 12px 0;
        position: relative;
    }
    .container1 {
        padding: 16px;
    }
    span.psw {
        float: right;
        padding-top: 16px;
    }
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0,0,0);
        background-color: rgba(0,0,0,0.4);
        padding-top: 60px;
    }
    .modal-content {
        background-color: #fefefe;
        margin: 5% auto 15% auto;
        border: 1px solid #888;
        width: 80%;
    }
    .close {
        position: absolute;
        right: 25px;
        top: 0;
        color: #000;
        font-size: 35px;
        font-weight: bold;
    }
    .close:hover,
    .close:focus {
        color: red;
        cursor: pointer;
    }
    .animate {
        -webkit-animation: animatezoom 0.6s;
        animation: animatezoom 0.6s
    }
    @-webkit-keyframes animatezoom {
        from {-webkit-transform: scale(0)}
        to {-webkit-transform: scale(1)}
    }
    @keyframes animatezoom {
        from {transform: scale(0)}
        to {transform: scale(1)}
    }
    @media screen and (max-width: 800px) {
        .close {
            right: 25px;
            top: 0;
            font-size: 25px;
        }
        input[type=text], input[type=password] {
            width: 100%;
            padding: 6px 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
        }
        .modal {
            padding-top: 40px;
        }
    }
    @media screen and (max-width: 600px) {
        .close {
            right: 25px;
            top: 0;
            font-size: 15px;
        }
        input[type=text], input[type=password] {
            width: 100%;
            padding: 3px 5px;
            margin: 4px 0;
            border: 1px solid #ccc;
        }
        .modal {
            padding-top: 20px;
        }
    }
    @media screen and (max-width: 300px) {
        span.psw {
            display: block;
            float: none;
        }
    }
</style>
<script src="{{URL::asset('js/flipclock.js')}}"></script>
<script>
    vm = new Vue({
        el:'#app',
        data:{
            list:[''],
            time:"",
            name:'',
            message:'',
            email:'',
            showFinishImage:false,
            id:'',
            team : false,
            link:'',
            count:4,
            username:'',
            copyLink:'',
            LinkClass:'btn btn-success'
        },
        created:function () {
                var j = 1
                    for(var i = 0 ; i< {!! json_encode($tournament->minMember) !!} ; i++) {
                      $('<div id="in' + i + '" class="form-group row">  <label for="Name-input" class="col-2 col-form-label">  هم تیمی ' + j  + '   </label><div class="col-5"> <input @input="checkInput"  name="teammate' + i + '" class="form-control" type="text"  id="number'+i+'">  </div></div>').insertBefore("#afterName");
                      j++
                    }
            if({!! json_encode($tournament->endTime == 0) !!}) {
                this.showFinishImage = true
            }else {
                this.showFinishImage = false
            }
            if( {!! json_encode($tournament->matchType == "تیمی") !!}){
                this.team = true
            }
            var time = {!! json_encode($tournament->endTime) !!};
            var clock;
            $(document).ready(function() {
                var currentDate = new Date();
                var futureDate  = new Date(currentDate.getFullYear() + 1, 0, 1);
                var diff = Number(time);
                clock = $('.clock').FlipClock(diff, {
                    clockFace: 'DailyCounter',
                    countdown: true
                });
            });
            setTimeout(this.checkTime , 100)
        },
        methods:{
            copy:function () {
                copyText = document.getElementById("myInput");
                copyText.select();
                document.execCommand("Copy");
                this.LinkClass = 'btn btn-danger';
                this.message = 'لینک دعوت کپی شد'
            },
            checkTime:function() {
                var label = document.getElementsByClassName("flip-clock-label");
                for(var i=0 ; i< label.length ; i++){
                    label[i].innerHTML = ' '
                }
                var counters = document.getElementsByClassName("inn");
                for(var i=0 ; i< counters.length ; i++) {
                    if (counters[i].innerHTML > 0) {
                        var t = 1
                    }
                }
            }

        }
    })
</script>

 <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOUQbmEcxW09DMfiP8SR96YclW5S87qec&callback=myMap">
 </script>
 <script>
 var g = {!! $tournament->minMember !!}
 function addInput() {
  if(g < {!! json_encode($tournament->maxMember) !!})
  {
    g++;
      var s = g-1
      $('<div id="in' + g + '" class="form-group row">  <label for="Name-input" class="col-2 col-form-label">  هم تیمی ' + g  + '   </label><div class="col-5"> <input @iput="checkInput"   name="teammate' + s + '" class="form-control" type="text"  id="number'+g+'">  </div></div>').insertBefore("#afterName");
  } else {
    alert('حداکثر تعداد اعضای تیم ' + {!! json_encode($tournament->maxMember) !!} +' نفر می باشد.');
  }
 };

 function removeInput() {
  if ({!! json_encode($tournament->minMember) !!} < g) {
   $('#in' + g).remove();
   g--;
  }
 else {
    alert('حداقل تعداد اعضای تیم ' + {!! json_encode($tournament->minMember) !!} +' نفر می باشد.');
  }
     };
  function myMap() {
   var mapCanvas = document.getElementById("map");
  var myCenter = new google.maps.LatLng({!! json_encode($tournament->lat) !!},{!! json_encode($tournament->lng) !!});
  var mapOptions = {center: myCenter, zoom: 15};
  var map = new google.maps.Map(mapCanvas,mapOptions);
  var marker = new google.maps.Marker({
    position: myCenter,
    animation: google.maps.Animation.BOUNCE
  });
  marker.setMap(map);
  }
  </script>


@endsection
