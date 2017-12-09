@extends('masterUserHeader.body')
@section('content')

 <div class="container" style="direction: rtl;" id="app">

  <nav class="nav nav-pills nav-fill" style="padding-top: 50px;">
    <a class="nav-item nav-link disabled" href="#">اطلاعات پایه</a>
    <a class="nav-item nav-link disabled" href="#">اطلاعات مسابقه</a>
    <a class="nav-item nav-link disabled" href="#">قوانین</a>
    <a class="nav-item nav-link active" href="#">برنامه مسابقات</a>
    <a class="nav-item nav-link disabled" href="#">اطلاعات ثبت نام</a>
    <a class="nav-item nav-link disabled" href="#">راه های ارتباطی</a>
  </nav>

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
    <label for="InputFile" class="col-2 col-form-label">برنامه مسابقات : </label>
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