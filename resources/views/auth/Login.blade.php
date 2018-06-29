@extends('masterHeader.body')
@section('title')
    چارش | ورود
@endsection

@section('content')
  <div  id="app" class="formDiv">
      <h2>ورود</h2>
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
      <form method="POST" action="{{route('login')}}">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <div class="form-group">
              <label for="exampleInputEmail1">ایمیل</label>
              <input name="email" type="text" class="form-control" value="{{Request::old('email')}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="ایمیل خود را وارد کنید">
          </div>
          <div class="form-group">
              <label for="exampleInputPassword1">کلمه عبور</label>
              <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="کلمه عبور">
          </div>
          <br>
          {{--<div class="g-recaptcha" data-sitekey="6LfjSj4UAAAAAD62COv7b0uURhIDgYYAQMRYGY0s"></div>--}}
          <br>
          <button @click="hidden" v-show="!hide" type="submit" class="btn btn-primary" id="btnReg"> ورود </button>
          <button v-show="hide" class="btn btn-warning " :disabled="true"><i class="fa fa-spinner fa-spin" ></i> در حال ورود </button>
          <a style="cursor:pointer" id="forget" class="btn btn-link">رمز خود را فراموش کرده اید ؟</a>
      </form>
  </div>
  <br>
  <br>
  <div id="passForget" class="formDiv" >
      <h3>فراموشی رمز</h3>
      <form method="POST" action="{{route('reset')}}">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <div class="form-group">
              <label for="exampleInputEmail1">جهت تغییر رمز عبور، ایمیل خود را وارد کنید</label>
              <input type="email" name="email" class="form-control" id="exampleInputEmail2" aria-describedby="emailHelp" placeholder="ایمیل خود را وارد کنید">
          </div>
          <br>
          {{--<div class="g-recaptcha" data-sitekey="6LfjSj4UAAAAAD62COv7b0uURhIDgYYAQMRYGY0s"></div>--}}
          <br>
          <button @click="hidden" v-show="!hide" type="submit" class="btn btn-primary" id="btnReg"> ارسال </button>
          <button v-show="hide" class="btn btn-warning " :disabled="true"><i class="fa fa-spinner fa-spin" ></i> در حال ارسال </button>
      </form>
  </div>
  <br>
  <br>
<style type="text/css">
    .formDiv {
        width: 80%;
        margin: 0 auto;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
        direction: rtl;
        background-color: white;
    }
    .formDiv h2 {
        background-color: #42CBC8;
        padding: 20px;
        color: white;
        width: 100%;
        display: block;
    }
    .formDiv form {
        padding: 20px;
    }
    #passForget {
        display: none;
    }
</style>
 <script type="text/javascript">
$(document).ready(function(){
    var flag = 0 ;
    $("#forget").click(function(){
        if (flag==0)
        {
            $('#passForget').css({"display":"block"});
            flag = 1 ;
        } else {
            $('#passForget').css({"display":"none"});
            flag = 0 ;
        }
    });
});
 </script>
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
      });
      new Vue({
          el:'#passForget',
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


