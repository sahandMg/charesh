@extends('masterUserHeader.body')
@section('content')
 <div class="container" style="direction: rtl;">

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
     <form style="padding-top: 20px;font-size: 20px;" method="post" action="{{route('setting')}}" enctype="multipart/form-data">
         <input type="hidden" name="_token" value="{{csrf_token()}}">


   <div class="form-group row">
    <label for="InputFile" class="col-2 col-form-label">عکس : </label>
    <div class="col-5">
     <input type="file" name="imageFile" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
    </div>
   </div>
 
   <div class="form-group row">
      <label for="email-input" class="col-2 col-form-label">ایمیل : </label>
      <div class="col-5">
        <input class="form-control" name="email" type="email" placeholder="me@example.com" id="example-email-input">
      </div>
    </div>

    <div class="form-group row">
      <label for="Telegram-input" class="col-2 col-form-label">رمز جدید : </label>
      <div class="col-5">
        <input class="form-control" name="password" type="password" id="Telegram-input">
      </div>
    </div>

    <div class="form-group row">
      <label for="Telegram-input" class="col-2 col-form-label">تکرار رمز جدید : </label>
      <div class="col-5">
        <input class="form-control" name="repeat" type="password" id="Telegram-input">
      </div>
    </div>
      
   <button type="submit" class="btn btn-primary">ذخیره</button>

  </form>
</div>




 <script type="text/javascript" src="../../public/js/bootstrap.js"></script>


   <script>
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