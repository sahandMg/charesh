@extends('masterHeader.body')
@section('content')

  <div class="container" style="direction: rtl;margin-top: 100px;">
    <div class="card" style="box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);z-index: 1;">
     <h3 class="card-title" style="background-color: #42CBC8;padding: 20px;color: white;">ثبت نام</h3>
     <form style="padding: 20px;" method="POST" action="{{route('register')}}">
         <input type="hidden" name="_token" value="{{csrf_token()}}">
      <!-- ٍٍError message -->
      @if(count($errors->all())>0)
         <div class="alert alert-danger" role="alert">
      @foreach($errors->all() as $error)
          <li>{{$error}}</li>
          @endforeach
      </div>
         @endif
	@if(count(session('message'))>0)

	 <div class="alert alert-danger" role="alert">
	{{session('message')}}
	</div>
	@endif
      <div class="form-group">
        <label for="name">نام کاربری</label>
        <input name="username" type="name" value="{{Request::old('username')}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="نام کاربری خود را وارد کنید">
      </div>

      <div class="form-group">
        <label for="exampleInputEmail1">ایمیل</label>
        <input name="email" type="email" class="form-control" value="{{Request::old('email')}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="ایمیل خود را وارد کنید">
      </div>

      <div class="form-group">
        <label for="exampleInputPassword1">رمز</label>
        <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="رمز">
      </div>

      <div class="form-group">
        <label for="exampleInputPassword1">تکرار رمز</label>
        <input name="repeat" type="password" class="form-control" id="exampleInputPassword1" placeholder="تکرار رمز">
      </div>
	<br>
{{--<div class="g-recaptcha" data-sitekey="6LfjSj4UAAAAAD62COv7b0uURhIDgYYAQMRYGY0s"></div>--}}
<br>
       <button type="submit" class="btn btn-primary">ثبت نام </button>
       <a href="{{route('login')}}" class="btn btn-link">قبلا ثبت نام کرده ام</a>
      </form>
    </div>
  </div>


</div>

 <script type="text/javascript" src="{{URL::asset('js/bootstrap.js')}}"></script>
@endsection
