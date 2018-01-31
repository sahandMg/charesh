<!DOCTYPE html>
<html lang="fa">
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
	<title>Index 2</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


    <style>

        @font-face {
            font-family:bjalal ;
            src: {{URL::asset('fonts/bjalal.woff')}}
        }

        th,td{

            font-family:'bjalal';
        }



    </style>

   <body>

   <div class="container">


        <h1 style="direction: rtl" class="text-center"> لیست شرکت کنندگان مسابقه  <span style="padding-right: 10px">{{$tournament->matchName}}</span></h1>
       <br>
       <br>
       <h4 style="text-align: right;direction: rtl">تاریخ برگزاری : {{unserialize($tournament->startTime)[0]}} {{unserialize($tournament->startTime)[1]}} {{unserialize($tournament->startTime)[2]}}</h4>
       <table class="table table-striped table-bordered ">
           <thead>
           <tr>
               <th class="text-center">وضعیت</th>
               <th class="text-center">نام شرکت کنندگان / نام گروه </th>
           </tr>
           </thead>
           <tbody>

            @if(isset($teams) )


                    @foreach($teams as $team)

                        <tr>
                            <td  class="text-center"><span class="glyphicon glyphicon-unchecked"></span></td>

                            <td  class="text-center">{{$team->teamName}}</td>


                        </tr>


                    @endforeach

            @else

                    @foreach($singulars as $singular)

                        <tr>
                            <td  class="text-center"><span class="glyphicon glyphicon-unchecked"></span></td>

                            <td  class="text-center">{{$singular->username}}</td>


                        </tr>


                    @endforeach


            @endif

           </tbody>
       </table>


   </div>



</body>
</html>
