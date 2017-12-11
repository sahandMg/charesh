@extends($auth == 1 ? 'masterUserHeader.body' : 'masterHeader.body')
@section('content')


    <div class="container" style="direction: rtl;padding-top: 30px;">
        @include('masterMatch.body',['tournament'=> $tournament,'route'=>$route])
        <br>


        <div class="card-group" style="padding-top: 20px;">
     <div class="card">
      <div class="card-block">
       <h4 class="card-title">زمان بندی مسابقات</h4>
       <br>
       <div class="row">
         <div class="col-6">
           <img class="rounded" src="../../public/images/calendar.jpg" height="300">
         </div>
         <div class="col-6">
            <p> {!! $tournament->plan !!} </p>
         </div>
         
       </div>
       
      </div>
    </div>
   </div>



 </div>





 <script type="text/javascript" src="{{URL::asset('js/bootstrap.js')}}"></script>
@endsection