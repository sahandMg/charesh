@extends('masterUserHeader.body')
@section('content')


    <div class="container" style="direction: rtl;padding-top: 30px;">

        @if(count($userMessages) != 0)

             <form style="padding: 20px;" method="POST" action="{{route('deleteNotification',['username'=>Auth::user()->username])}}">
                      <input type="hidden" name="_token" value="{{csrf_token()}}">

                    <button type="submit" class="btn btn-danger"> حذف همه پیام ها </button>

                   </form>

            <div id="accordion" role="tablist" aria-multiselectable="true">

                @for($i = 0 ; $i< count($userMessages) ; $i++)

                    <div class="card">
                        <div class="card-header" role="tab" id="heading{{$i}}">
                            <h5 class="mb-0">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$i}}" aria-expanded="false" aria-controls="collapse{{$i}}">
                                    <span style="color: blue;"> {{$userMessages[$i]->organize->name}} </span>
                                    : <span style="color: blue"> {{$userMessages[$i]->tournament->matchName}} </span>

                                </a>
                                <span style="float: left;font-size: 12px"> {{$remain[$i]}}  روز قبل</span>
                            </h5>
                        </div>

                        <div id="collapse{{$i}}" class="collapse show" role="tabpanel" aria-labelledby="heading{{$i}}">
                            <div class="card-block">

                                {!!$userMessages[$i]->message!!}
                            </div>
                        </div>
                    </div>

                @endfor


            </div>


        @else

            <center><h3 style="color:darkred;"> پیامی موجود نیست </h3></center>

        @endif

    </div>

    <br>
    <br>



    <script type="text/javascript" src="{{URL::asset('js/main.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/bootstrap.js')}}"></script>


@endsection
