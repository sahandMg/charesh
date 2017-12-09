    <script src="http://cdnjs.cloudflare.com/ajax/libs/vue/1.0.28/vue.js"></script>
            <script src="https://cdn.jsdelivr.net/vue.resource/1.2.1/vue-resource.min.js"></script>
           <script src="https://cdn.jsdelivr.net/lodash/4.17.4/lodash.js"></script>
            <script src="https://unpkg.com/axios/dist/axios.min.js"></script>


<ul class="nav nav-tabs" id="app">
    <li class="nav-item">
        <a  href="{{route('challengePanel',['id'=>$tournament->id,'url'=>$tournament->code])}}" :class="RegClass">ویرایش اطلاعات مسابقه</a>
    </li>
    {{--<li class="nav-item">--}}
    {{--<a  @click="activeRule"  :class="RuleClass" href="challenge-rules-{{$tournament->matchName}}-{{$tournament->id}}">قوانین</a>--}}
    {{--</li>--}}
    <li class="nav-item">
        <a  href="{{route('challengeBracket',['id'=>$tournament->id,'url'=>$tournament->code])}}" :class="BracketClass" >براکت مسابقه</a>
    </li>
    <li class="nav-item">
        <a  href="{{route('challengeTime',['id'=>$tournament->id , 'url'=>$tournament->code])}}" :class="TimelineClass" >تعیین زمان بندی </a>
    </li>

    <li class="nav-item">
        <a   href="{{route('challengeMessage',['id'=>$tournament->id , 'url'=> $tournament->code])}}" :class="attendersClass" >اطلاعیه دادن </a>
    </li>

    <li class="nav-item">
        <a  href="{{route('participants',['id'=>$tournament->id,'url'=>$tournament->code])}}"  :class="participantsClass">شرکت کنندگان</a>
    </li>

</ul>


    <script type="text/javascript">
        var i = 3 ;
        var maxTeamMember = 10 ;
        var minTeamMember = 2 ;

        function addInput() {
            if(i < maxTeamMember)
            {
                i++;
                $( '<div id="in'+ i +'" class="form-group row"><label for="Name-input" class="col-1 col-form-label"> '+ i +' </label><div class="col-5"><input name="column'+ i +'" class="form-control" type="text" value="" id="example-text-input"></div></div>' ).insertBefore( "#submitButton" );
            } else {
                alert('حداکثر تعدا اعضای تیم' + maxTeamMember +' نفر می باشد.');
            }

        }

        function removeInput() {
            if (minTeamMember < i) {
                $('#in' + i).remove();
                i--;
            } else {
                alert('حداقل تعدا اعضای تیم' + minTeamMember +' نفر می باشد.');
            }

        }

    </script>


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
            participantsClass:'nav-link'

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

                case 'info':

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

                case 'message':
                    vm.attendersClass = 'nav-link'+' '+'active'
                    break
                case 'announce':
                    vm.announceClass = 'nav-link'+' '+'active'
                    break
                case 'participants':

                    vm.participantsClass = 'nav-link'+' '+'active'
                    break

            }

            {{--console.log({!! json_encode($route) !!})--}}
            //            })





        },
        methods:{



        }
    })


</script>


