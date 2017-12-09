@extends('masterUserHeader.body')
@section('content')
  <br>
  <br>
  <br>
   <div class="container" style="direction: rtl;">
    <!-- Tournoments -->
       <h3>چالش های من</h3>

       @if(count($matches))

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
                         <a href="{{route('organizeProfile',['id'=>$match->organize->name])}}">   <img src="../../public/storage/images/{{$match->organize->logo_path}}" class="rounded" height="35px" style="margin-top: 7px;margin-left: 5px; float: left;" > </a>

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
                     @if($match->canceled == 0)
                     <a href="{{route('matchRegistered',['id'=>$match->id , 'url'=>$match->code])}}"><img class="card-img-top rounded mx-auto" src="../../public/storage/images/{{$match->path}}" alt="Responsive image" style="width: 100%;"></a>
                     @else

                         <img class="card-img-top rounded mx-auto" src="../../public/storage/images/{{$match->path}}" alt="Responsive image" style="width: 100%;">
                         @endif

                         <div class="bg-primary rounded" style="position: absolute;top:55px;right: 10px;color: white;padding: 2px;">
                         <p style="padding: 0px;margin: 0px;">{{$match->endTimeDays}} روز مانده </p>
                     </div>
                     <div class="card-block">
                         <div class="row" >
                             <span class="badge badge-default">{{$match->cost}} تومان</span>
                             <span class="badge badge-default">{{$match->mode}}</span>
                             <span class="badge badge-default">{{$match->matchType}}</span>
                             <span class="badge badge-default">{{$match->attendType}}</span>
                             {{--<span class="badge badge-default"> تعداد بلیط های باقی مانده {{$match->tickets}}</span>--}}


                         </div>

                            @if($match->canceled == 0)
                         <a style="background: orange;color: #1d1e1f" href="{{route('matchRegistered',['id'=>$match->id , 'url'=>$match->code])}}" class="btn">جزییات مسابقه</a>
                        @endif
                         {{--@if($match->endTime == 0)--}}

                             {{--<a href="challenge-register-{{$match->id}}-{{$match->matchName}}" class="btn btn-danger">تمام شد</a>--}}

                         {{--@else--}}
                             {{--<a href="challenge-register-{{$match->id}}-{{$match->matchName}}" class="btn btn-success">ثبت نام</a>--}}


                         {{--@endif--}}



                     </div>
                 </div>
             </div>
            </div>
         @endforeach



   
     </div>

           @else

           <center><h3 style="color:darkred;">شما در هیچ مسابقه ای شرکت نکرده اید</h3></center>

           @endif
     <br>
     <br>
   </div>

</div>


  <style>
    .Vnav {
      margin-top: 20px;
      margin-right: 40px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 1;
      background-color: #f1f1f1;
      max-height: 200px;
    }

    .Vnav ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        width: 200px;
        background-color: #f1f1f1;
        
    }

    .Vnav li a {
        display: block;
        color: #000;
        padding: 8px 16px;
        text-decoration: none;
    }

    .Vnav li a.active {
        background-color: #008CBA;
        color: white;
    }

    .Vnav li a:hover:not(.active) {
        background-color: #555;
        color: white;
    }
  </style>

 {{--<script type="text/javascript" src="js/jquery-3.2.1.js"></script>--}}
 <script type="text/javascript" src="../../public/js/main.js"></script>
 <script type="text/javascript" src="../../public/js/bootstrap.js"></script>
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