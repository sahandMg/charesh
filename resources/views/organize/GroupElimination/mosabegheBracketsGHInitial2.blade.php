@extends('masterUserHeader.body')
@section('title')
    چارش | جدول گروهی-حذفی  {{$tournament->matchName}}
@endsection

@section('content')
    @include('masterOrganize.body',['tournament'=> $tournament,'route'=>$route])
        <!-- content -->
        <div class="container" style=" direction: rtl;" id="app">
            <br>

            <nav class="nav nav-tabs" id="secondNav">
                <li><a  href="{{route('ElBracket',['id'=>$tournament->id,'matchName'=>$tournament->slug])}} " >حذفی</a></li>
                <li class="active"><a href="{{route('makeGroupBracket',['id'=>$tournament->id,'matchName'=>$tournament->slug])}}" >گروهی</a></li>
            </nav>
            <br>
            <h4 style="direction: rtl;">با استفاده از drag & drop ، تیم ها را گروه بندی کنید. </h4>
            <br>

            <div class="row" id="allTeams"  ondrop="drop(event,this)" ondragover="allowDrop(event)" style="padding: 30px;direction: ltr;border-style: solid;">

                @foreach($teams as $team)

                    @if($tournament->matchType == 'انفرادی')

                     <div class="teamiaFardi"  ondrop="notAllowDrop(event)" draggable="true" ondragstart="drag(event)" id="{{$team->username}}">
                       <img class="rounded" draggable="false" src="{{URL::asset('storage/images/'.$team->path)}}"> {{$team->username}}
                     </div>

                    @else

                        <div class="teamiaFardi" ondrop="notAllowDrop(event)" draggable="true" ondragstart="drag(event)" id="{{$team->teamName}}">
                            <img class="rounded" draggable="false" src="{{URL::asset('storage/images/'.$team->path)}}"> {{$team->teamName}}
                        </div>
                    @endif

            @endforeach

            </div>

            <!-- َََAll Group -->
            <div class="row" id="Groups" style="direction: ltr;padding: 20px;">
                <!-- Group A -->


                @for($i=1;$i<= $bracketDetail->groupNumber; $i++)

                <div class="col-sm-6 col-md-3 col-lg-3">
                    <table class="table table-striped">
                        <p hidden>{{$s=0}}</p>
                        <thead>
                        <tr>
                            <th> {{$i}}گروه</th>
                            <th>{{$bracketDetail->teamName}}</th>
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
                                @if(unserialize($bracketDetail->bracketTable )== null)

                                    <tr>
                                        <th scope="row">{{$t}}</th>
                                        <td id="G{{$i}}{{$t}}" ondrop="drop(event,this)" ondragover="allowDrop(event)"></td>
                                        <td>0</td>

                                        @if($s>0)
                                            @for($f=0 ; $f<$s ; $f++)
                                                <td>0</td>
                                             @endfor
                                        @endif




                                    </tr>
                                @else
                                    <tr>
                                        <th scope="row">{{$t}}</th>
                                        <td  id="G{{$i}}{{$t}}" ondrop="drop(event,this)" ondragover="allowDrop(event)">
                                            @if($tournament->matchType == 'انفرادی')
                                                <img class="round" height="30" src="{{URL::asset('storage/images/'.App\User::where('username',unserialize($bracketDetail->bracketTable)[$i-1][$t-1])->first()->path)}}" alt=""> {{unserialize($bracketDetail->bracketTable)[$i-1][$t-1]}}
                                            @else
                                                <img class="round" height="30" src="{{URL::asset('storage/images/'.App\Team::where('teamName',unserialize($bracketDetail->bracketTable)[$i-1][$t-1])->first()->path)}}" alt=""> {{unserialize($bracketDetail->bracketTable)[$i-1][$t-1]}}
                                            @endif
                                        </td>

                                        <td>0</td>

                                        @if($s>0)
                                            @for($f=0 ; $f<$s ; $f++)
                                                <td>0</td>
                                            @endfor
                                        @endif




                                    </tr>

                                @endif


                            @endfor



                        </tbody>
                    </table>
                </div>

                @endfor

                <br>
                <br>

            </div>

          <div style="text-align: center;">
            <button v-show="!success" @click="save" type="submit" class="btn btn-primary">ذخیره</button>
             <a v-if="success" href="{{route('makeGroupBracket3',['id'=>$tournament->id,'matchName'=>$tournament->slug])}}"><button  type="button" class="btn btn-success">ادامه </button></a>
          </div>
            <div style="text-align: center;">
                <button @click="confirm" type="button" class="btn btn-warning" style="margin-right: 40px;margin-top: 40px;margin-bottom: 5px;">تغییر نوع برگزاری براکت</button>

            </div>
        </div>





    <script>


        new Vue({
            el:'#app',
            data:{
                teamNames:'',
                success :false,


            },
            methods:{

                save:function () {


                    var GNumber = {!! json_encode($bracketDetail->groupNumber) !!} ;
                    var GTeamNumber = {!! json_encode($bracketDetail->groupTeam) !!} ;

                        var  GTable = new Array(GNumber);
                        var i;
                        var j;
                        for (i = 1; i <= GNumber; i++) {
                            GTable[i-1] = new Array(GTeamNumber);
                            for (j = 1; j <= GTeamNumber; j++) {
                                var temp = $('#G'+ i  + j + ' div').attr('id');
                                GTable[i-1][j-1] = temp ;
                            }
                        }

                        vm = this
//                    console.log(GTable);
                    axios.post({!! json_encode(route('makeGroupBracket',['id'=>$tournament->id,'matchName'=>$tournament->matchName]))!!},{'GTable':GTable }).then(function (response) {


                       if(response.data == 1){

                           vm.success = true
                           alert('تغییرات اعمال شد')

                       }

                    })

                },
                confirm:function () {

                    var ans = prompt('در صورت تغییر نوع برگزاری ، تمامی اطلاعات جدول امتیازات و براکت مسابقه پاک می شود. برای ادامه، تایید را وارد کنید');
                    if(ans == 'تایید'){

                        window.location.href = {!! json_encode(route('bracketDelete',['id'=>$tournament->id,'matchName'=>$tournament->slug])) !!}
                    }

                },



            }
        })
    </script>
    <style>
        #secondNav {
            width: 50%;
        }
        #secondNav li {
            width: 50%;
        }
        .teamiaFardi {
            padding: 5px;
            float: left;
        }
        .teamiaFardi img {
            height: 30px;
            width: 30px;
        }
        @media screen and (max-width: 600px) {
            .teamiaFardi {
                padding: 3px;
                font-size: 75%;
            }
            .teamiaFardi img {
                height: 20px;
                width: 20px;
            }
        }
    </style>


    <style type="text/css">
        *[draggable=true] {
            -moz-user-select: none;
            -khtml-user-drag: element;
            cursor: move;
        }

    </style>

    <!-- <script type="text/javascript" src="js/jquery-3.2.1.js"></script> -->
    <script type="text/javascript" src="{{URL::asset('js/main.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/bootstrap.js')}}"></script>


    <script type="text/javascript">


        function allowDrop(ev) {
            ev.preventDefault();
        }

        function drag(ev) {

            ev.dataTransfer.setData("text", ev.target.id);
//            ev.dataTransfer.setData("parentId", ev.target.parent.id);
        }

        function drop(ev,el) {

            ev.preventDefault();
            var data = ev.dataTransfer.getData("text");
            el.appendChild(document.getElementById(data));
        }

    </script>

@endsection