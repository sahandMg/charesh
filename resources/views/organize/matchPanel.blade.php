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
           <div class="form-group" id="endTimeDivId">
               <label for="Name-input" style="width: 100%;">زمان پایان ثبت نام  </label>
               {{--<div class="endTimeReg">--}}
               <input class="form-control" @input="check" v-model="endTime" name="endTime" type="number" min="0"  placeholder="به روز وارد نمایید ، مثلا : 20 " id="example-text-input">
               <span @input="convertDate" class="form-control"   v-model="date">@{{date}}</span>


           </div>
        {{--<div class="form-group">--}}
              {{--<label>تاریخ شروع مسابقه : </label>--}}

              {{--<input class="form-control"  :style="style3"  name="startTime" type="text"  placeholder="yyyy/mm/dd" value="{{Request::old('startTime')}}" id="example-text-input">--}}
        {{--</div>--}}
<br>
           <div class="form-group">
               <label for="Name-input">تاریخ شروع مسابقه  </label>
               <div>
                   <input style="float: right;margin-left: 1%;width: 25%;" type="number" min="1" max="31" class="form-control" @input="check"  :style="style3" v-model="startDay" placeholder="روز" name="startDay" type="text"  id="example-text-input">

                   <select name="startMonth" v-model="startMonth" style="float: right;margin-left: 1%;width: 40%;" class="form-control" id="sel1">
                       <option>فروردین</option>
                       <option>اردیبهشت</option>
                       <option>خرداد</option>
                       <option>تیر</option>
                       <option>مرداد</option>
                       <option>شهریور</option>
                       <option>مهر</option>
                       <option>آبان</option>
                       <option>آذر</option>
                       <option>دی</option>
                       <option>بهمن</option>
                       <option>اسفند</option>
                   </select>
                   <select name="startYear" v-model="startYear" style="float: right;margin-left: 1%;width: 32%;" class="form-control" id="sel2">
                       <option>1396</option>
                       <option>1397</option>
                   </select>
               </div>
           </div>

           <br>
            @if($tournament->matchType == 'تیمی')
               <div class="form-group" id="timi">
                   <label> تعداد تیم های شرکت کننده : </label>
                   <input type="number" @input="check" v-model="timi" name="maxAttenders" min="1" class="form-control" placeholder="به عدد" id="example-text-input">
               </div>
            @elseif($tournament->matchType == 'انفرادی')
               <div class="form-group" id="fardi">
                   <label> تعداد شرکت کنندگان : </label>
                   <input type="number" v-model="fardi" @input="check" name="maxAttenders" min="1" class="form-control" placeholder="به عدد" id="example-text-input">
               </div>
             @endif
           <br>
          <div class="form-group">
              <label>توضیحات : </label>
	<p> {!!$tournament->comment!!} </p>
              <textarea class="form-control"  :style="style5"  name="comment" id="summernote" rows="3"></textarea>
          </div>
        @if($tournament -> mode == "حضوری")
          <div class="form-group">
              <div id="map" style="width:100%;height: 250px; background-color: rgb(229, 227, 223);"></div>
          </div>
        @endif
        <div class="form-group" style="padding-right: 20px;">
            <button  @click="hidden" type="submit" v-show="!hide" :disabled="saveBtn" class="btn btn-primary">ذخیره تغییرات</button>
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
      #endTimeDivId input {
          width: 20%;
          margin-left: 1%;
          float: right;
      }
      #endTimeDivId span {
          float: right;
          margin-left: 1%;
          width: 25%;
      }
      @media screen and (max-width: 600px) {
          .endTimeReg input{
              width: 40%;
          }
          .endTimeReg select{
              width: 40%;
          }
          #endTimeDivId span {
              width: 40%;
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
             hide:false,
             startMonth:{!! json_encode(unserialize($tournament->startTime)[1]) !!},
             startYear:{!! json_encode(unserialize($tournament->startTime)[2]) !!},
             startDay:{!! json_encode(unserialize($tournament->startTime)[0]) !!},
             endTime:{!! json_encode($tournament->endTimeDays) !!},
           date:{!! json_encode($tournament->endTimeDays) !!},
             saveBtn:false,
             fardi:{!! json_encode($tournament->maxAttenders) !!},
             timi:{!! json_encode($tournament->maxTeam) !!},
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
        check:function () {

            if(this.fardi != null){

                if(this.endTime == null || this.startDay == 0 || this.startDay == null || this.fardi == 0 || this.fardi == null){
                    this.saveBtn = true
                }else{

                    this.saveBtn = false
                }
            }else
            if(this.timi != null){

                if(this.endTime == null || this.startDay == 0 || this.startDay == null || this.timi == 0 || this.timi == null){
                    this.saveBtn = true
                }else{

                    this.saveBtn = false
                }

            }


            vm = this
            axios.get({!! json_encode(route('convertDate')) !!}+'?day=' + this.endTime).then(function (response) {

                vm.date = response.data
            })
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
    google.maps.event.addListener(map, 'dblclick', function(e) {
        var positionDoubleclick = e.latLng;
        marker.setPosition(positionDoubleclick);
        // if you don't do this, the map will zoom in

        e.stopPropagation();
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
