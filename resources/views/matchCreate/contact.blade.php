@extends('masterUserHeader.body')
@section('content')
 <div class="container" style="direction: rtl;" id="app">

  <nav class="nav nav-pills nav-fill" style="padding-top: 50px;">
    <a class="nav-item nav-link disabled" href="#">اطلاعات پایه</a>
    <a class="nav-item nav-link disabled" href="#">اطلاعات مسابقه</a>
    <a class="nav-item nav-link disabled" href="#">قوانین</a>

    <a class="nav-item nav-link disabled" href="#">اطلاعات ثبت نام</a>
    {{--<a class="nav-item nav-link active" href="#">راه های ارتباطی</a>--}}
  </nav>

   <form style="padding-top: 20px;" method="post" action="{{route('contactInfo')}}">
       <input type="hidden" name="_token" value="{{csrf_token()}}">


    <!-- ٍٍError message -->
      {{--<div class="alert alert-danger" role="alert">--}}
       {{--<strong>ایمیل</strong> خود را اشتباه وارد کرده اید .--}}
      {{--</div>--}}


    <div class="form-group row">
        <label for="email-input" class="col-2 col-form-label">ایمیل : </label>
        <div class="col-5">
          <input name="email" style="text-align: left;direction: ltr" v-model="email" @input="check"  class="form-control"  type="email" placeholder="bootstrap@example.com" id="example-email-input">
        </div>
      </div>

    <div class="form-group row">
      <label for="Telegram-input" class="col-2 col-form-label">تلگرام : </label>
      <div class="col-5">
        <input class="form-control" style="text-align: left;direction: ltr" v-model="telegram" @input="check"  name="telegram" type="name" placeholder="@example" id="Telegram-input">
      </div>
    </div>
   
   <div class="form-group row">
     <a href="{{route("returnCostInfo")}}" class="btn btn-danger" style="margin-left: 20px;">بازگشت</a>
     <button :disabled="btn" type="submit" class="btn btn-primary">ثبت مسابقه</button>
   </div>

  </form>
</div>
 <script>

     vm = new Vue({

         el:'#app',
         data:{
             email:'',
             telegram:'',
             btn:true,
         },
         methods:{

             check:function () {


                 if(this.email.length>0 && this.telegram.length>0 && this.email.search('@')>0){

                     this.btn = false

                 }else{
                     this.btn = true

                 }

             }

         }

     })

 </script>
</div>

 <script type="text/javascript" src="js/bootstrap.js"></script>
@endsection
