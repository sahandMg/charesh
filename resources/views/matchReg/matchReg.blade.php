@extends($auth == 1 ? 'masterUserHeader.body' : 'masterHeader.body')
@section('content')

<div class="container" style="direction: rtl;padding-top: 30px; overflow-x: hidden;" id="app" >

    @include('masterMatch.body',['tournament'=> $tournament,'route'=>$route])

    <br>
    <br>
    @if(count($errors->all()))
        <div class="alert alert-danger" role="alert">

            {{--<li>{{session('message')}}</li>--}}
            @foreach($errors->all() as $error)

                <li>{{$error}}</li>

            @endforeach
        </div>
    @endif

    @if(count(session('message')))

        <div class="alert alert-danger" role="alert">

            {{session('message')}}  <a href="{{route('credit')}}"> افزایش اعتبار</a>

            </div>
        @endif

    <div class="card" style="margin-top: 20px;box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);z-index:0;">
     <div>
          <h4 class="card-title" style="padding-top: 10px;padding-right: 10px;padding-left: 10px;float: right;">مسابقه {{$tournament->matchName}}</h4>
         <h4 class="card-title" style="padding-top: 10px;padding-right: 300px;padding-left: 10px;float:right;">تاریخ برگزاری {{$tournament->startTime}}</h4>
         <a href="{{route('organizeProfile',['id'=>$org->name])}}"> <img src="../../public/storage/images/{{$org->logo_path}}" class="rounded" height="35px" style="margin-top: 7px;margin-left: 5px; float: left;" > </a>
          {{--<img src="storage/images/{{$img}}" class="rounded" height="35px" style="margin-top: 7px;margin-left: 5px; float: left;" >--}}
         {{--@if($tournament->endTime == 0)--}}
             {{--<div v-if="showFinishImage">--}}
                 {{--<img   class="card-img-top" src="storage/images/regfinish.png"  style="position: absolute;top: 59px;" >--}}

             {{--</div>--}}

         {{--@endif--}}

         <div class="star-rating" title="{{$org->rating*10}}%" style="padding-top: 13px;float: left;">
              <div class="back-stars">
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <i class="fa fa-star" aria-hidden="true"></i>

                  <div class="front-stars" style="width:{{$org->rating*10}}%">
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                  </div>
              </div>
          </div>
      </div>
      <img class="card-img-top rounded" src="../../public/storage/images/{{$tournament->path}}" alt="Card image cap" height="400px;">
      <div class="card-block">
       <div class="row" >
           <span class="badge badge-default">{{$tournament->cost}} تومان</span>
           <span class="badge badge-default">{{$tournament->mode}}</span>
           <span class="badge badge-default">{{$tournament->matchType}}</span>
           <span class="badge badge-default">{{$tournament->attendType}}</span>
           <span class="badge badge-default"> تعداد بلیط های باقی مانده {{$tournament->tickets - $tournament->sold}}</span>

       </div>
          <div class="clock" style="margin:2em;position: relative;left: 230px;"></div>

          <hr>
       <div class="row">
         <div class="col-8">
          <p class="card-text">{!!$tournament->comment!!}</p>
         </div>
         <div class="col-4">
           <p>{{$tournament->email}}</p>
             <p>{{$tournament->telegram}}</p>

         </div>
       </div>

       <hr>
       <div class="card-block">
         <div class="row">
           <div class="col-4">
            <h4>جوایز</h4>
            <br>
             <p style="padding-right: 10px;">{!!$tournament->prize!!}</p>

           </div>
           <div class="col-2">
             <h5>قوانین</h5>
             <a href="../../public/storage/pdfs/{{$tournament->rules}}" style="padding: 15px;"><i class="fa fa-file-pdf-o fa-lg" aria-hidden="true"></i></a>
           </div>
           @if($tournament->mode == 'حضوری')
             <div class="col-6">
                <h4>محل برگزاری مسابقه</h4>
                <p>{{$tournament->address}}</p>
               <div id="map" style="width:100%;height: 250px;background-color: rgb(229, 227, 223)">
               </div>
                </div>
            @endif


       </div>
            {{-- Check if user has NOT registered --}}
           @if(count($users)== 0 && $auth == 1 && $tournament->endTime > 0 && $tournament->sold != $tournament->tickets)
               {{-- Check single or team --}}
           @if($tournament->matchType == "تیمی")

    <form style="padding-top: 20px;font-size: 20px;" method="post" action="{{route('matchRegister')}}" enctype="multipart/form-data">
      <input type="hidden" name="_token" value="{{csrf_token()}}">

        <H1>  مشخصات تیم</H1>
      <button type="button" onclick="removeInput()" class="btn btn-danger" style="margin: 10PX;">-</button>
      <button type="button" onclick="addInput()" class="btn btn-info" style="margin: 10PX;">+</button>

      {{--<div class="form-group row">--}}
        {{--<label for="InputFile" class="col-4 col-form-label">لوگو تیم (100px * 100px) </label>--}}
        {{--<div class="col-6">--}}
          {{--<input name="logo" type="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">--}}
        {{--</div>--}}
      {{--</div>--}}

      <div class="form-group row" id="in1">
        <label for="Name-input" class="col-2 col-form-label"> نام تیم</label>
        <div class="col-5">
         <input name="teamName" class="form-control" type="text" value="" id="example-text-input">
       </div>
      </div>

        @if($tournament->matchType == "تیمی")
            <div>
                <label for="InputFile" class="col-4 col-form-label" id="afterName">لوگو (100px * 100px) </label>

                <div class="col-6">
                    <br>

                    <input name="TeamLogo" type="file"   class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
                </div>
            </div>
        @endif
        <input type="hidden" name="matchId" value="{{$tournament->id}}">

        {{--<div class="form-group row" id="in2">--}}
        {{--<label for="Name-input" class="col-2 col-form-label"> 2 هم تیمی  </label>--}}
        {{--<div class="col-5">--}}
         {{--<input name="teammate2" class="form-control" type="text" value="" id="example-text-input">--}}
       {{--</div>--}}
      {{--</div>--}}

      {{--<div class="form-group row" id="in3">--}}
        {{--<label for="Name-input" class="col-2 col-form-label"> 3 هم تیمی </label>--}}
        {{--<div class="col-5">--}}
         {{--<input name="teammate3" class="form-control" type="text" id="example-text-input">--}}
       {{--</div>--}}
      {{--</div>   --}}
      <!-- tozihate digee ke bargozar konnade mikhad -->

        {{--<div class="form-group row" id="in1">--}}
            {{--<label for="Name-input" class="col-2 col-form-label">  سرگروه</label>--}}
            {{--<div class="col-5">--}}
                {{--<input name="teammate0" placeholder="نام کاربری" class="form-control" type="text" value="" id="example-text-input">--}}
            {{--</div>--}}
        {{--</div>--}}
      <br>
        @if(count($tournament->moreInfo)>0)
      <div class="form-group">
        <label for="InputFile">{!!$tournament->moreInfo!!}</label>
        <br>
        <br>

              <h4>اطلاعات درخواست شده در قسمت پایین وارد کنید</h4>
        <div>
         <textarea name="additionalData" class="form-control" id="summernote" rows="10"></textarea>
        </div>


       </div>
        @endif


        {{--<p style="color: red;">لطفا قبل از ثبت نام قوانین مسابقه را بطور کامل مطالعه کنید .</p>--}}
        <p style="color:red;direction: rtl">لطفا پیش از ثبت نام،<a href="../../public/storage/pdfs/{{$tournament->rules}}"> قوانین مسابقه </a>را به طور کامل مطالعه نمایید </p>

        <br>
       <button type="submit" class="btn btn-success" id="btnReg">ثبت نام</button>



      </form>


               {{-- Single --}}
               @else

               @if($tournament->endTime > 0)

               <form style="padding-top: 20px;font-size: 20px;" method="post" action="{{route('matchRegister')}}" enctype="multipart/form-data">
                   <input type="hidden" name="_token" value="{{csrf_token()}}">




                   <!-- tozihate digee ke bargozar konnade mikhad -->
                   <br>

                   <br>
                   <div class="form-group">
                       <label for="InputFile">{!!$tournament->moreInfo!!}</label>
                       <br>
                       <br>
                       @if(count($tournament->moreInfo)>0)
                           <h4>اطلاعات درخواست شده در متن زیر را نیز در پایین وارد کنید</h4>
                           <div>
                               <textarea id="summernote" name="additionalData" class="form-control" id="exampleTextarea" rows="10" placeholder="text editor"></textarea>
                           </div>
                       @endif

                   </div>
                   <br>
                   <input type="hidden" name="single" value="single">
                   <input type="hidden" name="name" value="{{$tournament->matchName}}">
                   <input type="hidden" name="id" value="{{$tournament->id}}">
                   <p style="color:red;direction: rtl">لطفا پیش از ثبت نام،<a href="../../public/storage/pdfs/{{$tournament->rules}}"> قوانین مسابقه </a>را به طور کامل مطالعه نمایید </p>
                   {{--<p style="color: red;">لطفا قبل از ثبت نام قوانین مسابقه رو بطور کامل مطالعه کنید .</p>--}}
                   <button type="submit" class="btn btn-success" id="btnReg">ثبت نام</button>

               </form>

                @endif
           @endif

               @elseif(count($users) > 0)

               <a href="{{route('generatePdf',['id'=>$tournament->id ,'url'=>$tournament->code])}}">دریافت نسخه pdf بلیط مسابقه </a>


           @elseif($auth == 0)
           <a href="{{route('login')}}">برای شرکت در مسابقه ابتدا وارد شوید</a>
        @endif
       </div>
    </div>



 </div>

</div>
<br>
<br>


<script src="../../public/js/flipclock.js"></script>

<script>

    vm = new Vue({

        el:'#app',
        data:{
            list:[''],
            time:"",
            showFinishImage:false,
            id:'',
            team : false,
            link:'',
            count:4,
            username:'',
        },

        created:function () {


                var j = 1
                    for(var i = 0 ; i< {!! json_encode($tournament->minMember) !!} ; i++) {



                            $('<div id="in' + i + '" class="form-group row">  <label for="Name-input" class="col-2 col-form-label">  هم تیمی ' + j  + '   </label><div class="col-5"> <input @input="checkInput"  name="teammate' + i + '" class="form-control" type="text"  id="number'+i+'">  </div></div>').insertBefore("#afterName");
//                        document.getElementById("in"+i).addEventListener("input", this.checkInput);
//                        document.getElementById("in"+i).getElementsByTagName('input')[0].addEventListener("blur", this.checkUser(i));


                    j++
                    }

//
            if({!! json_encode($tournament->endTime == 0) !!}) {

                this.showFinishImage = true

            }else {

                this.showFinishImage = false
            }


            if( {!! json_encode($tournament->matchType == "تیمی") !!}){

                this.team = true

            }

            var time = {!! json_encode($tournament->endTime) !!};
            var clock;

            $(document).ready(function() {

                // Grab the current date
                var currentDate = new Date();

                // Set some date in the future. In this case, it's always Jan 1
                var futureDate  = new Date(currentDate.getFullYear() + 1, 0, 1);

                // Calculate the difference in seconds between the future and current date
                var diff = Number(time);

                // Instantiate a coutdown FlipClock
                clock = $('.clock').FlipClock(diff, {
                    clockFace: 'DailyCounter',
                    countdown: true
                });
            });


            setTimeout(this.checkTime , 100)



        },
        methods:{



//            createLink:function (id,matchName,tag) {
//
//
//
//                this.link = 'match'+'-'+tag+'-'+id+'-'+matchName
//
//            },
//
//
            checkTime:function() {



                var label = document.getElementsByClassName("flip-clock-label");

                for(var i=0 ; i< label.length ; i++){

                    label[i].innerHTML = ' '


                }
//
                var counters = document.getElementsByClassName("inn");


                for(var i=0 ; i< counters.length ; i++) {


                    if (counters[i].innerHTML > 0) {

                        var t = 1

                    }
                }

//                if(t == 0){
//
//                    this.showFinishImage = true
//
//                }

            }

        }
    })


</script>

<script type="text/javascript" src="../../public/js/main.js"></script>


 {{--<script type="text/javascript" src="js/jquery-3.2.1.js"></script>--}}
 {{--<script type="text/javascript" src="js/main.js"></script>--}}
 {{--<script type="text/javascript" src="js/bootstrap.js"></script>--}}
 <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOUQbmEcxW09DMfiP8SR96YclW5S87qec&callback=myMap">
 </script>
 <script>




 var g = {!! $tournament->minMember !!}

// var maxTeamMember = 5 ;
// var minTeamMember = 3 ;

 function addInput() {
  if(g < {!! json_encode($tournament->maxMember) !!})
  {
    g++;
      var s = g-1
      $('<div id="in' + g + '" class="form-group row">  <label for="Name-input" class="col-2 col-form-label">  هم تیمی ' + g  + '   </label><div class="col-5"> <input @iput="checkInput"   name="teammate' + s + '" class="form-control" type="text"  id="number'+g+'">  </div></div>').insertBefore("#afterName");
  } else {
    alert('حداکثر تعداد اعضای تیم ' + {!! json_encode($tournament->maxMember) !!} +' نفر می باشد.');
  }

 };

 function removeInput() {
  if ({!! json_encode($tournament->minMember) !!} < g) {
   $('#in' + g).remove();
   g--;
  }

 else {
    alert('حداقل تعداد اعضای تیم ' + {!! json_encode($tournament->minMember) !!} +' نفر می باشد.');
  }
     };





  function myMap() {
   var mapCanvas = document.getElementById("map");
  var myCenter = new google.maps.LatLng({!! json_encode($tournament->lat) !!},{!! json_encode($tournament->lng) !!});
  var mapOptions = {center: myCenter, zoom: 15};
  var map = new google.maps.Map(mapCanvas,mapOptions);
  var marker = new google.maps.Marker({
    position: myCenter,
    animation: google.maps.Animation.BOUNCE
  });
  marker.setMap(map);
  }
  </script>


@endsection