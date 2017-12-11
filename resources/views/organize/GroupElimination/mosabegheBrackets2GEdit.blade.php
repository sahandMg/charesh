@extends('masterUserHeader.body')
@section('content')

    <div class="row" style=" direction: rtl;">
        <!— right menu —>
        <div class="col-2">
            <ul class="Vnav">
                <li class="active"><a href="{{route('orgMatches')}}">پنل مدیریت</a></li>
                <li><a href="{{route('matchCreate')}}">مسابقه جدید</a></li>
                <li><a href="{{route('orgEdit')}}">ویرایش اطلاعات من</a></li>
                <li><a href="{{route('organizeAccount')}}">حساب من</a></li>
            </ul>
        </div>
        <!— content —>
        <div class="container col-8" id="app">
            <br>
            @include('masterOrganize.body',['tournament'=> $tournament,'route'=>$route])

            <br>
            <a href="{{route('bracketDelete',['id'=>$tournament->id,'url'=>$tournament->code])}}"><button type="button" class="btn btn-warning" style="margin-right: 40px;margin-top: 40px;margin-bottom: 5px;">تغییر نوع برگزاری براکت</button></a>
            <p style="width: 200px;margin-right: 50px;">در صورت تغییر نوع برگزاری براکت ، تمام اطلاعات براکت قبلی شما پاک می شود ، باید از ابتدا به دسته بندی مسابقه دهندگان بپردازید.</p>

            <br>

            <nav class="nav nav-pills nav-fill" style="padding: 30px;">
                <a class="nav-item nav-link active" href="#">گروهی</a>
                <a class="nav-item nav-link" href="{{route('ElBracket',['id'=>$tournament->id,'url'=>$tournament->code])}}">حذفی</a>
            </nav>
            <br>

            <br>

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
                            <tbody class="sortable" id="Group{{$i}}">

                            @for($t=1 ;$t<= $bracketDetail->groupTeam; $t++)

                                <tr id="G{{$i}}{{$t}}">
                                    <th scope="row">{{$t}}</th>


                                    {{--<td><img class="round" height="30" src="../../public/storage/images/{{\App\Match::where('team_id',App\Team::where('teamName',$teamName[$i-1][$t-1])->first()->id)->first()->image}}" alt=""> {{unserialize($bracketDetail->bracketTable)[$i-1][$t-1]}}</td>--}}



                                    @if(unserialize($bracketDetail->GroupBracketTableEdit) != null)

                                            @if($tournament->matchType == 'انفرادی')
                                                <td>   <img class="round" height="30" src="{{URL::asset('storage/images/'.App\User::where('username',unserialize($bracketDetail->GroupBracketTableEdit)[$i-1][$t-1][0])->first()->path)}}" alt=""> {{unserialize($bracketDetail->GroupBracketTableEdit)[$i-1][$t-1][0]}}</td>
                                            @else
                                                <td> <img class="round" height="30" src="{{URL::asset('storage/images/'.App\Team::where('teamName',unserialize($bracketDetail->GroupBracketTableEdit)[$i-1][$t-1][0])->first()->path)}}" alt=""> {{unserialize($bracketDetail->GroupBracketTableEdit)[$i-1][$t-1][0]}}</td>
                                            @endif
                                        {{--<td><img class="round" height="30" src="../../public/storage/images/{{\App\Match::where('team_id',App\Team::where('teamName',$teamName[$i-1][$t-1])->first()->id)->first()->image}}" alt=""> {{$teamName[$i-1][$t-1]}}</td>--}}
                                        <td  data-editable class="editable">{{unserialize($bracketDetail->GroupBracketTableEdit)[$i-1][$t-1][1]}}</td>
                                    @endif


                                   @if(unserialize($bracketDetail->GroupBracketTableEdit) == null)

                                        @if($tournament->matchType == 'انفرادی')
                                            <td>   <img class="round" height="30" src="{{URL::asset('storage/images/'.App\User::where('username',unserialize($bracketDetail->bracketTable)[$i-1][$t-1])->first()->path)}}" alt=""> {{unserialize($bracketDetail->bracketTable)[$i-1][$t-1]}}</td>
                                        @else
                                            <td> <img class="round" height="30" src="{{URL::asset('storage/images/'.App\Team::where('teamName',unserialize($bracketDetail->bracketTable)[$i-1][$t-1])->first()->path)}}" alt=""> {{unserialize($bracketDetail->bracketTable)[$i-1][$t-1]}}</td>
                                        @endif

                                            <td  data-editable class="editable">0</td>
                                   @endif
                                        @if($s>0)


                                            @for($f=0 ; $f<$s ; $f++)
                                                @if(unserialize($bracketDetail->GroupBracketTableEdit) != null)
                                                    <td  data-editable class="editable">{{unserialize($bracketDetail->GroupBracketTableEdit)[$i-1][$t-1][$f+2]}}</td>
                                                @else
                                                    <td  data-editable class="editable">0</td>
                                                @endif
                                            @endfor
                                    @endif






                                </tr>


                            @endfor


                            </tbody>
                        </table>
                    </div>

                @endfor
                <br>
            </div>
            <center><button @click="save" type="submit" class="btn btn-primary">ذخیره</button></center>
            <br>
            <br>
            <h4 v-if="success">اطلاعات جدول ذخیره شد</h4>
            <h4 v-if="fail">خطا در برقراری ارتباط با سرور</h4>
        </div>

    </div>

    <style>
        .rounded {
            padding-right: 5px;
        }


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

        .editable {
            color: red;
        }
    </style>
    <script>
        new Vue({
            el:'#app',
            data:{
                teamNames:'',
                success :false,
                fail:false

            },
            methods:{

                save:function () {




                    vm = this
                   var GNumber = {!! json_encode($bracketDetail->groupNumber) !!} ;
                    var colNumber =  {!! json_encode($bracketDetail->columnNumber) !!}-1 ;
                    var GTable = new Array(GNumber) ;


                        for (var i=1; i <= GNumber; i++) {
                            GTable[i-1] = new Array(rowNumber);
                            var GroupId = 'Group' + i ;
                            for (var j = 1; j <=rowNumber ; j++) {
                                GTable[i-1][j-1] = new Array(colNumber);
                                var GroupRowId =$('#'+GroupId+' tr:nth-child('+j+')').attr("id") ;
                                for (var k = 2 ; k <= colNumber+1; k++) {
                                    var temp = $('#'+GroupRowId+' td:nth-child('+k+')').text() ;
                                    GTable[i-1][j-1][k-2] = temp ;
                                    // console.log(temp);
                                }
                            }
                        }
                        axios.post('{{route('makeGroupBracket3',['id'=>$tournament->id,'url'=>$tournament->code])}}',{'GTable':GTable}).then(function (response) {


                            if(response.data == 1 && response.status == 200){

                                alert('اطلاعات جدول ذخیره شد')

                            }else{

                                vm.fail = true

                            }
                        })



                }


            }
        })
    </script>
    <!-- <script type="text/javascript" src="js/jquery-3.2.1.js"></script> -->
    <script type="text/javascript" src="{{URL::asset('js/main.js')}}"></script>
    <script type="text/javascript">
        var rowNumber = $('#Group1 tr').length;

//        alert(rowNumber)

        function testFunc() {
            for (var i = rowNumber ; i > 0; i--) {
                var temp = $('.sortable tr:nth-child('+i+')').attr("id") ;
                $('#'+temp+' th:nth-child(1)').text(i);
            }

        }
        // $( "#sortable" ).sortable();
        $( ".sortable" ).sortable( {
            update: function( event, ui ) {
                testFunc();
            }
        });


        function allowDrop(ev) {
            ev.preventDefault();
        }

        function drag(ev) {
            ev.dataTransfer.setData("text", ev.target.id);
            ev.dataTransfer.setData("parentId", ev.target.parent.id);
        }

        function drop(ev,el) {
            ev.preventDefault();
            var data = ev.dataTransfer.getData("text");
            el.appendChild(document.getElementById(data));
        }

        /**
         We're defining the event on the `body` element,
         because we know the `body` is not going away.
         Second argument makes sure the callback only fires when
         the `click` event happens only on elements marked as `data-editable`
         */
        $('body').on('click', '[data-editable]', function(){

            var $el = $(this);

            var $input = $('<input style="width:40px;margin-top:7px;" />').val( $el.text() );
            $el.replaceWith( $input );

            var save = function(){
                var $p = $('<td data-editable class="editable" />').text( $input.val() );
                $input.replaceWith( $p );
            };

            /**
             We're defining the callback with `one`, because we know that
             the element will be gone just after that, and we don't want
             any callbacks leftovers take memory.
             Next time `p` turns into `input` this single callback
             will be applied again.
             */
            $input.one('blur', save).focus();

        });
    </script>

@endsection

<!-- <div class="col-sm-6 col-md-3 col-lg-3"><table class="table table-striped"><thead><tr><th></th><th>Group A</th><th>Point</th></tr></thead><tbody><tr><th scope="row">1</th><td id="G11" ondrop="drop(event)" ondragover="allowDrop(event)"></td><td>0</td></tr><tr><th scope="row">2</th><td id="G12" ondrop="drop(event)" ondragover="allowDrop(event)"></td><td>0</td></tr><tr><th scope="row">3</th><td id="G13" ondrop="drop(event)" ondragover="allowDrop(event)"></td><td>0</td></tr><tr><th scope="row">4</th><td id="G14" ondrop="drop(event)" ondragover="allowDrop(event)"></td><td>0</td></tr></tbody></table></div> -->