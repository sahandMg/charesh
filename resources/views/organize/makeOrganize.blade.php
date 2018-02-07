@extends('masterUserHeader.body')
@section('title')
    چارش | ثبت نام برگزار کننده
@endsection
@section('content')
<div class="container" style="direction: rtl;margin-top: 2%;" id="app">
   <div class="card" style="background-color: white;">
     <h2 class="card-title" style="background-color: #42CBC8;padding: 20px;color: white;">پروفایل برگزار کننده</h2>
     <form style="padding:1%;" method="POST" action="{{route('MakeOrganize')}}" enctype="multipart/form-data">
         <input type="hidden" name="_token" value="{{csrf_token()}}">
         <!-- ٍٍError message -->
         @if(count($errors->all()))
             <div class="alert alert-danger" role="alert">
                 @foreach($errors->all() as $error)

                     <li>{{$error}}</li>

                 @endforeach
             </div>
         @endif

         @if(count(session('error')))
             <div class="alert alert-danger" role="alert">


                     <li>{{session('error')}}</li>


             </div>
         @endif
         <div class="form-group ">
             <label for="Name-input">نام </label>
             <input  class="form-control" @input="check" name="name" v-model="name" type="text" value="{{Request::old('OrgName')}}" id="example-text-input">
         </div>
         {{--<div class="form-group">--}}
             {{--<label for="InputFile">عکس لوگو (100px * 100px حداکثر ۱ مگابایت)  </label>--}}
             {{--<input type="file" name="logo_path" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">--}}
         {{--</div>--}}
         <div class="wrapperImageUpload">
             <div class="boxImageUpload">
                 <div class="js--image-preview"></div>
                 <div class="upload-options">
                     <label>
                         <input name="logo_path" type="file" class="image-upload" aria-describedby="fileHelp" accept="image/*"  />
                     </label>
                 </div>
             </div>
         </div>
         <div class="form-group">
             <label for="InputFile">توضیحات  </label>
             <textarea  class="form-control" name="comment" id="summernote" rows="3"></textarea>
         </div>
         {{--<div class="form-group">--}}
             {{--<label for="InputFile">عکس پشت زمینه (1150px * 380px حداکثر ۱ مگابایت)  </label>--}}
             {{--<input type="file" class="form-control-file" name="background_path" id="exampleInputFile" aria-describedby="fileHelp">--}}
         {{--</div>--}}
         <div class="wrapperImageUpload">
             <div class="boxImageUpload">
                 <div class="js--image-preview"></div>
                 <div class="upload-options">
                     <label>
                         <input name="background_path" type="file" class="image-upload" aria-describedby="fileHelp" accept="image/*"  />
                     </label>
                 </div>
             </div>
         </div>
         <a  href="{{route('OrganizeContact')}}"><button :disabled="next"  type="submit" class="btn btn-primary">ادامه</button></a>
     </form>
   </div>
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
<script>
     vm = new Vue({
         el:'#app',
         data:{
             name:'',
             url:'',
             startTime:'',
             endTime:'',
             comment:'',
             next:true,
         },
         methods:{
             check:function () {
                 if(this.name.length > 0 ){

                     this.next = false
                 }else{

                     this.next = true

                 }
             },
         }
     })
 </script>
@endsection