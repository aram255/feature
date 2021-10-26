@section('style header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
          integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/owl-carousel-min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/star-rating.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/service.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/calendar/calendar.css') }}">
    {{--    calendar script--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/calendar2_parctitioner/calendar.css') }}">

    <style>
        /*.activeUser {*/
        /*    inset:647.5px -17px -694.5px 1px !important;*/
        /*}*/
    </style>
    <script>

    </script>
@endsection

@section('title', __('site.Home') )

@extends('app.layouts.app_home')


@section('content')
    <script>var body = document.body; body.classList.add("body");</script>

    <!---  0000000  ---->
    <main>
        <div class="container">

            <div class="profile-practitioner">
                <div class="profile-practitioner__user nl">
                    <div class="person__info">
                        <div class="person__info-cont1">
                            <div class="avatar-img">
                                <img class="person__info-img" src="@if($PractitionerInfo->img){{asset('web_sayt/img_practitioners/'.$PractitionerInfo->img)}}@else{{asset('web_sayt/img/img-file.svg')}}@endif" alt="">
                            </div>
                            <div class="person__info-name">
                                <span class="profile-practitioner-name">{{$PractitionerInfo->first_name}} {{$PractitionerInfo->last_name}}</span>
                                <span class="edit-pen"><a href="{{route('edit-profile-practitioner',[app()->getLocale()])}}"><img src="{{ asset('web_sayt/img/edit-pen.svg') }}" alt=""></a></span>


                            </div>
                            <div class="person__info-specialist">
                                @foreach($Speciality as $ValSpeciality)
                                    <span class="person__info-skin-tag">{{$ValSpeciality->title}}</span>
                                @endforeach
                            </div>
                            <div class="person__info-skin">
                                @foreach($MyTagManagements as $GetTagManagements)
                                  <span class="person__info-skin-tag">{{$GetTagManagements->name}}</span>
                                @endforeach
                            </div>
                            <div class="person__info-my">
                                <a href="{{route('my-appointments-practitioners',[app()->getLocale(),1])}}" class="mb-4 text-black d-block">My Appointments</a>
                                <a href="{{route('type-form-practitioner',[app()->getLocale()])}}" class="mb-4 text-black d-block">My Intake Forms</a>
                                <a target="_blank" href="https://typeform.com/" class="mb-4 text-black d-block">Create Intake Forms</a>

                                <a href="#" class="mb-4 text-black d-block"  data-toggle="modal" data-target="#myProtocolsModal">My Protocols
                                </a>

                            </div>


                            @if(isset($Rate) and $Rate>0 )
                                @php $Rt =  $Rate; @endphp
                            <div class="person__info-rating qew">

                               <span class="gl-star-rating gl-star-rating--ltr " data-star-rating="">
                                   <select class="star-rating">
                                   @for($Rate; $Rate >=1 ; $Rate--)
                                           <option value="{{$Rate}}">{{$Rate}}.0</option>
                                       @endfor
                                   </select>

                                   <span class="gl-star-rating--stars s{{$Rt}}0" role="tooltip" aria-label="{{$Rt}}.0">
                                         @for($r = 1; $r <= $Rt; $r++)
                                           <span  data-value="{{$r}}" class="gl-selected"></span>
                                       @endfor
                                   </span>
                                </span>
                            </div>
                            @endif
                            <p class="perion__info-session">{{$SessionCount}}<span> Sessions</span></p>
                        </div>

                    </div>
                </div>
                <div class="profile-practitioner__consultation nl">
                    <div class="fs-24 text-center mb-4" style="color: #00309E;"> Available appointment time</div>
                    <div class="d-flex flex-md-row flex-column align-items-center">

{{--                            @if($PractitionerInfo->video != null)--}}
{{--                                <div class="profile-practitioner__consultation-video flex-1 mr-md-3 p-0 overflow-hidden">--}}
{{--                                    <video id="video" src="{{ asset('web_sayt/video_practitioners/'.$PractitionerInfo->video) }}"  width="100%" height="100%" controls>--}}

{{--                                    </video>--}}
{{--                                </div>--}}
{{--                            @else--}}
{{--                                <div class="profile-practitioner__consultation-video flex-1 mr-md-3">--}}
{{--                                    <label for="file-input">--}}
{{--                                        <img  class="upload" width="100%" height="100%" src="{{ asset('web_sayt/img/video-file.svg') }}" alt="">--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                            @endif--}}


{{--                        <div class="person__content-calendar ds-none flex-1">--}}

{{--                            <div  class="jquery-calendar bg-yellow br-10 px-4 py-2 mt-4 fs-16 view-more detail-btn" data-toggle="modal" data-target="#myModal"  >fff</div>--}}
{{--                            @foreach($GetServiceID as $ServiceId)--}}
{{--                            <input type="hidden" class="serviceid" >--}}
{{--                            @endforeach--}}
{{--                            <div class="calendar-wrapper">--}}
{{--                                <button id="btnPrev" type="button">Prev</button>--}}
{{--                                <button id="btnNext" type="button">Next</button>--}}
{{--                                <div id="divCal" ></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <div class="container"  >

                            <div id="calendar"></div>
{{--                            <div class="calendar-section" >--}}
{{--                                <div class="row" >--}}

{{--                                    <div class="col-sm-6 detail-btn" data-toggle="modal" data-target="#myModal">--}}

{{--                                        <div class="calendar calendar-first " id="calendar_first">--}}
{{--                                            <div class="calendar_header ">--}}
{{--                                                <button class="switch-month switch-left">--}}
{{--                                                    <i class="glyphicon glyphicon-chevron-left"></i>--}}
{{--                                                </button>--}}
{{--                                                <h2></h2>--}}
{{--                                                <button class="switch-month switch-right">--}}
{{--                                                    <i class="glyphicon glyphicon-chevron-right"></i>--}}
{{--                                                </button>--}}
{{--                                            </div>--}}
{{--                                            <div class="calendar_weekdays"></div>--}}
{{--                                            <div class="calendar_content"></div>--}}
{{--                                        </div>--}}

{{--                                    </div>--}}
{{--                                    <div class="col-sm-6 detail-btn" data-toggle="modal" data-target="#myModal">--}}

{{--                                        <div class="calendar calendar-second " id="calendar_second">--}}
{{--                                            <div class="calendar_header">--}}
{{--                                                <button class="switch-month switch-left">--}}
{{--                                                    <i class="glyphicon glyphicon-chevron-left"></i>--}}
{{--                                                </button>--}}
{{--                                                <h2></h2>--}}
{{--                                                <button class="switch-month switch-right">--}}
{{--                                                    <i class="glyphicon glyphicon-chevron-right"></i>--}}
{{--                                                </button>--}}
{{--                                            </div>--}}
{{--                                            <div class="calendar_weekdays"></div>--}}
{{--                                            <div class="calendar_content"></div>--}}
{{--                                        </div>--}}

{{--                                    </div>--}}

{{--                                </div> <!-- End Row -->--}}

{{--                            </div> <!-- End Calendar -->--}}
                        </div> <!-- End Container -->
                    </div>
                    <div class="profile-practitioner__consultation-time">
                        <div class="profile-practitioner__consultation-time-content">
                            <p class="time-content-title">VIDEO CONSULTATION <img src="{{ asset('web_sayt/img/zoom-icon-logo.png') }}" alt=""></p>
                            @foreach($ThisWeekMeetingsList as $Value)
                            <button class="btn bg-yellow">{{date('h:i A', strtotime($Value->start)) }}</button>
                            @endforeach
                        </div>
                    </div>
                    <div class="profile__reviews">
                        <p class="profile__reviews-title">REVIEWS</p>
                        <div class="d-flex flex-lg-row flex-column">
                            @if(count($Review)>0)
                                @foreach($Review as $valR)
                            <div class="profile__reviews-block">
                                <div class="profile__reviews-person flex-xl-row flex-column">
                                    <img src="{{ asset('web_sayt/img_customer/'.$valR->img) }}" alt="" srcset="">
                                    <div class="profile__reviews-content">
                                        <div class="person__info-rating">
                                          <span class="gl-star-rating gl-star-rating--ltr " data-star-rating="">
                                             <select class="star-rating">
                                                <option value="5"></option>
                                                <option value="4"></option>
                                                <option value="3"></option>
                                                <option value="2"></option>
                                                <option value="1"></option>
                                             </select>
                                             <span class="gl-star-rating--stars s50" role="tooltip" aria-label="">
                                              @for ($i = 0; $i < $valR->rate; $i++)
                                                    <span data-index="{{$i}}" data-value="{{$i}}" class="gl-active"
                                                          style="font-size: 28px;"></span>
                                              @endfor
                                            </span>
                                          </span>
                                        </div>
                                        <div class="profile__reviews-content-clock">
                                            <img src="{{ asset('web_sayt/img/clock.svg') }}" alt="" srcset="">
                                            <span class="reviews-clock-data">{{ date('M-d',strtotime($valR->created_at)) }}</span>
                                        </div>
                                        <div class="reviews-cooment">
                                            {{$valR->description}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>

           @if(@isset($Service) and  @count($Service) > 0 )

            <div class="service mt-5 py-5">
                <h2 class="text-center">My Services</h2>
                <h4 class="text-uppercase text-center mb-5">ONE ON ONE PROGRAMS</h4>
                <div id="customer-testimonal" class="owl-carousel owl-theme owl-loaded owl-drag  d-flex justify-content-between">
                    @foreach($Service as $Value)
                        @php
                            $array = array("item light-green","item light-yellow");
                            $k = array_rand($array);
                            $color = $array[$k];
                        @endphp
                        <div class="@php echo $color; @endphp" style="max-width: 530px">
                            <div class="d-flex flex-column align-items-center">
                                <h4  class="mb-3">{{$Value->title}}</h4>
                                <div class="d-flex flex-column mx-auto align-items-center mb-3 italic-text">
                                    @foreach($ServiceSession as $valS)
                                        @foreach($valS as $valSS)
                                            @if($valSS->services_id == $Value->id)
                                                <span>{{$valSS->sessions}}</span>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </div>
                            </div>
                            <div class="price d-flex flex-column align-items-center mb-3">
                                <div class="d-flex">
                                    <span class="">$</span> <span >{{$Value->price}}</span>
                                </div>
                                <small>USD plus HST</small>
                            </div>
                            <ul class="list-unstyled px-5 overflow-auto">
                                @foreach($ServiceDescription as $valD)
                                    @foreach($valD as $valDD)
                                        @if($valDD->services_id == $Value->id)
                                            <li><i class="fas fa-angle-right mr-2" ></i> <span>{{$valDD->description}}</span></li>
                                        @endif
                                    @endforeach
                                @endforeach
                            </ul>

                            {{--                                    <button class="bg-yellow br-10 px-4 py-2 mt-4 fs-16 view-more">View More >></button>--}}
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </main>


    <!-- Modal -->
    <div class="modal fade" id="myProtocolsModal" tabindex="-1" aria-labelledby="myProtocolsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content pb-5">
                <div class="p-4 m-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="color-blue">&times;</span>
                    </button>
                    <br>
                    <h2 class="modal-title" id="myProtocolsModalLabel">All Protocol</h2>
                </div>
                <div class="w-50 mb-3 px-5">
                    <select class="form-control" id="exampleFormControlSelect1">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>
                <div class="scrollbar py-4"  id="style-1">
                    <div class="modal-body force-overflow" style="overflow-y: auto; max-height: 450px">
                        @foreach($Complete as $GetVal)
                        <div class="alert bg-light alert-dismissible fade show" role="alert">
                            <div class="d-flex align-items-center">
                                <div class="img-space">
                                    <img src="{{asset('web_sayt/img_customer/'.$GetVal->user_img)}}" alt="">
                                </div>
                                <div class="px-4">

{{--                                    edit-protocol-practitioner-view--}}
                                    <p><b><a href="{{route('edit-view-protocol',[
                                     app()->getLocale(),
                                    'user_id'=> $GetVal->user_id,
                                    'practitioner_id'=>$GetVal->practitioner_idd,
                                    'service_id'=>$GetVal->service_id,
                                    'meeting_id'=>$GetVal->meeting_id
                                    ])}}">{{$GetVal->first_name}} {{$GetVal->last_name}}</a></b></p>
                                    <div class="text-blue">{{$GetVal->title}}</div>
                                </div>
                            </div>
                            <button type="button" class="close delete-protocol"  data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <input  type="hidden" value="{{$GetVal->user_id}}">
                            <input  type="hidden" value="{{$GetVal->practitioner_idd}}">
                            <input  type="hidden" value="{{$GetVal->service_id}}">
                            <input  type="hidden" value="{{$GetVal->meeting_id}}">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="EditProtocolsModal" tabindex="-1" aria-labelledby="myProtocolsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content pb-5">
                <div class="p-4 m-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="color-blue">&times;</span>
                    </button>
                    <br>
                    <h2 class="modal-title" id="myProtocolsModalLabel">All Protocol</h2>
                </div>

                <div class="scrollbar py-4"  id="style-1">
                    <div class="modal-body force-overflow">
                        @foreach($Complete as $GetVal)
                            <div class="alert bg-light alert-dismissible fade show" role="alert">
                                <div class="d-flex align-items-center">
                                    <div class="img-space">
                                        <img src="{{asset('web_sayt/img_customer/'.$GetVal->user_img)}}" alt="">
                                    </div>
                                    <div class="px-4">
                                        <p><b><a href="{{route('add-edit-protocol-practitioner',[
                                     app()->getLocale(),
                                    'user_id'=> $GetVal->user_id,
                                    'practitioner_id'=>$GetVal->practitioner_idd,
                                    'service_id'=>$GetVal->service_id,
                                    'meeting_id'=>$GetVal->meeting_id
                                    ])}}">{{$GetVal->first_name}} {{$GetVal->last_name}}</a></b></p>
                                        <div class="text-blue">{{$GetVal->title}}</div>
                                    </div>
                                </div>
                                <button type="button" class="close "  data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <input  type="hidden" value="{{$GetVal->user_id}}">
                                <input  type="hidden" value="{{$GetVal->practitioner_idd}}">
                                <input  type="hidden" value="{{$GetVal->service_id}}">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

{{--    <!---  0000000 ----->--}}
{{--    <div class="modal" tabindex="-1" id="myModal">--}}
{{--        <div class="modal-dialog max-dialog">--}}
{{--            <div class="modal-content ">--}}
{{--                <div class="modal-header border-bottom-0">--}}
{{--                    <h2 class="text-center w-100 title">Available appointment time</h2>--}}
{{--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                        <span aria-hidden="true">&times;</span>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}
{{--                    <div id="calendar"></div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

@include('modal-list')
@endsection

@section('style')


    <script type="text/javascript" src="{{ asset('web_sayt/js/jquery.js') }}"></script>


    <script>
        $(function() {
            $('#myModal').modal('show');
        });
    </script>
    <script>



        // $(document).on('click','.detail-btn', function()  {

        $( document ).ready(function() {

            var practitionerId = $(this).attr('data-id');
            var calendar = null;

            var service_id     = $('.serviceid').val();



            if(service_id == null)

                service_id = '';



            $('#calendar').fullCalendar('destroy');

            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#calendar').fullCalendar('destroy');

            var calendar = $('#calendar').fullCalendar({
                editable:true,
                header:{
                    left:'prev,next today',
                    center:'title',
                    right:'month,agendaWeek,agendaDay'
                },
                //events:'/en/profile-practitioner/'+ practitionerId+'/'+service_id,
                events:'/en/profile-practitioner/'+ practitionerId,
                selectable:true,
                selectHelper: true,
                timeFormat: 'hh:mm a',
                select:function(start, end, allDay)
                {
                    // console.log(arrText)
                    var start = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');

                    var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');


                    // Check live DateTime
                    var today = new Date();
                    var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
                    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
                    var LiveDateTime = date + ' ' + time;


                    // compare
                    var d1 = new Date(start);
                    var d2 = new Date(LiveDateTime);

                    if (d1 >= d2) {

                            $.ajax({
                                url: "{{ route('add-free-date-practitioner-calendar',app()->getLocale()) }}",
                                type: "POST",
                                data: {
                                    title: 'Practitioner',
                                    start: start,
                                    end: end,
                                    // service_id: arrServiceId,
                                    LiveDateTime:LiveDateTime,
                                    type: 'add'
                                },
                                success: function (data) {
                                    calendar.fullCalendar('refetchEvents');
                                    if(data.success !== undefined)
                                    {
                                     //   alert(data.success)
                                        //calendar.fullCalendar('refetchEvents');
                                        // Show Success Meeting
                                        $('#succes-meeting-free').modal('show');

                                        // Close Select Meeting
                                        $("#myModal-free").modal('hide');
                                    }

                                    if(data.error !== undefined)
                                    {
                                        //alert(data.error);
                                        // Show Error No Repeat Service
                                        $("#select_error").modal('show');

                                        // Close Select Meeting
                                        $("#myModal2").modal('hide');

                                    }
                                },
                            });
                    }else{
                        //alert('You can not make appointments with back date.');

                        // Show Error with back date
                        $("#with-back-date").modal('show');

                        // Close Select Meeting
                        $("#myModal2").modal('hide');
                    }
                },

                eventRender: function(event, element,start, end, allDay) {


                    if(event['status'] == null) {

                        setTimeout(() => {
                            element[0].setAttribute('class', 'activeNull  fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable');
                        }, 10)

                    }

                    if(event['status'] != null) {

                        setTimeout(() => {
                            element[0].setAttribute('class', 'activeUser  fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable');
                        }, 10)

                    }

                    // Display none booking date
                    setTimeout(() => {
                        $(".DeactiveUser" ).css( "display", "none" );
                        $(".DeactiveUser" ).next().css( "display", "none" );
                        $(".activeUser").next('.activeNull').css( "display", "none" );;
                    }, 20);
                },

               editable:true,
                eventDrop: function(event) {

                    var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                    var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');

                    // Check live DateTime
                    var today = new Date();
                    var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
                    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
                    var LiveDateTime = date + ' ' + time;


                    // compare

                    var d1 = new Date(start);
                    var d2 = new Date(LiveDateTime);

                    if (d1 >= d2) {

                        var event_id = event.id;

                        // if (confirm("Do you want to change your meeting details?")) {

                            // submitTimeChanges(event.id);
                            $.ajax({
                                url: "/en/free-date-time-update",
                                type: "POST",
                                data: {
                                    start: start,
                                    end: end,
                                    event_id:event_id,
                                    type: 'update'
                                },
                                success: function (response) {
                                    console.log(response)
                                    calendar.fullCalendar('refetchEvents');
                                    //alert("Event Updated Successfully");

                                    // Show Success Delete
                                    $("#update-success").modal('show');

                                    // Close Select Meeting
                                    $("#myModal").modal('hide');
                                },
                                error: function(response) {
                                    console.log(response)
                                    // alert("The event has not been updated.");

                                    // Show Error No not been created
                                    $("#not-been-created").modal('show');

                                    // Close Select Meeting
                                    $("#myModal2").modal('hide');
                                }
                            })
                        // }
                    }else{
                       // alert('You can not make appointments with back date.');

                        // Show Error with back date
                        $("#with-back-date").modal('show');

                        // Close Select Meeting
                        $("#myModal2").modal('hide');
                    }

                },

                eventClick:function(event)
                {
                    var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                    var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');

                    var event_id         = event.id;
                    var user_id  = event.user_id;

                   @if(!empty(Session::get('UserID')))

                    var AuthID = {{Session::get('UserID')}}

{{--                    // fc-event-container--}}

                    if((AuthID === event.practitioner_id) &&  (user_id == null)) {

                        // if (confirm("Are you sure you want to remove it?")) {

                            $.ajax({
                                url: "{{ route('free-date-time-delete',app()->getLocale()) }}",
                                type: "POST",
                                data: {
                                    start: start,
                                    end: end,
                                    event_id: event_id,
                                    type: "delete"
                                },
                                success: function (data) {
                                    calendar.fullCalendar('refetchEvents');

                                    if(data.success !== undefined)
                                    {
                                        //alert(data.success)
                                        // Show Success Delete
                                        $("#delete-success-free").modal('show');

                                        // Close Select Meeting
                                        $("#myModal").modal('hide');
                                    }

                                    if(data.error !== undefined)
                                    {
                                       // alert(data.error);

                                        // Show Error Delete
                                        $("#delete-error").modal('show');

                                        // Close Select Meeting
                                        $("#myModal").modal('hide');
                                    }
                                },
                            })
                        // }
                    }else{
                       // alert('You can not delete this meeting because you did not add it.')

                    // Show Error Delete
                    $("#delete-did-not-add-it").modal('show');

                    // Close Select Meeting
                    $("#myModal").modal('hide');
                    }
                    @endif
                }
            });

        });


        function displayMessage(message) {
            toastr.success(message, 'Event');
        }

        $('.person__info-heartt').click(function () {
            @if(!isset(Auth::user()->id))
                window.location.href = "login-practitioners";
            @endif
        });

    </script>

    <script type="text/javascript" src="{{ asset('web_sayt/js/calendar/calendar.js') }}"></script>
{{--    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>--}}
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="{{ asset('web_sayt/js/star-rating.js') }}"></script>
{{--    <script type="text/javascript" src="{{ asset('web_sayt/js/jquery.js') }}"></script>--}}
    <script type="text/javascript" src="{{ asset('web_sayt/js/bootstrap/bootstrap.min.js') }}"></script>
{{--    <script type="text/javascript" src="{{ asset('web_sayt/js/bootstrap/bootstrap.bundle.min.js') }}"></script>--}}
    <script type="text/javascript" src="{{ asset('web_sayt/js/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_sayt/js/carusel.js') }}"></script>
    <script src="{{ asset('web_sayt/js/filter.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_sayt/js/script.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_sayt/js/readMoreJS.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>

    <script>
        $(document).ready(function(){

            $(function() {
                $('.edit').on('click', function() {

                    var div = $(this);
                    var tb = div.find('input:text');//get textbox, if exist
                    if (tb.length) {//text box already exist
                        div.text(tb.val());//remove text box & put its current value as text to the div
                    } else {
                        tb = $('<input>').prop({
                            'type': 'text',
                            'class': 'form-control',
                            'value': div.text()//set text box value from div current text
                        });
                        div.empty().append(tb);//add new text box
                        tb.focus();//put text box on focus
                    }
                });
            });



            $("#rightMenu").click(function(){
                $(".right-sidebar").addClass("active");
            });

            $("#close-right-sidebar").click(function() {
                $(".right-sidebar").removeClass("active");
            });
        });

        $('[data-toggle="popover"]').popover();


        // Clone Add New Plan

        $("#Bdescription").click(function() {
            var x = $("#Description"),
                y = x.clone();
            x.attr("class", "mb-3 form-control");
            y.insertAfter("#Bdescription");
            var scrollableSpace = $ (".scrollable-space")
            $( scrollableSpace ).append( y );
        });

        $("#Bsessions").click(function() {
            var a = $("#SSession"),
                b = a.clone();
            a.attr("class", "mb-3 form-control");
            b.insertAfter("#Bsessions");
            var scrollableSpace1 = $ (".scrollable-space1")
            $( scrollableSpace1 ).append( b );
        });

        $readMoreJS.init({
            target: '.overflow-auto',
            numOfWords: 70,
            toggle: true,
            moreLink: '<button class="bg-yellow br-10 px-4 py-2 mt-4 fs-16 view-more position-relative" style="bottom: 0">View More >></button>',
            lessLink: '<button class="bg-yellow br-10 px-4 py-2 mt-4 fs-16 view-more position-relative" style="bottom: 0">View less >></button>'
        });

        $('.view-more').click(function () {
            $(this).parent().parent().prev('.list-unstyled').css( "max-height","270px" );

        })


        // Delete Protocol
        $('.delete-protocol').on('click',function () {

            var user_id         = $(this).next().val();
            var practitioner_id = $(this).next().next().val();
            var service_id      = $(this).next().next().next().val();
            var meeting_id      = $(this).next().next().next().next().val();

            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:"{{route('delete-protocol',[app()->getLocale()])}}",
                method:"POST",
                data:{user_id:user_id,practitioner_id:practitioner_id,service_id:service_id,meeting_id:meeting_id, _token:_token},
                success:function(data){
                    console.log(data)

                   // alert('The tag you entered has been added.')
                },error: function (error) {
                    if(error.status == 500)
                    {
                        //alert('The tag you entered was not entered, or it currently exists.')
                    }
                }
            });

        })

    </script>

    <script src="{{ asset('web_sayt/js/calendar2_practition/calendar.js') }}"></script>
@endsection
