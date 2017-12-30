<!DOCTYPE html>
<html lang="fa">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
    <title>mController</title>

    {{--<script type="text/javascript" src="js/jquery-3.2.1.js"></script>--}}


    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

    <script type="text/javascript" src="{{URL::asset('js/nicEdit.js')}}"></script>
    {{--<script type="text/javascript">--}}
        {{--//        <![CDATA[--}}
        {{--bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });--}}
        {{--//        ]]>--}}
    {{--</script>--}}
    <script src="http://cdnjs.cloudflare.com/ajax/libs/vue/1.0.28/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/vue.resource/1.2.1/vue-resource.min.js"></script>
    <script src="https://cdn.jsdelivr.net/lodash/4.17.4/lodash.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script type="text/javascript" src="{{URL::asset('js/bootstrap.js')}}"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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


    {{--<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>--}}
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>

    <!-- include summernote css/js-->
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>


    <link rel="stylesheet" type="text/css" href="{{URL::asset('CSS/flipclock.css')}}">
    <link rel="stylesheet" type="text/css"  href="{{URL::asset('CSS/bootstrap.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet"   type="text/css"   href="{{URL::asset('CSS/main.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('CSS/bracket.css')}}">




    @if( isset($request) && $request->route()->getName() == 'ElBracket2')

        @elseif(isset($request) && $request->route()->getName() == 'matchElBracket')

        @elseif(isset($request) && $request->route()->getName() == 'ElBracket')

        @elseif(isset($request) && $request->route()->getName() == 'MatchGElBracket')

    @else


    <!-- include libraries(jQuery, bootstrap) -->
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
    @endif



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

<body style="padding: 0px;width: 100%;background: whitesmoke;">



<div class="container"  id="mainDiv" style="width: 100%;padding: 0px;">

    <div class="row">
        <div class="col-md-4 col-sm-6">
        <!--    <img style="position: absolute;margin-top: 10px;margin-left: 50px;" height="100px"  src="{{URL::asset('images/logo.png')}}" alt=""> -->
        </div>
        <div class="col-md-8 col-sm-6" style="margin: 0px;height: 20px;">
            <h3 class="pull-right" style="margin:50px;padding: 0px;">راهی <b>برای اطلاع رسانی </b> ، <b>مدیریت</b> و <b>ثبت نام</b>  مسابقات</h3>
        </div>
    </div>

    <div class="filler one">

    </div>
    <nav id="navbar" class="topNav">
        <ul>
            <li><a class="setColor" href="{{route('credit',['username'=>Auth::user()->slug])}}">اعتبار {{$name->credit}} تومان</a></li>
            <li>
                <div class="dropdown">
                    <a onclick="myFunction()" href="" class="setColor">

                        <span style="color:orangered;" > {{ $name->unread }} <span style="color: white">|</span> </span> {{$name->username}}  <img src="{{URL::asset('storage/images/'.$name->path)}}" class="rounded" height="40" width="40" style="margin-bottom: 3px;">

                    </a>
                    <div class="dropdown-content">
                        <a href="{{route('userChallenge',['username'=>Auth::user()->slug])}}">چالش های من</a>
                        @if(isset(Auth::user()->organize->slug))
                            <a href="{{route('orgMatches',['orgName'=>Auth::user()->organize->slug])}}">مسابقات من</a>
                        @else
                            <a href="{{route('orgMatches',['orgName'=>Auth::user()->slug])}}">مسابقات من</a>
                        @endif

                        @if($name->unread>0)
                        <a style="color:red;" href="{{route('notification',['username'=>Auth::user()->slug])}}">اطلاعیه های من</a>
                        @else
                            <a style="color:black;" href="{{route('notification',['username'=>Auth::user()->slug])}}">اطلاعیه های من</a>
                            @endif

                        <a href="{{route('setting',['username'=>Auth::user()->slug])}}"> ویرایش اطلاعات</a>
                        <a href="{{route('logout',['username'=>Auth::user()->slug])}}">خروج</a>
                    </div>
                </div>
            </li>

            <li><a href="{{route('about')}}" class="setColor">درباره ما</a></li>
            <li><a href="{{route('contact')}}" class="setColor">ارتباط با ما</a></li>
            <li><a href="{{route('home')}}" class="setColor"><i class="fa fa-home fa-lg"></i></a></li>

        </ul>

    </nav>

@yield('content')

@yield('round')






</div>

@include('masterUserHeader.footer')
</body>
</html>
