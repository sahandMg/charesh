@extends('masterHeader.body')
@section('content')

  <div id="app" class="container" style="direction: rtl;margin-top: 2%;margin-bottom: 2%;">
    <div class="card" style="box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);z-index: 1;background-color: white;">
     <h2 class="card-title" style="background-color: #42CBC8;padding: 20px;color: white;">تایید ایمیل</h2>
     <form style="padding: 1%;" method="POST" action="{{route('resendVerify')}}">
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
         <h2>برای تایید حساب کاربری، بر روی لینک ارسال شده به ایمیل خود کلیک کنید.</h2>
         <hr>
      <div class="form-group">
          <label>ایمیل : </label>
            <input name="email" style="text-align: left;direction: ltr" v-model="email" @input="check"  class="form-control"  type="email" placeholder="bootstrap@example.com" id="example-email-input">
      </div>

      <br>
         <button @click="hidden" v-show="!hide" type="submit" class="btn btn-primary" id="btnReg">ارسال مجدد</button>
         <button v-show="hide" class="btn btn-primary "><i class="fa fa-spinner fa-spin"></i>در حال ارسال</button>
         <span>در صورت دریافت نکردن ایمیل از طرف سایت، مجدداً ایمیل خود را وارد کنید.</span>‌
     </form>
    </div>
 </div>
  <style>

      @media screen and (max-width: 600px) {
          h2 {
              font-size: 100%;
          }
          span {
              font-size: 75%;
          }
      }
  </style>
  <script>
      new Vue({
          el:'#app',
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
@endsection





