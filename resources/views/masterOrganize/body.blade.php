    {{--<script src="http://cdnjs.cloudflare.com/ajax/libs/vue/1.0.28/vue.js"></script>--}}
            {{--<script src="https://cdn.jsdelivr.net/vue.resource/1.2.1/vue-resource.min.js"></script>--}}
           <script src="https://cdn.jsdelivr.net/lodash/4.17.4/lodash.js"></script>
            <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <ul class="breadcrumb">
        <li><a href="{{route('orgMatches',['id'=>$tournament->id,'orgName'=>$orgName])}}">مسابقات من</a></li>
        <li><a>{{$tournament->matchName}}</a></li>
    </ul>

<ul class="nav nav-tabs" id="navLink">
    <li :class="attendersClass">
        <a   href="{{route('challengeMessage',['id'=>$tournament->id , 'matchName'=>$tournament->slug])}}"  >اطلاعیه دادن</a>
    </li>

    <li  :class="participantsClass">
        <a  href="{{route('participants',['id'=>$tournament->id,'matchName'=>$tournament->slug])}}" ">شرکت کنندگان</a>
    </li>
    <li :class="BracketClass">
        <a  href="{{route('challengeBracket',['id'=>$tournament->id,'matchName'=>$tournament->slug])}}"  >براکت مسابقه</a>
    </li>
    <li  :class="TimelineClass">
        <a  href="{{route('challengeTime',['id'=>$tournament->id ,'matchName'=>$tournament->slug])}}" >تعیین زمان بندی</a>
    </li>
    <li :class="RegClass">
        <a  href="{{route('challengePanel',['id'=>$tournament->id,'matchName'=>$tournament->slug])}}" >اطلاعات مسابقه</a>
    </li>
</ul>

    <style>
        .nav-tabs {
            margin: auto;
            margin-top: 1%;
            width: 100%;
            clear: both;
        }
        .nav-tabs li {
            width: 20%;
            text-align: center;
            font-size: 150%;
            font-weight: 400;
        }
        @media screen and (max-width: 600px) {
            .nav-tabs li a{
                font-size: 65%;
                font-weight: 100;
            }
        }
        @media screen and (max-width: 800px) {
            .nav-tabs li {
                font-size: 75%;
                font-weight: 200;
            }
        }
        /* Style the list */
        ul.breadcrumb {
            padding: 10px 16px;
            list-style: none;
            background-color: #eee;
        }
        .breadcrumb {
            direction: rtl;
            float: right;
            margin-right: 1%;
            margin-top: 1%;

        }
        /* Display list items side by side */
        ul.breadcrumb li {
            display: inline;
            font-size: 18px;
        }

        /* Add a slash symbol (/) before/behind each list item */
        ul.breadcrumb li+li:before {
            padding: 8px;
            color: black;
            content: "/\00a0";
        }

        /* Add a color to all links inside the list */
        ul.breadcrumb li a {
            color: #0275d8;
            text-decoration: none;
        }

        /* Add a color on mouse-over */
        ul.breadcrumb li a:hover {
            color: #01447e;
            text-decoration: underline;
        }
        @media screen and (max-width: 800px) {
            ul.breadcrumb {
                padding: 5px 8px;
            }

            ul.breadcrumb li {
                font-size: 15px;
            }

            /* Add a slash symbol (/) before/behind each list item */
            ul.breadcrumb li+li:before {
                padding: 5px;
            }
        }
        @media screen and (max-width: 600px) {
            ul.breadcrumb {
                padding: 3px 4px;
            }

            ul.breadcrumb li {
                font-size: 10px;
            }

            /* Add a slash symbol (/) before/behind each list item */
            ul.breadcrumb li+li:before {
                padding: 4px;
            }
        }

    </style>

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

        el:'#navLink',
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


