<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<div class="containar" style="direction: rtl;">
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="row">
        <div style="padding: 1%;float: left;width: 35%;">

                @php
                    echo "<img src='data:image/png;base64," . $png . "'>";

                @endphp




            <br>
            <img src="{{URL::asset('images/charesh.jpg')}}" width="100" height="100" style="margin-right: 15%;">
        </div>
        <div style="padding: 1%;float: left;width: 63%;">

            <h1 style="text-align: center;direction: rtl"> {{$name}}</h1>
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <td>نام برگزار کننده :<strong> {{$tournament->organize->name}} </strong></td>
                    <td>نام خریدار :<strong> {{$owner}} </strong></td>
                </tr>
                <tr>
                    <td>زمان :<strong> {{unserialize($time)[0]}} {{unserialize($time)[1]}} {{unserialize($time)[2]}} </strong></td>
                    <td>هزینه ثبت نام :<strong style="direction: rtl"> {{$cost}} تومان </strong></td>
                </tr>
                <tr>
                    <td  colspan="2">آدرس :<strong>{{$tournament->organize->address}} </strong></td>
                </tr>
                <tr>
                    <td  colspan="2"  align="center"><strong> اعضای تیم </strong></td>
                </tr>


                    @for($i=0 ; $i<count($names);$i++)
                <tr>



                        <td align="center">  {{$names[$i]}}  </td>
                    @if( ($i+1) != count($names) )
                        <td align="center">  {{$names[$i+1]}}  </td>
                    @endif


                </tr>
                @endfor

                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
