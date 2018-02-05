@extends('masterHeader.body')
@section('title')
    چارش | ثبت نام
@endsection

@section('content')

  <div id="app" class="container" style="direction: rtl;margin-top: 1%;">
    <div class="card" style="box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);z-index: 1;background-color: white;">
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
             <label for="fname"> نام</label>
             <input name="fname" type="name" value="{{Request::old('fname')}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="نام">
         </div>
         <div class="form-group">
             <label for="lname">نام خانوادگی</label>
             <input name="lname" type="name" value="{{Request::old('lname')}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="نام خانوادگی">
         </div>
         <div class="form-group">
             <label for="exampleInputEmail1">ایمیل</label>
             <input name="email" type="text" class="form-control" value="{{Request::old('email')}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="ایمیل">
         </div>

         <div class="form-group">
             <label for="name">نام کاربری</label>
             <input name="username" type="name" value="{{Request::old('username')}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="نام کاربری">
         </div>

         <div class="form-group">
             <label for="exampleInputPassword1">کلمه عبور</label>
             <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="کلمه عبور">
         </div>

         <div class="form-group">
             <label for="exampleInputPassword1">تکرار رمز</label>
             <input name="repeat" type="password" class="form-control" id="exampleInputPassword1" placeholder="تکرار کلمه عبور">
         </div>
         <hr>
         <h4> پس از ثبت نام، در قسمت تنظیمات می توانید این سطح دسترسی را تغییر دهید </h4>
         <div class="form-group" style="font-weight: 400;font-size: 125%;">
           <label class="container respon">ثبت نام به عنوان برگزار کننده مسابقه
              <input type="radio" checked="checked" name="radio" value="supplier">
              <span class="checkmark"></span></label>
           <label class="container respon"> ثبت نام به عنوان شرکت کننده در مسابقه
              <input type="radio" name="radio" value="customer">
              <span class="checkmark"></span></label>
          </div>
       <div class="g-recaptcha" data-sitekey="6LfjSj4UAAAAAD62COv7b0uURhIDgYYAQMRYGY0s"></div>
         <div class="form-group">
           <label class="container">
             <div class="checkbox">
                 <a href="{{route('chareshRule')}}"> قوانین  </a> <span style="padding-left: 0.5%;">سایت چارش را قبول دارم</span>
                 <input   @click="show" type="checkbox" >
             </div>
           </label>
         </div>
         <button @click="hidden" v-show="!hide" :disabled="rule" type="submit" class="btn btn-primary" id="btnReg">ثبت نام</button>
         <button v-show="hide" class="btn btn-warning" :disabled="true"><i class="fa fa-spinner fa-spin"></i>در حال ارسال فرم ثبت نام</button>
         <a href="{{route('login')}}" class="btn btn-link">قبلا ثبت نام کرده ام</a>
      </form>
    </div>
  </div>

<style>
    @media screen and (max-width: 600px) {
       label {
           font-size: 75%;
       }
        h4 {
            font-size: 75%;
        }
        .respon {
            font-size: 55%;
        }
    }
</style>

  <script>
      new Vue({

          el:'#app',
          data:{
              hide:false,
              rule:true
          },
          methods:{

              hidden:function () {
                  this.hide = true
              },
              show:function () {

              this.rule = !this.rule

              }
          }

      })
  </script>

@endsection
