@extends('masterUserHeader.body')
@section('content')
@section('title')
    چارش | اطلاعات مسابقه
@endsection
    <ul class="nav nav-tabs">
        <li class="disabled"><a href=""> اطلاعات ثبت نام </a></li>
        <li class="disabled"><a href=""> قوانین </a></li>
        <li class="active"><a href=""> اطلاعات مسابقه </a></li>
        <li class="disabled"><a href="">اطلاعات پایه</a></li>
    </ul>
  <div class="formDiv" id="matchInfo">
   <form  method="post" action="{{route('matchInfo')}}">
       <input type="hidden" name="_token" value="{{csrf_token()}}">
      <!-- ٍٍError message -->
       @if(count($errors->all()))
       <div class="alert alert-danger" role="alert">
           @foreach($errors->all() as $error)
               <li>{{$error}}</li>
           @endforeach
       </div>
       @endif

    <div class="form-group">
      <label> به صورت </label>
      <select @change="check" v-model="mode" name="mode" class="form-control form-control-lg" style="height: 35px;padding: 0px;padding-right: 5px;" id="mySelect">
        <option disabled value="">انتخاب ...</option>
        <option value="غیر حضوری">غیر حضوری</option>
        <option value="حضوری">حضوری</option>
      </select>
    </div>

    <div class="form-group">
      <label> نوع مسابقه  </label>
       <select name="matchType" v-model="matchType" @change="check" class="form-control form-control-lg" style="height: 35px;padding: 0px;padding-right: 5px;" id="selectkind">
         <option disabled value="">انتخاب ...</option>
         <option value="انفرادی">انفرادی</option>
         <option value="تیمی">تیمی</option>
      </select>
    </div>

    <div class="form-group" id="fardi">
      <label>  تعداد شرکت کننده ها  </label>
      <input name="maxAttenders" @input="check"  v-model="maxAttenders"  class="form-control" type="number" min="1" max="100" placeholder="به عدد" id="example-text-input">
    </div>

   <div class="form-group" id="Timi3" style="display: none;">
      <label> حداکثر تعداد تیم ها  </label>
      <input name="maxTeam" @input="check"  v-model="maxTeam"  class="form-control" type="number" min="1" max="100" placeholder="به عدد" id="example-text-input">
    </div>

   <div class="form-group" id="Timi1" style="display: none;">
      <label>  تعداد اعضای تیم  </label>
      <input name="maxMember" @input="check"  v-model="maxMember" class="form-control" type="number" min="1" max="100" placeholder="به عدد" id="example-text-input">
   </div>
       <div class="form-group" id="Timi2" style="display: none;">
           <label>  تعداد افراد ذخیره تیم  </label>
           <input name="subst" @input="check"  v-model="subst" class="form-control" type="number" min="1" max="100" placeholder="به عدد" id="example-text-input">
       </div>

    <div class="form-group">
      <label for="Name-input"> نوع برگزاری </label>
       <select name="attendType" v-model="attendType" @change="check" class="form-control form-control-lg" style="height: 35px;padding: 0px;padding-right: 5px;">
        <option disabled value="">انتخاب ...</option>
        <option value="یک مرحله ای - حذفی">یک مرحله ای - حذفی</option>
        <option value="دو مرحله ای - گروهی - حذفی">دو مرحله ای - گروهی - حذفی</option>
        <option value="لیگ">لیگ</option>
      </select>
    </div>

   <div class="form-group">
    <label for="InputFile"> جوایز  </label>
    <textarea name="prize"   class="form-control" id="summernote" rows="3"></textarea>
   </div>
    <h4 id="guide" style="display: none">در صورت معلوم نبودن محتوای نقشه، روی علامت [ ] در بالای نقشه کلیک کنید</h4>
    <div class="form-group" id="address" style="display: none;">
        <label> آدرس </label>
        <br>
        <select name="city"  style="float: right;margin-left: 1%;width: 30%;" class="form-control" id="sel1">
            <option value="East Azerbaijan">آذربایجان شرقی</option>
            <option value="West Azerbaijan">آذربایجان غربی</option>
            <option value="ardabil">اردبیل </option>
            <option value="Esfehan">اصفهان </option>
            <option value="ardabil">البرز </option>
            <option value="Ilam">ایلام </option>
            <option value="Bushehr">بوشهر </option>
            <option value="Tehran">تهران </option>
            <option value="Chahar Mahaal and Bakhtiari">چهارمحال و بختیاری</option>
            <option value="Khorasan">خراسان </option>
            <option value="Khuzestan">خوزستان </option>
            <option value="Zanjan">زنجان  </option>
            <option value="Semnan">سمنان  </option>
            <option value="Sistan and Baluchistan">سیستان و بلوچستان </option>
            <option value="Fars">فارس  </option>
            <option value="Qazvin">قزوین  </option>
            <option value="Qom">قم  </option>
            <option value="Kurdistan">کردستان  </option>
            <option value="Kerman">کرمان  </option>
            <option value="Kermanshah">کرمانشاه  </option>
            <option value="Kohkiluyeh and Buyer Ahmad">کهگیلویه و بویراحمد </option>
            <option value="Golestan">گلستان  </option>
            <option value="Gilan">گیلان   </option>
            <option value="Lorestan">لرستان  </option>
            <option value="Mazandaran">مازندران   </option>
            <option value="Markazi">مرکزی   </option>
            <option value="Hormozgan">هرمزگان   </option>
            <option value="Hamadan">همدان   </option>
            <option value="Yazd">یزد   </option>
        </select>
       <input name="address" class="form-control" type="text" placeholder="آدرس" style="width: 60%;" >
    </div>
   <div id="map" style="width:80%;height: 250px; background:whitesmoke;position: relative;display: none"></div>
   <br>
    <div class="form-group">
     <a href="{{route('returnBaseInfo')}}" class="btn btn-danger" style="margin-left: 20px;">بازگشت</a>
     <button :disabled="btn" type="submit" class="btn btn-primary">ادامه</button>
   </div>

       <input type="hidden" name="lat" id="lat" value="">
       <input type="hidden" name="lng" id="lng" >
  </form>
</div>
    <style>
        .nav-tabs li {
            width: 25%;
            font-size: 100%;
            font-weight: 400;
        }
        @media screen and (max-width: 800px) {
            .nav-tabs li {
                font-size: 80%;
                font-weight: 400;
            }
        }
        @media screen and (max-width: 600px) {
            .nav-tabs li {
                font-size: 50%;
                font-weight: 400;
            }
            .formDiv {
                width: 95%;
            }
        }
        .formDiv {
            width: 80%;
            margin: 0 auto;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            direction: rtl;
            background-color: white;
            margin-top: 2%;
        }
        .formDiv form {
            padding: 1%;
        }
    </style>
 <script>
     vm = new Vue({
         el:'#matchInfo',
         data:{
             mode:'',
             matchType:'',
             maxAttenders:'',
             attendType:'',
             minMember:'',
             maxMember:'',
             maxTeam:'',
             prize:'',
             btn:true,
         },

         methods:{
             check:function () {

                   if(this.matchType == "انفرادی") {
                       this.btn = true;
                       this.subst = '';
                       this.maxMember = '';
                       this.maxTeam = '';


                       if (this.mode.length > 0 && this.matchType.length > 0 && this.maxAttenders.length > 0 && this.attendType.length > 0 ) {

                           this.btn = false
                       } else {

                           this.btn = true
                       }
                   }
                   else{

                       this.maxAttenders = ''
                       this.btn = true
                       if (this.mode.length > 0 && this.matchType.length > 0 && this.subst.length > 0 && this.maxMember.length > 0  && this.maxTeam.length > 0  && this.attendType.length > 0 ) {

                           this.btn = false
                       } else {

                           this.btn = true
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

     var map = null;
     var marker = null;
     var default_lat = 35.700099108612996;
     var default_lng = 51.33760368041999;
     var default_zoom = 15;
     var map_div = "map";
     var infowindow;
     var geocoder;
     function myMap() {

         var latlng = new google.maps.LatLng(default_lat, default_lng);

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

     function showMarker() {
         // remove all markers
         remove_all_markers();

         marker = new google.maps.Marker({
             position: map.getCenter(),
             map: map,
//            title: arr_markers[marker_index]["name"],
             draggable: true
         });

         build_info_window();

         google.maps.event.addListener(marker, 'click', function (event) {
             build_info_window();
         });

         google.maps.event.addListener(marker, "dragend", function () {
             build_info_window();
         });

     }


     function remove_all_markers() {
         if (this.marker != null) {
             this.marker.setMap(null);
         }
     }

     function build_info_window() {

         var sea_level;
         document.getElementById('lat').value = marker.getPosition().lat()
         document.getElementById('lng').value = marker.getPosition().lng()

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
     function  initialize() {

         // some google objects
          infowindow = new google.maps.InfoWindow();
          geocoder = new google.maps.Geocoder();


//         $(document).ready(function () {
//             $("#frm_show_address").submit(function () {
//                 var street_address = $("#street_address").val();
//                 if (street_address.length > 0) {
//                     // display code address
//                     showAddress(street_address);
//                 }
//
//                 return false;
//             });

//         });


     }


     $(document).ready(function() {
         $('#selectkind').change(function(){

             if ($(this).find("option:selected").attr('value') == "تیمی") {
                 $('#Timi1').css({"display":"block"});
                 $('#Timi2').css({"display":"block"});
                 $('#Timi3').css({"display":"block"});
                 $('#fardi').css({"display":"none"});
             } else {
                 $('#Timi1').css({"display":"none"});
                 $('#Timi2').css({"display":"none"});
                 $('#Timi3').css({"display":"none"});
                 $('#fardi').css({"display":"block"});
             }

         });

         $('#mySelect').change(function(){

             if ($(this).find("option:selected").attr('value') == "حضوری") {
                 $('#map').css({"display":"flex"});
                 $('#guide').css({"display":"flex"});
                 $('#address').css({"display":"block"});
                 initialize();
             } else {
                 $('#map').css({"display":"none"});
                 $('#guide').css({"display":"none"});
                 $('#address').css({"display":"none"});
             }
         });
     });



 </script>

 <script type="text/javascript">

 </script>
@endsection
