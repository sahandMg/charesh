<!DOCTYPE html>
<html lang="fa">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content="برگزاری مسابقه,مسابقه,برگزاری مسابقه آنلاین,برگزاری مسابقات حضوری,مسبقه ها ورزشی,ورزش, ">
<head>
    <title>Index</title>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

    {{--<script type="text/javascript" src="../../public/js/nicEdit.js"></script>--}}
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

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- Fonts -->

    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
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


    <link rel="stylesheet" type="text/css" href="{{URL::asset('CSS/flipclock.css')}}">
    <link rel="stylesheet" type="text/css"  href="{{URL::asset('CSS/bootstrap.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet"   type="text/css"   href="{{URL::asset('CSS/main.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('CSS/bracket.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <!-- include libraries(jQuery, bootstrap) -->



    @if(isset($request) && $request->route()->getName() == 'matchElBracket')



    @elseif(isset($request) && $request->route()->getName() == 'MatchGElBracket')

    @else

        <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
        <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">

    @endif


</head>
<body style="padding: 0px;width: 100%;background: whitesmoke;">



<div class="container"  id="mainDiv" style="width: 100%;padding: 0px;">

    <div class="row">
        <div class="col-md-4 col-sm-6">
        <!--    <img style="position: absolute;margin-top: 10px;margin-left: 50px;" height="100px"  src="{{URL::asset('images/Logo.png')}}" alt=""> -->
        </div>
        <div class="col-md-8 col-sm-6" style="margin: 0px;height: 20px;">
            <h3 class="pull-right" style="margin:50px;padding: 0px;">راهی <b>برای اطلاع رسانی </b> ، <b>مدیریت</b> و <b>ثبت نام</b>  مسابقات</h3>
        </div>
    </div>




    <div class="filler one">

    </div>

    <!-- Nav -->
    <nav id="navbar" class="topNav">
        <ul>
            <li><a href="{{route('login')}}" class="setColor"> ورود <i class="fa fa-sign-in fa-lg"></i></a></li>
            <li><a href="{{route('register')}}" class="setColor"> ثبت نام <i class="fa fa-user fa-lg"></i></a></li>
            <li><a href="{{route('about')}}" class="setColor">درباره ما</a></li>
            <li><a href="{{route('contact')}}" class="setColor">ارتباط با ما</a></li>
            <li><a href="{{route('home')}}" class="setColor"><i class="fa fa-home fa-lg"></i></a></li>
        </ul>
    </nav>

    @yield('content')
    @yield('round')




</div>
@include('masterHeader.footer')
</body>
</html>
