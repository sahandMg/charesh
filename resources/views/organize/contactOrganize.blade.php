@extends('masterUserHeader.body')
@section('content')
 <div class="container" style="direction: rtl;" id="app">

  <nav class="nav nav-pills nav-fill" style="padding-top: 50px;">
    <a class="nav-item nav-link disabled" href="#">اطلاعات پایه</a>
    <a class="nav-item nav-link active" href="#">راه های ارتباطی</a>
  </nav>

     <form style="padding-top: 20px;" method="post" action="{{route('OrganizeContact')}}">
         <input type="hidden" name="_token" value="{{csrf_token()}}">
         <!-- ٍٍError message -->
         {{--<div class="alert alert-danger" role="alert">--}}
             {{--<strong>ایمیل</strong> خود را اشتباه وارد کرده اید .--}}
         {{--</div>--}}
         <div class="form-group row">
             <label for="email-input" class="col-2 col-form-label">ایمیل : </label>
             <div class="col-5">
                 <input @input="check" v-model="email" class="form-control" name="email" type="email" placeholder="name@example.com" id="example-email-input">
             </div>
         </div>




    <h3>اختیاری</h3>
    <br>
         <div class="form-group row">
             <label for="Telegram-input" class="col-2 col-form-label">تلگرام : </label>
             <div class="col-5">
                 <input class="form-control" type="name" name="telegram" placeholder="@example" id="Telegram-input">
             </div>
         </div>

    <div class="form-group row">
      <label for="Telegram-input" class="col-2 col-form-label">شماره تلفن : </label>
      <div class="col-5">
        <input class="form-control" name="phone" type="name" placeholder="0xxxxxxxxx" id="Telegram-input">
      </div>
    </div>

    <div class="form-group row">
      <label for="Telegram-input" class="col-2 col-form-label">آدرس : </label>
      <div class="col-5">
        <input class="form-control" type="name" placeholder="خیابان" id="Telegram-input">
      </div>
    </div>

    <div class="form-group row">
     <div id="map" style="width:80%;height: 250px; background:whitesmoke;"></div>
    </div>
    <br>
         <div class="form-group row">
             <a href="{{route('MakeOrganize')}}" class="btn btn-danger" style="margin-left: 20px;">بازگشت</a>
             <button :disabled="next" type="submit" class="btn btn-primary">ثبت</button>
         </div>
    <br>

  </form>



</div>
 <script>
     vm = new Vue({

         el:'#app',
         data:{

             email:'',
             next:true,


         },
         methods:{

             check:function () {


//
                 console.log(this.email)
                 if(this.email.length > 0 ){

                     this.next = false
                 }else{

                     this.next = true

                 }


             },

         }

     })
 </script>




 <script type="text/javascript" src="{{URL::asset('js/bootstrap.js'}}"></script>
  <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOUQbmEcxW09DMfiP8SR96YclW5S87qec&callback=myMap">
 </script>
 <script>

     var map = null;
     var marker = null;
     var default_lat = 35.6998;
     var default_lng = 51.3374;
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

         axios.post('{{route('orgLocation')}}',{'id':{!! json_encode($org->id) !!} , 'lat': marker.getPosition().lat(),'lng':marker.getPosition().lng()}).then(function (response) {

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
  </script>
@endsection