<!DOCTYPE html>
<html lang="fa">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
    <title>mController</title>

    {{--<script type="text/javascript" src="js/jquery-3.2.1.js"></script>--}}


    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

    <script type="text/javascript" src="../../public/js/nicEdit.js"></script>
    <script type="text/javascript">
        //        <![CDATA[
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
        //        ]]>
    </script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/vue/1.0.28/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/vue.resource/1.2.1/vue-resource.min.js"></script>
    <script src="https://cdn.jsdelivr.net/lodash/4.17.4/lodash.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script type="text/javascript" src="../../public//js/bootstrap.js"></script>
    {{--<script type="text/javascript" src="../../public/js/bootstrap-filestyle.min.js"> </script>--}}

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


    <link rel="stylesheet" type="text/css" href="../../public/CSS/flipclock.css">
    <link rel="stylesheet" type="text/css"  href="../../public/CSS/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet"   type="text/css"   href="../../public/CSS/main.css">
    <link rel="stylesheet" type="text/css" href="../../public/CSS/bracket.css">


    <style type="text/css">
        .dropdown {
            position: relative;
            display: inline-block;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {background-color: #f1f1f1}

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: #3e8e41;
        }
    </style>
</head>

<body style="padding: 0px;margin: 0px;width: 100%;">

<div class="container" style="width: 100%;padding: 0px;">

    <div class="filler one">

    </div>
    <nav id="navbar" class="topNav">
        <ul>
            <li>
                <div class="dropdown">
                    <a onclick="myFunction()" href="" class="setColor">

                        <span style="color:orangered;">{{ $name->unread}} <span style="color: white">|</span> </span> {{$name->username}}  <img src="../../public/storage/images/{{$name->path}}" class="rounded" height="40" width="40" style="margin-bottom: 3px;">

                    </a>
                    <div class="dropdown-content">
                        <a href="{{route('userChallenge')}}">چالش های من</a>
                        <a href="{{route('orgMatches')}}">مسابقات من</a>
                        @if($name->unread>0)
                            <a style="color:red;" href="{{route('notification')}}">اطلاعیه های من</a>
                        @else
                            <a style="color:black;" href="{{route('notification')}}">اطلاعیه های من</a>
                        @endif
                        <a href="{{route('credit')}}">اعتبار {{$name->credit}} تومان</a>
                        <a href="{{route('setting')}}"> ویرایش اطلاعات</a>
                        <a href="{{route('logout')}}">خروج</a>
                    </div>
                </div>
            </li>
            <li><a href="{{route('about')}}" class="setColor">درباره ما</a></li>
            <li><a href="{{route('contact')}}" class="setColor">ارتباط با ما</a></li>
            <li><a href="{{route('home')}}" class="setColor"><i class="fa fa-home fa-lg"></i></a></li>
        </ul>

    </nav>

@yield('content')






@include('masterUserHeader.footer')

</body>
</html>
