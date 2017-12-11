@extends($auth == 1 ? 'masterUserHeader.body' : 'masterHeader.body')
@section('content')
<div class="container" style="width: 100%;padding: 0px;" id="app">


<div class="container" style="direction: rtl;padding-top: 30px;">

    @include('masterMatch.body',['tournament'=> $tournament,'route'=>$route])

</div>
  <br>
  <br>
 <div class="container" >
   <!-- League Table -->

     <table class="table table-striped">
         <p hidden>{{$s=0}}</p>
         <thead>
         <tr>
             <th> {{$bracketDetail->row}}</th>
             <th>{{$bracketDetail->teamName}}</th>
             <th>{{$bracketDetail->point}}</th>
             @if($bracketDetail->column4)
                 <th>{{$bracketDetail->column4}}</th>
                 <p hidden>{{$s=1}}</p>
             @endif
             @if($bracketDetail->column5)
                 <th>{{$bracketDetail->column5}}</th>
                 <p hidden>{{$s=2}}</p>
             @endif
             @if($bracketDetail->column6)
                 <th>{{$bracketDetail->column6}}</th>
                 <p hidden>{{$s=3}}</p>
             @endif
             @if($bracketDetail->column7)
                 <th>{{$bracketDetail->column7}}</th>
                 <p hidden>{{$s=4}}</p>
             @endif
             @if($bracketDetail->column8)
                 <th>{{$bracketDetail->column8}}</th>
                 <p hidden>{{$s=5}}</p>
             @endif
             @if($bracketDetail->column9)
                 <th>{{$bracketDetail->column9}}</th>
                 <p hidden>{{$s=6}}</p>
             @endif
             @if($bracketDetail->column10)
                 <th>{{$bracketDetail->column10}}</th>
                 <p hidden>{{$s=7}}</p>
             @endif
             @if($bracketDetail->column11)
                 <th>{{$bracketDetail->column11}}</th>
                 <p hidden>{{$s=8}}</p>
             @endif
             @if($bracketDetail->column12)
                 <th>{{$bracketDetail->column12}}</th>
                 <p hidden>{{$s=9}}</p>
             @endif
         </tr>
         </thead>
         <tbody class="sortable" id="sortable">

         @for($t=1 ;$t<= count($teams); $t++)


             <tr id="team{{$t}}T">
                 <th scope="row">{{$t}}</th>
                 {{--<td><img class="rounded" height="30" src="../../public/storage/images/{{$teams[$t-1]->path}}" alt=""> {{$teams[$t-1]->teamName}}</td>--}}
                 @if(unserialize($bracketDetail->LTable) != null)

                     @if($tournament->matchType == 'انفرادی')

                         <td> <img class="rounded" height="30" src="{{URL::asset('storage/images/'.App\User::where('username',unserialize($bracketDetail->LTable)[0][0][$t-1][0])->first()->path)}}" alt=""> {{unserialize($bracketDetail->LTable)[0][0][$t-1][0]}}</td>

                         {{--<img class="rounded" height="30" src="../../public/storage/images/{{App\Match::where('team_id',App\Team::where('teamName',unserialize($bracketDetail->LTable)[0][0][$i][0])->first()->id)->first()->image}}" alt=""> {{unserialize($bracketDetail->LTable)[0][0][$i][0]}}--}}
                     @else

                         <td> <img class="rounded" height="30" src="{{URL::asset('storage/images/'.App\Team::where('teamName',unserialize($bracketDetail->LTable)[0][0][$t-1][0])->first()->path)}}" alt=""> {{unserialize($bracketDetail->LTable)[0][0][$t-1][0]}}</td>

                     @endif

                 @else
                     <td>{{$teams[$t-1]->teamName}}</td>
                 @endif


                 <td>{{$table[0][0][$t-1][1]}}</td>

                 @if($s>0)
                     @for($f=0 ; $f<$s ; $f++)
                         <td  data-editable class="editable">{{$table[0][0][$t-1][$f+2]}}</td>
                     @endfor
                 @endif


             </tr>


         @endfor


         </tbody>
     </table>

     <br>
  <br>  
  <center>

      @if($bracketDetail->type == 'sg')
          <p hidden> {{$type = 1}} </p>
      @else

          <p hidden> {{$type = 2}}</p>
      @endif
      <select  @input="check" name="round" class="form-control form-control-lg" style="height: 35px;padding: 0px;padding-right: 5px;max-width: 400px;" id="selectkind">

          @for($i=1 ; $i<= (count($teams)-1)*$type ; $i++)
              <option value="Round{{$i}}"> دور {{$i}}</option>

          @endfor

      </select>
    <br>


   <!-- Round -->
   {{--<table class="table table-striped" style="max-width: 500px;">--}}

       {{--@if(unserialize($bracketDetail->LTable)[0][1][0][0] != null)--}}
       {{--<tbody id="round1">--}}


       {{--@for($i=0;$i< floor(count($teams)/2);$i++)--}}
           {{--<tr id="match{{$s}}">--}}
               {{--<th scope="row"></th>--}}
               {{--<td id="Player{{$s}}" ondrop="drop(event,this)" ondragover="allowDrop(event)"><img class="round" height="30" src="../../public/storage/images/{{\App\Team::where('teamName',unserialize($bracketDetail->LTable)[0][1][$i][0] )->first()->path}}" alt=""> {{unserialize($bracketDetail->LTable)[0][1][$i][0]}}</td>--}}
               {{--<td data-editable class="editable" id="table{{$s}}"> {{unserialize($bracketDetail->LTable)[0][1][$i][1]}}</td>--}}
               {{--<td>{{unserialize($bracketDetail->LTable)[0][1][$i][2]}}</td>--}}
               {{--<td data-editable id="table{{$s+1}}" class="editable">{{unserialize($bracketDetail->LTable)[0][1][$i][3]}}</td>--}}
               {{--<td id="Player{{$s+1}}" ondrop="drop(event,this)" ondragover="allowDrop(event)"><img class="round" height="30" src="../../public/storage/images/{{\App\Team::where('teamName',unserialize($bracketDetail->LTable)[0][1][$i][4] )->first()->path}}" alt=""> {{unserialize($bracketDetail->LTable)[0][1][$i][4]}}</td>--}}
           {{--</tr>--}}
           {{--<p hidden>{{$s+=2}}</p>--}}
       {{--@endfor--}}



       {{--</tbody>--}}

       {{--@else--}}

           {{--<tbody id="round1">--}}

           {{--@for($i=0;$i<floor(count($teams)/2);$i++)--}}
               {{--<tr id="match{{$s}}">--}}
                   {{--<th scope="row"></th>--}}

                   {{--<td id="Player{{$s}}" ondrop="drop(event,this)" ondragover="allowDrop(event)"></td>--}}
                   {{--<td id="table{{$s}}" data-editable class="editable">?</td>--}}
                   {{--<td>-</td>--}}
                   {{--<td id="table{{$s+1}}" data-editable class="editable">?</td>--}}
                   {{--<td id="Player{{$s+1}}" ondrop="drop(event,this)" ondragover="allowDrop(event)"></td>--}}
               {{--</tr>--}}
               {{--<p hidden>{{$s+=2}}</p>--}}
           {{--@endfor--}}


           {{--</tbody>--}}

       {{--@endif--}}



  {{--</table>--}}
</center>

  </div>

 </div>

 

 <script type="text/javascript" src="{{URL::asset('js/bootstrap.js')}}"></script>
 <script src="{{URL::asset('jquery-1.11.3.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/main.js')}}"></script>
 <script src="{{URL::asset('js/brackets.min.js')}}"></script>

<script>

    new Vue({

        el:'#app',

        data:{


            round:'Round1',
            table:[''],

        },

        methods:{

            check:function () {



                {{--axios.post( {!! json_encode(route('round'))!!} ,{'round':vm.round,'id': {!! json_encode($tournament->id) !!}  }).then(function (response) {--}}


                    {{--vm.table = response.data--}}

                    {{--console.log(response.data[0])--}}


                {{--})--}}



                    vm = this
                    vm.roundNum = document.getElementById('selectkind').value;
//                  console.log(vm.roundNum)
                    axios.get({!! json_encode(route('round',['id'=>$tournament->id]))!!}+vm.roundNum ).then(function (response) {

//                    console.log(response.data);
                        if(response.data != 0) {
                            $("#roundCounter").html(response.data)
                        }
                    });



            }

        }


    })


</script>





@endsection

  <!-- All participants -->
   <!-- <div class="row" style="direction: ltr;overflow: auto;">
      <div class="col-md-3 col-sm-4 col-lg-2">
        <div class="row">
          <img class="rounded" src="images/LOLBack.jpg" height="30">
          <p style="padding-left: 5px;">Tigers</p> 
        </div>
      </div>
      <div class="col-md-3 col-sm-4 col-lg-2">
        <div class="row">
          <img class="rounded" src="images/LOLBack.jpg" height="30">
          <p style="padding-left: 5px;">Tigers</p> 
        </div>
      </div>
      <div class="col-md-3 col-sm-4 col-lg-2">
        <div class="row">
          <img class="rounded" src="images/LOLBack.jpg" height="30">
          <p style="padding-left: 5px;">Tigers</p> 
        </div>
      </div>
      <div class="col-md-3 col-sm-4 col-lg-2">
        <div class="row">
          <img class="rounded" src="images/LOLBack.jpg" height="30">
          <p style="padding-left: 5px;">Tigers</p> 
        </div>
      </div>
      <div class="col-md-3 col-sm-4 col-lg-2">
        <div class="row">
          <img class="rounded" src="images/LOLBack.jpg" height="30">
          <p style="padding-left: 5px;">Tigers</p> 
        </div>
      </div>
   </div> -->
@section('round')


    <div id="roundCounter">


        <table class="table table-striped" style="max-width: 500px;direction: ltr;">
            <p hidden>{{$s=0}}</p>
            @if($roundSign == 1 )
                <tbody id="round1" >

                @for($i=0;$i< floor(count($teams)/2);$i++)

                    {{-- Check wether rows are filled --}}
                    @if(unserialize($bracketDetail->LTable)[0][1][$i][0] != null && unserialize($bracketDetail->LTable)[0][1][$i][4] != null)

                        @if($tournament->matchType == 'انفرادی')

                            <tr id="match{{$i}}">
                                <th scope="row"></th>
                                <td id="Player{{$s}}" ondrop="drop(event,this)" ondragover="allowDrop(event)">
                                    <div style="padding: 5px;" ondrop="notAllowDrop(event)" draggable="true" ondragstart="drag(event)" id="{{unserialize($bracketDetail->LTable)[0][1][$i][0]}}">

                                        <img class="rounded" height="30" src="{{URL::asset('storage/images/'.App\User::where('username',unserialize($bracketDetail->LTable)[0][1][$i][0])->first()->path)}}"> {{unserialize($bracketDetail->LTable)[0][1][$i][0]}}


                                    </div>
                                </td>
                                <td data-editable class="editable" id="table{{$s}}">  {{unserialize($bracketDetail->LTable)[0][1][$i][1]}}</td>
                                <td>{{unserialize($bracketDetail->LTable)[0][1][$i][2]}}</td>
                                <td data-editable id="table{{$s+1}}" class="editable">{{unserialize($bracketDetail->LTable)[0][1][$i][3]}}</td>
                                <td id="Player{{$s+1}}" ondrop="drop(event,this)" ondragover="allowDrop(event)">
                                    <div style="padding: 5px;" ondrop="notAllowDrop(event)" draggable="true" ondragstart="drag(event)" id="{{unserialize($bracketDetail->LTable)[0][1][$i][4]}}">
                                        <img class="rounded" height="30" src="{{URL::asset('storage/images/'.App\User::where('username',unserialize($bracketDetail->LTable)[0][1][$i][4])->first()->path)}}"> {{unserialize($bracketDetail->LTable)[0][1][$i][4]}}
                                    </div>
                                </td>
                            </tr>

                        @else



                            <tr id="match{{$i}}">
                                <th scope="row"></th>
                                <td id="Player{{$s}}" ondrop="drop(event,this)" ondragover="allowDrop(event)">
                                    <div style="padding: 5px;" ondrop="notAllowDrop(event)" draggable="true" ondragstart="drag(event)" id="{{unserialize($bracketDetail->LTable)[0][1][$i][0]}}">

                                        <img class="rounded" height="30" src="{{URL::asset('storage/images/'.App\Team::where('teamName',unserialize($bracketDetail->LTable)[0][1][$i][0])->first()->path)}}" alt=""> {{unserialize($bracketDetail->LTable)[0][1][$i][0]}}


                                    </div>
                                </td>
                                <td data-editable class="editable" id="table{{$s}}"> {{unserialize($bracketDetail->LTable)[0][1][$i][1]}}</td>
                                <td>{{unserialize($bracketDetail->LTable)[0][1][$i][2]}}</td>
                                <td data-editable id="table{{$s+1}}" class="editable">{{unserialize($bracketDetail->LTable)[0][1][$i][3]}}</td>
                                <td id="Player{{$s+1}}" ondrop="drop(event,this)" ondragover="allowDrop(event)">
                                    <div style="padding: 5px;" ondrop="notAllowDrop(event)" draggable="true" ondragstart="drag(event)" id="{{unserialize($bracketDetail->LTable)[0][1][$i][4]}}">
                                        <img class="round" draggable="false" height="30" src="{{URL::asset('storage/images/'.App\Team::where('teamName',unserialize($bracketDetail->LTable)[0][1][$i][4] )->first()->path)}}" alt=""> {{unserialize($bracketDetail->LTable)[0][1][$i][4]}}
                                    </div>
                                </td>
                            </tr>

                        @endif

                        <p hidden>{{$s+=2}}</p>

                    @else

                        <tr id="match{{$s}}">
                            <th scope="row"></th>

                            <td id="Player{{$s}}" ondrop="drop(event,this)" ondragover="allowDrop(event)"></td>
                            <td id="table{{$s}}" data-editable class="editable">?</td>
                            <td>-</td>
                            <td id="table{{$s+1}}" data-editable class="editable">?</td>
                            <td id="Player{{$s+1}}" ondrop="drop(event,this)" ondragover="allowDrop(event)"></td>
                            <p hidden>{{$s+=2}}</p>

                        </tr>

                    @endif

                @endfor



                </tbody>
            @else


                <tbody id="round1">

                @for($i=0;$i<floor(count($teams)/2);$i++)
                    <tr id="match{{$s}}">
                        <th scope="row"></th>

                        <td id="Player{{$s}}" ondrop="drop(event,this)" ondragover="allowDrop(event)"></td>
                        <td id="table{{$s}}" data-editable class="editable">?</td>
                        <td>-</td>
                        <td id="table{{$s+1}}" data-editable class="editable">?</td>
                        <td id="Player{{$s+1}}" ondrop="drop(event,this)" ondragover="allowDrop(event)"></td>
                    </tr>
                    <p hidden>{{$s+=2}}</p>
                @endfor


                </tbody>

            @endif


        </table>

    </div>




@endsection
