@extends('masterUserHeader.body')
@section('content')
  <div class="row" style=" direction: rtl;">
   <div class="Vnav">
    <ul>
      <li><a class="active" href="{{route('orgMatches')}}">پنل مدیریت</a></li>
      <li><a href="{{route('matchCreate')}}">مسابقه جدید</a></li>
      <li><a href="{{route('orgEdit')}}">ویرایش اطلاعات من</a></li>
      <li><a href="{{route('organizeAccount')}}">حساب من</a></li>
    </ul>
   </div>
   <div class="container">
       <h3>مسابقات من</h3>
    <!-- Tiket Counter -->
    <div class="card row" style=" box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);z-index: 0.5;padding: 20px;margin-top: 20px;">
      <h2>کل بلیت هایی که فروخته اید :  <span id="counter">0</span></h2>  
    </div>
    <br>
    <!-- Tournoments -->
     <div class="row">
      <!-- First -->

         @foreach($matches as $match)


             <div class="col-md-6 col-lg-4" style="padding-top: 10px;">
                 <div class="card" style=" box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);z-index: 0.5;">
                     <div>
                         <h4 class="card-title" style="padding-top: 10px;padding-right: 10px;padding-left: 10px;float: right;">مسابقه {{$match->matchName}}</h4>
                         <a href="{{route('organizeProfile',['id'=>$match->organize->name])}}"> <img src="../../public/storage/images/{{$match->organize->logo_path}}" class="rounded" height="35px" style="margin-top: 7px;margin-left: 5px; float: left;" > </a>
                         {{--<img src="storage/images/{{$match->organize->logo_path}}" class="rounded" height="35px" style="margin-top: 7px;margin-left: 5px; float: left;" >--}}
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
                     <a href=""><img class="card-img-top rounded mx-auto" src="../../public/storage/images/{{$match->path}}" alt="Responsive image" style="width: 100%;"></a>
                     <div class="bg-primary rounded" style="position: absolute;top:55px;right: 10px;color: white;padding: 2px;">
                         <p style="padding: 0px;margin: 0px;">{{$match->endTimeDays}} روز مانده </p>
                     </div>
                     <div class="card-block">
                         <div class="row" >
                             <span class="badge badge-default">{{$match->cost}} تومان</span>
                             <span class="badge badge-default">{{$match->mode}}</span>
                             <span class="badge badge-default">{{$match->matchType}}</span>
                             <span class="badge badge-default">{{$match->attendType}}</span>
                             {{--<span class="badge badge-default"> تعداد بلیط های باقی مانده {{$match->tickets - $match->sold}}</span>--}}

                         </div>


                             <a href="{{route('challengePanel',['id'=>$match->id,'url'=>$match->code])}}" class="btn btn-info">ورود به پنل مسابقه</a>



                     </div>
                 </div>
             </div>

         @endforeach
     </div>
     <br>
     <br>
   </div>

  
  </div>




  <style>
    .Vnav {
      margin-top: 20px;
      margin-right: 40px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 0.5;
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

 <script type="text/javascript" src="../../public/js/main.js"></script>

 <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOUQbmEcxW09DMfiP8SR96YclW5S87qec&callback=myMap">
 </script>
 <script>
//  function myMap() {
//  var mapOptions = {
//      center: new google.maps.LatLng(51.5, -0.12),
//      zoom: 10,
//      mapTypeId: google.maps.MapTypeId.HYBRID
//  }
//      var marker = new google.maps.Marker({
//          position: myCenter,
//          animation: google.maps.Animation.BOUNCE
//      });
//  var map = new google.maps.Map(document.getElementById("map"), mapOptions);
//  }

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