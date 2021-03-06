

@extends('masterUserHeader.body')
@section('title')
    چارش | پیام های  {{Auth::user()->username}}
@endsection
@section('content')
    <div class="container" style="direction: rtl;margin-top: 1%;" id="msgUser" xmlns="http://www.w3.org/1999/html">
        {{--@if(count($userMessages) != 0)--}}
        {{--<form style="padding: 20px;" method="POST" action="{{route('deleteNotification',['username'=>Auth::user()->username])}}">--}}
        {{--<input type="hidden" name="_token" value="{{csrf_token()}}">--}}
        {{--<button type="submit" class="btn btn-danger"> حذف همه پیام ها </button>--}}
        {{--</form>--}}



        <div v-for="message in messages" id="accordion" role="tablist" aria-multiselectable="true">
            {{--@for($i = 0 ; $i< count($userMessages) ; $i++)--}}

            <button  class="accordion"> <span style="margin-left:40%;"> مشاهده پیام </span> </button>
            <div class="panel">
                {{--<p>{!!$userMessages[$i]->message!!}</p>--}}

                <div v-for="msg in message" class="container2">

                    <img src="{{URL::asset('storage/images')}}/@{{ msg.path }}" alt="Charesh.ir" style="width:100%;">
                    <p>@{{{ msg.message }}}</p>
                    <span class="time-right">@{{ msg.created_at }}</span>
                </div>



            </div>
            {{--@endfor--}}
        </div>
        {{--@else--}}
        {{--<center><h3 style="color:darkred;"> پیامی موجود نیست </h3></center>--}}
        {{--@endif--}}
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

    <script>
        new Vue({
            el:'#msgUser',
            data:{
                messages:[''],
                text:'',
                btn:true
            },
            created:function () {
                vm = this

                axios.get({!! json_encode(route('GetMsgUser')) !!}).then(function (response) {

                    vm.messages = response.data.reverse()


                })
                setTimeout(this.msg,1000)
            },
            methods:{

                check:function () {

                    if(this.text.length>0){
                        this.btn = false
                    }else{
                        this.btn = true
                    }

                },
                msg:function () {

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
                },


            }
        })
    </script>


@endsection

