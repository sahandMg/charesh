@extends('masterUserHeader.body')
@section('content')
    <div class="container" style="direction: rtl;padding-top: 30px;">
        @if(count($messages) != 0)
            <form style="padding: 20px;" method="POST" action="{{route('deleteNotification',['username'=>Auth::user()->username])}}">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <button type="submit" class="btn btn-danger"> حذف همه پیام ها </button>
            </form>
            <div id="accordion" role="tablist" aria-multiselectable="true">
                @for($i = 0 ; $i< count($messages) ; $i++)
                    <button class="accordion"> <span style="margin-left:40%;"> {{$remain[$i]}} روز قبل </span> {{$messages[$i]->tournament->matchName}} : {{$messages[$i]->organize->name}} </button>
                    <div class="panel">
                        {{--<p style="direction: rtl"> نام :<span>{{$messages[$i]->name}}</span></p>--}}
                        {{--<p style="direction: rtl">ایمیل :<span>{{$messages[$i]->email}}</span></p>--}}
                        {{--<p>{!!$messages[$i]->message!!}</p>--}}
                        <div class="container2">
                            <img src="/w3images/bandmember.jpg" alt="Avatar" style="width:100%;">
                            <p>Hello. How are you today?</p>
                            <span class="time-right">11:00</span>
                        </div>
                        <div class="container2 darker">
                            <img src="/w3images/avatar_g2.jpg" alt="Avatar" class="right" style="width:100%;">
                            <p>Hey! I'm fine. Thanks for asking!</p>
                            <span class="time-left">11:01</span>
                        </div>

                        <div class="container2">
                            <img src="/w3images/bandmember.jpg" alt="Avatar" style="width:100%;">
                            <p>Sweet! So, what do you wanna do today?</p>
                            <span class="time-right">11:02</span>
                        </div>

                        <div class="container2 darker">
                            <img src="/w3images/avatar_g2.jpg" alt="Avatar" style="width:100%;">
                            <p>Nah, I dunno. Play soccer.. or learn more coding perhaps?</p>
                            <span class="time-left">11:05</span>
                        </div>
                    </div>
                @endfor
            </div>
        @else
            <center><h3 style="color:darkred;"> پیامی موجود نیست </h3></center>
        @endif
    </div>
    <br>
    <br>
    <style>
        .accordion {
            background-color: #eee;
            color: #444;
            cursor: pointer;
            padding: 18px;
            width: 100%;
            border: none;
            text-align: left;
            outline: none;
            font-size: 15px;
            transition: 0.4s;
        }
        .active, .accordion:hover {
            background-color: #ccc;
        }
        .accordion:after {
            content: '\002B';
            color: #777;
            font-weight: bold;
            float: right;
            margin-left: 5px;
        }
        .active:after {
            content: "\2212";
        }
        .panel {
            padding: 0 18px;
            background-color: white;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.2s ease-out;
        }
    </style>
    <script>
        var acc = document.getElementsByClassName("accordion");
        var i;
        for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var panel = this.nextElementSibling;
                if (panel.style.maxHeight){
                    panel.style.maxHeight = null;
                } else {
                    panel.style.maxHeight = panel.scrollHeight + "px";
                }
            });
        }
    </script>
    <style>
        .container2 {
            border: 2px solid #dedede;
            background-color: #f1f1f1;
            border-radius: 5px;
            padding: 10px;
            margin: 10px 0;
        }

        .darker {
            border-color: #ccc;
            background-color: #ddd;
        }

        .container2::after {
            content: "";
            clear: both;
            display: table;
        }

        .container2 img {
            float: left;
            max-width: 60px;
            width: 100%;
            margin-right: 20px;
            border-radius: 50%;
        }

        .container2 img.right {
            float: right;
            margin-left: 20px;
            margin-right:0;
        }

        .time-right {
            float: right;
            color: #aaa;
        }

        .time-left {
            float: left;
            color: #999;
        }
    </style>
@endsection
