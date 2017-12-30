@extends('masterUserHeader.body')
@section('content')
  <div class="row" style=" direction: rtl;">
      <div class="Vnav">
          <ul>
              <li><a  href="{{route('orgMatches',['orgName'=>$name->organize->slug])}}">پنل مدیریت</a></li>
              <li><a href="{{route('matchCreate')}}">مسابقه جدید</a></li>
              <li><a href="{{route('orgEdit',['orgName'=>$name->organize->slug])}}">ﻭیرایش اطلاعات من</a></li>
              <li><a class="active" href="{{route('organizeAccount',['orgName'=>$name->organize->slug])}}"> حساب من</a></li>

          </ul>
      </div>
   <div class="container">
    <!-- Tiket Counter -->
    <div class="card row" style=" box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);z-index: 0.5;padding: 20px;margin-top: 20px;">

        <form style="padding: 20px;" method="POST" action="{{route('organizeAccount',['id'=>$org->id,'orgName'=>$name->organize->slug])}}">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
       <h2>موجودی حساب شما : {{$org->credit}} تومان </h2>
       <br>
       <!-- ٍٍError message -->
          @if(count(session('message')) && session('code') == 0)
              <div class="alert alert-success ">
                  {{session('message')}}
              </div>
          @elseif(count(session('message')) && session('code') == 1)

                <div class="alert alert-danger ">
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
       <br>
      <div class="form-group row">
        <label for="Name-input" class="col-2 col-form-label">نام دارنده حساب</label>
        <div class="col-5">
         <input class="form-control" name="owner" type="text" value="" id="example-text-input">
       </div>
      </div>

      <div class="form-group row">
        <label for="Name-input" class="col-2 col-form-label">شماره حساب  </label>
        <div class="col-5">
         <input class="form-control" name="accountNumber" type="text" value="" id="example-text-input">
       </div>
      </div>

      <div class="form-group row">
        <label for="Name-input" class="col-2 col-form-label">بانک  </label>
        <div class="col-5">
         <input class="form-control" name="bank" type="text" value="" id="example-text-input">
       </div>
      </div>
      <br>
       <button type="submit" class="btn btn-primary" >درخواست واریز</button>
      </form>
    </div>
  
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
