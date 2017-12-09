{{-- GroupElimination Bracket --}}
@extends($auth == 1 ? 'masterUserHeader.body' : 'masterHeader.body')
@section('content')

    <div class="container" style="direction: rtl;padding-top: 30px;">

        @include('masterMatch.body',['tournament'=> $tournament,'route'=>$route])

    </div>

    <div class="container" id="app">


        <nav class="nav nav-pills nav-fill" style="padding: 30px;">
            <a class="nav-item nav-link active" href="{{route('MatchGElBracket',['id'=>$tournament->id,'url'=>$tournament->code])}}">حذفی</a>
            <a class="nav-item nav-link " href="{{route('matchGroupBracket',['id'=>$tournament->id,'url'=>$tournament->code])}}">گروهی</a>

        </nav>
        <br>
        <!-- Brackets -->
        <div id="playoff"></div>

    </div>



    <script type="text/javascript" src="../../public/js/bootstrap.js"></script>
    {{--<script src="js/jquery-3.2.1.js"></script>--}}
    <script type="text/javascript" src="../../public/js/jquery.bracket.min.js"></script>

    <script type="text/javascript">

        var customData = {
            teams: [],
            results: []
        };

        var status
        /* Custom data objects passed as teams */


        new Vue({

            el:'#app',
            data:{
                detail:''

            },
            methods:{

                readBracket:function () {

                    for(var i=0 ; i< vm.detail['teams'].length ; i++) {
                        customData.teams[i] = new Array(vm.detail['teams'][i].length);
//                        console.log(vm.detail['teams'][i].length);
                        for (var j = 0; j < vm.detail['teams'][i].length; j++) {

                            customData.teams[i][j] = {
                                name : vm.detail['teams'][i][j]['name'] ,
                                flag: vm.detail['teams'][i][j]['flag']
                            } ;

                        }
                    }

                    for(var i=0 ; i< vm.detail['results'].length ; i++) {
                        customData.results[i] = new Array(vm.detail['results'][i].length);
//                        console.log(vm.detail['results'][i].length);
//                        for (var j = 0; j < vm.detail['teams'][i].length; j++) {

                            customData.results[i] =  vm.detail['results'][i] ;




//                        }
                    }
//                    console.log(customData);
                },


                run: function() {

                    $('div#playoff').bracket({

                        init: customData,
                        // save: function(){},
                        decorator: {edit: edit_fn,
                            render: render_fn}})
                }

            },
            created:function () {

                vm = this
                axios.get('{!!route('getGElBracket',['id'=>$tournament->id,'url'=>$tournament->code])!!}').then(function (response) {

                    vm.detail = response.data;

//                console.log(vm.detail.results)




                    setTimeout(vm.readBracket,200)
                    setTimeout(vm.run,200)

                });



            }


        });





        /* Edit function is called when team label is clicked */
        function edit_fn(container, data, doneCb) {


            var input = $('<input type="text">')
            input.val(data ? data.flag + ':' + data.name : '')
            container.html(input)
            input.focus()
            input.blur(function() {
                var inputValue = input.val()
                if (inputValue.length === 0) {
                    doneCb(null); // Drop the team and replace with BYE
                } else {
                    var flagAndName = inputValue.split(':') // Expects correct input
                    doneCb({flag: flagAndName[0], name: flagAndName[1]})
                }
            })
        }

        /* Render function is called for each team label when data is changed, data
         * contains the data object given in init and belonging to this slot.
         *
         * 'state' is one of the following strings:
         * - empty-bye: No data or score and there won't team advancing to this place
         * - empty-tbd: No data or score yet. A team will advance here later
         * - entry-no-score: Data available, but no score given yet
         * - entry-default-win: Data available, score will never be given as opponent is BYE
         * - entry-complete: Data and score available
         */
        var img2
        function render_fn(container, data, score, state) {


            axios.post('getTeamImage',{'name':data.name}).then(function (response) {


                img2 = response.data
//                    console.log(img2)

            })
            switch(state) {
                case "empty-bye":
                    container.append("No team")
                    return;
                case "empty-tbd":
                    container.append("Upcoming")
                    return;

                case "entry-no-score":
                case "entry-default-win":
                case "entry-complete":
                    container.append('<img src="../../public/storage/images/' +img2 +'" /> ').append(data.name)
                    return;
            }
        }

        // var temp = {
        //  name : vm.detail['teams'][i][j]['name'] ,
        //  flag: vm.detail['teams'][i][j]['name']
        // };

        // temp2.push(temp);
        //  t++;
        // if ( t == 2) {
        //    console.log(temp2);
        //     // customData.teams.push(temp2);
        //     customData.teams.push.apply(customData.teams, temp2);
        //     temp2.pop();
        //     temp2.pop();

        //     t=0;
        //  }
        //  console.log("test");


        // console.log(vm.detail['teams'][i][j]['name']);
        // console.log(temp2);
        // customData.teams.push({
        //  name : vm.detail['teams'][i][j]['name'] ,
        //  flag: vm.detail['teams'][i][j]['name']
        // });
    </script>


@endsection


