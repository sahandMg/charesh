@extends('masterUserHeader.body')
@section('content')

   <div class="container" style=" direction: rtl;" id="Edit">
    <!-- Tiket Counter -->
    <div class="card row" style=" box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);z-index: 0.5;padding: 20px;margin-top: 20px;">

        <form style="padding: 20px;" method="POST" action="{{route('orgEdit',['id'=>$org->id,'orgName'=>$name->organize->slug])}} " enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
       <!-- ٍٍError message -->
            @if(count(session('message')) )
                <div class="alert alert-success ">
                    {{session('message')}}
                </div>
            @endif
            @if(count($errors->all()))
                <div class="alert alert-danger" role="alert">

                    @foreach($errors->all() as $error)

                        <li>{{$error}}</li>

                    @endforeach

                </div>
            @endif
	
		@if(count(session('settingError')) )
                <div class="alert alert-danger ">
                    {{session('settingError')}}
                </div>
            @endif


       <div class="form-group">
        <label for="InputFile">لوگو (100px * 100px) : </label>
        <input type="file" name="logo_path" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
       </div>

      <div class="form-group">
        <label for="InputFile">توضیحات : </label>
        <textarea class="form-control" name="comment" id="summernote" rows="3"></textarea>
       </div>

       <div class="form-group">
        <label for="InputFile">عکس پشت زمینه (1150px * 380px) : </label>
        <input type="file" class="form-control-file" name="background_path" id="exampleInputFile" aria-describedby="fileHelp">
       </div>
       
        {{--<div class="form-group">--}}
          {{--<label for="email-input">ایمیل : </label>--}}
          {{--<input class="form-control" type="email" name="email" placeholder="bootstrap@example.com" id="example-email-input">--}}
        {{--</div>--}}
            @if(Auth::user()->role == 'supplier')
                <div class="form-group" style="font-weight: 400;font-size: 125%;">
                    <label class="container" style="color:darkgreen"> برگزار کننده مسابقه
                        <input type="radio" checked="checked" name="radio" value="supplier">
                        <span class="checkmark"></span>
                    </label>
                    <label class="container">  شرکت کننده در مسابقه
                        <input type="radio" name="radio" value="customer">
                        <span class="checkmark"></span>
                    </label>
                </div>

            @else

                <div class="form-group" style="font-weight: 400;font-size: 125%;">
                    <label class="container" > برگزار کننده مسابقه
                        <input type="radio"  name="radio" value="supplier">
                        <span class="checkmark"></span>
                    </label>
                    <label class="container" style="color:darkgreen">  شرکت کننده در مسابقه
                        <input type="radio" name="radio" checked="checked" value="customer">
                        <span class="checkmark"></span>
                    </label>
                </div>

            @endif

        <h3>اختیاری</h3>
        <br>
        <div class="form-group">
          <label for="Telegram-input">آدرس : </label>
          <input class="form-control" type="name" name="address" placeholder="خیابان" id="Telegram-input">
        </div>

        <div class="form-group">
         <div id="map" style="width:80%;height: 250px; background:whitesmoke;"></div>
        </div>
	<br>
	<div class="g-recaptcha" data-sitekey="6LfjSj4UAAAAAD62COv7b0uURhIDgYYAQMRYGY0s"></div>
	<br>
       <button  @click="hidden" type="submit" v-show="!hide" class="btn btn-primary">ذخیره تغییرات</button>
      <button v-show="hide" class="btn btn-warning " :disabled="true"><i class="fa fa-spinner fa-spin" ></i> در حال ذخیره </button>

    </form>
    </div>
    <br>
   </div>



  <style>

  </style>

 {{--<script type="text/javascript" src="js/jquery-3.2.1.js"></script>--}}
  <script type="text/javascript" src="{{URL::asset('js/main.js')}}"></script>
  <script type="text/javascript" src="{{URL::asset('js/bootstrap.js')}}"></script>
 <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOUQbmEcxW09DMfiP8SR96YclW5S87qec&callback=myMap">
 </script>

  <script>


      new Vue({

          el:'#Edit',
          data:{
              hide:false
          },
          methods:{

              hidden:function () {
                  this.hide = true
              }
          }

      })

      var map = null;
      var marker = null;
      var default_lat =  {!! json_encode($org->lat) !!};
      var default_lng = {!! json_encode($org->lng) !!};
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

//        alert(response.data)
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
