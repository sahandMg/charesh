@extends('masterUserHeader.body')
@section('content')

  <div class="row" style=" direction: rtl;" id="app">
    <!-- right menu -->
      <div class="Vnav">
          <ul>
              <li><a class="active" href="{{route('orgMatches')}}">پنل مدیریت</a></li>
              <li><a href="{{route('matchCreate')}}">مسابقه جدید</a></li>
              <li><a href="{{route('orgEdit')}}">ویرایش اطلاعات من</a></li>
              <li><a href="{{route('organizeAccount')}}">حساب من</a></li>
          </ul>
      </div>
  <!-- content -->
   <div class="container" style="width: 100%">
    <br>
   @include('masterOrganize.body',['tournament'=> $tournament,'route'=>$route])


       <br>
    <br>
    <!-- Tiket Counter -->

       <form style="padding: 20px;" method="POST" action="{{route('challengePanel',['id'=>$tournament->id,'url'=>$tournament->code])}}" enctype="multipart/form-data">
           <input type="hidden" name="_token" value="{{csrf_token()}}">
           @if(session('bracketError'))


               <div class="alert alert-danger" role="alert">

                   <p>{{session('bracketError')}}</p>


               </div>
           @endif

           <div class="card row" style=" box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);z-index:0.5;padding: 20px;margin-top: 20px;width: 100%;">
        <h2>کل بلیت هایی که فروخته اید :  <span id="counter">{{$tournament->sold}}</span></h2>
      </div>
      <br>
           {{--<div>--}}
           @if(count($errors->all()))
               <div class="alert alert-danger" role="alert">
                <ul>
                   @foreach($errors->all() as $error)

                       <li>{{$error}}</li>

                   @endforeach
                </ul>
               </div>
                   @endif



               @if(session('message'))
               <div class="alert alert-success" role="alert">
                   <ul>
                       <li>{{session('message')}}</li>
                   </ul>

               </div>
           @endif


           {{--</div>--}}



      <div class="card row" style=" box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);z-index: 0.5;padding: 20px;margin-top: 20px;width: 100%;">



        <div class="form-group row">
            <label for="InputFile" class="col-3 col-form-label"><h2>فایل قوانین</h2></label>
            <div class="col-6">
              <input type="file" name="rulesPath" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp" style="margin-top: 15px;">
            </div>
        </div>

          <div class="form-group row">
              <label class="col-3 col-form-label">زمان پایان ثبت نام : </label>
              <!-- <label class="col-2 col-form-label">ایمیل : </label> -->
              <div class="col-5">
                  <input class="form-control"  :style="style4"  name="endTime" type="number" min="1" value="{{Request::old('matchName')}}" placeholder="به روز وارد نمایید ، مثلا : 20 " id="example-text-input">
              </div>
          </div>

          <div class="form-group row">
              <label class="col-3 col-form-label">تاریخ شروع مسابقه : </label>
              <div class="col-5">
                  <input class="form-control"  :style="style3"  name="startTime" type="text" placeholder="yyyy/mm/dd" value="{{Request::old('startTime')}}" id="example-text-input">
              </div>
          </div>

          <div class="form-group row">
              <label class="col-3 col-form-label">توضیحات : </label>
              <div class="col-5">
                  <textarea class="form-control"  :style="style5"  name="comment" id="summernote" rows="3"></textarea>
              </div>
          </div>

          <div class="form-group row" id="fardi">
              <label class="col-3">حداکثر تعداد شرکت کننده ها : </label>
              <div class="col-5">
                  <input type="number" name="maxAttenders" class="form-control" placeholder="به عدد" id="example-text-input">
              </div>
          </div>

          <div class="form-group row">
              <label class="col-3 col-form-label">ایمیل : </label>
              <div class="col-5">
                  <input name="email" style="text-align: left;direction: ltr"   class="form-control"  type="email" placeholder="bootstrap@example.com" id="example-email-input">
              </div>
          </div>

          <div class="form-group row">
              <label class="col-3 col-form-label">تلگرام : </label>
              <div class="col-5 col-form-label">
                  <input class="form-control" style="text-align: left;direction: ltr" v-model="telegram"   name="telegram" type="text" placeholder="@example" id="Telegram-input">
              </div>
          </div>




      </div>

      <br>
        @if($tournament -> mode == "حضوری")
      <div class="card row" style=" box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);z-index: 0.5;padding: 20px;margin-top: 20px;width: 100%;">
       <div class="form-group row">
          <div id="map" style="width:100%;height: 250px; background-color: rgb(229, 227, 223);">
          </div>
        </div>
      </div>

        @endif

      <div class="card row" style=" box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);z-index: 0.2;padding: 20px;margin-top: 20px;width: 100%;">
       <div class="form-group row" style="padding-right: 20px;">
         <button type="submit"  class="btn btn-info">ذخیره تغییرات</button>

        </div>
      </div>

           <div class="card row" style=" box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);z-index: 0.5;padding: 20px;margin-top: 20px;width: 100%;">
               <div class="form-group row" style="padding-right: 20px;">
                   <button type="button" @click="cancel" class="btn btn-danger">لغو مسابقه</button>
               </div>
           </div>

   </form>

    <br>
    <br>
    <br>



  </div>


  <style>
    .Vnav {
      margin-top: 20px;
      margin-right: 40px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 0.1;
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
//     function myMap() {
//         var mapCanvas = document.getElementById("map");
//         var myCenter = new google.maps.LatLng(51.508742,-0.120850);
//         alert(myCenter);
//         var mapOptions = {center: myCenter, zoom: 5};
//         var map = new google.maps.Map(mapCanvas,mapOptions);
//         var marker = new google.maps.Marker({
//             position: myCenter,
//             animation: google.maps.Animation.BOUNCE,
//             draggable: true
//         });
//
//         marker.setMap(map);
//     }
//new Vue({
//    el:'#app',
//    data:{
//
//    },
//    methods:{
//
//        getCoordinate:function () {
//
//            this.build_info_window()
//
//        }
//    },
//
//})

new Vue({

    el:'#app',
    data:{},
    methods:{
        cancel:function () {
            vm = this;

            axios.post({!! json_encode(route('cancelChallenge',['id'=>$tournament->id]))!!}).then(function (response) {

                if(response.status == 200){

                    alert(response.data)

                } else{

                    alert( 'خطا در برقراری ارتباط با سرور' )
                }

            })
        }
    }

});



var map = null;
var marker = null;
var default_lat = {!! json_encode($tournament->lat)!!};
var default_lng = {!! json_encode($tournament->lng) !!};
var default_zoom = 15;
var map_div = "map";
// some google objects
var infowindow = new google.maps.InfoWindow();
var geocoder = new google.maps.Geocoder();

$(document).ready(function() {
    $("#frm_show_address").submit(function() {
        var street_address = $("#street_address").val();
        if(street_address.length > 0 ){
            // display code address
            showAddress(street_address);
        }

        return false;
    });

});

function myMap() {

    var latlng = new google.maps.LatLng(default_lat,default_lng);

    var mapOptions = {
        scaleControl: true,
        zoom: default_zoom,
        zoomControl: true,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        draggableCursor: 'crosshair'
    };

    map = new google.maps.Map(document.getElementById(map_div), mapOptions);

    showMarker();
}

function showMarker(){
    // remove all markers
    remove_all_markers();

    marker = new google.maps.Marker({
        position: map.getCenter(),
        map: map,
//            title: arr_markers[marker_index]["name"],
        draggable: true
    });

    build_info_window();

    google.maps.event.addListener(marker, 'click', function(event) {
        build_info_window();
    });

    google.maps.event.addListener(marker, "dragend", function() {
        build_info_window();
    });

}



function remove_all_markers(){
    if(this.marker != null){
        this.marker.setMap(null);
    }
}

function build_info_window() {

    var sea_level;
//    alert(marker.getPosition().lat())

    {{--$.ajax({--}}
        {{--url: "coordinate",--}}
        {{--type: "POST",--}}
        {{--dataType: 'html',--}}
        {{--data: {--}}
            {{--lat: marker.getPosition().lat(),--}}
            {{--lng: marker.getPosition().lng(),--}}
            {{--id:{!! json_encode($tournament->id) !!}--}}
        {{--},--}}
        {{--success: function(respText) {--}}

            {{--console.log(respText)--}}
        {{--}--}}


    {{--})--}}
//alert (marker.getPosition().lat())
    axios.post('{{route('matchLocation')}}',{'id':{!! json_encode($tournament->id) !!} , 'lat': marker.getPosition().lat(),'lng':marker.getPosition().lng()}).then(function (response) {

//        console.log(response.data)
    })
}
function showPosition(position) {
    var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

    var mapOptions = {
        scaleControl: true,
        zoom: default_zoom,
        zoomControl: true,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        draggableCursor: 'crosshair'
    };

    map = new google.maps.Map(document.getElementById(map_div), mapOptions);

    showMarker();
}

  $({countNum: $('#counter').text()}).animate({countNum: 100}, {
    duration: 1000,
    easing:'linear',
    step: function() {
      $('#counter').text(Math.floor(this.countNum));
    },
    complete: function() {
      $('#counter').text({!! json_encode($tournament->sold) !!});
    }
  })
  </script>
@endsection
