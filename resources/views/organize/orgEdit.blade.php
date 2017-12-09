@extends('masterUserHeader.body')
@section('content')

  <div class="row" style=" direction: rtl;">
      <div class="Vnav">
          <ul>
              <li><a  href="{{route('orgMatches')}}">پنل مدیریت</a></li>
              <li><a href="{{route('matchCreate')}}">مسابقه جدید</a></li>
              <li><a class="active" href="{{route('orgEdit')}}">ویرایش اطلاعات من</a></li>
              <li><a  href="{{route('organizeAccount')}}">حساب من</a></li>
          </ul>
      </div>
   <div class="container">
    <!-- Tiket Counter -->
    <div class="card row" style=" box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);z-index: 0.5;padding: 20px;margin-top: 20px;">

        <form style="padding: 20px;" method="POST" action="{{route('orgEdit',['id'=>$org->id])}} " enctype="multipart/form-data">
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

       <div class="form-group row">
        <label for="InputFile" class="col-2 col-form-label">لوگو (100px * 100px) : </label>
        <div class="col-5">
         <input type="file" name="logo_path" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
        </div>
       </div>

      <div class="form-group row">
        <label for="InputFile" class="col-2 col-form-label">توضیحات : </label>
        <div class="col-5">
         <textarea class="form-control" name="comment" id="summernote" rows="3"></textarea>
        </div>
       </div>

       <div class="form-group row">
        <label for="InputFile" class="col-2 col-form-label">عکس پشت زمینه (1150px * 380px) : </label>
        <div class="col-5">
         <input type="file" class="form-control-file" name="background_path" id="exampleInputFile" aria-describedby="fileHelp">
        </div>
       </div>
       
        <div class="form-group row">
          <label for="email-input" class="col-2 col-form-label">ایمیل : </label>
          <div class="col-5">
            <input class="form-control" type="email" name="email" placeholder="bootstrap@example.com" id="example-email-input">
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
            <input class="form-control" type="name" name="phoneNumber" placeholder="0xxxxxxxxx" id="Telegram-input">
          </div>
        </div>

        <div class="form-group row">
          <label for="Telegram-input" class="col-2 col-form-label">آدرس : </label>
          <div class="col-5">
            <input class="form-control" type="name" name="address" placeholder="خیابان" id="Telegram-input">
          </div>
        </div>

        <div class="form-group row">
         <div id="map" style="width:80%;height: 250px; background:whitesmoke;"></div>
        </div>


       <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>

    </form>
    </div>
    <br>

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

 {{--<script type="text/javascript" src="js/jquery-3.2.1.js"></script>--}}
 <script type="text/javascript" src="../../public/js/main.js"></script>
 <script type="text/javascript" src="../../public/js/bootstrap.js"></script>
 <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOUQbmEcxW09DMfiP8SR96YclW5S87qec&callback=myMap">
 </script>

  <script>




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