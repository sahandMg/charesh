@extends('masterUserHeader.body')
@section('title')
    چارش | پنل پیام رسانی مسابقه  {{$tournament->matchName}}
@endsection
@section('content')
    @include('masterOrganize.body',['tournament'=> $tournament,'route'=>$route])
 <div class="container" id="message">
     <div class="wallDiv">
        <h2>فرستادن پیام به شرکت کنندگان در مسابقه</h2>
        @if(count(session('message')))
         <div class="alert alert-success ">
             {{session('message')}}
         </div>
        @endif
     <form method="post" action="{{route('challengeMessage',['id'=>$tournament,'matchName'=>$tournament->matchName])}}">
         <input type="hidden" name="_token" value="{{csrf_token()}}">
         @if(count($errors->all()))
             <div class="alert alert-danger" role="alert">
                 @foreach($errors->all() as $error)
                     <li>{{$error}}</li>
                 @endforeach
             </div>
         @endif
         <textarea name="message" id="summernote" cols="100" rows="6"></textarea>
      <div class="form-group">
	      <div class="col-5">
              @if($tournament->matchType == 'تیمی')
                <select name="team" class="form-control form-control-lg" style="height: 35px;padding: 0px;padding-right: 5px;" id="mySelect">
                 <option disabled>انتخاب ...</option>
                 <option value="all">همه تیم ها</option>
                 @foreach($teams as $team)
	              <option >{{$team->teamName}}</option>
                 @endforeach
                </select>

               @endif
               @if($tournament->matchType == 'انفرادی')
                 <select name="user" class="form-control form-control-lg" style="height: 35px;padding: 0px;padding-right: 5px;" id="mySelect">
                   <option disabled>انتخاب ...</option>
                   <option value="all">همه شرکت کنندگان</option>
                     @for($i=0;$i<count($username);$i++)
                        <option >{{$username[$i]}}</option>
                      @endfor

                 </select>
               @endif
	     </div>
     </div>
     <button @click="hidden" v-show="!hide" type="submit" class="btn btn-primary" >ارسال پیام</button>

         <button v-show="hide" class="btn btn-warning " :disabled="true"><i class="fa fa-spinner fa-spin" ></i> در حال ارسال </button>

     </form>
</div>


  
  </div>

    <style>
        .wallDiv {
            width: 95%;
            height: auto;
            margin: auto;
            display: block;
            margin-top: 7%;
            margin-bottom: 2%;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            transition: 0.3s;
            border-radius: 5px; /* 5px rounded corners */
            background-color: white;
            direction: rtl;
            /*float: left;*/
            padding: 1%;

        }
        .wallDiv {
            text-align: center;
        }
    </style>

    <script>
        new Vue({

            el:'#message',
            data:{
                hide:false
            },
            methods:{

                hidden:function () {
                    this.hide = true
                }
            }

        })
  </script>


 {{--<script type="text/javascript" src="js/jquery-3.2.1.js"></script>--}}
    <script type="text/javascript" src="{{URL::asset('js/main.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/bootstrap.js')}}"></script>
 <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOUQbmEcxW09DMfiP8SR96YclW5S87qec&callback=myMap">
 </script>
 <script>
  function myMap() {
  var mapOptions = {
      center: new google.maps.LatLng(51.5, -0.12),
      zoom: 10,
      mapTypeId: google.maps.MapTypeId.HYBRID
  }
  var map = new google.maps.Map(document.getElementById("map"), mapOptions);
  }

  </script>

@endsection