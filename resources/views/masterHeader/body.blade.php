<!DOCTYPE html>
<html lang="fa">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="چارش – ابزاری برای اطلاع رسانی ، مدیریت و ثبت نام مسابقات حضوری و آنلاین ">
<meta name="keywords" content=",برگزاری مسابقه,مسابقه,برگزاری مسابقه آنلاین,برگزاری مسابقات حضوری,مسبقه ها ورزشی,مسابقات بازی های رایانه ای,برگزاری مسابقات بازی های رایانه ای@yield('matchName'),برگزاری مسابقه های آنلاین,بازی های رایانه ای,">

<head>
    <title>@yield('title')</title>



    <script src="http://cdnjs.cloudflare.com/ajax/libs/vue/1.0.28/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/vue.resource/1.2.1/vue-resource.min.js"></script>
    <script src="https://cdn.jsdelivr.net/lodash/4.17.4/lodash.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
	<script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>

    <!-- include summernote css/js-->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#summernote').summernote({
                height : '150px',
                placeholder:'متن',
                fontNames:['Arial','Arial Black','Khmer OS'],

            })
        })

        $('#clear').on('click',function(){
            $('#summernote').summernote('code',null);
        })
    </script>

    <link rel="alternate" href="http://charesh.ir" hreflang="fa-ir" />
    <link rel="stylesheet" type="text/css" href="{{URL::asset('CSS/flipclock.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet"   type="text/css"   href="{{URL::asset('CSS/newMain.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('CSS/bracket.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{URL::asset('images/charesh.png')}}" />
    <style>
        @media screen and (max-width: 600px) {
            .g-recaptcha {
                transform:scale(0.5);
                -webkit-transform:scale(0.5);
                transform-origin:0 0;
                -webkit-transform-origin:0 0;
                margin-left: 50%;
                display: block;
            }
        }
    </style>

    @if(isset($request) && $request->route()->getName() == 'matchElBracket')



    @elseif(isset($request) && $request->route()->getName() == 'MatchGElBracket')

    @else


        <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">

    @endif


</head>
<body style="padding: 0px;width: 100%;background-color: #e6e6e6;">

<header>
    <a href="{{route('home')}}" class="logo"><img src="{{URL::asset('images/charesh.jpg')}}"></a>

    <h1>ابزاری <b>برای اطلاع رسانی </b> ، <b>مدیریت</b> و <b>ثبت نام</b>  مسابقات  </h1>
    <br>
    <nav class="topnav" id="myTopnav">
        <a href="{{route('login')}}" class="leftNav"> ورود <i class="fa fa-sign-in fa-lg"></i></a>
        <a href="{{route('register')}}" class="leftNav"> ثبت نام <i class="fa fa-user fa-lg"></i></a>

        <a href="{{route('home')}}" class="rightNav active1"> <i class="fa fa-home fa-lg"></i></a>
        <a href="{{route('matchCreate')}}" class="rightNav">ایجاد مسابقه جدید</a>
        <a href="{{route('faq')}}" class="rightNav">سوالات متداول</a>
        <a href="#" class="rightNav">راهنمای سایت</a>
        {{--<a href="{{route('about')}}" class="rightNav"> درباره ما </a>--}}
        {{--<a href="{{route('contact')}}" class="rightNav"> ارتباط با ما </a>--}}

        <a href="javascript:void(0);" style="font-size:15px;" class="icon"  onclick="navResponsive()">&#9776;</a>
    </nav>
</header>


    @yield('content')
    @yield('round')




</div>
@include('masterHeader.footer')

<script type="text/javascript">

    function navResponsive() {
        var x = document.getElementById("myTopnav");
        if (x.className === "topnav") {
            x.className += " responsive";
        } else {
            x.className = "topnav";
        }
    }
</script>
</body>
</html>
