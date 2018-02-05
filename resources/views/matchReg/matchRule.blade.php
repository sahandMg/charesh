@extends($auth == 1 ? 'masterUserHeader.body' : 'masterHeader.body')
@section('matchName')
    مسابقه {{$tournament->matchName}}
@endsection

@section('title')
    چارش | مسابقه  {{$tournament->matchName}}
@endsection

@section('content')

<div class="container" style="direction: rtl;padding-top: 30px;">

     <ul class="nav nav-tabs">
      <li class="nav-item">
        <a class="nav-link" href="matchRegister.html">ثبت نام</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="matchBrackets.html">براکت مسابقه</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="matchTime.html">زمان بندی</a>
      </li>
      <li class="nav-item">
        <a class="nav-link  active" href="matchUser.html">شرکت کنندگان</a>
      </li>
    </ul>

    <div class="card-group" style="padding-top: 20px;">
     <div class="card">
      <div class="card-block">
       <h4 class="card-title">قوانین مسابقات</h4>
       <br>
       <div class="row">
         <div class="col-7">
           <img class="rounded" src="images/Rules.jpg" height="300">
         </div>
         <div class="col-5">
           <p class="card-text">حضوری</p>
           <p class="card-text">تیمی</p>
           <p class="card-text">حداکثر تعداد شرکت کننده ها</p>
           <p class="card-text">حذفی</p>
           <p class="card-text">اطلاعت بیشتر</p>
         </div>
       </div>
       <br>
       <p class="card-text">توضیحات</p>
      </div>
    </div>
   </div>



 </div>



 <script type="text/javascript" src="js/bootstrap.js"></script>
 @endsection