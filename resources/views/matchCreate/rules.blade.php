@extends('masterUserHeader.body')
@section('content')
 <div class="container" style="direction: rtl;">

  <nav class="nav nav-pills nav-fill" style="padding-top: 50px;">
    <a class="nav-item nav-link disabled" href="#">اطلاعات پایه</a>
    <a class="nav-item nav-link disabled" href="#">اطلاعات مسابقه</a>
    <a class="nav-item nav-link active" href="#">قوانین</a>
    <a class="nav-item nav-link disabled" href="#">برنامه مسابقات</a>
    <a class="nav-item nav-link disabled" href="#">اطلاعات ثبت نام</a>
    <a class="nav-item nav-link disabled" href="#">راه های ارتباطی</a>
  </nav>

  <br>
  <br>
   <form style="padding-top: 20px;" method="post" action="{{route('rules')}}" enctype="multipart/form-data">
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
        <label for="InputFile" class="col-4 col-form-label">قوانین (فایل PDF) :</label>
        <div class="col-6">
          <input name="rulesPath" type="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">

            {{--<textarea name="rules" id="" cols="30" rows="10"></textarea>--}}
        
        </div>
      </div>
   
   <div class="form-group row">
     <a href="{{route("returnMatchInfo")}}" class="btn btn-danger" style="margin-left: 20px;">بازگشت</a>
     <button :disabled="btn" type="submit" class="btn btn-primary">ادامه</button>
   </div>

  </form>
</div>


</div>




 <script type="text/javascript" src="js/bootstrap.js"></script>
@endsection