@extends($auth == 1 ? 'masterUserHeader.body' : 'masterHeader.body')
@section('content')

    <div class="container" style="direction: rtl;margin-top: 100px;">
        <div class="card" style="box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);z-index: 0;">
            <h3 class="card-title" style="background-color: #42CBC8;padding: 20px;color: white;">قوانین</h3>
            <br>
            <p style="padding-right: 20px;padding-left: 20px;">۱. با پذیرفتن قوانین سایت در هنگام ثبت نام ، متعهد شده اید که قوانین را بطور کامل مطالعه کرده و به تمامی بندهای آن پایبند خواهید بود.</p>
                <p style="padding-right: 20px;padding-left: 20px;"> ۲. ممکن است سایت به علت مشکلات فنی، از دسترس خارج شود ، ما هیچ مسئولیتی در قبال زیان شما نداریم </p>

            <p style="padding-right: 20px;padding-left: 20px;">۳. استفاده از محتوای سایت با ذکر منبع ، بلامانع است.</p>
            <p style="padding-right: 20px;padding-left: 20px;">	۴. عدم رعایت قوانین و ضوابط اسلامی و کشوری توسط کاربران در آپلود محتوا (عکس و متن)، حذف آن ها را از سایت به دنبال خواهد داشت (به تشخیص تیم چارش).</p>
            <p style="padding-right: 20px;padding-left: 20px;">۵. درصورتی که مسابقه توسط برگزار کننده به هر دلیلی لغو شود ، وی موظف به بازگرداندن مبلغ دریافتی از شرکت کنندگان و همچنین پرداخت حق کمیسیون چارش است.</p>
            <p style="padding-right: 20px;padding-left: 20px;">۶. مبلغ جمع آوری شده از بلیت ها پس از کسر حق کمیسیون چارش ، بعد از برگزاری مسابقه پرداخت خواهد شد.</p>
            <p style="padding-right: 20px;padding-left: 20px;">	۷. در صورت عدم رعایت قوانین مسابقه از سوی شرکت کننده، برگزارکننده می تواند وی را از جریان مسابقه حذف نماید.</p>
            <br>
        </div>
    </div>

@endsection
