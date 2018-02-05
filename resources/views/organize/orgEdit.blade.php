@extends('masterUserHeader.body')
@section('title')
    چارش | تنظیمات  {{$org->name}}
@endsection
@section('content')

   <div class="container" style=" direction: rtl;" id="Edit">

    <div class="card row" style=" box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);z-index: 0.5;padding: 1%;margin-top: 2%;background-color: white;">
        <h2 class="card-title" style="background-color: #42CBC8;padding: 20px;color: white;">تنظیمات پروفایل</h2>
        <form style="padding: 20px;" method="POST" action="{{route('orgEdit',['id'=>$org->id,'orgName'=>$name->organize->slug])}} " enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
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
       {{--<div class="form-group">--}}
        {{--<label for="InputFile">لوگو (100px * 100px) : </label>--}}
        {{--<input type="file" name="logo_path" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">--}}
       {{--</div>--}}
            <div class="wrapperImageUpload">
                <div class="boxImageUpload">
                    <div class="js--image-preview"></div>
                    <div class="upload-options">
                        <label>
                            <input name="logo_path" type="file" class="image-upload" aria-describedby="fileHelp" accept="image/*"  />
                        </label>
                    </div>
                </div>
            </div>
      <div class="form-group">
        <label for="InputFile">توضیحات : </label>
        <textarea class="form-control" name="comment" id="summernote" rows="3"></textarea>
       </div>
       {{--<div class="form-group">--}}
        {{--<label for="InputFile">عکس پشت زمینه (1150px * 380px) : </label>--}}
        {{--<input type="file" class="form-control-file" name="background_path" id="exampleInputFile" aria-describedby="fileHelp">--}}
       {{--</div>--}}
            {{----}}
            <div class="wrapperImageUpload">
                <div class="boxImageUpload">
                    <div class="js--image-preview"></div>
                    <div class="upload-options">
                        <label>
                            <input name="background_path" type="file" class="image-upload" aria-describedby="fileHelp" accept="image/*"  />
                        </label>
                    </div>
                </div>
            </div>
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
 <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOUQbmEcxW09DMfiP8SR96YclW5S87qec&callback=myMap">
 </script>
   <style>

       @import url(https://fonts.googleapis.com/icon?family=Material+Icons);
       @import url("https://fonts.googleapis.com/css?family=Raleway");

       .wrapperImageUpload {
           display: flex;
           flex-direction: row;
           flex-wrap: wrap;
           align-items: center;
           justify-content: center;
       }

       .boxImageUpload {
           display: block;
           min-width: 300px;
           height: 300px;
           margin: 10px;
           background-color: white;
           border-radius: 5px;
           box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
           transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
           overflow: hidden;
       }

       .upload-options {
           position: relative;
           height: 75px;
           background-color: cadetblue;
           cursor: pointer;
           overflow: hidden;
           text-align: center;
           transition: background-color ease-in-out 150ms;
       }
       .upload-options:hover {
           background-color: #7fb1b3;
       }
       .upload-options input {
           width: 0.1px;
           height: 0.1px;
           opacity: 0;
           overflow: hidden;
           position: absolute;
           z-index: -1;
       }
       .upload-options label {
           display: flex;
           align-items: center;
           width: 100%;
           height: 100%;
           font-weight: 400;
           text-overflow: ellipsis;
           white-space: nowrap;
           cursor: pointer;
           overflow: hidden;
       }
       .upload-options label::after {
           content: 'add';
           font-family: 'Material Icons';
           position: absolute;
           font-size: 2.5rem;
           color: #e6e6e6;
           top: calc(50% - 2.5rem);
           left: calc(50% - 1.25rem);
           z-index: 0;
       }
       .upload-options label span {
           display: inline-block;
           width: 50%;
           height: 100%;
           text-overflow: ellipsis;
           white-space: nowrap;
           overflow: hidden;
           vertical-align: middle;
           text-align: center;
       }
       .upload-options label span:hover i.material-icons {
           color: lightgray;
       }

       .js--image-preview {
           height: 225px;
           width: 100%;
           position: relative;
           overflow: hidden;
           background-image: url('../100_100.jpg');
           background-color: white;
           background-position: center center;
           background-repeat: no-repeat;
           background-size: cover;
       }
       .js--image-preview.js--no-default::after {
           display: none;
       }

       i.material-icons {
           transition: color 100ms ease-in-out;
           font-size: 2.25em;
           line-height: 55px;
           color: white;
           display: block;
       }

       .dropImage {
           display: block;
           position: absolute;
           background: rgba(95, 158, 160, 0.2);
           border-radius: 100%;
           transform: scale(0);
       }

       .animateImage {
           animation: ripple 0.4s linear;
       }

       @keyframes ripple {
           100% {
               opacity: 0;
               transform: scale(2.5);
           }
       }
   </style>
   <script>
       function initImageUpload(box) {
           let uploadField = box.querySelector('.image-upload');

           uploadField.addEventListener('change', getFile);

           function getFile(e){
               let file = e.currentTarget.files[0];
               checkType(file);
           }

           function previewImage(file){
               let thumb = box.querySelector('.js--image-preview'),
                   reader = new FileReader();

               reader.onload = function() {
                   thumb.style.backgroundImage = 'url(' + reader.result + ')';
               }
               reader.readAsDataURL(file);
               thumb.className += ' js--no-default';
           }

           function checkType(file){
               let imageType = /image.*/;
               if (!file.type.match(imageType)) {
                   throw 'Datei ist kein Bild';
               } else if (!file){
                   throw 'Kein Bild gewählt';
               } else {
                   previewImage(file);
               }
           }

       }

       // initialize box-scope
       var boxes = document.querySelectorAll('.boxImageUpload');

       for(let i = 0; i < boxes.length; i++) {
           let box = boxes[i];
           initDropEffect(box);
           initImageUpload(box);
       }



       /// drop-effect
       function initDropEffect(box){
           let area, drop, areaWidth, areaHeight, maxDistance, dropWidth, dropHeight, x, y;

           // get clickable area for drop effect
           area = box.querySelector('.js--image-preview');
           area.addEventListener('click', fireRipple);

           function fireRipple(e){
               area = e.currentTarget
               // create drop
               if(!drop){
                   drop = document.createElement('span');
                   drop.className = 'dropImage';
                   this.appendChild(drop);
               }
               // reset animate class
               drop.className = 'dropImage';

               // calculate dimensions of area (longest side)
               areaWidth = getComputedStyle(this, null).getPropertyValue("width");
               areaHeight = getComputedStyle(this, null).getPropertyValue("height");
               maxDistance = Math.max(parseInt(areaWidth, 10), parseInt(areaHeight, 10));

               // set drop dimensions to fill area
               drop.style.width = maxDistance + 'px';
               drop.style.height = maxDistance + 'px';

               // calculate dimensions of drop
               dropWidth = getComputedStyle(this, null).getPropertyValue("width");
               dropHeight = getComputedStyle(this, null).getPropertyValue("height");

               // calculate relative coordinates of click
               // logic: click coordinates relative to page - parent's position relative to page - half of self height/width to make it controllable from the center
               x = e.pageX - this.offsetLeft - (parseInt(dropWidth, 10)/2);
               y = e.pageY - this.offsetTop - (parseInt(dropHeight, 10)/2) - 30;

               // position drop and animate
               drop.style.top = y + 'px';
               drop.style.left = x + 'px';
               drop.className += ' animateImage';
               e.stopPropagation();

           }
       }

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
      var infowindow = new google.maps.InfoWindow();
      var geocoder = new google.maps.Geocoder();
      $(document).ready(function() {
          $("#frm_show_address").submit(function() {
              var street_address = $("#street_address").val();
              if(street_address.length > 0 ){
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
          remove_all_markers();
          marker = new google.maps.Marker({
              position: map.getCenter(),
              map: map,
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
          axios.post('{{route('orgLocation')}}',{'id':{!! json_encode($org->id) !!} , 'lat': marker.getPosition().lat(),'lng':marker.getPosition().lng()}).then(function (response) {
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
