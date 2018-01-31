@extends('masterUserHeader.body')
@section('content')
    @include('masterOrganize.body',['tournament'=> $tournament,'route'=>$route])
   <div class="container" id="Brack" style="direction: rtl;">

       <h2>{{$message}}</h2>
 <form style="padding-top: 20px;font-size: 20px;" method="post" action="{{route('groupBracket',['id'=>$tournament->id,'matchName'=>$tournament->matchName])}}">
     <input type="hidden" name="_token" value="{{csrf_token()}}">
     <div v-if="error" class="alert alert-danger">

         مجموع تعداد تیم های وارد شده بیش از تعداد تیم های ثبت نام شده است

     </div>
     <div class="form-group">
      <label for="Name-input">تعدا گروه ها </label>
      <input class="form-control" @focusout="check" min="1" v-model="groupNumber" max="100" type="number" name="groupNumber" placeholder="به عدد" id="example-text-input">
    </div>

   <div class="form-group">
      <label for="Name-input">تعداد تیمهای هر گروه : </label>
      <input class="form-control" @focusout="check" type="number" v-model="groupTeam" min="1" max="100" name="groupTeam" placeholder="به عدد" id="example-text-input">
    </div>

   <div class="form-group">
      <label for="Name-input">تعداد تیم های صعود کننده از هر گروه : </label>
      <input class="form-control" type="number" min="1" max="100" placeholder="به عدد"  name="winnerTeams" id="example-text-input">
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
    
     <button :disabled="error"  id="submitButton" type="submit" class="btn btn-primary" style="margin-right: 20px;">ساختن براکت</button>


  </form>
    <br>
    <br>

  
</div>



<style>

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

  new Vue({
      el:'#Brack',
      data:{
          groupNumber:1,
          groupTeam:1,
          error:false
      },
      methods:{
          check:function () {
             var ans = this.groupNumber * this.groupTeam;
              if(ans > {!! json_decode($tournament->sold) !!}){

                  this.error = true

              }else{

                  this.error = false
              }
          }
      }
  })
   var count = 3 ;
 var maxTeamMember = 10 ;
 var minTeamMember = 3 ;


 function addInput() {  
  if(count < maxTeamMember)
  {

      count++
      document.getElementById('hidden').value = count;
   $( '<div id="in'+ count +'" class="form-group"><label for="Name-input"> '+ count +' </label><input name="column'+ count +'" class="form-control" type="text" value="" id="example-text-input"></div>' ).insertBefore( "#submitButton" );
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