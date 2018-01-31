@extends('masterUserHeader.body')
@section('content')


    <div class="container" style="direction: rtl;padding-top: 30px;">

        @if(count($userMessages) != 0)

            <form style="padding: 20px;" method="POST" action="{{route('deleteNotification',['username'=>Auth::user()->username])}}">
                <input type="hidden" name="_token" value="{{csrf_token()}}">

                <button type="submit" class="btn btn-danger"> حذف همه پیام ها </button>

            </form>

            <div id="accordion" role="tablist" aria-multiselectable="true">

                @for($i = 0 ; $i< count($userMessages) ; $i++)
                    <button class="accordion"> <span style="margin-left:40%;"> {{$remain[$i]}} روز قبل </span> {{$userMessages[$i]->tournament->matchName}} : {{$userMessages[$i]->organize->name}} </button>
                    <div class="panel">
                        <p>{!!$userMessages[$i]->message!!}</p>
                    </div>
                <!-- <div class="card">
                        <div class="card-header" role="tab" id="heading{{$i}}">
                            <h5 class="mb-0">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$i}}" aria-expanded="false" aria-controls="collapse{{$i}}">
                                    <span style="color: blue;"> {{$userMessages[$i]->organize->name}} </span>
                                    : <span style="color: blue"> {{$userMessages[$i]->tournament->matchName}} </span>

                                </a>
                                <span style="float: left;font-size: 12px"> {{$remain[$i]}}  روز قبل</span>
                            </h5>
                        </div>

                        <div id="collapse{{$i}}" class="collapse show" role="tabpanel" aria-labelledby="heading{{$i}}">
                            <div class="card-block">

                                {!!$userMessages[$i]->message!!}
                        </div>
                    </div>
                </div> -->

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
            /*direction: ltr;*/
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


@endsection
