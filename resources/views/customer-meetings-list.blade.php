@section('style header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
          integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
          crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('web_sayt/css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/service.css') }}">
    <script src="{{ asset('web_sayt/js/jquery.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
        <script>
            $(document).ready(function() {
                $("#checkAll").click(function () {
                    $('input:checkbox').not(this).prop('checked', this.checked);
                });
            });
        </script>

    <style>
        .activeNull{
            background-color: #569e66 !important;
        }
    </style>
@endsection

@section('title', __('site.Home') )

@extends('app.layouts.app_home')


@section('content')


    @if (Session::get('success'))
        <div class="alert alert-success" style="text-align: center;">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ session('success') }}
        </div>
    @endif

    {{--    {{dd($data)}}--}}
    {{--    <section>--}}
    {{--        <div class="container">--}}
    {{--            <div class="card mb-3">--}}
    {{--                <h2 style="text-align: center;">My Meetings Zoom  </h2>--}}
    {{--                <form action="{{route('zoom-delete',[app()->getLocale()])}}" method="post" >--}}
    {{--                    {{csrf_field()}}--}}
    {{--                    <div class="card-header py-3">--}}
    {{--                        <button class="btn btn-danger"  type="submit">Remove</button>--}}
    {{--                    </div>--}}

    {{--                    --}}{{--  Edit category title--}}
    {{--                    <div class="card-body">--}}
    {{--                        <div class="table-responsive">--}}
    {{--                            <table class="table table-bordered"  width="100%" cellspacing="0">--}}
    {{--                                <thead>--}}
    {{--                                <tr>--}}
    {{--                                    <th style="width: 3%;"><input id="checkAll" class="group-checkable sb-checkbox" type="checkbox" ></th>--}}
    {{--                                    <th>Title</th>--}}
    {{--                                    <th>Start Time</th>--}}
    {{--                                    <th>Duration</th>--}}
    {{--                                    <th>Time Zone</th>--}}
    {{--                                    <th>Remove</th>--}}
    {{--                                </tr>--}}
    {{--                                </thead>--}}
    {{--                                <tbody>--}}
    {{--                                @foreach($data->meetings as $val)--}}
    {{--                                    <tr>--}}
    {{--                                        <td><input class="group-checkable sb-checkbox" type="checkbox" name="form_id[]" value=""></td>--}}
    {{--                                        <td><a href="{{$val->join_url}}" target="_blank">{{$val->topic}}</a></td>--}}
    {{--                                        <td>{{date('d-m-Y-H:i:s', strtotime($val->start_time)) }}</td>--}}
    {{--                                        <td>{{$val->duration}}</td>--}}
    {{--                                        <td>{{$val->timezone}}</td>--}}
    {{--                                        <td>--}}

    {{--                                                <input type="hidden" name="delete_id" value="{{$val->id}}">--}}
    {{--                                                <input type="submit" value="Remove">--}}

    {{--                                        </td>--}}
    {{--                                    </tr>--}}
    {{--                                @endforeach--}}
    {{--                                </tbody>--}}
    {{--                            </table>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </form>--}}
    {{--            </div>--}}
    {{--    </section>--}}

    <section>
        <div class="container">
            <div class="card mb-3">
                <h1 style="text-align: center;font-size:34px;">My appointments</h1>
                <form action="{{route('zoom-delete-table',[app()->getLocale()])}}" method="post" >
                    {{csrf_field()}}

                    {{--  Edit category title--}}
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered"  width="100%" cellspacing="0" style="text-align: center">
                                <thead>
                                <tr>
                                    <th>Practitioner</th>
                                    <th>Title</th>
                                    <th>Start Time</th>
                                    <th>Duration</th>
                                    <th>Status</th>
                                    <th>Remove</th>
                                    <th>Edit</th>
                                </tr>
                                </thead>
                                <tbody style="font-size: 20px;">
                                @foreach($data as $val)
                                    <tr>
                                        <td>{{$val->first_name}} {{$val->last_name}}</td>
                                        <td><a href="{{$val->join_url}}" target="_blank">{{$val->title}}</a></td>
                                        <td>{{date('d-m-Y-h:i A', strtotime($val->start)) }}</td>
                                        <td>{{$val->duration}}</td>
                                        <td style="font-weight:bold;color: @if($val->status == 'Pending') red; @elseif($val->status == 'Accept') #1c7430; @endif">{{$val->status}}</td>
                                        <td>
                                            <input type="hidden"  name="delete_id" value="{{$val->id}}">
                                            <input type="hidden" name="delete_meeting_id" value="{{$val->meeting_id}}">
                                            <button  type="submit" class="fas fa-times" style="margin:0 10px 0 55px;"></button>
                                        </td>
                                        <td>
                                            <input type="hidden"  class="meetingg_id"  value="{{$val->id}}">
                                            <input type="hidden"  class="user_email" value=" @if(isset(Auth::user()->email)){{Auth::user()->email}}@endif">
                                            <input type="hidden"  class="user_email" value=" @if(isset(Auth::user()->email)){{Auth::user()->email}}@endif">
                                            <input type="hidden"  class="user_email" value=" @if(isset(Auth::user()->email)){{Auth::user()->email}}@endif">
                                            <input type="hidden"  class="service_name_appointments" value="{{$val->title}}">
                                            <input type="hidden"  value="{{$val->create}}">
                                            <input type="hidden"  value="{{$val->join_url}}">
                                            <input type="hidden"  value="{{$val->password}}">
                                            <input type="hidden"  value="{{$val->duration}}">
                                            <input type="hidden"  value="{{$val->service_id}}">
                                            <input type="hidden"  value="{{$val->email}}">
                                            <input type="hidden"  value="{{$val->first_name}}">
                                            <input type="hidden"  value="{{$val->last_name}}">
                                            <input type="hidden"  value="{{$val->phone_number}}">
                                            <input type="hidden"  value="{{$val->practitioner_id}}">
                                            <button class="fa fa-edit edit-detail-btn" type="button" style="margin:0 10px 0 55px;" data-toggle="modal" data-target="#myModal" data-id="{{$val->practitioner_id}}"></button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <div class="modal" tabindex="-1" id="myModal">
        <div class="modal-dialog max-dialog">

            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h2 class="text-center w-100 title" id="titlee"></h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade show" id="editHour" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-modal="true" >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal__form lg-header-form">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="x" aria-hidden="true">×</span>
                    </button>
                    <div class="lg-sg__form">
                        <div class="lg-sg__form-text">You can change the date only <span style="color: red;">12 hours in advance</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div id="myModal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <button type="button" class="position-absolute back-btn" data-dismiss="modal" aria-hidden="true" style="left: 20px; top: 16px">
                        <i class="fa fa-angle-left"></i> Back
                    </button>
                    <button type="button" class="close position-absolute" data-dismiss="modal" aria-hidden="true" style="right: 20px; top: 16px">×</button>
                    <div class="w-100 text-center mt-4">
                        <h3 id="myModalLabel" class="text-center title">Communication Tool</h3>
                        <div class="info-text text-center">
                            Please choose your preferred communication tool
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center my-5">
                    <div id="zoom" class="modal-body mx-4 flex-1">
                        <a href="#">
                            <img src="{{ asset('web_sayt/img/zoom-icon-logo.png') }}" alt="">
                            zoom
                        </a>
                    </div>
                    <div id="offline" class="modal-body mx-4 flex-1">
                        <a href="#">
                            <img src="{{ asset('web_sayt/img/Group 2013.svg') }}" alt="" style="width: 32px; height: 32px">
                            In-person visit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade show" id="editHour" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-modal="true" >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal__form lg-header-form">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="x" aria-hidden="true">×</span>
                    </button>
                    <div class="lg-sg__form">
                        <div class="lg-sg__form-text">You can change the date only <span style="color: red;">12 hours in advance</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('modal-list')
@endsection
{{--<form method="post" action="{{route('update-zoom-meeting',[app()->getLocale()])}}">--}}
{{--    {{csrf_field()}}--}}
{{--    <input type="submit">--}}
{{--</form>--}}
@section('style')
    <script>
        $(document).ready(function() {
            $(document).on('click','.edit-detail-btn', function()  {

                var calendar = null;

                var practitionerId = $(this).prev().val();
                var phone_number   = $(this).prev().prev().val();
                var last_name      = $(this).prev().prev().prev().val();
                var first_name     = $(this).prev().prev().prev().prev().val();
                var email          = $(this).prev().prev().prev().prev().prev().val();
                var service_id     = $(this).prev().prev().prev().prev().prev().prev().val();
                // var duration       = $(this).prev().prev().prev().prev().prev().prev().prev().val();
                //  var password       = $(this).prev().prev().prev().prev().prev().prev().prev().prev().val();
                var join_url       = $(this).prev().prev().prev().prev().prev().prev().prev().prev().prev().val();
                var serviceName    = $(this).prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().val();
                var user_email     = $(this).prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().val();

                var  meetings_id   = $(this).prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().val();

                // alert(meetings_id)


                // alert('title ' +serviceName)
                // alert('start ' +start)
                // alert('end ' +end)
                // alert('practitionerId ' +practitionerId)
                // alert('phone_number ' +phone_number)
                // alert('last_name ' +last_name)
                // alert('first_name ' +first_name)
                // alert('email ' +email)
                // alert('duration ' +duration)
                // alert('password ' +password)
                // alert('service_id ' +service_id)
                // alert(user_email)
                //alert('LiveDateTime ' +LiveDateTime)
                // alert('add_user_id ' +add_user_id)


                // if(service_id == null)

                //   service_id = '';


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
                    //events:'/en/Search/'+ practitionerId+'/'+service_id,
                    events:'/en/Search/'+ practitionerId+'/'+service_id+'/'+meetings_id,
                    selectable:true,
                    selectHelper: true,
                    editable:true,
                    timeFormat: 'hh:mm a',
                    eventDrop: function(event) {
                        // Generate password zoom
                        const characters =
                            "abcdefghijklmnopqrstuvwxyz0123456789";
                        const length = 6;
                        let password = "";

                        for (let i = 0; i < length; i++) {
                            const randomNum = Math.floor(Math.random() * characters.length);
                            password += characters[randomNum];
                        }


                        var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                        var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');

                        // Check live DateTime
                        var today = new Date();
                        var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
                        var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
                        var LiveDateTime = date + ' ' + time;


                        // compare
                        var d1 = new Date(start);
                        var d5 = new Date(end);
                        var d2 = new Date(LiveDateTime);
                        var diff_time = d5-d1;
                        var  duration = diff_time/(60000);

                        if (d1 >= d2) {

                            var id = event.id;
                            var user_id = event.user_id;
                            var meeting_id = event.meeting_id;

                            // submitTimeChanges(event.id);
                            $.ajax({
                                url: "/en/update-zoom-meeting",
                                type: "POST",
                                data: {
                                    title: serviceName,
                                    start: start,
                                    end: end,
                                    meeting_id: meeting_id,
                                    password: password,
                                    duration: duration,
                                    phone_number: phone_number,
                                    last_name: last_name,
                                    first_name: first_name,
                                    email:email,
                                    join_url:join_url,
                                    user_email:user_email,
                                    LiveDateTime:LiveDateTime,
                                    type: 'update'
                                },
                                success: function (response) {
                                    // calendar.fullCalendar('refetchEvents');
                                    // alert("Event Updated Successfully");
                                    //
                                    // if(response.Hour != null)
                                    // {
                                    //     alert(response.Hour)
                                    // }else{
                                    //     //alert("Event Updated Successfully");
                                    //     $("#update-success").modal('show');
                                    //
                                    //     // Close Select Meeting
                                    //     $("#myModal").modal('hide');
                                    // }
                                    calendar.fullCalendar('refetchEvents');
                                    console.log(response.select_error)

                                    if(response.select_error == null)
                                    {
                                        if(response.Hour != null)
                                        {
                                            //alert(response.Hour)
                                            // Show Error with back date
                                            $("#editHour").modal('show');

                                            // Close Select Meeting
                                            $("#myModal2").modal('hide');
                                        }else{
                                            // alert("Event Updated Successfully");

                                            // // Show Success Delete
                                            $("#update-success").modal('show');

                                            // Close Select Meeting
                                            $("#myModal").modal('hide');
                                        }
                                    }else{

                                        //alert(response.select_error);
                                        // Show Error No Repeat Service
                                        $("#select_error").modal('show');

                                        // Close Select Meeting
                                        $("#myModal2").modal('hide');
                                        //  alert(data.select_error);
                                    }

                                },
                                error: function(data) {
                                    // console.log(data)
                                    // alert('Your appointment has not been created');
                                    // Show Error No not been created
                                    $("#not-been-created").modal('show');

                                    // Close Select Meeting
                                    $("#myModal2").modal('hide');
                                }

                            })
                        }
                    },
                    eventRender: function(event, element,start, end, allDay) {

                            var us_id = "{{Auth::user()->id}}";
                            if(event['status'] == null) {

                                setTimeout(() => {
                                    element[0].setAttribute('class', 'activeNull  fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable');
                                    let x = document.querySelector('.fc-event-container');
                                    x.removeAttribute('class');
                                }, 10)

                            }else{

                                if(event['user_id'] == us_id && event['service_id'] == service_id)
                                {

                                    setTimeout(() => {
                                        element[0].setAttribute('class', ' activeUser fc-day-grid-event fc-h-event fc-event fc-start fc-end');
                                        element[0].setAttribute('active', 'activeUser');
                                        let div = document.getElementsByClassName('fc-content-col');
                                        let aArray = div[0].childNodes[1].childNodes;
                                        // console.log('5555555555',aArray[0]?.getAttribute('active'));
                                        for(let key of aArray) {
                                            if (key.getAttribute('active') === 'activeUser') {
                                                let aDiv = document.createElement('div');
                                                aDiv.setAttribute('class', 'fc-event-container');
                                                aDiv.appendChild(element[0])
                                                div[0].childNodes[1].appendChild(aDiv)
                                            }
                                        }
                                    }, 20)
                                }
                                if(event['user_id'] != us_id)
                                {
                                    setTimeout(() => {
                                        element[0].setAttribute('class', 'DeactiveUser fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable');
                                    }, 10)
                                }

                                if(event['service_id'] != service_id)
                                {
                                    setTimeout(() => {
                                        element[0].setAttribute('class', 'DeactiveUser fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable');
                                    }, 10)
                                }
                            }

                            // Display none booking date
                            setTimeout(() => {
                                $(".DeactiveUser" ).css( "display", "none" );
                                $(".DeactiveUser" ).next().css( "display", "none" );
                            }, 20);
                        },

                        eventClick:function(event,element)
                        {
                            // Check live DateTime
                            var today = new Date();
                            var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
                            var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
                            var LiveDateTime = date + ' ' + time;

                            var date1 = new Date(event.create);
                            var date2 = new Date(LiveDateTime);

                            var Difference_In_Time = date2.getTime() - date1.getTime();
                            let DiffHours = parseInt(Difference_In_Time/36e5);




                            var id         = event.id;
                            var user_id    = event.user_id;
                            var meeting_id = event.meeting_id;

                                @if(!empty(Auth::user()->id))

                            var AuthID = {{Auth::user()->id}}

                        if(AuthID === user_id) {

                            //Check 12 hours
                            if(DiffHours <= 12)
                            {
                                $("#editHour").modal("show");
                            }else{

                                // if (confirm("Are you sure you want to remove it?")) {
                                $.ajax({
                                    url: "{{ route('zoom-delete',app()->getLocale()) }}",
                                    type: "POST",
                                    data: {
                                        delete_id: id,
                                        delete_meeting_id:meeting_id,
                                        type: "delete"
                                    },
                                    success: function (response) {
                                        calendar.fullCalendar('refetchEvents');
                                        //alert("Event Deleted Successfully");

                                        // Show Success Delete
                                        $("#delete-success").modal('show');

                                        // Close Select Meeting
                                        $("#myModal").modal('hide');
                                    },
                                    error: function(returnval) {
                                        // alert('Your appointment has not been deleted');

                                        // Show Error Delete
                                        $("#delete-error").modal('show');

                                        // Close Select Meeting
                                        $("#myModal").modal('hide');
                                    }
                                })
                                // }
                            }
                        }else{
                            //alert('You can not delete this meeting because you did not add it.')

                            // Show Error Delete
                            $("#delete-did-not-add-it").modal('show');

                            // Close Select Meeting
                            $("#myModal").modal('hide');
                        }
                            @endif
                        },
                    eventColor: '#378006'
                });
            });
        });
    </script>

    <script src="{{ asset('web_sayt/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>

@endsection
