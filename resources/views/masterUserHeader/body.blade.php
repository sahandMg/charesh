<!DOCTYPE html>
<html lang="fa">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content=",برگزاری مسابقه,مسابقه,برگزاری مسابقه آنلاین,برگزاری مسابقات حضوری,مسبقه ها ورزشی,مسابقات بازی های رایانه ای,برگزاری مسابقات بازی های رایانه ای@yield('matchName'),برگزاری مسابقه های آنلاین,بازی های رایانه ای,">
@yield('location')
<head>
    <title>@yield('title')</title>

    {{--<script type="text/javascript" src="js/jquery-3.2.1.js"></script>--}}


    {{--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>--}}

    {{--<script type="text/javascript">--}}
    {{--//        <![CDATA[--}}
    {{--bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });--}}
    {{--//        ]]>--}}
    {{--</script>--}}
    <script src="http://cdnjs.cloudflare.com/ajax/libs/vue/1.0.28/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/vue.resource/1.2.1/vue-resource.min.js"></script>
    <script src="https://cdn.jsdelivr.net/lodash/4.17.4/lodash.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="{{URL::asset('js/bootstrap.js')}}"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>

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
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>

    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>

    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet"   type="text/css"   href="{{URL::asset('CSS/newMainUser.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('CSS/bracket.css')}}">
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

    @if( isset($request) && $request->route()->getName() == 'ElBracket2')

    @elseif(isset($request) && $request->route()->getName() == 'matchElBracket')

    @elseif(isset($request) && $request->route()->getName() == 'ElBracket')

    @elseif(isset($request) && $request->route()->getName() == 'MatchGElBracket')

    @else

    @endif

</head>

<body style="padding: 0px;width: 100%;background-color: #e6e6e6;">

<header>
    <a href="{{route('home')}}" class="logo"><img src="{{URL::asset('images/charesh.jpg')}}"></a>

    <h1>ابزاری <b>برای اطلاع رسانی </b> ، <b>مدیریت</b> و <b>ثبت نام</b>  مسابقات  </h1>
    <br>
    <nav class="topnav" id="myTopnav">
        <div class="dropdown1 leftNav" id="dropdownBtn">
            @if(isset(Auth::user()->organize))
                @if(Auth::user()->role == 'supplier')
                    {{--{{ Auth::user()->organize->unread }}--}}
                    <button class="dropbtn" style="direction: rtl">{{Auth::user()->organize->name}} <span class="notification notify"></span></button>
                @else
                    {{--{{ $name->unread }}--}}
                    <button class="dropbtn">{{Auth::user()->username}} <span class="notification notify"></span></button>
                @endif

            @else
                <button class="dropbtn">{{Auth::user()->username}} <span class="notification notify"></span> </button>
            @endif

            <div class="dropdown-content">
                @if(Auth::user()->role == 'admin')
                    <a href="{{route('contents')}}">مدیریت محتوا</a>
                    <a href="{{route('setting',['username'=>Auth::user()->username])}}"> تنظیمات </a>
                    <a href="{{route('logout',['username'=>Auth::user()->username])}}">خروج</a>
                @elseif(Auth::user()->role == 'supplier')
                    @if(!isset(Auth::user()->organize))
                        <a href="{{route('MakeOrganize')}}">تکمیل پروفایل</a>
                        <a href="{{route('setting',['username'=>Auth::user()->slug])}}"> تنظیمات </a>
                        <a href="{{route('logout',['username'=>Auth::user()->slug])}}">خروج</a>
                    @else
                        <a href="{{route('orgMatches',['orgName'=>Auth::user()->organize->slug])}}"> مسابقات من</a>
                        @if(Auth::user()->organize->unread > 0 )
                            <a style="color:red" href="{{route('OrgMsg',['orgName'=>Auth::user()->organize->slug])}}">پیام ها</a>
                        @else
                            <a href="{{route('OrgMsg',['orgName'=>Auth::user()->organize->slug])}}">پیام ها</a>
                        @endif
                        <a style="direction: rtl"  href="{{route('organizeAccount',['orgName'=>Auth::user()->organize->slug])}}"> {{Auth::user()->organize->credit * 0.95}}  تومان</a>
                        <a href="{{route('orgEdit',['orgName'=>Auth::user()->organize->slug])}}"> تنظیمات </a>
                        <a href="{{route('logout',['orgName'=>Auth::user()->organize->slug])}}">خروج</a>
                    @endif
                @else
                    <a href="{{route('userChallenge',['username'=>Auth::user()->slug])}}"> چالش های من</a>

                    @if($name->unread > 0 )
                        <a style="color:red" href="{{route('notification',['username'=>Auth::user()->slug])}}">پیام های برگزار کنندگان</a>
                    @else
                        <a  href="{{route('notification',['username'=>Auth::user()->slug])}}">پیام های برگزار کنندگان</a>
                    @endif
                    <a style="direction: rtl" href="{{route('credit',['username'=>Auth::user()->slug])}}"> {{Auth::user()->credit}}  تومان</a>
                    <a href="{{route('setting',['username'=>Auth::user()->slug])}}"> تنظیمات </a>
                    <a href="{{route('logout',['username'=>Auth::user()->slug])}}">خروج</a>
                @endif


            </div>
        </div>
        <a href="{{route('home')}}" class="rightNav active1"><i class="fa fa-home fa-lg"></i></a>
        <a href="{{route('matchCreate')}}" class="rightNav">ایجاد مسابقه جدید</a>
        <a href="{{route('faq')}}" class="rightNav">سوالات متداول</a>
        <a href="#" class="rightNav">راهنمای سایت</a>
        {{--<a href="{{route('about')}}" class="rightNav"> درباره ما </a>--}}
        {{--<a href="{{route('contact')}}" class="rightNav"> ارتباط با ما </a>--}}

        <a href="javascript:void(0);" style="font-size:15px;" class="icon"  onclick="navResponsive()">&#9776;</a>
    </nav>
</header>

<div class="container"  id="mainDiv" style="width: 100%;padding: 0px;background-color: #e6e6e6;">

    @yield('content')
    @yield('round')
</div>

@include('masterUserHeader.footer')
<script type="text/javascript">
    function navResponsive() {
        var x = document.getElementById("myTopnav");
        var y = document.getElementById('dropdownBtn');
        if (x.className === "topnav") {
            y.style.display = 'none';
            x.className += " responsive";
        } else {
            x.className = "topnav";
            y.style.display = 'block';
        }
    }
</script>
<style type="text/css">
    .notification.notify:after {
        margin:  0;
        border-radius: 50%;
        font-size: 0.75em;
        text-align: center;
        background: #f53d3d;
        box-shadow: 0 0 0 0.25em #c20a0a;
        animation: pulse 0.75s infinite;
        padding: 1%;
    }
    .notification {
        position: relative;
        width: 100%;
        padding: 0 ;
        font-size: 100%;
        color: white;
        cursor: pointer;
    }
    @import url(https://fonts.googleapis.com/css?family=Lato:300|Oswald);


    .notification {
        position: relative;
        width: 20em;
        /*padding: 0 1em;*/
        padding: 0 ;
        font-size: 0.8em;
        line-height: 1.125;
        color: white;
        cursor: pointer;
        /*background-color: #2b2b2b;*/
        /*background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #2b2b2b), color-stop(100%, #262626));*/
        /*background-image: -webkit-linear-gradient(#2b2b2b, #262626);*/
        /*background-image: linear-gradient(#2b2b2b, #262626);*/
    }


    @if(isset(Auth::user()->organize))
    @if(Auth::user()->role == 'supplier' )
        @if( Auth::user()->organize->unread>0)
         .notification.notify:after {
          content:' {{Auth::user()->organize->unread}}';
         }
    @endif
    @else

        @if(Auth::user()->unread>0)
         .notification.notify:after {
           content:' {{Auth::user()->unread}}';
         }
    @endif

    @endif
@else
     @if(Auth::user()->unread>0)
      .notification.notify:after {
        content:' {{Auth::user()->unread}}';
       }
    @endif
@endif


@-webkit-keyframes pulse {
        0% {
            box-shadow: 0 0 0 0.2em #c20a0a;
        }
        25% {
            box-shadow: 0 0 0 0.05em #c20a0a;
        }
        50% {
            box-shadow: 0 0 0 0.375em #c20a0a;
        }
        75% {
            box-shadow: 0 0 0 0.2em #c20a0a;
        }
        100% {
            box-shadow: 0 0 0 0.3em #c20a0a;
        }
    }
    @-moz-keyframes pulse {
        0% {
            box-shadow: 0 0 0 0.2em #c20a0a;
        }
        25% {
            box-shadow: 0 0 0 0.05em #c20a0a;
        }
        50% {
            box-shadow: 0 0 0 0.375em #c20a0a;
        }
        75% {
            box-shadow: 0 0 0 0.2em #c20a0a;
        }
        100% {
            box-shadow: 0 0 0 0.3em #c20a0a;
        }
    }
    @-o-keyframes pulse {
        0% {
            box-shadow: 0 0 0 0.2em #c20a0a;
        }
        25% {
            box-shadow: 0 0 0 0.05em #c20a0a;
        }
        50% {
            box-shadow: 0 0 0 0.375em #c20a0a;
        }
        75% {
            box-shadow: 0 0 0 0.2em #c20a0a;
        }
        100% {
            box-shadow: 0 0 0 0.3em #c20a0a;
        }
    }
    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0.2em #c20a0a;
        }
        25% {
            box-shadow: 0 0 0 0.05em #c20a0a;
        }
        50% {
            box-shadow: 0 0 0 0.375em #c20a0a;
        }
        75% {
            box-shadow: 0 0 0 0.2em #c20a0a;
        }
        100% {
            box-shadow: 0 0 0 0.3em #c20a0a;
        }
    }
</style>
</body>
</html>
