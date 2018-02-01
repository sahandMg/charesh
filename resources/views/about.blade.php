@extends($auth == 1 ? 'masterUserHeader.body' : 'masterHeader.body')



@section('content')

    <div class="container" style="direction: rtl;margin-top: 100px;">
    <div class="card" style="box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);z-index: 0;">
     <h3 class="card-title" style="background-color: #42CBC8;padding: 20px;color: white;">درباره ما</h3>
     <h4 style="padding: 20px;direction: rtl">charesh.ir چیست؟</h4>
     <p style="padding-right: 20px;padding-left: 20px;">سایت چارش ، ابزاری برای اطلاع رسانی ، پخش زنده نتایج و فروش اینترنتی بلیت مسابقات است. مسابقاتی که می توانند هم به صورت حضوری و هم به صورت آنلاین برگزار شوند.</p>
     <h4 style="padding: 20px;">چطوری کار می کنه ؟</h4>
     <h5 style="padding: 20px;">برای برگزار کنندگان مسابقه :</h5>
     <p style="padding-right: 20px;padding-left: 20px;"> معمولاُ برای برگزاری یک مسابقه، با چالش های متعددی دست و پنجه نرم می کنید از جمله اطلاع رسانی زمان شروع، فرایند بعضاً دردسر ساز ثبت نام شرکت کنندگان، مدیریت نحوه اجرای مسابقه، تهییه جدول امتیازات و براکت و درنهایت اعلام برندگان و اهدای جوایز.</p>
     <p style="padding-right: 20px;padding-left: 20px;"> چارش به شما کمک می کند تا در یک چارچوب فوق العاده ساده همه ی موارد بالا را سریعتر و بهتر انجام دهید. لطفاً برای اطلاعات بیشتر به راهنمای سایت مراجعه فرمایید .</p>
     <h5 style="padding: 20px;">برای شرکت کنندگان در مسابقه :</h5>
     <p style="padding-right: 20px;padding-left: 20px;"> شما می توانید تمامی مسابقات ایجاد شده توسط برگزارکنندگان را در این صفحه مشاهده و در آنها شرکت کنید.<a href="{{route('home')}}"> همه مسابقات</a> </p>
        <br>
    </div>
  </div>

    <script type="text/javascript" src="{{URL::asset('js/main.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/bootstrap.js')}}"></script>
@endsection
