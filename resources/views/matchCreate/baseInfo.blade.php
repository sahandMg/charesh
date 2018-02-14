@extends('masterUserHeader.body')
@section('title')
    چارش | اطلاعات پایه
@endsection
@section('content')
    <ul class="nav nav-tabs">
        <li class="disabled"><a href=""> اطلاعات ثبت نام </a></li>
        <li class="disabled"><a href=""> قوانین </a></li>
        <li class="disabled"><a href=""> اطلاعات مسابقه </a></li>
        <li class="active"><a href="">اطلاعات پایه</a></li>
    </ul>
  <div class="formDiv" id="baseInfo">
   <form method="POST" action="{{route('baseInfo')}}" enctype="multipart/form-data">
       <input type="hidden" name="_token" value="{{csrf_token()}}">
     @if(count($errors->all()))
      <div class="alert alert-danger" role="alert">
          @foreach($errors->all() as $error)
              <li>{{$error}}</li>
          @endforeach
      </div>
    @endif
    <div class="form-group">
      <label for="Name-input">نام مسابقه  </label>
      <input name="matchName" @input="check"   :style="style1" v-model="matchName" class="form-control" type="text" value="{{Request::old('matchName')}}" id="example-text-input">
    </div>
    <div class="form-group" id="endTimeDivId">
      <label for="Name-input" style="width: 100%;">زمان پایان ثبت نام  </label>
        {{--<div class="endTimeReg">--}}
        <input class="form-control" @input="check" v-model="endTime" name="endTime" type="number" min="1"  placeholder="به روز وارد نمایید ، مثلا : 20 " id="example-text-input">
        <span @input="convertDate" class="form-control"   v-model="date">@{{date}}</span>
        <span @input="convertDate" class="form-control"   v-model="date">ساعت ۲۳:۵۹:۵۹</span>
            {{--<select name="startMonth" v-model="startMonth" style="float: right;margin-left: 1%;width: 40%;" class="form-control" id="sel1">--}}
                {{--<option>فروردین</option>--}}
                {{--<option>اردیبهشت</option>--}}
                {{--<option>خرداد</option>--}}
                {{--<option>تیر</option>--}}
                {{--<option>مرداد</option>--}}
                {{--<option>شهریور</option>--}}
                {{--<option>مهر</option>--}}
                {{--<option>آبان</option>--}}
                {{--<option>آذر</option>--}}
                {{--<option>دی</option>--}}
                {{--<option>بهمن</option>--}}
                {{--<option>اسفند</option>--}}
            {{--</select>--}}
            {{--<select name="startYear" v-model="startYear" style="float: right;margin-left: 1%;width: 20%;" class="form-control" id="sel2">--}}
                {{--<option>1396</option>--}}
                {{--<option>1397</option>--}}
            {{--</select>--}}
        {{--</div>--}}

    </div>
       <br>
       <br>
    <div class="form-group">
           <label for="Name-input">تاریخ شروع مسابقه  </label>
           <div>
               <input style="float: right;margin-left: 1%;width: 25%;" type="number" min="1" max="31" class="form-control" @input="check"  :style="style3" v-model="startDay" placeholder="روز" name="startDay" type="text" value="" id="example-text-input">
               <select name="startMonth" v-model="startMonth" style="float: right;margin-left: 1%;width: 40%;" class="form-control" id="sel1">
                   <option>فروردین</option>
                   <option>اردیبهشت</option>
                   <option>خرداد</option>
                   <option>تیر</option>
                   <option>مرداد</option>
                   <option>شهریور</option>
                   <option>مهر</option>
                   <option>آبان</option>
                   <option>آذر</option>
                   <option>دی</option>
                   <option>بهمن</option>
                   <option>اسفند</option>
               </select>
               <select name="startYear" v-model="startYear" style="float: right;margin-left: 1%;width: 32%;" class="form-control" id="sel2">
                   <option>1396</option>
                   <option>1397</option>
               </select>
           </div>
       </div>
       <br>
       <br>
   <div class="form-group">
    <label for="InputFile">توضیحات ضروری (تکمیل شود)  </label>
    <textarea class="form-control"  name="comment" id="summernote" rows="3"></textarea>
   </div>
   {{--<div class="form-group">--}}
    {{--<label for="InputFile" style="font-size: 18px">عکس بنر مسابقه<p style="font-size: 16px">(1290px * 600px)</p></label>--}}
    {{--<input type="file" class="form-control-file" name="path" style="font-size:15px" id="exampleInputFile" aria-describedby="fileHelp">--}}
   {{--</div>--}}
       <div class="wrapperImageUpload">
           <div class="boxImageUpload">
               <div class="js--image-preview" style=" background-image: url('{{URL::asset('images/1200_800.jpg')}}'); "></div>
               <div class="upload-options">
                   <label>
                       <input name="path" type="file" class="image-upload" aria-describedby="fileHelp" accept="image/*"  />
                   </label>
               </div>
           </div>
       </div>
       <a href="{{route('home')}}"><button   type="button" class="btn btn-danger">انصراف</button></a>
       <button :disabled="next"  type="submit" class="btn btn-primary">ادامه</button>
  </form>
  </div>
    <style>

        @import url(https://fonts.googleapis.com/icon?family=Material+Icons);
        @import url("https://fonts.googleapis.com/css?family=Raleway");


        .wrapperImageUpload {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
        }

        .boxImageUpload {
            display: block;
            min-width: 300px;
            height: 300px;
            margin: 10px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            overflow: hidden;
        }

        .upload-options {
            position: relative;
            height: 75px;
            background-color: cadetblue;
            cursor: pointer;
            overflow: hidden;
            text-align: center;
            transition: background-color ease-in-out 150ms;
        }
        .upload-options:hover {
            background-color: #7fb1b3;
        }
        .upload-options input {
            width: 0.1px;
            height: 0.1px;
            opacity: 0;
            overflow: hidden;
            position: absolute;
            z-index: -1;
        }
        .upload-options label {
            display: flex;
            align-items: center;
            width: 100%;
            height: 100%;
            font-weight: 400;
            text-overflow: ellipsis;
            white-space: nowrap;
            cursor: pointer;
            overflow: hidden;
        }
        .upload-options label::after {
            content: 'add';
            font-family: 'Material Icons';
            position: absolute;
            font-size: 2.5rem;
            color: #e6e6e6;
            top: calc(50% - 2.5rem);
            left: calc(50% - 1.25rem);
            z-index: 0;
        }
        .upload-options label span {
            display: inline-block;
            width: 50%;
            height: 100%;
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
            vertical-align: middle;
            text-align: center;
        }
        .upload-options label span:hover i.material-icons {
            color: lightgray;
        }

        .js--image-preview {
            height: 225px;
            width: 100%;
            position: relative;
            overflow: hidden;
            background-image: url("image/11.jpg");
            background-color: white;
            background-position: center center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .js--image-preview.js--no-default::after {
            display: none;
        }

        i.material-icons {
            transition: color 100ms ease-in-out;
            font-size: 2.25em;
            line-height: 55px;
            color: white;
            display: block;
        }

        .dropImage {
            display: block;
            position: absolute;
            background: rgba(95, 158, 160, 0.2);
            border-radius: 100%;
            transform: scale(0);
        }

        .animateImage {
            animation: ripple 0.4s linear;
        }

        @keyframes ripple {
            100% {
                opacity: 0;
                transform: scale(2.5);
            }
        }
    </style>
    <script>
        function initImageUpload(box) {
            let uploadField = box.querySelector('.image-upload');

            uploadField.addEventListener('change', getFile);

            function getFile(e){
                let file = e.currentTarget.files[0];
                checkType(file);
            }

            function previewImage(file){
                let thumb = box.querySelector('.js--image-preview'),
                    reader = new FileReader();

                reader.onload = function() {
                    thumb.style.backgroundImage = 'url(' + reader.result + ')';
                }
                reader.readAsDataURL(file);
                thumb.className += ' js--no-default';
            }

            function checkType(file){
                let imageType = /image.*/;
                if (!file.type.match(imageType)) {
                    throw 'Datei ist kein Bild';
                } else if (!file){
                    throw 'Kein Bild gewählt';
                } else {
                    previewImage(file);
                }
            }

        }
        // initialize box-scope
        var boxes = document.querySelectorAll('.boxImageUpload');

        for(let i = 0; i < boxes.length; i++) {
            let box = boxes[i];
            initDropEffect(box);
            initImageUpload(box);
        }
        /// drop-effect
        function initDropEffect(box){
            let area, drop, areaWidth, areaHeight, maxDistance, dropWidth, dropHeight, x, y;
            // get clickable area for drop effect
            area = box.querySelector('.js--image-preview');
            area.addEventListener('click', fireRipple);

            function fireRipple(e){
                area = e.currentTarget
                // create drop
                if(!drop){
                    drop = document.createElement('span');
                    drop.className = 'dropImage';
                    this.appendChild(drop);
                }
                // reset animate class
                drop.className = 'dropImage';

                // calculate dimensions of area (longest side)
                areaWidth = getComputedStyle(this, null).getPropertyValue("width");
                areaHeight = getComputedStyle(this, null).getPropertyValue("height");
                maxDistance = Math.max(parseInt(areaWidth, 10), parseInt(areaHeight, 10));

                // set drop dimensions to fill area
                drop.style.width = maxDistance + 'px';
                drop.style.height = maxDistance + 'px';

                // calculate dimensions of drop
                dropWidth = getComputedStyle(this, null).getPropertyValue("width");
                dropHeight = getComputedStyle(this, null).getPropertyValue("height");

                // calculate relative coordinates of click
                // logic: click coordinates relative to page - parent's position relative to page - half of self height/width to make it controllable from the center
                x = e.pageX - this.offsetLeft - (parseInt(dropWidth, 10)/2);
                y = e.pageY - this.offsetTop - (parseInt(dropHeight, 10)/2) - 30;

                // position drop and animate
                drop.style.top = y + 'px';
                drop.style.left = x + 'px';
                drop.className += ' animateImage';
                e.stopPropagation();

            }
        }

    </script>
 <style>
        .nav-tabs li {
            width: 25%;
            font-size: 100%;
            font-weight: 400;
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
        @media screen and (max-width: 800px) {
            .nav-tabs li {
                font-size: 80%;
                font-weight: 400;
            }
        }
        #endTimeDivId input {
            width: 20%;
            margin-left: 1%;
            float: right;
        }
        #endTimeDivId span {
            float: right;
            margin-left: 1%;
            width: 25%;
        }
        @media screen and (max-width: 600px) {
            .nav-tabs li {
                font-size: 50%;
                font-weight: 400;
            }
            .formDiv {
                width: 95%;
            }
            option {
                font-size: 60%;
            }
            .formDiv {
                width: 95%;
            }
            .endTimeReg input{
                width: 40%;
            }
            .endTimeReg select{
                width: 40%;
            }
            #endTimeDivId span {
                width: 40%;
            }
        }
    </style>
 <script>
 vm = new Vue({
 el:'#baseInfo',
 data:{
 matchName:'',
 url:'',
 startTime:'',
 endTime:'1',
 comment:'',
     startDay:'',
     startMonth:'فروردین',
     startYear:'1396',
date:{!! json_encode(\Morilog\Jalali\jDate::forge('now')->format('date')) !!},
 next:true,
 },
 methods:{


     check:function () {

        vm = this
         axios.get({!! json_encode(route('convertDate')) !!}+'?day='+this.endTime).then(function (response) {

             vm.date = response.data
         })


 if(this.endTime.length > 0 && this.startDay.length > 0 && this.startMonth.length > 0 && this.startYear.length > 0 &&  this.matchName.length > 0){
 this.next = false
 }else{
 this.next = true
 }
 },
 }
 })


 </script>
@endsection