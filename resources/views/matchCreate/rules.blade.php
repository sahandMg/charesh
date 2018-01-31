@extends('masterUserHeader.body')
@section('content')
    <ul class="nav nav-tabs" id="app">
        {{--<li class="disabled"><a href=""> راه های ارتباطی </a></li>--}}
        <li class="disabled"><a href=""> اطلاعات ثبت نام </a></li>

        <li class="active"><a href=""> قوانین </a></li>
        <li class="disabled"><a href=""> اطلاعات مسابقه </a></li>
        <li class="disabled"><a href="">اطلاعات پایه</a></li>
    </ul>
 <div class="container" style="direction: rtl;width: 80%;">

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

    <style>
        .nav-tabs li {
            width: 20%;
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
        }
    </style>


 <script type="text/javascript" src="js/bootstrap.js"></script>
@endsection