@extends('masterUserHeader.body')
@section('content')

 <div class="container" style="direction: rtl;" id="app">

  <nav class="nav nav-pills nav-fill" style="padding-top: 50px;">
    <a class="nav-item nav-link disabled" href="#">اطلاعات پایه</a>
    <a class="nav-item nav-link active" href="#">اطلاعات مسابقه</a>
    <a class="nav-item nav-link disabled" href="#">قوانین</a>
    <a class="nav-item nav-link disabled" href="#">برنامه مسابقات</a>
    <a class="nav-item nav-link disabled" href="#">اطلاعات ثبت نام</a>
    <a class="nav-item nav-link disabled" href="#">راه های ارتباطی</a>
  </nav>

   <form style="padding-top: 20px;font-size: 20px;" method="post" action="{{route('matchInfo')}}">

       <input type="hidden" name="_token" value="{{csrf_token()}}">

      <!-- ٍٍError message -->
       @if(count($errors->all()))
       <div class="alert alert-danger" role="alert">
           @foreach($errors->all() as $error)

               <li>{{$error}}</li>

           @endforeach
       </div>
       @endif

    <div class="form-group row">
      <label for="Name-input" class="col-2 col-form-label">به صورت :</label>
      <div class="col-5">
       <select @change="check" v-model="mode" name="mode" class="form-control form-control-lg" style="height: 35px;padding: 0px;padding-right: 5px;" id="mySelect">
           <option disabled value="">انتخاب ...</option>
           <option value="غیر حضوری">غیر حضوری</option>
        <option value="حضوری">حضوری</option>
      </select>
     </div>
    </div>

    <div class="form-group row">
      <label for="Name-input" class="col-2 col-form-label">نوع مسابقه :</label>
      <div class="col-5">
       <select name="matchType" v-model="matchType" @change="check" class="form-control form-control-lg" style="height: 35px;padding: 0px;padding-right: 5px;" id="selectkind">
           <option disabled value="">انتخاب ...</option>
           <option value="انفرادی">انفرادی</option>
        <option value="تیمی">تیمی</option>
      </select>
     </div>
    </div>

  <div class="form-group row" id="fardi">
      <label for="Name-input" class="col-2 col-form-label">حداکثر تعداد شرکت کننده ها : </label>
      <div class="col-5">
       <input name="maxAttenders" @input="check"  v-model="maxAttenders"  class="form-control" type="number" placeholder="به عدد" id="example-text-input">
     </div>
    </div>

   <div class="form-group row" id="Timi3" style="display: none;">
      <label for="Name-input" class="col-2 col-form-label">حداکثر تعداد تیم ها : </label>
      <div class="col-5">
       <input name="maxTeam" @input="check"  v-model="maxTeam"  class="form-control" type="number" placeholder="به عدد" id="example-text-input">
     </div>
    </div>

   <div class="form-group row" id="Timi2" style="display: none;">
      <label for="Name-input" class="col-2 col-form-label">حداقل تعداد اعضای تیم : </label>
      <div class="col-5">
       <input name="minMember" @input="check"  v-model="minMember" class="form-control" type="number" placeholder="به عدد" id="example-text-input">
     </div>
    </div>

   <div class="form-group row" id="Timi1" style="display: none;">
      <label for="Name-input" class="col-2 col-form-label">حداکثر تعداد اعضای تیم : </label>
      <div class="col-5">
       <input name="maxMember" @input="check"  v-model="maxMember" class="form-control" type="number" placeholder="به عدد" id="example-text-input">
     </div>
    </div>

    <div class="form-group row">
      <label for="Name-input" class="col-2 col-form-label">نوع برگزاری :</label>
      <div class="col-5">
       <select name="attendType" v-model="attendType" @change="check" class="form-control form-control-lg" style="height: 35px;padding: 0px;padding-right: 5px;">
           <option disabled value="">انتخاب ...</option>
           <option value="یک مرحله ای - حذفی">یک مرحله ای - حذفی</option>
        <option value="دو مرحله ای - گروهی - حذفی">دو مرحله ای - گروهی - حذفی</option>
        <option value="لیگ">لیگ</option>
      </select>
     </div>
    </div>

   <div class="form-group row">
    <label for="InputFile" class="col-2 col-form-label">جوایز : </label>
    <div class="col-5">
     <textarea name="prize"   class="form-control" id="summernote" rows="3"></textarea>
    </div>
   </div>


       <div id="map" style="width:80%;height: 250px; background:whitesmoke;position: relative;display: none"></div>

       <br>
    <div class="form-group row">
     <a href="{{route('returnBaseInfo')}}" class="btn btn-danger" style="margin-left: 20px;">بازگشت</a>
     <button :disabled="btn" type="submit" class="btn btn-primary">ادامه</button>
   </div>

       <input type="hidden" name="lat" id="lat" value="">
       <input type="hidden" name="lng" id="lng" >
  </form>




</div>
 <script>

     vm = new Vue({
         el:'#app',
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
//             style1:{borderColor:'#d9d9d9',borderStyle:'solid',fontSize:'16',height:'35',padding:0,paddingRight:5},
//             style2:{borderColor:'#d9d9d9',borderStyle:'solid'},
//             style3:{borderColor:'#d9d9d9',borderStyle:'solid'},
//             style4:{borderColor:'#d9d9d9',borderStyle:'solid'},
//             style5:{borderColor:'#d9d9d9',borderStyle:'solid'},
         },

         methods:{
             check:function () {


                   if(this.matchType == "انفرادی") {


                       if (this.mode.length > 0 && this.matchType.length > 0 && this.maxAttenders.length > 0 && this.attendType.length > 0 ) {

                           this.btn = false
                       } else {

                           this.btn = true

                       }
                   }
                   else{


                       if (this.mode.length > 0 && this.matchType.length > 0 && this.minMember.length > 0 && this.maxMember.length > 0  && this.maxTeam.length > 0  && this.attendType.length > 0 ) {

                           this.btn = false
                       } else {

                           this.btn = true

                       }

                   }



             }
         }
     })

 </script>


<script type="text/javascript" src="../../public/js/bootstrap.js"></script>
<script type="text/javascript">
    function myFunction() {
        var x = document.getElementById("mySelect").value ;

        if( x == "انفرادی" ) {
            document.getElementById("fardi").style.display = "block"
            document.getElementById("Timi").style.display = "none" ;
        }
        if ( x == "غیرحضوری" ) {
            document.getElementById("fardi").style.display = "none" ;
            document.getElementById("Timi").style.display = "block  "
        }
    }
</script>
</div>

 {{--<script type="text/javascript" src="js/jquery-3.2.1.js"></script>--}}
 <script type="text/javascript" src="../../public/js/bootstrap.js"></script>
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
                 $('#Timi1').css({"display":"flex"});
                 $('#Timi2').css({"display":"flex"});
                 $('#Timi3').css({"display":"flex"});
                 $('#fardi').css({"display":"none"});
             } else {
                 $('#Timi1').css({"display":"none"});
                 $('#Timi2').css({"display":"none"});
                 $('#Timi3').css({"display":"none"});
                 $('#fardi').css({"display":"flex"});
             }

         });

         $('#mySelect').change(function(){

             if ($(this).find("option:selected").attr('value') == "حضوری") {
                 $('#map').css({"display":"flex"});
                 initialize();
             } else {
                 $('#map').css({"display":"none"});
             }

         });
     });



 </script>

 <script type="text/javascript">

 </script>
@endsection
