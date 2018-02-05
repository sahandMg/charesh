@extends('masterUserHeader.body')
@section('title')
    چارش | قوانین مسابقه
@endsection

@section('content')
    <ul class="nav nav-tabs" id="app">
        <li class="disabled"><a href=""> اطلاعات ثبت نام </a></li>
        <li class="active"><a href=""> قوانین </a></li>
        <li class="disabled"><a href=""> اطلاعات مسابقه </a></li>
        <li class="disabled"><a href="">اطلاعات پایه</a></li>
    </ul>
  <div class="formDiv">
   <form  method="post" action="{{route('rules')}}" enctype="multipart/form-data">
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
        </div>
      </div>
   <div class="form-group">
     <a href="{{route("returnMatchInfo")}}" class="btn btn-danger" style="margin-left: 20px;">بازگشت</a>
     <button :disabled="btn" type="submit" class="btn btn-primary">ادامه</button>
   </div>
  </form>
</div>
  <style>
        .nav-tabs li {
            width: 25%;
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
        .formDiv {
            width: 80%;
            margin: 0 auto;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            direction: rtl;
            background-color: white;
            margin-top: 2%;
        }
        .formDiv form {
            padding: 1%;
        }
   </style>
@endsection