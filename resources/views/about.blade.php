@extends($auth == 1 ? 'masterUserHeader.body' : 'masterHeader.body')



@section('content')

    <div class="container" style="direction: rtl;margin-top: 100px;">
    <div class="card" style="box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);z-index: 0;">
     <h3 class="card-title" style="background-color: #42CBC8;padding: 20px;color: white;">درباره ما</h3>
     <h4 style="padding: 20px;">challengeBazaar  چیست ؟</h4>
     <p style="padding-right: 20px;padding-left: 20px;">سایت چلنج بازار ، بستری برای اطلاع رسانی ، ایجاد براکت و فروش اینترنتی بلیت مسابقات فراهم می کند . مسابقات هم به صورت حضوری و هم به صورت آنلاین می تواند برگزار شود. </p>
     <h4 style="padding: 20px;">چطوری کار می کنه ؟</h4>
     <h5 style="padding: 20px;">برای برگزار کنندگان مسابقه :</h5>
     <p style="padding-right: 20px;padding-left: 20px;">یادتون برای برگزاری یک مسابقه نیاز به کلی ابزار مختلف داشتید؟ باید یه فرم ثبت نام درست می کردید ، یک براکت مسابقه ، کانال اطلاع رسانی ، راهی برای دریافت وجه نیاز داشتید ؟  </p>
     <p style="padding-right: 20px;padding-left: 20px;">ChallengeBazaar به شما کمک می کند تا همه ی این کارها رو سریعتر و بهتر انجام بدهید. برای اطلاعات بیشتر به راهنمای سایت مراجعه کنید. </p>
     <h5 style="padding: 20px;">برای شرکت کنندگان در مسابقه :</h5>
     <p style="padding-right: 20px;padding-left: 20px;">کلی مسابقه هر ماه وجود داره که می تونید در آن شرکت کنید. <a href="{{route('home')}}"> همه مسابقات</a> </p>
    </div>          
  </div>

    <script type="text/javascript" src="{{URL::asset('js/main.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/bootstrap.js')}}"></script>
@endsection
