@extends('masterUserHeader.body')
@section('title')
    چارش | جدول لیگ  {{$tournament->matchName}}
@endsection

@section('content')
    @include('masterOrganize.body',['tournament'=> $tournament,'route'=>$route])
        <div class="container" style=" direction: rtl;" id= "app">
            <br>

            <form style="font-size: 20px;" method="post" action="{{route('leagueBracket',['id'=>$tournament->id,'matchName'=>$tournament->slug])}}">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <h4>تیم ها هرکدام باهم یک بازی برگزار می کنند یا دوبازی(رفت و برگشت) ؟ </h4>
                <div class="switch1 white" style="margin: auto;">

                    <input type="radio" name="TYPE" id="switch-off" value="sg">
                    <input type="radio" name="TYPE" id="switch-on" value="dg" checked>

                    <label for="switch-off">یک بازی </label>
                    <label for="switch-on">دو بازی</label>

                    <span class="toggle1"></span>

                </div>

                <h4 style="margin: 20px;">اطلاعات ستون های جدول گروه ها</h4>
                <button type="button" onclick="removeInput()" class="btn btn-danger" style="margin: 10PX;">-</button>
                <button type="button" onclick="addInput()" class="btn btn-info" style="margin: 10PX;">+</button>

                <div class="form-group" id="in1">
                    <label for="Name-input">1 </label>
                    <input name="row" class="form-control" type="text" value="شماره" id="example-text-input">
                </div>

                <div class="form-group" id="in2">
                    <label for="Name-input">2 </label>
                    <input name="teamName" class="form-control" type="text" value="نام تیم" id="example-text-input">
                </div>

                <div class="form-group" id="in3">
                    <label for="Name-input">3 </label>
                     <input name="point" class="form-control" type="text" value="امتیاز" id="example-text-input">
                </div>

                <input type="hidden" name="columnNumber" id="hidden" value="">

                  <button  id="submitButton" type="submit" class="btn btn-primary" style="margin-right: 20px;">ساختن براکت</button>
                  <button onclick="confirm()" type="button" class="btn btn-warning">تغییر نوع برگزاری براکت</button>
                <div>

                    {{--<p style="width: 200px;margin-right: 50px;">در صورت تغییر نوع برگزاری براکت ، تمام اطلاعات براکت قبلی شما پاک می شود ، باید از ابتدا به دسته بندی مسابقه دهندگان بپردازید.</p>--}}
                </div>
            </form>
            <br>
            <br>
        </div>





<style>


    .switch1 input {
        font-family: inherit;
        font-size: 100%;
        line-height: normal;
        margin: 0;
    }

    .switch1 input[type="radio"] {
        box-sizing: border-box;
        padding: 0;
    }

    .switch1 {
        background: #fff;
        border-radius: 32px;
        display: block;
        height: 64px;
        position: relative;
        width: 160px;
    }

    .switch1 label {
        color: #fff;
        font-size: 150%;
        font-weight: 300;
        line-height: 64px;
        text-transform: uppercase;
        -webkit-transition: color .2s ease;
        -moz-transition: color .2s ease;
        -ms-transition: color .2s ease;
        -o-transition: color .2s ease;
        transition: color .2s ease;
        width: 100px;
    }

    .switch1 label:nth-of-type(1) {
        left: -75%;
        position: absolute;
        text-align: right;
    }

    .switch1 label:nth-of-type(2) {
        position: absolute;
        right: -75%;
        text-align: left;
    }

    .switch1 input {
        height: 64px;
        left: 0;
        opacity: 0;
        position: absolute;
        top: 0;
        width: 160px;
        z-index: 2;
    }

    .switch1 input:checked~label:nth-of-type(1) { color: #333333; }
    .switch1 input:checked~label:nth-of-type(2) { color: #808080; }

    .switch1 input~:checked~label:nth-of-type(1) { color: #808080; }
    .switch1 input~:checked~label:nth-of-type(2) { color: #333333; }

    .switch1 input:checked~.toggle1 {
        left: 4px;
    }

    .switch1 input~:checked~.toggle1 {
        left: 100px;
    }

    .switch1 input:checked {
        z-index: 0;
    }

    .toggle1 {
        background: #4a4a4a;
        border-radius: 50%;
        height: 56px;
        left: 0;
        position: absolute;
        top: 4px;
        -webkit-transition: left .2s ease;
        -moz-transition: left .2s ease;
        -ms-transition: left .2s ease;
        -o-transition: left .2s ease;
        transition: left .2s ease;
        width: 56px;
        z-index: 1;
    }
    @media screen and (max-width: 600px) {
        .switch1 input {
            font-size: 100%;
        }


        .switch1 {
            border-radius: 32px;
            height: 50px;
            width: 120px;
        }

        .switch1 label {
            font-size: 100%;
            font-weight: 300;
            line-height: 64px;
            text-transform: uppercase;
            -webkit-transition: color .2s ease;
            -moz-transition: color .2s ease;
            -ms-transition: color .2s ease;
            -o-transition: color .2s ease;
            transition: color .2s ease;
            width: 80px;
        }

        .switch1 label:nth-of-type(1) {
            left: -75%;
        }

        .switch1 label:nth-of-type(2) {
            right: -75%;
        }

        .switch1 input {
            height: 50px;
            left: 0;
            opacity: 0;
            top: 0;
            width: 120px;
        }
        .switch1 input:checked~.toggle1 {
            left: 4px;
        }

        .switch1 input~:checked~.toggle1 {
            left: 70px;
        }


        .toggle1 {
            border-radius: 50%;
            height: 46px;
            left: 0;
            top: 3px;
            -webkit-transition: left .2s ease;
            -moz-transition: left .2s ease;
            -ms-transition: left .2s ease;
            -o-transition: left .2s ease;
            transition: left .2s ease;
            width: 46px;
        }
        h4 {
            font-size: 90%;
        }
    }

</style>


<style type="text/css">
    *[draggable=true] {
        -moz-user-select: none;
        -khtml-user-drag: element;
        cursor: move;
    }
</style>

{{--<script type="text/javascript" src="js/jquery-3.2.1.js"></script >--}}
{{--<script type="text/javascript" src="js/main.js"></script>--}}
{{--<script type="text/javascript" src="js/bootstrap.js"></script>--}}
<script type="text/javascript">
    var count = 3 ;
    var maxTeamMember = 12 ;
    var minTeamMember = 3 ;
    function confirm() {



            var ans = prompt('در صورت تغییر نوع برگزاری ، تمامی اطلاعات جدول امتیازات و براکت مسابقه پاک می شود. برای ادامه، تایید را وارد کنید');
            if(ans == 'تایید'){

                window.location.href = {!! json_encode(route('bracketDelete',['id'=>$tournament->id,'matchName'=>$tournament->slug])) !!}
            }


    }
    function addInput() {
        console.log(count)
        if(count < maxTeamMember)
        {
            count++;
            $( '<div id="in'+ count +'" class="form-group row"><label for="Name-input" class="col-1 col-form-label"> '+ count +' </label><div class="col-5"><input name="column'+ count +'" class="form-control" type="text" value="" id="example-text-input"></div></div>' ).insertBefore( "#submitButton" );
        } else {
            alert('حداکثر تعداد ستون ها ' + maxTeamMember +'میتواند می باشد.');
        }

    }

    function removeInput() {
        console.log(count)
        if (minTeamMember < count) {
            $('#in' + count).remove();
            count--;
        } else {
            alert('حداقل تعداد ستون ها' + minTeamMember +' میتواند می باشد.');
        }

    }

</script>
@endsection