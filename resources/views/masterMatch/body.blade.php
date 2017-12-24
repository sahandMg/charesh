

<ul class="nav nav-tabs" id="app">
    <li class="nav-item">




            <a  href="{{route('matchRegistered',['id'=>$tournament->id,'matchName'=>$tournament->matchName])}}" :class="RegClass">ثبت نام</a>


    </li>
    {{--<li class="nav-item">--}}
        {{--<a  @click="activeRule"  :class="RuleClass" href="challenge-rules-{{$tournament->matchName}}-{{$tournament->id}}">قوانین</a>--}}
    {{--</li>--}}
    <li class="nav-item">
        <a   href="{{route('matchBracket',['id'=>$tournament->id,'matchName'=>$tournament->matchName])}}" :class="BracketClass" >براکت مسابقه</a>
    </li>
    <li class="nav-item">
        <a  href="{{route('matchTimeline',['id'=>$tournament->id,'matchName'=>$tournament->matchName])}}" :class="TimelineClass" >زمان بندی</a>
    </li>
    <li class="nav-item">
        <a   href="{{route('matchAttenders',['id'=>$tournament->id,'matchName'=>$tournament->matchName])}}" :class="attendersClass"> شرکت کنندگان </a>
    </li>

</ul>



<script>

    vm = new Vue({

        el:'#app',
        data:{
            list:[''],
            time:'',
            id:'',
            team : false,
            link:'',
            RegClass:'nav-link',
            RuleClass:'nav-link',
            BracketClass:'nav-link',
            TimelineClass:'nav-link',
            attendersClass:'nav-link',
            announceClass:'nav-link',
            error : false

        },

        created:function () {


//            axios.get('/get-tournament').then(function (response) {
//
//
//                vm.list = response.data

//                console.log(vm.list)
//            })

//            axios.get('/get-routeName').then(function (response) {


//                vm.route = response.data

            vm = this
            switch ({!! json_encode($route) !!}){

                case 'detail':

                    vm.RegClass = 'nav-link'+' '+'active'
                    break;

                case 'register':

                    vm.RegClass = 'nav-link'+' '+'active'
                    break

                case 'rules':
                    vm.RuleClass = 'nav-link'+' '+'active'
                    break

                case 'bracket':
                    vm.BracketClass = 'nav-link'+' '+'active'
                    break



                case 'timeline':
                    vm.TimelineClass = 'nav-link'+' '+'active'
                    break

                case 'attenders':
                    vm.attendersClass = 'nav-link'+' '+'active'
                    break
                case 'announce':
                    vm.announceClass = 'nav-link'+' '+'active'
                    break

            }

            {{--console.log({!! json_encode($route) !!})--}}
            //            })





        },
        methods:{

            {{--bracketTime:function () {--}}
                {{----}}
                {{----}}
                {{--if( {!! $tournament->endTime !!} != 0){--}}
                    {{----}}
                    {{--this.error = true--}}
                    {{--this.BracketClass = '#'--}}
                    {{----}}
                {{--}--}}
            {{--}--}}

//            createLink:function (id,matchName,tag) {
//
//                this.link = 'match'+'-'+tag+'-'+id+'-'+matchName
//
//
//            }


//            activeReg:function () {
//
//                this.RegClass = 'nav-link'+' '+'active'
//
//            },
//            activeRule:function () {
//
//                this.RuleClass = 'nav-link'+' '+'active'
//
//            }


        }
    })


</script>

