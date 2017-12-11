@extends('masterHeader.body')
@section('content')

  <div class="container" style="direction: rtl;margin-top: 50px;margin-bottom: 50px;">

    <div class="card" style="box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);z-index: 1;">
     <h3 class="card-title" style="background-color: #42CBC8;padding: 20px;color: white;">تایید ایمیل</h3>
     <form style="padding: 20px;" method="POST" action="{{route('resendVerify')}}">
         <input type="hidden" name="_token" value="{{csrf_token()}}">
      <!-- ٍٍError message -->
         @if(count($errors->all()))
             <div class="alert alert-danger" role="alert">
                 @foreach($errors->all() as $error)

                     <li>{{$error}}</li>

                 @endforeach
             </div>

         @endif
         @if(count(session('message')))
             <div class="alert alert-info" role="alert">
              {{session('message')}}
             </div>

         @endif

            <h4>برای تایید حساب کاربری، بر روی لینک ارسال شده به ایمیل خود کلیک کنید.</h4>
       <br>

      <div class="form-group row">
          <label class="col-2 col-form-label">ایمیل : </label>
          <div class="col-5">
            <input name="email" style="text-align: left;direction: ltr" v-model="email" @input="check"  class="form-control"  type="email" placeholder="bootstrap@example.com" id="example-email-input">
          </div>
      </div>

      <br>
       <button type="submit" class="btn btn-primary"> ارسال مجدد</button>
      </form>
    </div>

  

 </div>




 <script type="text/javascript" src="{{URL::asset('js/bootstrap.js')}}"></script>
 {{--<script type="text/javascript" src="js/jquery-3.2.1.js"></script>--}}
 <script type="text/javascript" src="{{URL::asset('js/main.js')}}"></script>

@endsection





