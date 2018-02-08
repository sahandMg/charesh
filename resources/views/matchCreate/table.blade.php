@extends('masterUserHeader.body')
@section('content')
    <ul class="nav nav-tabs" id="app">
        {{--<li class="disabled"><a href=""> راه های ارتباطی </a></li>--}}
        <li class="disabled"><a href=""> اطلاعات ثبت نام </a></li>

        <li class="disabled"><a href=""> قوانین </a></li>
        <li class="disabled"><a href=""> اطلاعات مسابقه </a></li>
        <li class="disabled"><a href="">اطلاعات پایه</a></li>
    </ul>
 <div class="container" style="direction: rtl;width: 80%;" id="app">



   <form style="padding-top: 20px;" method="post" action="{{route('plan')}}">
       <input type="hidden" name="_token" value="{{csrf_token()}}">

    <!-- ٍٍError message -->
       @if(count($errors->all()))
       <div class="alert alert-danger" role="alert">
           @foreach($errors->all() as $error)

               <li>{{$error}}</li>

           @endforeach
       </div>
       @endif

   <div class="form-group row">
    <label for="InputFile" class="col-2 col-form-label" style="font-size: 150%;font-weight: 400;">برنامه مسابقات : </label>
    <div class="col-5">
     <textarea name="plan" class="form-control"  id="summernote" rows="10"></textarea>
    </div>
   </div>
   
   <div class="form-group row">
     <a href="{{route("returnRuleInfo")}}" class="btn btn-danger" style="margin-left: 20px;">بازگشت</a>
     <button type="submit" :disabled="btn" class="btn btn-primary">ادامه</button>
   </div>

  </form>
</div>
 <style>
     .nav-tabs li {
         width: 16.66666%;
         font-size: 100%;
         font-weight: 400;
     }
     @media screen and (max-width: 800px) {
         .nav-tabs li {
             font-size: 80%;
             font-weight: 400;
         }
     }
     @media screen and (max-width: 600px) {
         .nav-tabs li {
             font-size: 50%;
             font-weight: 400;
         }
         .formDiv {
             width: 95%;
         }
     }
 </style>
 <script>

     vm = new Vue({

         el:'#app',
         data:{
             plan:'',
             btn:false,
         },
         methods:{



         }

     })

 </script>

</div>   

 <script type="text/javascript" src="js/bootstrap.js"></script>
@endsection