@section('style header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
          integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
          crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('web_sayt/css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/service.css') }}">
    <style>
        .my-appointments-person-img{
            display: flex;
            align-items: center;
            border-radius: 0;
            width: 150px;
            height: 150px;
            overflow: hidden;
            justify-content: center;
        }
        .info_imgg{
            width: 100%;
            height: 128px;
        }
    </style>
@endsection

@section('title', __('site.Home') )

@extends('app.layouts.app_home')


@section('content')

    <script>var body = document.body; body.classList.add("body");</script>

    <section>
        <div class="container">
            <div class="my-appointments">
                <div class="my-appointments__title">
                    <p>My Appointments</p>
                    <p>
                        <span class="my-appointments__title-li active"><a @if($id == 1) style="color: #585858;" @endif href="{{route('my-appointments-practitioners',[app()->getLocale(),2])}}">Complete</a></span>
                        <span class="my-appointments__title-border"></span>
                        <span class="my-appointments__title-li " ><a @if($id == 2) style="color: #585858;" @endif href="{{route('my-appointments-practitioners',[app()->getLocale(),1])}}">In Process</a></span>
                    </p>
                </div>

              @if($id == 1 and count($InProcess)>0)
                  @foreach($InProcess as $InProcessVal)
                <div class="my-appointments__complete-process">
                    <div class="my-appointments__complete-process-content">
                        <div class="my-appointments__complete-process-content-flex">
                            <div class="my-appointments-person__info">
                                <div class="my-appointments-person__info-cont1 mr-3 my-appointments-person-img">
                                    <img class="my-appointments-person__info-img info_imgg" src="{{ asset('web_sayt/img_customer/'.$InProcessVal->img) }}" alt="">
                                </div>
                                <div class="my-appointments-person__info-cont2">
                                    <div class="my-appointments-person__info-name">{{$InProcessVal->first_name}} {{$InProcessVal->last_name}}</div>
                                    <div class="my-appointments-person__info-specialist">{{$InProcessVal->title}}</div>
                                    <div class="my-appointments-person__info-data">{{date('M-jS, Y  h:i A', strtotime($InProcessVal->start)) }}</div>
                                </div>
                            </div>
                            <div class="my-appointments-person__complete-process">
                                <div class="my-appointments-person__complete-process-time">{{$InProcessVal->duration}} Mins Consultation</div>
                                <div class="my-appointments-person__complete-process-session"><a target="_blank" href="{{$InProcessVal->join_url}}">Join session</a></div>
                                <button class="my-appointments-person__complete-process-button btn bg-yellow">Fill Intake
                                    Form</button>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
              @endif


                <!-- Complete -->
            @if($id == 2  and count($Complete)>0)

               @foreach($Complete as $keyComp => $InCompleteVal)

                 <div class="my-appointments__complete-process">
                    <div class="my-appointments__complete-process-content">
                        <div class="my-appointments__complete-process-content-flex">
                            <div class="my-appointments-person__info">
                                <div class="my-appointments-person__info-cont1 mr-3 my-appointments-person-img">
                                    <img class="my-appointments-person__info-img info_imgg" src="{{ asset('web_sayt/img_customer/'.$InCompleteVal->img) }}" alt="">
                                </div>
                                <div class="my-appointments-person__info-cont2">
                                    <div class="my-appointments-person__info-name"><a href="#">{{$InCompleteVal->first_name}} {{$InCompleteVal->last_name}}</a></div>
                                    <div class="my-appointments-person__info-specialist">{{$InCompleteVal->title}}</div>
                                    <div class="my-appointments-person__info-data">{{date('M-jS, Y  h:i A', strtotime($InCompleteVal->start)) }}</div>
                                </div>
                            </div>
                            <div class="my-appointments-person__complete-process">
                                <div class="my-appointments-person__complete-process-time">{{$InCompleteVal->duration}} Mins Consultation</div>
                                @php
                                  $CheckStatusProtocol = $StatusProtocol->where('user_id','=',$InCompleteVal->user_id)->where('service_id','=',$InCompleteVal->service_id)->where('meeting_id','=',$InCompleteVal->id);
                                @endphp

                                    @if((count($CheckStatusProtocol)>0))
                                        <button
                                            class="my-appointments-person__complete-process-button procces-button btn bg-yellow">
                                            <a href="{{route('view-protocol-practitioner',[
                                     app()->getLocale(),
                                    'user_id'=>$InCompleteVal->user_id,
                                    'practitioner_id'=>$InCompleteVal->practitioner_id,
                                    'service_id'=>$InCompleteVal->service_id,
                                    'meeting_id'=>$InCompleteVal->id
                                    ])}}
                                     ">View Protocol</a>
                                        </button>
                                    @else
                                        <button
                                            class="my-appointments-person__complete-process-button procces-button btn bg-yellow">
                                            <a href="{{route('add-edit-protocol-practitioner',[
                                     app()->getLocale(),
                                    'user_id'=> $InCompleteVal->user_id,
                                    'practitioner_id'=>$InCompleteVal->practitioner_id,
                                    'service_id'=>$InCompleteVal->service_id,
                                    'meeting_id'=>$InCompleteVal->id
                                    ])}}">Fill Protocol</a>
                                        </button>
                                    @endif

                            </div>

                        </div>
                    </div>
                </div>
               @endforeach
            @endif

                @if($id == 2 and count($Complete)>0)
                    {{ $Complete->links() }}
                @endif

                <div class="my-appointments__pagination">
                    <div class="py-5 d-flex justify-content-end">
                        @if($id == 1 and count($InProcess)>0)
                            {{ $InProcess->links("pagination::bootstrap-4") }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('style')
    <script type="text/javascript" src="{{ asset('web_sayt/js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_sayt/js/bootstrap/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_sayt/js/my-appointments.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_sayt/js/script.js') }}"></script>

@endsection
