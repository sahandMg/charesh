@extends('masterUserHeader.body')
@section('title')
    چارش | جدول لیگ  {{$tournament->matchName}}
@endsection

@section('content')
        <div class="container col-8" id="leagueBracket" style=" direction: rtl;">
            @include('masterOrganize.body',['tournament'=> $tournament,'route'=>$route])
            <br>
            <h4>با استفاده از drag و drop جایگاه تیم ها رو عوض کنید .</h4>
            <h4>با استفاده از کلیک بر روی داده های قرمز رنگ ، آن ها رو تغییر بدید .</h4>
            <br>
            <div class="row" id="Groups" style="direction: ltr;padding: 20px;">
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
                            @if(unserialize($bracketDetail->LTable) != null)
                                @if($tournament->matchType == 'انفرادی')
                                    <td> <img style="border-radius: 5px;" height="30" src="{{URL::asset('storage/images/'.App\User::where('username',unserialize($bracketDetail->LTable)[0][0][$t-1][0])->first()->path)}}" alt=""> {{unserialize($bracketDetail->LTable)[0][0][$t-1][0]}}</td>
                                @else
                                    <td> <img style="border-radius: 5px;" height="30" src="{{URL::asset('storage/images/'.App\Team::where('teamName',unserialize($bracketDetail->LTable)[0][0][$t-1][0])->first()->path)}}" alt=""> {{unserialize($bracketDetail->LTable)[0][0][$t-1][0]}}</td>
                                @endif
                            @else
                                @if($tournament->matchType == 'انفرادی')
                                    <td> <img  style="border-radius: 5px;" height="30" src="{{URL::asset('storage/images/'.$teams[$t-1]->path)}}" alt=""> {{$teams[$t-1]->username}}</td>
                                @else
                                    <td> <img  style="border-radius: 5px;" height="30" src="{{URL::asset('storage/images/'.$teams[$t-1]->path)}}" alt=""> {{$teams[$t-1]->teamName}}</td>
                                @endif
                            @endif
                            @for($l=0 ; $l <= $bracketDetail->columnNumber ; $l++)
                                @if(unserialize($bracketDetail->LTable) != null)
                                    <td  data-editable class="editable">  {{unserialize($bracketDetail->LTable)[0][0][$t-1][$l+1]}} </td>
                                @else
                                    <td  data-editable class="editable"> 0 </td>
                                @endif
                            @endfor
                        </tr>
                      @endfor
                    </tbody>
                </table>
            </div>
            <br>
            <br>
            <center>
                @if($bracketDetail->type == 'sg')
                    <p hidden> {{$type = 1}} </p>
                @else
                    <p hidden> {{$type = 2}}</p>
                @endif
                <select name="round"  @input="round"   class="form-control form-control-lg" style="height: 35px;padding: 0px;padding-right: 5px;max-width: 400px;" id="selectkind">
                  @for($i=1 ; $i<= (count($teams)-1)*$type ; $i++)
                    <option   value="Round{{$i}}"> دور {{$i}}</option>
                   @endfor
                </select>
                <br>
            </center>
        </div>
    </div>
    <script type="text/javascript" src="{{URL::asset('js/bootstrap.js')}}"></script>
    <script>
        new Vue({
            el:'#leagueBracket',
            data:{
                roundNum:''
            },
            methods:{
                round:function () {
                    vm = this
                    vm.roundNum = document.getElementById('selectkind').value;
                    axios.get({!! json_encode(route('checkRound',['id'=>$tournament->id]))!!}+'/'+vm.roundNum ).then(function (response) {
                        if(response.data != 0) {
                            $("#roundCounter").html(response.data)
                        }
                    });
                },
                confirm:function () {
                    var ans = prompt('در صورت تغییر نوع برگزاری ، تمامی اطلاعات جدول امتیازات و براکت مسابقه پاک می شود. برای ادامه، تایید را وارد کنید');
                    if(ans == 'تایید'){
                        window.location.href = {!! json_encode(route('bracketDelete',['id'=>$tournament->id,'matchName'=>$tournament->slug])) !!}
                    }
                }
            }
        });
    </script>
    <script type="text/javascript">
        var rowNumber = $('#sortable tr').length;
        var colNumberL = {!! json_encode($bracketDetail->columnNumber) !!}+2 ;
        var colNumberR =  5;
        var LTable = new Array(rowNumber) ;
        var matchPerRound = Math.floor(rowNumber/2) ;
        var RoundTable = new Array(matchPerRound) ;
        function sendData() {
            for (var j = 1; j <=rowNumber ; j++) {
                LTable[j-1] = new Array(colNumberL);
                var GroupRowId =$('#sortable tr:nth-child('+j+')').attr("id") ;
                for (var k = 2 ; k <= colNumberL+1; k++) {
                    var temp = $('#'+GroupRowId+' td:nth-child('+k+')').text() ;
                    LTable[j-1][k-2] = temp ;
                }
            }
            console.log(LTable);
            for (var j = 1; j <= matchPerRound ; j++) {
                RoundTable[j-1] = new Array(colNumberR);
                var RoundRowId =$('#round1 tr:nth-child('+j+')').attr("id") ;
                for (var k = 2 ; k <= colNumberR+1; k++) {
                    if (k == 2 || k == colNumberR+1) {
                        var temp3 = $('#'+RoundRowId+' td:nth-child('+k+') div').attr("id") ;
                        var temp2 = $('#'+temp3).text() ;
                        RoundTable[j-1][k-2] = temp3 ;
                    } else {
                        var temp2 = $('#'+RoundRowId+' td:nth-child('+k+')').text() ;
                        RoundTable[j-1][k-2] = temp2 ;
                    }
                }
            }
            axios.post({!! json_encode(route('LeagueTable',['id'=>$tournament->id])) !!} ,{'ltable':[LTable,RoundTable,document.getElementById('selectkind').value]}).then(function (response) {
                if(response.data == 1){
                    alert('اطلاعات ذخیره شد')
                }
            })
        }
        function sortTable() {
            for (var i = rowNumber ; i > 0; i--) {
                var temp = $('#sortable tr:nth-child('+i+')').attr("id") ;
                $('#'+temp+' th:nth-child(1)').text(i);
            }
        }
        $( "#sortable" ).sortable( {
            update: function( event, ui ) {
                sortTable();
            }
        });
        function allowDrop(ev) {
            ev.preventDefault();
        }
        function drag(ev) {
            ev.dataTransfer.setData("text", ev.target.id);
        }
        function drop(ev,el) {
            ev.preventDefault();
            var data = ev.dataTransfer.getData("text");
            el.appendChild(document.getElementById(data));
        }
        $('body').on('click', '[data-editable]', function(){
            var $el = $(this);
            var $input = $('<input style="width:40px;" />').val( $el.text() );
            $el.replaceWith( $input );
            var save = function(){
                var $p = $('<td data-editable  class="editable" />').text( $input.val() );
                $input.replaceWith( $p );
            };
            $input.one('blur', save).focus();
        });
    </script>
@endsection
@section('round')
    <div id="roundCounter">
        <h4 style="text-align: center">شرکت کنندگان</h4>
        <div class="row" id="allTeams"  ondrop="drop(event,this)" ondragover="allowDrop(event)" style="padding: 20px;direction: ltr;max-width: 800px;border-style: solid;margin:auto;">
            @if($roundSign == 0)
                @for($i=0 ; $i < count($teams) ; $i++)
                    @if($tournament->matchType == 'انفرادی')
                        @if(array_search($teams[$i]->username,$teamArr) === false)
                            <div style=" padding: 5px;float: left;" ondrop="notAllowDrop(event)" draggable="true" ondragstart="drag(event)" id="{!! $teams[$i]->username !!}">
                                <img style="border-radius: 5px;" draggable="false" src="{{URL::asset('storage/images/'.$teams[$i]->path)}}" height="30" > {{$teams[$i]->username}}
                            </div>
                        @endif
                    @else
                        @if(array_search($teams[$i]->teamName,$teamArr) === false)
                            <div style=" padding: 5px;float: left;" ondrop="notAllowDrop(event)" draggable="true" ondragstart="drag(event)" id="{!! $teams[$i]->teamName !!}">
                                <img style="border-radius: 5px;" draggable="false" src="{{URL::asset('storage/images/'.$teams[$i]->path)}}" height="30" > {{$teams[$i]->teamName}}
                            </div>
                        @endif
                    @endif
                @endfor
            @else
                @for($i=0 ; $i < count($teams) ; $i++)
                    @if($tournament->matchType == 'انفرادی')
                        @if(array_search($teams[$i]->username,$teamArr) === false)
                            <div style="padding: 5px;float: left;" ondrop="notAllowDrop(event)" draggable="true" ondragstart="drag(event)" id="{!! $teams[$i]->username !!}">
                                <img  style="border-radius: 4px;" draggable="false" src="{{URL::asset('storage/images/'.$teams[$i]->path)}}" height="30" > {{$teams[$i]->username}}
                            </div>
                        @endif
                    @else
                        @if(array_search($teams[$i]->teamName,$teamArr) === false)
                            <div style="padding: 5px;float: left;" ondrop="notAllowDrop(event)" draggable="true" ondragstart="drag(event)" id="{!! $teams[$i]->teamName !!}">
                                <img   style="border-radius: 4px;" draggable="false" src="{{URL::asset('storage/images/'.$teams[$i]->path)}}" height="30" > {{$teams[$i]->teamName}}
                            </div>
                        @endif
                    @endif
                @endfor
            @endif
        </div>
        <br>
        <table class="table table-striped" style="max-width: 500px;direction: ltr; margin: auto">
            <p hidden>{{$s=0}}</p>
            @if($roundSign == 1 )
                <tbody id="round1" >
                @for($i=0;$i< floor(count($teams)/2);$i++)
                    @if(unserialize($bracketDetail->LTable)[0][1][$i][0] != null && unserialize($bracketDetail->LTable)[0][1][$i][4] != null)
                        <tr id="match{{$i}}">
                            <th scope="row"></th>
                            <td id="Player{{$s}}" ondrop="drop(event,this)" ondragover="allowDrop(event)">
                                <div style="padding: 5px;" ondrop="notAllowDrop(event)" draggable="true" ondragstart="drag(event)" id="{{unserialize($bracketDetail->LTable)[0][1][$i][0]}}">
                                    @if($tournament->matchType == 'انفرادی')
                                         <img class="rounded" height="30" src="{{URL::asset('storage/images/'.App\User::where('userName',unserialize($bracketDetail->LTable)[0][1][$i][0])->first()->path)}}" alt=""> {{unserialize($bracketDetail->LTable)[0][1][$i][0]}}
                                    @else
                                         <img class="rounded" height="30" src="{{URL::asset('storage/images/'.App\Team::where('teamName',unserialize($bracketDetail->LTable)[0][1][$i][0])->first()->path)}}" alt=""> {{unserialize($bracketDetail->LTable)[0][1][$i][0]}}
                                     @endif
                                </div>
                            </td>
                            <td data-editable class="editable" id="table{{$s}}"> {{unserialize($bracketDetail->LTable)[0][1][$i][1]}}</td>
                            <td>{{unserialize($bracketDetail->LTable)[0][1][$i][2]}}</td>
                            <td data-editable id="table{{$s+1}}" class="editable">{{unserialize($bracketDetail->LTable)[0][1][$i][3]}}</td>
                            <td id="Player{{$s+1}}" ondrop="drop(event,this)" ondragover="allowDrop(event)">
                                <div style="padding: 5px;" ondrop="notAllowDrop(event)" draggable="true" ondragstart="drag(event)" id="{{unserialize($bracketDetail->LTable)[0][1][$i][4]}}">
                                    @if($tournament->matchType == 'انفرادی')
                                        <img class="rounded" height="30" src="{{URL::asset('storage/images/'.App\User::where('userName',unserialize($bracketDetail->LTable)[0][1][$i][4])->first()->path)}}" alt=""> {{unserialize($bracketDetail->LTable)[0][1][$i][4]}}
                                    @else
                                        <img class="rounded" height="30" src="{{URL::asset('storage/images/'.App\Team::where('teamName',unserialize($bracketDetail->LTable)[0][1][$i][4])->first()->path)}}" alt=""> {{unserialize($bracketDetail->LTable)[0][1][$i][4]}}
                                    @endif
                                </div>
                            </td>
                        </tr>
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
        <br>
        <br>
        <div style="text-align: center;">
          <button onclick="sendData()" type="submit" class="btn btn-primary">ذخیره</button>
          <br>
          <button @click="confirm" type="button" class="btn btn-warning" style="margin-top: 1%;">تغییر نوع برگزاری براکت</button>
        </div>
    </div>
    <style type="text/css">
        .editable {
            color: red;
        }
    </style>
@endsection