@extends('masterUserHeader.body')
@section('content')
 <div class="container" style="direction: rtl;" id="Edit">
<br>
     @if(count(session('message')))
         <div class="alert alert-success ">
             {{session('message')}}
         </div>
     @endif
         @if(count($errors->all()))
         <div class="alert alert-danger" role="alert">

                 @foreach($errors->all() as $error)

                     <li>{{$error}}</li>

                 @endforeach

             </div>
         @endif

@if(count(session('settingError')))
         <div class="alert alert-danger ">
             {{session('settingError')}}
         </div>
     @endif

     <form style="padding-top: 20px;font-size: 20px;" method="post" action="{{route('setting',['username'=>Auth::user()->slug])}}" enctype="multipart/form-data">
         <input type="hidden" name="_token" value="{{csrf_token()}}">


   <div class="form-group">
    <label for="InputFile">عکس  </label>
    <input type="file" name="imageFile" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
   </div>
 
   <div class="form-group">
      <label for="email-input">ایمیل  </label>
      <input class="form-control" name="email" type="email" placeholder="me@example.com" id="example-email-input">
   </div>
   <div class="form-group">
      <label for="oldpass">رمز قبلی  </label>
      <input class="form-control" name="oldPass" type="password" id="Telegram-input">
   </div>
   <div class="form-group">
      <label for="password">رمز جدید  </label>
      <input class="form-control" name="password" type="password" id="Telegram-input">
   </div>

    <div class="form-group">
      <label for="Telegram-input">تکرار رمز جدید  </label>
      <input class="form-control" name="repeat" type="password" id="Telegram-input">
    </div>

       @if(Auth::user()->role == 'supplier')
             <div class="form-group" style="font-weight: 400;font-size: 125%;">
                 <label class="container" style="color:darkgreen"> برگزار کننده مسابقه
                     <input type="radio" checked="checked" name="radio" value="supplier">
                     <span class="checkmark"></span>
                 </label>
                 <label class="container">  شرکت کننده در مسابقه
                     <input type="radio" name="radio" value="customer">
                     <span class="checkmark"></span>
                 </label>
             </div>

         @else

             <div class="form-group" style="font-weight: 400;font-size: 125%;">
                 <label class="container" > برگزار کننده مسابقه
                     <input type="radio"  name="radio" value="supplier">
                     <span class="checkmark"></span>
                 </label>
                 <label class="container" style="color:darkgreen">  شرکت کننده در مسابقه
                     <input type="radio" name="radio" checked="checked" value="customer">
                     <span class="checkmark"></span>
                 </label>
             </div>

         @endif

<br>
<div class="g-recaptcha" data-sitekey="6LfjSj4UAAAAAD62COv7b0uURhIDgYYAQMRYGY0s"></div>
<br>      

         <button  @click="hidden" type="submit" v-show="!hide" class="btn btn-primary">ذخیره تغییرات</button>
         <button v-show="hide" class="btn btn-warning " :disabled="true"><i class="fa fa-spinner fa-spin" ></i> در حال ذخیره </button>

  </form>
</div>





 <script type="text/javascript" src="{{URL::asset('js/bootstrap.js')}}"></script>


   <script>

       new Vue({

           el:'#Edit',
           data:{
               hide:false
           },
           methods:{

               hidden:function () {
                   this.hide = true
               }
           }

       })

       /* When the user clicks on the button,
       toggle between hiding and showing the dropdown content */
    function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
    }

    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
      if (!event.target.matches('.dropbtn')) {

        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
          }
        }
      }
    }
  </script>

@endsection
