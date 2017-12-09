<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/vue/1.0.28/vue.js"></script>
            <script src="https://cdn.jsdelivr.net/vue.resource/1.2.1/vue-resource.min.js"></script>
           <script src="https://cdn.jsdelivr.net/lodash/4.17.4/lodash.js"></script>
            <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
           <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.css">
           <script src="https://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.js"></script>
    <!-- Site Fonts -->


    <link href="https://fonts.googleapis.com/css?family=Alice|Proza+Libre" rel="stylesheet">

    <title>Users status</title>
    <style>
        body {
            margin: 2rem;
            background: #FFCC4C;
        }

        h1 {
            padding-bottom: 2rem;
            text-align: center;
            color: #7F6184;
            font-weight: 700;
            font-family: "Proza", sans-serif;
        }

        .menu {
            position: relative;
            display: table;
            background-color: #7F6184;
            width: 100%;
            border-bottom: 2px solid #fff;
        }

        .menu-item {
            color: #FFB700;
        }

        .menu-item:hover {
            color: #FF4818;
        }

        .menu li {
            display: inline;
            font-size: 2rem;
            float: left;
            padding: 2rem 4.5rem;
            font-family: "Proza", sans-serif;
        }

        li {
            list-style-type: none;
            padding: 2rem;
            font-family: "Alice", serif;
        }

        .logo {
            height: 10%;
            width: 10%;
            border-radius: 50%;
            border: 2px solid #fff;
        }

        .users li a {
            color: #F7D581;
            text-decoration: underline;
        }

        .users li a:hover {
            color: #fff;
        }

        .users li {
            border: 1px solid #fff;
            font-size: 1.75rem;
            font-weight: 500;
        }

        #online {
            background-color: #38BE72;
        }


        #offline {
            background-color: #FF714C;
        }

        #unavailable {
            background-color: #A237B1;
            color: #F7D581;
        }

        footer {
            margin: 1.5rem;
            text-align: center;
            font-size: 1.5rem;
            font-family: "Alice", serif;
        }

        footer a {
            color: #A237B1;
            text-decoration: underline;
            font-weight: 600;
        }

        footer a:hover {
            color: #38BE72;
        }
    </style>
</head>
<body>
<div class="container-fluid" id="app">
    <div class="row">
        <h1> Website Users Status </h1>

        <div class="col-md-6 col-md-offset-3">

            <div class="menu nav">
                <ul>
                    <li @click="AllUsers" id="all-user" class="menu-item selector active">تمام کاربران</li>
                    <li @click="OnlineUsers" id="online-user" class="menu-item selector">کاربران آنلاین</li>
                    <li @click="Guest" id="Guests" class="menu-item selector">مهمان</li>
                    <li><a style="text-decoration: none;color:rgb(255,160,51)
                        " href="{{route('barGraph')}}">نمای میله ای</a></li>
                </ul>
            </div>


            <div id="all" class="users">

            </div>
            <div id="online" class="users">

            </div>

            <div id="Guest" class="users">
            </div>

        </div>
    </div>
</div>

<script>

    new Vue({

        el:'#app',
        data:{

            allUsers : [''],
            onlineUsers : [''],
            guests:0
        },

        methods:{

            AllUsers:function () {

                var online = document.getElementById("online")


                while (online.hasChildNodes()) {

                    online.removeChild(online.lastChild)
                }
                var all = document.getElementById("all")


                while (all.hasChildNodes()) {

                    all.removeChild(all.lastChild)
                }
                var guest = document.getElementById("Guest")


                while (guest.hasChildNodes()) {

                    guest.removeChild(guest.lastChild)
                }

                vm = this
                axios.get('/digimatch/public/all').then(function (response) {

                  vm.allUsers = response.data

                    for(var i=0 ; i<vm.allUsers.length ; i++){

                        $("#all").append("<li style='background: coral'>"



                                + vm.allUsers[i]['username'] + "</li>");


                    }

              })


            },

            OnlineUsers:function () {

                var online = document.getElementById("online")


                while (online.hasChildNodes()) {

                    online.removeChild(online.lastChild)
                }
                var guest = document.getElementById("Guest")


                while (guest.hasChildNodes()) {

                    guest.removeChild(guest.lastChild)
                }

            var all = document.getElementById("all")


                while (all.hasChildNodes()) {

                    all.removeChild(all.lastChild)
                }
                vm = this
                axios.get('/digimatch/public/online').then(function (response) {

                    vm.onlineUsers = response.data
                    for(var i=0 ; i<vm.onlineUsers.length ; i++){


                        $("#online").append("<li>" + vm.onlineUsers[i]['user']['username'] + "</li>");


                    }

                })


            },
            Guest:function () {

                var online = document.getElementById("online")


                while (online.hasChildNodes()) {

                    online.removeChild(online.lastChild)
                }

                var all = document.getElementById("all")


                while (all.hasChildNodes()) {

                    all.removeChild(all.lastChild)
                }

                var guest = document.getElementById("Guest")


                while (guest.hasChildNodes()) {

                    guest.removeChild(guest.lastChild)
                }



                vm = this
                axios.get('/digimatch/public/guests').then(function (response) {

                    vm.guests = response.data

                    $("#Guest").append("<li style='background: coral'>" + vm.guests + "</li>");


                })


            },

        }





    })


</script>

</body>
</html>


{{--{{$Guests}}--}}
{{--@foreach($onlineUsers as $onlineUser)--}}

{{--<li>{{$onlineUser->user->username}}</li>--}}

{{--@endforeach--}}
