@extends($auth == 1 ? 'masterUserHeader.body' : 'masterHeader.body')
@section('title')
چارش | درباره ما
@endsection
@section('content')

  <div class="container" style="direction: rtl;margin-top: 1%;">
    <div class="card" style="box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);z-index: 0;background-color: white;text-align: justify;">
     <h3 class="card-title" style="background-color: #42CBC8;padding: 20px;color: white;">درباره ما</h3>
     <div style="padding-left: 2%;padding-right: 2%;">
      <h4>charesh.ir  چیست ؟</h4>
      <p>سایت چارش ، ابزاری برای اطلاع رسانی ، پخش زنده نتایج و فروش اینترنتی بلیت مسابقات است. مسابقاتی که می توانند هم به صورت حضوری و هم به صورت آنلاین برگزار شوند. </p>
      <h4>چطوری کار می کنه ؟</h4>
      <h5 style="font-weight: 300;">برای برگزار کنندگان مسابقه :</h5>
      <p>معمولاُ برای برگزاری یک مسابقه، با چالش های متعددی دست و پنجه نرم می کنید از جمله اطلاع رسانی زمان شروع، فرایند بعضاً دردسر ساز ثبت نام شرکت کنندگان، مدیریت نحوه اجرای مسابقه، تهییه جدول امتیازات و براکت و درنهایت اعلام برندگان و اهدای جوایز. </p>
      <p>چارش به شما کمک می کند تا در یک چارچوب فوق العاده ساده همه ی موارد بالا را سریعتر و بهتر انجام دهید. لطفاً برای اطلاعات بیشتر به <a href="{{route('home')}}">راهنمای سایت</a> مراجعه فرمایید  </p>
      <h5>برای شرکت کنندگان در مسابقه :</h5>
      <p>شما می توانید تمامی مسابقات ایجاد شده توسط برگزارکنندگان را در این <a href="{{route('home')}}">  صفحه </a> مشاهده و در آنها شرکت کنید.</p>
      <br>
     </div>
    </div>
  </div>

    <script type="text/javascript" src="{{URL::asset('js/main.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/bootstrap.js')}}"></script>
@endsection
