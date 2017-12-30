@extends('masterUserHeader.body')
@section('content')
    <div class="row" style=" direction: rtl;" id="app">
        <!— right menu —>
        <div class="col-2">
            <ul class="Vnav">
                <li><a class="active" href="{{route('orgMatches',['orgName'=>$name->organize->slug])}}">پنل مدیریت</a></li>
                <li><a href="{{route('matchCreate')}}">مسابقه جدید</a></li>
                <li><a href="{{route('orgEdit',['orgName'=>$name->organize->slug])}}">ویرایش اطلاعات من</a></li>
                <li><a href="{{route('organizeAccount',['orgName'=>$name->organize->slug])}}">حساب من</a></li>
            </ul>
        </div>
        <!— content —>
        <div class="container col-8">
            <br>
            @include('masterOrganize.body',['tournament'=> $tournament,'route'=>$route])
            <div>
                <button type="submit" class="btn btn-warning" style="margin-right: 40px;margin-top: 40px;margin-bottom: 5px;">تغییر نوع برگزاری براکت</button>
                <p style="width: 200px;margin-right: 50px;">در صورت تغییر نوع برگزاری براکت ، تمام اطلاعات براکت قبلی شما پاک می شود ، باید از ابتدا به دسته بندی مسابقه دهندگان بپردازید.</p>

            </div>
            <br>
            <br>


            <form style="padding-top: 20px;font-size: 20px;" method="post" action="{{route('leagueBracket',['id'=>$tournament->id,'matchName'=>$tournament->slug])}}">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <h4>تیم ها هرکدام باهم یک بازی برگزار می کنند یا دوبازی(رفت و برگشت) ؟ </h4>
                <div class="switch">
                    <input type="radio" class="switch-input" name="TYPE" value="sg" id="week" checked>
                    <label for="week" class="switch-label switch-label-off">یک بازی</label>
                    <input type="radio" class="switch-input" name="TYPE" value="dg" id="month">
                    <label for="month" class="switch-label switch-label-on">دو بازی</label>
                    <span class="switch-selection"></span>
                </div>

                <h4 style="margin: 20px;">اطلاعات ستون های جدول گروه ها</h4>
                <button type="button" onclick="removeInput()" class="btn btn-danger" style="margin: 10PX;">-</button>
                <button type="button" onclick="addInput()" class="btn btn-info" style="margin: 10PX;">+</button>

                <div class="form-group row" id="in1">
                    <label for="Name-input" class="col-1 col-form-label">1 </label>
                    <div class="col-5 ">
                        <input name="row" class="form-control" type="text" value="شماره" id="example-text-input">
                    </div>
                </div>

                <div class="form-group row" id="in2">
                    <label for="Name-input" class="col-1 col-form-label">2 </label>
                    <div class="col-5 ">
                        <input name="teamName" class="form-control" type="text" value="نام تیم" id="example-text-input">
                    </div>
                </div>

                <div class="form-group row" id="in3">
                    <label for="Name-input" class="col-1 col-form-label">3 </label>
                    <div class="col-5 ">
                        <input name="point" class="form-control" type="text" value="امتیاز" id="example-text-input">
                    </div>
                </div>

                <input type="hidden" name="columnNumber" id="hidden" value="">

                <button  id="submitButton" type="submit" class="btn btn-primary" style="margin-right: 20px;">ساختن براکت</button>


            </form>

            <br>
            <br>
            <br>
        </div>


    </div>



<style>
    .Vnav {
        margin-top: 20px;
        margin-right: 40px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 0.1;
        background-color: #f1f1f1;
        max-height: 200px;
        list-style-type: none;
        /*margin: 0;*/
        padding: 0;
        width: 200px;
        /*background-color: #f1f1f1;*/
    }


    .Vnav li a {
        display: block;
        color: #000;
        padding: 8px 16px;
        text-decoration: none;
    }

    .Vnav li.active {
        background-color: #008CBA;
        color: white;
    }

    .Vnav li a:hover:not(.active) {
        background-color: #555;
        color: white;
    }


    /*
 * Copyright (c) 2012-2013 Thibaut Courouble
 * http://www.cssflow.com
 * Licensed under the MIT License
 *
 * Sass/SCSS source: https://goo.gl/vVfMr
 * PSD by Orman Clark: https://goo.gl/MNFHK
 */



    .switch {
        position: relative;
        margin: 20px auto;
        height: 26px;
        width: 120px;
        background: rgba(0, 0, 0, 0.25);
        border-radius: 3px;
        -webkit-box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.3), 0 1px rgba(255, 255, 255, 0.1);
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.3), 0 1px rgba(255, 255, 255, 0.1);
    }

    .switch-label {
        position: relative;
        z-index: 2;
        float: left;
        width: 58px;
        line-height: 26px;
        font-size: 11px;
        color: rgba(255, 255, 255, 0.35);
        text-align: center;
        text-shadow: 0 1px 1px rgba(0, 0, 0, 0.45);
        cursor: pointer;
    }

    .switch-label:active {
        font-weight: bold;
    }

    .switch-label-off {
        padding-left: 2px;
    }

    .switch-label-on {
        padding-right: 2px;
    }

    /*
      Note: using adjacent or general sibling selectors
      combined with pseudo classes doesn't work in Safari
      5.0 and Chrome 12.
      See this article for more info and a potential fix:
      https://css-tricks.com/webkit-sibling-bug/
    */

    .switch-input {
        display: none;
    }

    .switch-input:checked + .switch-label {
        font-weight: bold;
        color: rgba(0, 0, 0, 0.65);
        text-shadow: 0 1px rgba(255, 255, 255, 0.25);
        -webkit-transition: 0.15s ease-out;
        -moz-transition: 0.15s ease-out;
        -o-transition: 0.15s ease-out;
        transition: 0.15s ease-out;
    }

    .switch-input:checked + .switch-label-on ~ .switch-selection {
        /* Note: left: 50% doesn't transition in WebKit */
        left: 51px;
    }

    .switch-selection {
        display: block;
        position: absolute;
        z-index: 1;
        top: -9.5px;
        left: -9px;
        width: 58px;
        height: 25px;
        background: #65bd63;
        border-radius: 3px;
        background-image: -webkit-linear-gradient(top, #9dd993, #65bd63);
        background-image: -moz-linear-gradient(top, #9dd993, #65bd63);
        background-image: -o-linear-gradient(top, #9dd993, #65bd63);
        background-image: linear-gradient(to bottom, #9dd993, #65bd63);
        -webkit-box-shadow: inset 0 1px rgba(255, 255, 255, 0.5), 0 0 2px rgba(0, 0, 0, 0.2);
        box-shadow: inset 0 1px rgba(255, 255, 255, 0.5), 0 0 2px rgba(0, 0, 0, 0.2);
        -webkit-transition: left 0.15s ease-out;
        -moz-transition: left 0.15s ease-out;
        -o-transition: left 0.15s ease-out;
        transition: left 0.15s ease-out;
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