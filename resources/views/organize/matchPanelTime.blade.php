@extends('masterUserHeader.body')
@section('content')
    @include('masterOrganize.body',['tournament'=> $tournament,'route'=>$route])

<div class="container" id="app" style="direction: ltr;width: 100%;">
    @if(count(session('message')))
        <div class="alert alert-success" role="alert">
            <li>{{session('message')}}</li>
        </div>
   @endif
        <p>روز یا روزهای برگزاری مسابقه را انتخاب کرده و ساعات برگزاری مسابقه در روز اتخاب شده را در کادر پایین شرح دهید</p>
        {{--<!-- Time Text Editor -->--}}
        {{--<form style="padding: 20px;" method="POST" action="{{route('challengeTime',['id'=>$tournament->id,'matchName'=>$tournament->matchName])}}">--}}
            {{--<input type="hidden" name="_token" value="{{csrf_token()}}">--}}
        {{--<div class="card row" style=" box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);z-index: 0.5;padding: 20px;margin-top: 20px;">--}}
          {{--<textarea name="timeline" id="summernote" cols="30" rows="10"></textarea>--}}
       {{--</div>--}}
            {{--<br>--}}
            {{--<button type="submit" class="btn btn-primary"> ذخیره </button>--}}
        {{--</form>--}}
   {{--</div>--}}


    {{--<div class="container" style="direction: ltr;width: 100%;">--}}
        <div class="calendar">
            <div class="month">
                <ul>
                    <li class="prev"><button class="arrow" onclick="prevMonth()" id="previous">&#10094;</button></li>
                    <li class="next"><button class="arrow" onclick="nextMonth()" id="next">&#10095;</button></li>
                    <li><span id="monthName">ماه فلان </span><br>
                        <span style="font-size:18px" id="year">۱۳۹۶</span>
                    </li>
                </ul>
            </div>
            <ul class="weekdays">
                <li>شنبه</li>
                <li>یکشنبه</li>
                <li>دوشنبه</li>
                <li>سه شنبه</li>
                <li>چهارشنبه</li>
                <li>پنج شنبه</li>
                <li>جمعه</li>
            </ul>
            <ul class="days">
                <li id="firstDay"><button class="day" id="1">1</button></li>
                <li><button class="day" id="2">2</button></li>
                <li><button class="day" id="3">3</button></li>
                <li><button class="day" id="4">4</button></li>
                <li><button class="day" id="5">5</button></li>
                <li><button class="day" id="6">6</button></li>
                <li><button class="day" id="7">7</button></li>
                <li><button class="day" id="8">8</button></li>
                <li><button class="day" id="9">9</button></li>
                <li><button class="day" id="10">10</button></li>
                <li><button class="day" id="11">11</button></li>
                <li><button class="day" id="12">12</button></li>
                <li><button class="day" id="13">13</button></li>
                <li><button class="day" id="14">14</button></li>
                <li><button class="day" id="15">15</button></li>
                <li><button class="day" id="16">16</button></li>
                <li><button class="day" id="17">17</button></li>
                <li><button class="day" id="18">18</button></li>
                <li><button class="day" id="19">19</button></li>
                <li><button class="day" id="20">20</button></li>
                <li><button class="day" id="21">21</button></li>
                <li><button class="day" id="22">22</button></li>
                <li><button class="day" id="23">23</button></li>
                <li><button class="day" id="24">24</button></li>
                <li><button class="day" id="25">25</button></li>
                <li><button class="day" id="26">26</button></li>
                <li><button class="day" id="27">27</button></li>
                <li><button class="day" id="28">28</button></li>
                <li id="day29"><button class="day" id="29">29</button></li>
                <li id="day30"><button class="day" id="30">30</button></li>
                <li id="day31"><button class="day" id="31">31</button></li>
            </ul>
        </div>
        <br>
        <br>
        <div class="form-group" id="textForm" style="width: 90%;margin: auto;display: none;direction: rtl;">
            <label for="InputFile" class="col-form-label">شرح زمان بندی مسابقه در روز <span id="dayNumber"></span> </label>
            <textarea name="moreInfo" class="form-control" id="summernote" rows="5" placeholder="ساعات برگزاری مسابقه در آن روز را توضیح دهید ."></textarea>
            <br>
            <button class="btn btn-success" onclick="store()">ذخیره</button>

            <button class="btn btn-danger" onclick="remove()">حذف</button>
        </div>
        <br>
        <br>
        <br>


    </div>

<script type="text/javascript">




    var firstDays1396 = [ 3 , 6 , 2 , 5 , 1 , 4 , 0 , 2 , 4 , 6 , 1 , 3] ;
    var firstDays1397 = [ 4 , 0 , 3 , 6 , 2 , 5 , 1 , 3 , 5 , 0 , 2 , 4] ;
  var j = 0 ;
   var firstDays = new Array(2);
   firstDays[0] = new Array(12);
  firstDays[1] = new Array(12);
  for(j=0;j<12;j++)
  {
      firstDays[0][j] =  firstDays1396[j];
  }
  for(j=0;j<12;j++)
  {
      firstDays[1][j] =  firstDays1397[j];
  }
   var yearnumber = 0 ;
   var year  = 1396 ;
   var months = [
        'فروردین',  'اردیبهشت' ,'خرداد','تیر','مرداد','شهریور','مهر','آبان','آذر','دی','بهمن','اسفند'
    ];

   var monthNumber = 0 ;
   var i = 0;
 var dayID ;
 var dayContent ;

 $(document).ready(function () {
     $("#monthName").html(months[monthNumber]);
     $("#year").html(year);
     for(i=0;i<firstDays[yearnumber][monthNumber];i++)
     {
         $( '<li class="removeDays" style="margin-right: 0.46%;"><button class="day"></button></li>' ).insertBefore( "#firstDay" );
     }
     $(".day").click(function (event) {

         dayID = event.target.id ;
         $("#textForm").css("display", "block");
         $("#dayNumber").html(dayID.toString());
         axios.get('{{route('getDate')}}'+'?id='+{!! json_decode($tournament->id) !!}+'&'+'day='+dayID+'&'+'month='+monthNumber+'&'+'year='+year).then(function (response) {

             if(response.status == 200){

                 var text = response.data

                 if(response.data == 1){
                     $('#summernote').summernote('code', '')
                 }else{
                     $('#summernote').summernote('code', '')
                     $('#summernote').summernote('editor.pasteHTML', text);
                     $('#'+ dayID).addClass("daySelected");
                 }
             }
         })
     });
     if( monthNumber > 5 ) {
         // $("#day31").css("display", "none");
         $("#day31").css("visibility", "hidden");
         // visibility: hidden;
         // visibility: visible;
     }
     if( monthNumber == 11 ) {
         // $("#day30").css("display", "none");
         $("#day30").css("visibility", "hidden");
     }
     // console.log("Hello");

 });
   function prevMonth() {
       monthNumber--;
       if(monthNumber === -1 )
       {
           monthNumber = 11 ;
           year--;
           yearnumber--;
       }
       $("#monthName").html(months[monthNumber]);
       $("#year").html(year);
       $(".removeDays").remove();
       for(i=0;i<firstDays[yearnumber][monthNumber];i++)
       {
           $( '<li class="removeDays" style="margin-right: 0.46%;"><button class="day"></button></li>' ).insertBefore( "#firstDay" );
       }
       if(monthNumber == 10) {
           // $("#day30").css("display", "block");
           $("#day30").css("visibility", "visible");
       }
       if( monthNumber == 5 ) {
           // $("#day31").css("display", "block");
           $("#day31").css("visibility", "visible");
       }
       if( monthNumber == 11 ) {
           // $("#day30").css("display", "none");
           // $("#day31").css("display", "none");
           $("#day30").css("visibility", "hidden");
           $("#day31").css("visibility", "hidden");
       }
       if( (monthNumber == 10) && ( year == 1397) ) {
           $("#next").attr("disabled", false);;
           $("#next").css("visibility", "visible");
       }
       if( (monthNumber == 0) && ( year == 1396) ) {
           $("#previous").attr("disabled", true);;
           $("#previous").css("visibility", "hidden");
       }

       $('.daySelected').removeClass("daySelected");
       for(var i=0;i<calender.length;i++){

           if(calender[i].month == monthNumber && calender[i].year == year){



               $('#'+ calender[i].day).addClass("daySelected");

           }

       }

   }
   function nextMonth() {
       monthNumber++;
       if(monthNumber === 12 )
       {
           monthNumber = 0 ;
           year++;
           yearnumber++;
       }
       $("#monthName").html(months[monthNumber]);
       $("#year").html(year);
       $(".removeDays").remove();
       for(i=0;i<firstDays[yearnumber][monthNumber];i++)
       {
           $( '<li class="removeDays" style="margin-right: 0.46%;"><button class="day"></button></li>' ).insertBefore( "#firstDay" );
       }
       if(monthNumber == 0) {
           // $("#day30").css("display", "inherit");
           // $("#day31").css("display", "inherit");
           $("#day30").css("visibility", "visible");
           $("#day31").css("visibility", "visible");
       }
       if( monthNumber == 6 ) {
           // $("#day31").css("display", "none");
           $("#day31").css("visibility", "hidden");
       }
       if( monthNumber == 11 ) {
           // $("#day30").css("display", "none");
           $("#day30").css("visibility", "hidden");
       }
       if( (monthNumber == 11) && ( year == 1397) ) {
           $("#next").attr("disabled", true);;
           $("#next").css("visibility", "hidden");
       }
       if( (monthNumber == 1) && ( year == 1396) ) {
           $("#previous").attr("disabled", false);;
           $("#previous").css("visibility", "visible");
       }
//
       $('.daySelected').removeClass("daySelected");
       for(var i=0;i<calender.length;i++){

//           console.log(calender[i].month)
           if(calender[i].month == monthNumber && calender[i].year == year){

               $('#'+ calender[i].day).addClass("daySelected");

           }

       }


   }
 function store() {
     $("#textForm").css("display", "none");
     $('#'+ dayID).addClass("daySelected");
     dayContent = $('#summernote').val();
//     console.log(dayContent);
//     console.log(dayID);
//     console.log(monthNumber);
//     console.log(year);

     axios.get('{{route('setDate')}}'+'?text='+dayContent+'&'+'day='+dayID+'&'+'month='+monthNumber+'&'+'year='+year+'&'+'id='+{!! json_decode($tournament->id) !!}).then(function (response) {


         alert(response.data)
     })

 }
 function remove() {
     $("#textForm").css("display", "none");
     $('#summernote').html(dayID.toString());
     $('#'+ dayID).removeClass("daySelected");
     dayContent = '' ;
     axios.get('{{route('rmCalender')}}'+'?text='+dayContent+'&'+'day='+dayID+'&'+'month='+monthNumber+'&'+'year='+year+'&'+'id='+{!! json_decode($tournament->id) !!}).then(function (response) {

        if(response.data == 1){

            alert('رویداد مورد نظر حذف شد')
        }else{

            alert('رویدادی برای این روز ثبت نشده است')
        }

     })
//     console.log(dayContent);
//     console.log(dayID);
//     console.log(monthNumber);
//     console.log(year);
 }
var calender
    axios.get('{{route('getDays')}}'+'?id='+{!! json_decode($tournament->id) !!}).then(function (response) {


        monthNumber = response.data[1];
        calender =  response.data[0];

        for(var i=0 ; i<response.data[0].length; i++){

                if(calender[i].month == monthNumber){

               $('#'+ calender[i].day).addClass("daySelected");

                }



        }
        $("#monthName").html(months[monthNumber]);
        if( monthNumber > 5 ) {
            // $("#day31").css("display", "none");
            $("#day31").css("visibility", "hidden");
            // visibility: hidden;
            // visibility: visible;
        }
        if( monthNumber == 11 ) {
            // $("#day30").css("display", "none");
            $("#day30").css("visibility", "hidden");
        }
        $("#monthName").html(months[monthNumber]);
        $("#year").html(year);
        $(".removeDays").remove();
        for(i=0;i<firstDays[yearnumber][monthNumber];i++)
        {
            $( '<li class="removeDays" style="margin-right: 0.40%;"><button class="day"></button></li>' ).insertBefore( "#firstDay" );
        }
    })




</script>


    <style>

        * {box-sizing: border-box;}
        ul {list-style-type: none;}
        body {font-family: Verdana, sans-serif;}

        .calendar {
            width: 100%;
            margin: auto;
            display: block;
        }

        .month {
            padding: 50px 25px;
            width: 100%;
            background: #1abc9c;
            text-align: center;
        }

        .month ul {
            margin: 0;
            padding: 0;
        }

        .month ul li {
            color: white;
            font-size: 20px;
            text-transform: uppercase;
            letter-spacing: 3px;
        }

        .month .prev {
            float: left;
            padding-top: 10px;
        }

        .month .next {
            float: right;
            padding-top: 10px;
        }

        .weekdays {
            margin: 0;
            padding: 10px 0;
            background-color: #ddd;
        }

        .weekdays li {
            display: inline-block;
            width: 13.6%;
            color: #666;
            text-align: center;
        }

        .days {
            padding: 10px 0;
            background: #eee;
            margin: 0;
        }

        .days li {
            list-style-type: none;
            display: inline-block;
            width: 13.6%;
            text-align: center;
            /*margin-bottom: 5px;*/
            /*font-size:12px;*/
            color: #777;
            padding: 0;
            border-radius: 5px;
            margin-bottom: 1%;
        }

        /*.days li .active {*/
            /*padding: 5px;*/
            /*background: #1abc9c;*/
            /*color: white !important*/
        /*}*/

        /* Add media queries for smaller screens */
        @media screen and (max-width:720px) {
            .weekdays li, .days li {width: 13.1%;}
            .weekdays li {
                font-size: 100%;
            }
            p {
                font-size: 75%;
            }
        }

        @media screen and (max-width: 420px) {
            .weekdays li, .days li {width: 12.5%;}
            .days li .active {padding: 2px;}
            .weekdays li {
                font-size: 65%;
            }
        }

        @media screen and (max-width: 290px) {
            .weekdays li, .days li {width: 12.2%;}
        }
        p {
            text-align: center;
            margin-top: 1%;
        }
        .arrow {
            background-color: transparent;
            border: none;
            color: white;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 150%;
            cursor: pointer;
        }
        .day {
            background-color: transparent;
            border: none;
            color: black;
            padding: 0px;
            text-align: center;
            text-decoration: none;
            font-size: 100%;
            cursor: pointer;
            width: 80%;
            border-radius: 5px;
        }
        .daySelected {
           background-color : green;
           color : white ;
        }
    </style>

@endsection