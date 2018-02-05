@extends('masterUserHeader.body')
@section('title')
    چارش | جدول حذفی  {{$tournament->matchName}}
@endsection

@section('content')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('CSS/bracket.css')}}">
    @include('masterOrganize.body',['tournament'=> $tournament,'route'=>$route])
        <div class="container" id="elbracket">
            <br>
            <h4 style="direction: rtl;padding-top: 10px;">نام تیم ها و نتایج مسابقات را داخل براکت بنویسید.</h4>
            <br>
            <div class="row" id="allTeams" style="padding: 30px;direction: ltr;border-style: solid;">
                @foreach($teams as $team)
                    <div class="teamiaFardi">
                        @if($tournament->matchType == 'انفرادی')
                            <img class="rounded" src="{{URL::asset('storage/images/'.$team->path)}}" height="30" > {{$team->username}}
                        @else
                            <img class="rounded" src="{{URL::asset('storage/images/'.$team->path)}}" height="30" > {{$team->teamName}}
                        @endif
                    </div>
                @endforeach
            </div>
    <div class="container">
      <div id="customHandlers" style="direction: ltr;margin-left: 20px;z-index:0.5; "></div>
    </div>
    <br>
    <button onclick="saveFn('finish',null)" type="button" class="btn btn-primary" style="margin: auto;display: block;">ذخیره</button>
    <br>
    <div style="margin: auto;display: block;text-align: center;">
        <!-- League Table -->
        <p style=""></p>
        <button @click="confirm" type="button" class="btn btn-warning" style="">تغییر نوع برگزاری براکت</button>
    </div>
     {{--  matn zakhire --}}
    <h4 id="saveData"></h4>

    </div>

    <style>
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



    <script type="text/javascript" src="{{URL::asset('js/main.js')}}"></script>
    {{--<script type="text/javascript" src="js/jquery-3.2.1.js"></script>--}}
    <script type="text/javascript" src="{{URL::asset('js/jquery.bracket.min.js')}}"></script>

    <script type="text/javascript">

        var customData = {
            teams: [],
            results: []
        };



//        Fetching Data

        new Vue({

            el:'#elbracket',
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

                confirm:function () {

                   var ans = prompt('در صورت تغییر نوع برگزاری ، تمامی اطلاعات جدول امتیازات و براکت مسابقه پاک می شود. برای ادامه، تایید را وارد کنید');
                    if(ans == 'تایید'){

                        window.location.href = {!! json_encode(route('bracketDelete',['id'=>$tournament->id,'matchName'=>$tournament->slug])) !!}
                    }

                },


                run: function() {


                    $('div#customHandlers').bracket({
                        init: customData,

                        save: saveFn, /* without save() labels are disabled */
                        decorator: {edit: edit_fn,
                            render: render_fn}})
                }

            },
            created:function () {

                vm = this
                axios.get('{!!route('getElBracket',['id'=>$tournament->id,'matchName'=>$tournament->matchName])!!}').then(function (response) {

                    vm.detail = response.data;

//                console.log(vm.detail)






                });

                setTimeout(vm.readBracket,200)
                setTimeout(vm.run,200)


            }


        });

// ----------------------------

        var status
        /* Custom data objects passed as teams */




        /* Custom data objects passed as teams */
        //var customData = {
        //    teams : [],
        //    results : []
        //  }
        //
        /* Edit function is called when team label is clicked */
        function edit_fn(container, data, doneCb) {
            var input = $('<input type="text">')
            // input.val(data ? data.name + ':' + data.name : '')
            input.val(data ?   data.name : '')
            container.html(input)
            input.focus()
            input.blur(function() {
                var inputValue = input.val()
                if (inputValue.length === 0) {
                    doneCb(null); // Drop the team and replace with BYE
                } else {
                    // var flagAndName = inputValue.split(':') // Expects correct input
                    var flagAndName = inputValue
                    doneCb({flag: flagAndName, name: flagAndName})
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
        function render_fn(container, data, score, state) {
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

//                    console.log(data.flag)
                    container.append('<img style="height:20px;width:20px" src="{{URL::asset('storage/images')}}'+'/'+data.flag+'.jpg" /> ').append(data.name)
                    return;
            }
        }


        /* Called whenever bracket is modified
         *
         * data:     changed bracket object in format given to init
         * userData: optional data given when bracket is created.
         */


        var param
        function saveFn(data, userData) {

            if(data != 'finish'){
                str = JSON.stringify(data);
//   console.log(str);
                param = data
                str = JSON.stringify(userData);

            }else{

                console.log('param');
                console.log(param)
                axios.post('{{route('ElBracket2',['id'=>$tournament->id,'matchName'=>$tournament->matchName])}}',{'data':param}).then(function (response) {
                console.log('customData');
                console.log(customData);
                    if(response.data == 1){

//                document.getElementById('saveData').innerHTML = 'اطلاعات براکت ذخیره شد'
                        alert('اطلاعات براکت ذخیره شد')

                    }
                })

            }

//   console.log("test");
            // console.log(json);
            // $('#saveOutput').text('POST '+userData+' '+json)
            /* You probably want to do something like this
             jQuery.ajax("rest/"+userData, {contentType: 'application/json',
             dataType: 'json',
             type: 'post',
             data: json})
             */
        }

//        $(function() {
//
//            $('div#customHandlers').bracket({
//                init: customData,
//
//                save: saveFn, /* without save() labels are disabled */
//                decorator: {edit: edit_fn,
//                    render: render_fn}})
//
//        })


        function test(data)
        {
            str = JSON.stringify(data);
        }

    </script>

@endsection