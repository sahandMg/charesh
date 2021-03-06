@extends($auth == 1 ? 'masterUserHeader.body' : 'masterHeader.body')

@section('matchName')
مسابقه {{$tournament->matchName}}
@endsection

@section('title')
    چارش | مسابقه  {{$tournament->matchName}}
@endsection




@section('content')
 

<div class="container" style="direction: rtl;padding-top: 30px;">
    @include('masterMatch.body',['tournament'=> $tournament,'route'=>$route])

  
  </div>

 <div class="container" >



     <br>

     <nav class="nav nav-tabs" style="padding: 30px;">
         <li><a class="active" href="{{route('matchGroupBracket',['id'=>$tournament->id,'matchName'=>$tournament->slug])}}">گروهی</a></li>
         <li><a href="{{route('MatchGElBracket',['id'=>$tournament->id,'matchName'=>$tournament->slug])}}">حذفی</a></li>
     </nav>
     <br>


     <!-- َََAll Group -->
   <div class="row">
    <!-- Group A -->
       @for($i=1;$i<= $bracketDetail->groupNumber; $i++)

           <div class="col-sm-6 col-md-3 col-lg-3">
               <table class="table table-striped" >
                   <p hidden>{{$s=0}}</p>
                   <thead>
                   <tr>
                       <th></th>
                       <th>گروه {{$i}}</th>
                       <th>امتیاز</th>
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
                   <tbody>

                   @for($t=1 ;$t<= $bracketDetail->groupTeam; $t++)

                           <tr >
                               <th scope="row">{{$t}}</th>
                               @if(unserialize($bracketDetail->GroupBracketTableEdit) != null)

                                   @if($tournament->matchType == 'انفرادی')
                                       <td>   <img class="round" height="30" src="{{URL::asset('storage/images/'.App\User::where('username',unserialize($bracketDetail->GroupBracketTableEdit)[$i-1][$t-1][0])->first()->path)}}" alt=""> {{unserialize($bracketDetail->GroupBracketTableEdit)[$i-1][$t-1][0]}}</td>
                                   @else
                                       <td> <img class="round" height="30" src="{{URL::asset('storage/images/'.App\Team::where('teamName',unserialize($bracketDetail->GroupBracketTableEdit)[$i-1][$t-1][0])->first()->path)}}" alt=""> {{unserialize($bracketDetail->GroupBracketTableEdit)[$i-1][$t-1][0]}}</td>
                                   @endif
                                   {{--<td><img class="round" height="30" src="../../public/storage/images/{{\App\Match::where('team_id',App\Team::where('teamName',$teamName[$i-1][$t-1])->first()->id)->first()->image}}" alt=""> {{$teamName[$i-1][$t-1]}}</td>--}}
                                   <td  data-editable class="editable">{{unserialize($bracketDetail->GroupBracketTableEdit)[$i-1][$t-1][1]}}</td>

                                       @if($s>0)
                                           @for($f=1 ; $f<=$s ; $f++)
                                               <td>{{$tableData[$i-1][$t-1][$f+1]}}</td>
                                           @endfor
                                       @endif
                               @endif


                               @if(unserialize($bracketDetail->GroupBracketTableEdit) == null&& unserialize($bracketDetail->bracketTable) != null)

                                   @if($tournament->matchType == 'انفرادی')
                                       <td>   <img class="round" height="30" src="{{URL::asset('storage/images/'.App\User::where('username',unserialize($bracketDetail->bracketTable)[$i-1][$t-1])->first()->path)}}" alt=""> {{unserialize($bracketDetail->bracketTable)[$i-1][$t-1]}}</td>
                                   @else
                                       <td> <img class="round" height="30" src="{{URL::asset('storage/images/'.App\Team::where('teamName',unserialize($bracketDetail->bracketTable)[$i-1][$t-1])->first()->path)}}" alt=""> {{unserialize($bracketDetail->bracketTable)[$i-1][$t-1]}}</td>
                                   @endif

                                   <td  data-editable class="editable">0</td>

                                       @if($s>0)
                                           @for($f=1 ; $f<=$s ; $f++)
                                               <td>0</td>
                                           @endfor
                                       @endif

                               @endif


                           </tr>

                   @endfor

                   </tbody>
               </table>
           </div>

       @endfor


           </div>

  </div>






 

 <script type="text/javascript" src="{{URL::asset('js/bootstrap.js')}}"></script>
 {{--<script src="js/jquery-1.11.3.js"></script>--}}
 <script src="{{URL::asset('js/brackets.min.js')}}"></script>


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

