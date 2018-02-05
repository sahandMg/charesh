@extends('masterUserHeader.body')
@section('title')
    چارش | اطلاعات مسابقه  {{$tournament->matchName}}
@endsection

@section('content')
    @include('masterOrganize.body',['tournament'=> $tournament,'route'=>$route])
    <div class="container" id="edit">

        <div class="wallDiv">
            <h2>کل بلیت هایی که فروخته اید :  <span id="counter">{{$tournament->sold}}</span></h2>
        </div>
        @if(session('bracketError'))
            <div class="alert alert-danger" role="alert">
                <p style="direction: rtl">{{session('bracketError')}}</p>
            </div>
        @endif
     <div class="wallDiv">
       <form style="padding: 20px;" method="POST" action="{{route('challengePanel',['id'=>$tournament->id,'matchName'=>$tournament->slug])}}" enctype="multipart/form-data">
           <input type="hidden" name="_token" value="{{csrf_token()}}">
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
        <div class="form-group">
            <label for="InputFile">فایل قوانین</label>
            <input type="file" name="rulesPath" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp" style="margin-top: 15px;">
        </div>
        <div class="form-group">
              <label>زمان پایان ثبت نام : </label>
              <input class="form-control"  :style="style4"  name="endTime" type="number" min="1" value="{{Request::old('matchName')}}" placeholder="به روز وارد نمایید ، مثلا : 20 " id="example-text-input">
        </div>
        <div class="form-group">
              <label>تاریخ شروع مسابقه : </label>
              <input class="form-control"  :style="style3"  name="startTime" type="text" placeholder="yyyy/mm/dd" value="{{Request::old('startTime')}}" id="example-text-input">
        </div>
            @if($tournament->matchType == 'تیمی')
               <div class="form-group" id="fardi">
                   <label> تعداد شرکت تیم ها : </label>
                   <input type="number" name="maxAttenders" min="1" class="form-control" placeholder="به عدد" id="example-text-input">
               </div>
            @elseif($tournament->matchType == 'فردی')

             @endif
          <div class="form-group">
              <label>توضیحات : </label>
              <textarea class="form-control"  :style="style5"  name="comment" id="summernote" rows="3"></textarea>
          </div>
        @if($tournament -> mode == "حضوری")
          <div class="form-group">
              <div id="map" style="width:100%;height: 250px; background-color: rgb(229, 227, 223);"></div>
          </div>
        @endif
        <div class="form-group" style="padding-right: 20px;">
            <button  @click="hidden" type="submit" v-show="!hide" class="btn btn-primary">ذخیره تغییرات</button>
            <button v-show="hide" class="btn btn-warning " :disabled="true"><i class="fa fa-spinner fa-spin" ></i> در حال ذخیره </button>
            <button type="button" @click="cancel" class="btn btn-danger">لغو مسابقه</button>
        </div>
   </form>
  </div>
    <br>
    <br>
    <br>
  </div>
  <style>
      .wallDiv {
          width: 95%;
          height: auto;
          margin: auto;
          display: block;
          margin-top: 2%;
          margin-bottom: 2%;
          box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
          transition: 0.3s;
          border-radius: 5px;
          background-color: white;
          direction: rtl;
          padding: 1%;
      }
      .wallDiv h4 {
          text-align: center;
      }
      @media screen and (max-width: 800px) {
          .wallDiv h4 {
              font-size: 125%;
          }
      }
      @media screen and (max-width: 800px) {
          .wallDiv h4 {
              font-size: 100%;
          }
      }
  </style>
 <script type="text/javascript" src="{{URL::asset('js/bootstrap.js')}}"></script>
 <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOUQbmEcxW09DMfiP8SR96YclW5S87qec&callback=myMap">
 </script>
 <script>
     new Vue({

    el:'#edit',

         data:{
             hide:false
         },

    methods:{
        cancel:function () {
            var ans = prompt('جهت لغو مسابقه کلمه لغو را وارد کنید');
            if(ans == 'لغو'){
                vm = this;
                axios.get({!! json_encode(route('cancelChallenge'))!!}+'?id='+ {!!$tournament->id !!}).then(function (response) {
                    if(response.status == 200){
                        alert(response.data)
                        window.location.href = {!! json_encode(route('orgMatches',['orgName'=>Auth::user()->organize->slug])) !!}

                    } else{
                        alert( 'خطا در برقراری ارتباط با سرور' )
                    }

                })
            }
        },
        hidden:function () {
            this.hide = true
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
    axios.post('{{route('matchLocation')}}',{'id':{!! json_encode($tournament->id) !!} , 'lat': marker.getPosition().lat(),'lng':marker.getPosition().lng()}).then(function (response) {
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
