@extends('masterUserHeader.body')
@section('content')
    <div class="row" style=" direction: rtl;" id="app">
        <!— right menu —>
        <div class="col-2">
            <ul class="Vnav">
                <li><a class="active" href="{{route('orgMatches',['orgName'=>$name->organize->name])}}">پنل مدیریت</a></li>
                <li><a href="{{route('matchCreate')}}">مسابقه جدید</a></li>
                <li><a href="{{route('orgEdit',['orgName'=>$name->organize->name])}}">ویرایش اطلاعات من</a></li>
                <li><a href="{{route('organizeAccount',['orgName'=>$name->organize->name])}}">حساب من</a></li>
            </ul>
        </div>
        <!— content —>
        <div class="container col-8">
       <br>
       @include('masterOrganize.body',['tournament'=> $tournament,'route'=>$route])
       <br>
       <a href="{{route('bracketDelete',['id'=>$tournament->id,'matchName'=>$tournament->matchName])}}"><button type="button" class="btn btn-warning" style="margin-right: 40px;margin-top: 40px;margin-bottom: 5px;">تغییر نوع برگزاری براکت</button></a>
       <p style="width: 200px;margin-right: 50px;">در صورت تغییر نوع برگزاری براکت ، تمام اطلاعات براکت قبلی شما پاک می شود ، باید از ابتدا به دسته بندی مسابقه دهندگان بپردازید.</p>
       <br>
       <h2>{{$message}}</h2>
 <form style="padding-top: 20px;font-size: 20px;" method="post" action="{{route('groupBracket',['id'=>$tournament->id,'url'=>$tournament->code])}}">
     <input type="hidden" name="_token" value="{{csrf_token()}}">
   <div class="form-group row">
      <label for="Name-input" class="col-5 col-form-label">تعدا گروه ها: </label>
      <div class="col-2">
       <input class="form-control" type="number" name="groupNumber" placeholder="به عدد" id="example-text-input">
     </div>
    </div>

   <div class="form-group row">
      <label for="Name-input" class="col-5 col-form-label">تعداد تیمهای هر گروه : </label>
      <div class="col-2">
       <input class="form-control" type="number" name="groupTeam" placeholder="به عدد" id="example-text-input">
     </div>
    </div>

   <div class="form-group row">
      <label for="Name-input" class="col-5 col-form-label">تعداد تیم های صعود کننده از هر گروه : </label>
      <div class="col-2 ">
       <input class="form-control" type="number" placeholder="به عدد"  name="winnerTeams" id="example-text-input">
     </div>
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
  </style>


 <style type="text/css">
   *[draggable=true] {
    -moz-user-select: none;
    -khtml-user-drag: element;
    cursor: move;
   }
 </style>

 {{--<script type="text/javascript" src="js/jquery-3.2.1.js"></script>--}}
 <script type="text/javascript" src="{{URL::asset('js/main.js')}}"></script>
 <script type="text/javascript" src="{{URL::asset('js/bootstrap.js')}}"></script>



<script type="text/javascript">
   var count = 3 ;
 var maxTeamMember = 10 ;
 var minTeamMember = 3 ;


 function addInput() {  
  if(count < maxTeamMember)
  {

      count++
      document.getElementById('hidden').value = count;
   $( '<div id="in'+ count +'" class="form-group row"><label for="Name-input" class="col-1 col-form-label"> '+ count +' </label><div class="col-5"><input name="column'+ count +'" class="form-control" type="text" value="" id="example-text-input"></div></div>' ).insertBefore( "#submitButton" );
  } else {
    alert('حداکثر تعداد ستون های جدول ' + maxTeamMember +' می باشد.');
  }
   
 }


 function removeInput() {
  if (minTeamMember < count) {
   $('#in' + count).remove();


      count--;
      document.getElementById('hidden').value = count;
  } else {
    alert('حداقل تعداد ستون های جدول ' + minTeamMember +' می باشد.');
  }
   
 }

</script>


@endsection
<!-- <div class="col-sm-6 col-md-3 col-lg-3"><table class="table table-striped"><thead><tr><th></th><th>Group A</th><th>Point</th></tr></thead><tbody><tr><th scope="row">1</th><td id="G11" ondrop="drop(event)" ondragover="allowDrop(event)"></td><td>0</td></tr><tr><th scope="row">2</th><td id="G12" ondrop="drop(event)" ondragover="allowDrop(event)"></td><td>0</td></tr><tr><th scope="row">3</th><td id="G13" ondrop="drop(event)" ondragover="allowDrop(event)"></td><td>0</td></tr><tr><th scope="row">4</th><td id="G14" ondrop="drop(event)" ondragover="allowDrop(event)"></td><td>0</td></tr></tbody></table></div> -->