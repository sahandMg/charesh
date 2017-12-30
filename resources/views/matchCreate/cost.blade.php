@extends('masterUserHeader.body')
@section('content')

 <div class="container" style="direction: rtl;" id="app">

  <nav class="nav nav-pills nav-fill" style="padding-top: 50px;">
    <a class="nav-item nav-link disabled" href="#">اطلاعات پایه</a>
    <a class="nav-item nav-link disabled" href="#">اطلاعات مسابقه</a>
    <a class="nav-item nav-link disabled" href="#">قوانین</a>
    <a class="nav-item nav-link disabled" href="#">برنامه مسابقات</a>
    <a class="nav-item nav-link active" href="#">اطلاعات ثبت نام</a>
    <a class="nav-item nav-link disabled" href="#">راه های ارتباطی</a>
  </nav>

   <form style="padding-top: 20px;font-size: 20px;" method="post" action="{{route('cost')}}">
       <input type="hidden" name="_token" value="{{csrf_token()}}">

    <!-- ٍٍError message -->
      {{--<div class="alert alert-danger" role="alert">--}}
       {{--<strong>ایمیل</strong> خود را اشتباه وارد کرده اید .--}}
      {{--</div>--}}

    <div class="form-group row">
        <label for="Name-input" class="col-2 col-form-label">هزینه ثبت نام(تومان) : </label>
        <div class="col-5">
         <input name="cost" v-model="cost"  @input="check"  class="form-control" type="number" min="1000" step="1000" :value="cost" placeholder="به تومان" id="example-text-input">
       </div>

   <h3>اختیاری </h3>

    <div class="form-group row">
    <label for="InputFile" class="col-2 col-form-label">اطلاعات بیشتر : </label>
    <div class="col-5">
     <textarea name="moreInfo" class="form-control" id="summernote" rows="5" placeholder="اطلاعات بیشتری که می خواهید اینجا توضیح دهید تا شرکت کنندگان وارد کنند ."></textarea>
    </div>
   </div>

     <div class="form-group row">
           <a href="{{route("returnPlanInfo")}}" class="btn btn-danger" style="margin-left: 20px;">بازگشت</a>
           <button :disabled="btn" type="submit" class="btn btn-primary">ادامه</button>
       </div>

  </form>
</div>
 <script>

     vm = new Vue({

         el:'#app',
         data:{
             cost:1000,
             btn:true,
             number: 1000,
             animatedNumber: 1000,
         },

         watch: {
             number: function(newValue, oldValue) {
                 var vm = this
                 var animationFrame
                 function animate (time) {
                     TWEEN.update(time)
                     animationFrame = requestAnimationFrame(animate)
                 }
                 new TWEEN.Tween({ tweeningNumber: oldValue })
                         .easing(TWEEN.Easing.Quadratic.Out)
                         .to({ tweeningNumber: newValue }, 500)
                         .onUpdate(function () {
                             vm.animatedNumber = this.tweeningNumber.toFixed(0)
                         })
                         .onComplete(function () {
                             cancelAnimationFrame(animationFrame)
                         })
                         .start()
                 animationFrame = requestAnimationFrame(animate)
             }
         },
         methods:{

             check:function () {


                 if(this.cost>= 1000){

                     this.btn = false

                 }else{
                     this.btn = true

                 }

             }

         },

         created:function () {
             this.check()

         }

     })

 </script>
</div>

 <script type="text/javascript" src="js/bootstrap.js"></script>
@endsection
