@extends('masterUserHeader.body')
    @section('content')


  <div class="container" style="direction: rtl;">

    <div class="row" style="padding: 20px;">
       <h3>همه مسابقه ها</h3>
        <a href="{{route('matchCreate')}}"  class="btn btn-primary mr-auto" style="height: 35px;">ایجاد مسابقه جدید</a>
    </div>

 </div>  

<div class="container" style="direction: rtl;">
 <div class="row">
  <!-- First -->


     @for($i=0;$i<count($matches);$i++)


   <div class="col-md-6 col-lg-4" style="padding-top: 10px;">
       @if($matches[$i]->canceled == 1)

           <div class="box sample">

               @else
                   <div>

       @endif


    <div class="card" style=" box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);z-index: 0.5;">
      <div>
          <h4 class="card-title" style="padding-top: 10px;padding-right: 10px;padding-left: 10px;float: right;">مسابقه {{$matches[$i]->matchName}}</h4>
          <a href="{{route('organizeProfile',['id'=>$matches[$i]->organize->name])}}"> <img src="{{URL::asset('storage/images/'.$matches[$i]->organize->logo_path)}}" class="rounded" height="35px" style="margin-top: 7px;margin-left: 5px; float: left;" > </a>
          <div class="star-rating" title="{{$matches[$i]->organize->rating*10}}%" style="padding-top: 13px;float: left;">
              <div class="back-stars">
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <i class="fa fa-star" aria-hidden="true"></i>
                  
                  <div class="front-stars" style="width: {{$matches[$i]->organize->rating*10}}%">
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                  </div>
              </div>
          </div> 
      </div>

        @if($matches[$i]->canceled == 1)
            <img class="card-img-top rounded mx-auto" src="{{URL::asset('storage/images/'.$matches[$i]->path)}}" alt="Responsive image" style="width: 100%;">
        @else
            <a href="{{route('matchRegistered',['id'=>$matches[$i]->id,'matchName'=>$matches[$i]->matchName])}}"><img class="card-img-top rounded mx-auto" src="{{URL::asset('storage/images/'.$matches[$i]->path)}}" alt="Responsive image" style="width: 100%;"></a>
        @endif


        <div class="bg-primary rounded" style="position: absolute;top:55px;right: 10px;color: white;padding: 2px;">
           <p style="padding: 0px;margin: 0px;">{{$matches[$i]->endTimeDays}} روز مانده </p>
      </div>
      <div class="card-block">
        <div class="row" >
          <span class="badge badge-default">{{$matches[$i]->cost}} تومان</span>
          <span class="badge badge-default">{{$matches[$i]->mode}}</span>
          {{--<span class="badge badge-default">{{$matches[$i]->matchType}}</span>--}}
          {{--<span class="badge badge-default">{{$matches[$i]->attendType}}</span>--}}
            {{--<span class="badge badge-default"> تعداد بلیط های باقی مانده {{$match->tickets - $match->sold}}</span>--}}

        </div>

            <p hidden>{{$t = 0}}</p>
          @foreach($registereds as $registered)

              @if($registered->id == $matches[$i]->id && $matches[$i]->canceled == 0)
                <p hidden>{{$t++}}</p>
                  <a style="background: orange;color: #1d1e1f" href="{{route('matchRegistered',['id'=>$matches[$i]->id , 'matchName'=>$matches[$i]->matchName ])}}" class="btn">جزییات مسابقه</a>

              @endif

              @endforeach

          @if($t==0)


              @if($matches[$i]->endTime == 0 && $matches[$i]->canceled == 0 )

                  <a href="{{route('matchRegistered',['id'=>$matches[$i]->id , 'matchName'=>$matches[$i]->matchName ])}}" class="btn btn-danger">زمان ثبت نام به پایان رسید </a>

                  @elseif($matches[$i]->tickets == $matches[$i]->sold && $matches[$i]->canceled == 0)
                      <a href="{{route('matchRegistered',['id'=>$matches[$i]->id , 'matchName'=>$matches[$i]->matchName ])}}" style="background:salmon;color:white;" class="btn">بلیط های مسابقه تمام شد!</a>


                  @elseif($matches[$i]->canceled == 0)
                  <a href="{{route('matchRegistered',['id'=>$matches[$i]->id , 'matchName'=>$matches[$i]->matchName ])}}" class="btn btn-success">ثبت نام</a>
                @else


              @endif
          @endif

      </div>
      </div>
   </div>
  </div>

     @endfor



         <div class="text-center"> {!! $matches->links() !!} </div>



 </div>

 </div>

  <style>


      div.box.sample:after
      {
          content:"مسابقه لغو شد";
          position:absolute;
          top:130px;
          left:60px;
          z-index:0.5;
          font-family:Arial,sans-serif;
          -webkit-transform: rotate(-45deg); /* Safari */
          -moz-transform: rotate(-45deg); /* Firefox */
          -ms-transform: rotate(-45deg); /* IE */
          -o-transform: rotate(-45deg); /* Opera */
          transform: rotate(-45deg);
          font-size:50px;
          color: #f09f0a;
          background:transparent;
          border:solid 4px #c00;
          padding:5px;
          border-radius:5px;
          zoom:1;
          filter:alpha(opacity=20);
          opacity:1;
          -webkit-text-shadow: 0 0 2px #c00;
          text-shadow: 0 0 2px #c00;
          box-shadow: 0 0 2px #c00;
      }
  </style>
  <script type="text/javascript" src="{{URL::asset('js/main.js')}}"></script>

  <script>

      {{--var time = {!! json_encode($tournament->endTime) !!};--}}
      {{--var clock;--}}

      {{--$(document).ready(function() {--}}

          {{--// Grab the current date--}}
          {{--var currentDate = new Date();--}}

          {{--// Set some date in the future. In this case, it's always Jan 1--}}
          {{--var futureDate  = new Date(currentDate.getFullYear() + 1, 0, 1);--}}

          {{--// Calculate the difference in seconds between the future and current date--}}
          {{--var diff = Number(time);--}}

          {{--// Instantiate a coutdown FlipClock--}}
          {{--clock = $('.clock').FlipClock(diff, {--}}
              {{--clockFace: 'DailyCounter',--}}
              {{--countdown: true--}}
          {{--});--}}
      {{--});--}}

  </script>

@endsection

