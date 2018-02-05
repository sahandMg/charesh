@extends('masterUserHeader.body')
@section('title')
    چارش | اعتبار  {{Auth::user()->username}}
@endsection
@section('content')

  <div class="container" style="direction: rtl;margin-top: 2%;">
    <div class="card" style="background-color: white;">
     <h2 class="card-title" style="background-color: #42CBC8;padding: 20px;color: white;">افزایش اعتبار</h2>
     <form style="padding: 20px;" method="post" action="{{route('credit',['username'=>Auth::user()->slug])}}">
         <input type="hidden" name="_token" value="{{csrf_token()}}">
         @if(count(session('message'))>0)
             <div class="alert alert-success" role="alert">
                 {{session('message')}}
              </div>
             @endif
         @if(count(session('Error')) >0)
             <div class="alert alert-danger" role="alert">
                 {{session('message')}}
             </div>
         @endif
      <div class="form-group">
        <label for="exampleInputEmail1">افزایش اعتبار (تومان) </label>
        <input type="number" min="2000" step="1000" max="1000000000"  value="2000" name="credit" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="به تومان">
      </div>
       <button type="submit" class="btn btn-primary"> افزایش </button>
      </form>
    </div>
      <br>
      <br>
      <div class="card" style="background-color: white;">
          <h2 class="card-title" style="background-color: #42CBC8;padding: 20px;color: white;">تراکنش ها</h2>
       <div style="width: 95%;margin: auto;">
          <table class="table table-striped table-bordered ">
              <thead>
              <tr>
                  <th class="text-center">نوع تراکنش</th>
                  <th class="text-center">مبلغ تراکنش (تومان) </th>
                  <th class="text-center">تاریخ</th>
              </tr>
              </thead>
              <tbody>
              @foreach($transactions as $transaction)
                  <tr>
                      <td  class="text-center">{{$transaction->type}}</td>
                      <td  class="text-center">{{$transaction->money}}</td>
                      <td  class="text-center">{{ jDate::forge($transaction->created_at)->format('%d %B، %Y')}}, <span> {{ jDate::forge($transaction->created_at)->format('time')}}</span> </td>
                  </tr>
              @endforeach
              </tbody>
          </table>
        </div>
          <br>
      </div>
  </div>

 <script type="text/javascript" src="{{URL::asset('js/bootstrap.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/main.js')}}"></script>
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
