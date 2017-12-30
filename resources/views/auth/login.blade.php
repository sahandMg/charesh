@extends('masterHeader.body')
@section('content')

  <div class="container" style="direction: rtl;margin-top: 100px;">
    <div class="card"  style=" box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);z-index: 1;">
     <h3 class="card-title" style="background-color: #42CBC8;padding: 20px;color: white;">ورود</h3>
     <form style="padding: 20px;" method="POST" action="{{route('login')}}">
         <input type="hidden" name="_token" value="{{csrf_token()}}">
      <!-- ٍٍError message -->
      @if($errors->all())
         <div class="alert alert-danger" role="alert">
       @foreach($errors->all() as $error)

           <li style="list-style: none">{{$error}}</li>

           @endforeach

      </div>

         @endif

         @if(session('resetError'))
             <div class="alert alert-danger" role="alert">

             {{session('resetError')}}
                 </div>
             @endif

         @if(session('message'))
             <div class="alert alert-success" role="alert">

                 {{session('message')}}
             </div>
         @endif

         @if(session('LoginError'))
             <div class="alert alert-danger" role="alert">

                 {{session('LoginError')}}
             </div>
         @endif




         <div class="form-group">
        <label for="exampleInputEmail1">ایمیل</label>
        <input name="email" type="email" class="form-control" id="exampleInputEmail1" value="{{Request::old('email')}}" aria-describedby="emailHelp" placeholder="ایمیل خود را وارد کنید">
      </div>

      <div class="form-group">
        <label for="exampleInputPassword1">رمز</label>
        <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="رمز">
      </div>
         <br>
         <div class="g-recaptcha" data-sitekey="6LfjSj4UAAAAAD62COv7b0uURhIDgYYAQMRYGY0s"></div>
         <br>
       <button type="submit" class="btn btn-primary">ورود </button>
       <a style="cursor:pointer" id="forget" class="btn btn-link">رمز خود را فراموش کرده اید ؟</a>
      </form>
    </div>
    <br>
    <br>
    
    <div id="passForget" class="card" style="box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);z-index: 1;">
     <h3 class="card-title" style="background-color: #42CBC8;padding: 20px;color: white;">فراموشی رمز</h3>
        <form style="padding: 20px;" method="POST" action="{{route('reset')}}">
            <input type="hidden" name="_token" value="{{csrf_token()}}">

      <div class="form-group">
        <label for="exampleInputEmail1">جهت تغییر رمز عبور، ایمیل خود را وارد کنید</label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="ایمیل خود را وارد کنید">
      </div>

       <button  type="submit" class="btn btn-primary">ارسال</button>

      </form>
    </div>
  </div>

</div>

<style type="text/css">
  #passForget {
   display: none;
  }
</style>

 <script type="text/javascript" src="{{URL::asset('js/jquery-3.2.1.js')}}"></script>
 <script type="text/javascript" src="{{URL::asset('js/bootstrap.js')}}"></script>
 <script type="text/javascript">
$(document).ready(function(){
    var flag = 0 ;
    $("#forget").click(function(){
        if (flag==0)
        {
            $('#passForget').css({"display":"flex"});
            flag = 1 ;
        } else {
            $('#passForget').css({"display":"none"});
            flag = 0 ;
        }

    });
});
 </script>

@endsection


