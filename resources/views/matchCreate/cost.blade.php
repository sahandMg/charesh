@extends('masterUserHeader.body')
@section('title')
    چارش | اطلاعات ثبت نام
@endsection

@section('content')
    <ul class="nav nav-tabs" id="app">
        <li class="active"><a href=""> اطلاعات ثبت نام </a></li>
        <li class="disabled"><a href=""> قوانین </a></li>
        <li class="disabled"><a href=""> اطلاعات مسابقه </a></li>
        <li class="disabled"><a href="">اطلاعات پایه</a></li>
    </ul>
    <div class="formDiv">
        <form method="post" action="{{route('cost')}}">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <p>اگر مسابقه هزینه ثبت نام ندارد ، کلید رایگان را انتخاب کنید . </p>
            <p> اگر مسابقه هزینه ثبت نام دارد مبلغ آن را به ازای هرفرد در پایین وارد کنید. </p>
            <div class="form-group">
                <label for="Name-input" class="col-2 col-form-label"> رایگان  </label>
                <div class="col-5">
                    <label class="switch">
                        <input type="checkbox" name="free" id="costCheckBox">
                        <span class="slider"></span>
                    </label>
                </div>
            </div>
            <div class="form-group" id="costInput">
                <label for="Name-input">">هزینه ثبت نام(تومان) : </label>
                <input name="cost" v-model="cost"  @input="check"  class="form-control" type="number" min="1000" step="1000" :value="cost" placeholder="به تومان" id="example-text-input">
            </div>
            <h4> اطلاعات اضافه ای را که نیاز دارید تا شرکت کنندگان وارد کنند، در این قسمت مطرح کنید </h4>
            <button type="button" onclick="removeInput()" class="btn btn-danger" style="margin: 10PX;">-</button>
            <button type="button" onclick="addInput()" class="btn btn-info" style="margin: 10PX;">+</button>

            <div class="form-group" id="in1">
                <label for="Name-input">1 </label>
                <input name="column" class="form-control" type="text" placeholder="مثلا کد ملی، عکس و ..." id="example-text-input">
            </div>

            {{--<div class="form-group" id="in2">--}}
            {{--<label for="Name-input">2 </label>--}}
            {{--<input name="teamName" class="form-control" type="text" value="نام تیم" id="example-text-input">--}}
            {{--</div>--}}

            {{--<div class="form-group" id="in3">--}}
            {{--<label for="Name-input">3 </label>--}}
            {{--<input name="point" class="form-control" type="text" value="امتیاز" id="example-text-input">--}}
            {{--</div>--}}

            {{--<div class="form-group row">--}}
            {{--<label for="InputFile" class="col-2 col-form-label">اطلاعات بیشتر : </label>--}}
            {{--<div class="col-5">--}}
            {{--<textarea name="moreInfo" class="form-control" id="summernote" rows="5" placeholder="اطلاعات بیشتری که می خواهید اینجا توضیح دهید تا شرکت کنندگان وارد کنند ."></textarea>--}}
            {{--</div>--}}
            {{--</div>--}}

            <div class="form-group" id="buttons">
                <a href="{{route("returnPlanInfo")}}" class="btn btn-danger" style="margin-left: 20px;">بازگشت</a>
                <button  type="submit" class="btn btn-primary">ادامه</button>
            </div>

        </form>
    </div>
    <style>
        .nav-tabs li {
            width: 25%;
            font-size: 100%;
            font-weight: 400;
        }
        p {
            font-size: 100%;
        }
        @media screen and (max-width: 800px) {
            .nav-tabs li {
                font-size: 80%;
                font-weight: 400;
            }
            p {
                font-size: 60%;
            }
        }
        @media screen and (max-width: 600px) {
            .nav-tabs li {
                font-size: 50%;
                font-weight: 400;
            }
            p {
                font-size: 50%;
            }
            label {
                font-size: 75%;
            }
            input {
                font-size: 75%;
            }
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {display:none;}

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #2196F3;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }
        .formDiv {
            width: 80%;
            margin: 0 auto;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            direction: rtl;
            background-color: white;
            margin-top: 2%;
        }
        .formDiv form {
            padding: 1%;
        }
    </style>

    <script>

        $('#costCheckBox').change(function(){
            if(this.checked)
            {
                $('#costInput').css({"display":"none"});
            } else {
                $('#costInput').css({"display":"flex"});
            }
        });
        var count = 1 ;
        var maxTeamMember = 5 ;
        var minTeamMember = 1 ;
        function addInput() {
            if(count < maxTeamMember)
            {
                count++
                // document.getElementById('hidden').value = count;
                $( '<div id="in'+ count +'" class="form-group"><label for="Name-input"> '+ count +' </label><input name="column'+ count +'" class="form-control" type="text" value="" id="example-text-input"></div>' ).insertBefore( "#buttons" );
            } else {
                alert('حداکثر تعداد فیلدها ' + maxTeamMember +' می باشد.');
            }
        }
        function removeInput() {
            if (minTeamMember < count) {
                $('#in' + count).remove();
                count--;
                // document.getElementById('hidden').value = count;
            } else {
                alert('حداقل تعداد فیلدها ' + minTeamMember +' می باشد.');
            }

        }
        vm = new Vue({
            el:'#app',
            data:{
                cost:1000,
                btn:true,
                number: 1000,
                animatedNumber: 1000,
            },
            watch: {
                number: function(newValue, oldValue) {
                    var vm = this
                    var animationFrame
                    function animate (time) {
                        TWEEN.update(time)
                        animationFrame = requestAnimationFrame(animate)
                    }
                    new TWEEN.Tween({ tweeningNumber: oldValue })
                            .easing(TWEEN.Easing.Quadratic.Out)
                            .to({ tweeningNumber: newValue }, 500)
                            .onUpdate(function () {
                                vm.animatedNumber = this.tweeningNumber.toFixed(0)
                            })
                            .onComplete(function () {
                                cancelAnimationFrame(animationFrame)
                            })
                            .start()
                    animationFrame = requestAnimationFrame(animate)
                }
            },
            methods:{
                check:function () {
                    if(this.cost>= 1000){
                        this.btn = false
                    }else{
                        this.btn = true
                    }
                }
            },
            created:function () {
                this.check()
            }
        })
    </script>
@endsection
