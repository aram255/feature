@section('style header')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
          integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
          crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('web_sayt/css/owl-carousel-min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/star-rating.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('web_sayt/maps/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('web_sayt/css/service.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/css/responsive.css') }}">
    {{--    calendar css--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />

    <style>
        .create__checkbox input.lg-sg__checkin + label::before {
            border: solid 1px #8BA9EE;
            background: white;
            border-radius: 3px;
        }

        [type="radio"]:checked,
        [type="radio"]:not(:checked) {
            position: absolute;
            left: -9999px;
        }
        [type="radio"]:checked + label,
        [type="radio"]:not(:checked) + label
        {
            position: relative;
            padding-left: 28px;
            cursor: pointer;
            line-height: 20px;
            display: inline-block;
            color: #666;
        }
        [type="radio"]:checked + label:before,
        [type="radio"]:not(:checked) + label:before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 18px;
            height: 18px;
            border: 1px solid #8BA9EE;
            border-radius: 100%;
            background: #fff;
        }
        [type="radio"]:checked + label:after,
        [type="radio"]:not(:checked) + label:after {
            content: '';
            width: 12px;
            height: 12px;
            background: #8BA9EE;
            position: absolute;
            top: 3px;
            left: 3px;
            border-radius: 100%;
            -webkit-transition: all 0.2s ease;
            transition: all 0.2s ease;
        }
        [type="radio"]:not(:checked) + label:after {
            opacity: 0;
            -webkit-transform: scale(0);
            transform: scale(0);
        }
        [type="radio"]:checked + label:after {
            opacity: 1;
            -webkit-transform: scale(1);
            transform: scale(1);
        }
    </style>

    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title', __('site.Home') )

@extends('app.layouts.app_home')


@section('content')
    <script>var body = document.body; body.classList.add("body");</script>

    <section>

        <div class="filter-area" style="display: flex;justify-content: space-between; width: 100%;">
            <div class="filter__content p-5">
                <div class="filter__header d-flex flex-row-reverse justify-content-between w-100">
                    <div class="find__form-settings">
                        <button class="settings-button ml-3" data-toggle="modal" data-target="#find__filter"><i
                                class="fas fa-sliders-h"></i></button>
                    </div>
                    <p class="filter__title">Filters</p>
                </div>
                <form id="filter-form" method="POST" action="{{route('search',[app()->getLocale()])}}">
                    @csrf
                    <div class="create__checkbox">
                        <p>Mode of delivery</p>

                        <input  type="checkbox" name="vir" value="virtual" id="virtual1" class="lg-sg__checkin delivery" @if(!empty($Virtual)) @if($Virtual == 'virtual') checked="checked"  @endif @endif /><label
                            for="virtual1">Virtual</label>
                        <input  type="checkbox" name="per" value="in_persion" id="person1" class="lg-sg__checkin delivery" @if(!empty($Person)) @if($Person == 'in_persion') checked="checked"  @endif @endif  /><label for="person1">
                            In Person</label>

                    </div>
                    <div class="user-info">
                        <p class="create-p">Language</p>
                        <select class="fadeIn" name="state" id="state">
                            <option value="">Select Language</option>
                            @foreach($Languages as $lang)
                                <option value="{{ $lang->id }}"  @if(!empty($Lang)) @if($Lang == $lang->id) selected="selected"  @endif @endif >{{ $lang->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="create__checkbox">
                        <p>Preferred Practitioner Gender</p>
                        <input  type="radio" name="gender" id="male" value="Male"  @if(!empty($Gender)) @if($Gender == 'Male') checked="checked"  @endif @endif  />
                        <label for="male" class="ml-2">Male</label>
                        <input  type="radio" name="gender"  id="female" value="Famale"  @if(!empty($Gender)) @if($Gender == 'Famale') checked="checked"  @endif @endif />
                        <label for="female" class="ml-2">Female</label>
                    </div>
                    <div class="create__checkbox">
                        <p>
                            <input  type="checkbox" name="yesNo" value="No" id="check" @if(!empty($Week)) @if($Week == 'No') checked="checked"  @endif @endif class="lg-sg__checkin delivery" />
                            <label for="check">Available appointments this week</label>
                        </p>

{{--                        <input type="radio" name="yesNo" value="Yes" id="yes" @if(!empty($Week)) @if($Week == 'Yes') checked="checked"  @endif @endif class="lg-sg__checkin">--}}
{{--                        <label for="yes" class="ml-2">Yes</label>--}}
{{--                        <input type="radio" name="yesNo" value="No"  id="no" @if(!empty($Week)) @if($Week == 'No') checked="checked"  @endif @endif class="lg-sg__checkin">--}}
{{--                        <label for="no" class="ml-2">No</label>--}}

{{--                                        @foreach($TegManagements as $key=>$TegManagement)--}}
{{--                                                <input  type="checkbox" name="teg_management[{{$TegManagement->id}}]" @if(!empty($Tag)) @if(in_array($TegManagement->id, $Tag)) checked="checked"  @endif @endif value="{{$TegManagement->id}}" class="lg-sg__checkin">--}}
{{--                                                <label for="remember">{{$TegManagement->name}}</label>--}}
{{--                                        @endforeach--}}
                </form>
            </div>
            {{-- Reset fild--}}
            <form  method="post" action="{{route('search',[app()->getLocale()])}}">
                @csrf
                <button type="submit" class="btn btn-warning" style="color: #212529;background-color: #FED638">Reset All Fields</button>
            </form><br>
        </div>


        <div class="container-filter mt-5 mt-md-0 pt-5 pt-md-0" style="display: flex;flex-direction: column;justify-content: space-around;">
            <!-- content -->

            <!-- filetr data -->

        @foreach($Practitioners as $k => $Result)

            @if(!empty($Result->count_meting)  and $Result->count_meting <= 7 and $Result->count_meting >= 1 and  $Week=='Yes' )
                @include('filter.practitioners-list')
            @elseif(isset($Result->count_meting)  and $Result->count_meting===0  and $Week=='No' )
                @include('filter.practitioners-list')
            @elseif(!empty($Result->count_meting)  and $Result->count_meting <= 7 and $Result->count_meting >= 1 and $Week=='Yes' and  isset($Result->email))
                @include('filter.practitioners-list')
            @elseif(isset($Result->count_meting)  and $Result->count_meting===0  and $Week=='No' and  isset($Result->email))
                @include('filter.practitioners-list')
            @elseif(empty($Result->count_meting) and isset($Result->email))
                @include('filter.practitioners-list')
            @endif

        @endforeach

        <!-- filetr data -->



            <!-- content -->
            @if(!empty($Result))

                <div class="pagination-filter mt-5" >
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="{{ url()->current().$Practitioners->previousPageUrl() }}" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>

                            <li class="page-item"><a class="page-link" href="{{ url()->current().'?page='.$Practitioners->hasPages() }}">{{ $Practitioners->hasPages() }}</a></li>

                            <li class="page-item"><a class="page-link" href="{{ url()->current().'?page='.$Practitioners->currentPage() }}">{{ $Practitioners->currentPage() }}</a></li>

                            <li class="page-item"><a class="page-link" href="{{ url()->current().'?page='.$Practitioners->lastPage() }}">{{ $Practitioners->lastPage() }}</a></li>

                            <li class="page-item">
                                <a class="page-link" href="{{ url()->current().$Practitioners->nextPageUrl() }}" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            @endif
        </div>
    </section>


    {{--    Service Modal--}}
    @foreach($Practitioners as $Result)

        <!-- The Modal service -->
        @if(!empty($Result->count_meting)  and $Result->count_meting <= 7 and $Result->count_meting >= 1 and  $Week=='Yes' )
            @include('filter.service-list')
        @elseif(isset($Result->count_meting)  and $Result->count_meting===0  and $Week=='No' )
            @include('filter.service-list')
        @elseif(!empty($Result->count_meting)  and $Result->count_meting <= 7 and $Result->count_meting >= 1 ||  isset($Result->email))
            @include('filter.service-list')
        @elseif(isset($Result->count_meting)  and $Result->count_meting===0  and $Week=='No' ||  isset($Result->email))
            @include('filter.service-list')
        @elseif(empty($Result->count_meting) and isset($Result->email))
            @include('filter.service-list')
        @endif


    @endforeach

    {{--    full calendar modal--}}
    <div class="modal" tabindex="-1" id="myModal">
        <div class="modal-dialog max-dialog">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h2 class="text-center w-100 title" id="titlee">Service Name</h2>
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
    <div id="myModal2" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                            Please choose your preferred communication tool.
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
                        <div class="lg-sg__form-text">You can change the date only <span style="color: red;">12 hours in advance.</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

  @include('modal-list')



@endsection

@section('style')
    <script type="text/javascript" src="{{ asset('web_sayt/js/jquery.js') }}"></script>
    <script src="{{ asset('web_sayt/maps/index.js') }}"></script>

    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    {{--     Calendar--}}
    <script>
        $(document).ready(function() {
            $('input[type="radio"],input[type="checkbox"],#state').on('change', function () {
                $(this).closest("form").submit();
            });
            $('.find__form-settings').click(function () {
                $(".filter__content").toggleClass("active")
            })
        });
    </script>

    <script>
        $(document).on('click','.detail-btn', function()  {
            // Hidden service modal
            $(".modal-service").modal('hide');


            var practitionerId = $(this).attr('data-id');
            var calendar = null;

            var practitionerID = $(this).prev().val();
            var phone_number   = $(this).prev().prev().val();
            var last_name      = $(this).prev().prev().prev().val();
            var first_name     = $(this).prev().prev().prev().prev().val();
            var email          = $(this).prev().prev().prev().prev().prev().val();
            var service_id     = $(this).prev().prev().prev().prev().prev().prev().val();
            var serviceName    = $(this).prev().prev().prev().prev().prev().prev().prev().val();
            var user_email     = $(this).prev().prev().prev().prev().prev().prev().prev().prev().val();

            $('#titlee').text(serviceName);
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
                //events:'/en/Search/'+ practitionerId+'/'+service_id,
                events:'/en/Search/'+ practitionerId,
                selectable:true,
                selectHelper: true,
                select:function(start, end, allDay,event,element,view)
                {

                    // Generate password zoom
                    const characters =
                        "abcdefghijklmnopqrstuvwxyz0123456789";
                    const length = 6;
                    let password = "";

                    for (let i = 0; i < length; i++) {
                        const randomNum = Math.floor(Math.random() * characters.length);
                        password += characters[randomNum];
                    }



                    start = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');
                    end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');


                    // // Check live DateTime
                    var today = new Date();
                    var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
                    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
                    var LiveDateTime = date + ' ' + time;

                    // // compare
                    var d1 = new Date(start);
                    var d5 = new Date(end);
                    var d2 = new Date(LiveDateTime);
                    var diff_time = d5-d1;


                    if (d1 >= d2) {
                        // Show Select meeting Online Or Offline
                        $("#myModal2").modal("show");

                        // Close Calendar
                        $("#myModal").modal('hide');

                        $("#zoom").click(function () {

                            var  duration = diff_time/(60000);
                                @if(isset(Auth::user()->id))
                            var add_user_id = "{{Auth::user()->id}}";
                            @endif

                            $.ajax({
                                url: "{{ route('add-zoom-meeting',app()->getLocale()) }}",
                                type: "POST",
                                data: {
                                    title: serviceName,
                                    start: start,
                                    end: end,
                                    practitionerId: practitionerId,
                                    add_user_id: add_user_id,
                                    phone_number: phone_number,
                                    last_name: last_name,
                                    first_name: first_name,
                                    email: email,
                                    duration: duration,
                                    password: password,
                                    practitionerID: practitionerID,
                                    service_id: service_id,
                                    LiveDateTime:LiveDateTime,
                                    user_email:user_email,
                                    type: 'add'
                                },
                                success: function (data) {
                                    calendar.fullCalendar('refetchEvents');
                                    console.log(data.select_error)

                                    if(data.select_error == null)
                                    {
                                        if(data.NoRepeatService != null)
                                        {
                                          // alert(data.NoRepeatService)

                                            // Show Error No Repeat Service
                                            $("#error-NoRepeatService").modal('hide');

                                            // Close Select Meeting
                                            $("#myModal2").modal('hide');
                                        }else{
                                            // Show Success Meeting
                                            $('#succes-meeting').modal('show');

                                            // Close Select Meeting
                                            $("#myModal2").modal('hide');
                                            //alert("Event Created Successfully");
                                        }
                                    }else{
                                        // Show Error No Repeat Service
                                        $("#select_error").modal('show');

                                        // Close Select Meeting
                                        $("#myModal2").modal('hide');
                                        //  alert(data.select_error);
                                    }

                                },
                                error: function(data) {
                                   // alert('Your appointment has not been created');

                                    // Show Error No not been created
                                    $("#not-been-created").modal('show');

                                    // Close Select Meeting
                                    $("#myModal2").modal('hide');
                                }
                            });
                        });
                    }else{
                       // alert('You can not make appointments with back date.');

                        // Show Error with back date
                        $("#with-back-date").modal('show');

                        // Close Select Meeting
                        $("#myModal2").modal('hide');
                    }
                },
                eventRender: function(event, element,start, end, allDay) {

                        @if(isset(Auth::user()->id))
                    var us_id = "{{Auth::user()->id}}";
                    if (event['status'] == null) {

                        setTimeout(() => {
                            element[0].setAttribute('class', 'activeNull  fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable');
                            let x = document.querySelector('.fc-event-container');
                            x.removeAttribute('class');

                        }, 10)

                    } else {

                        if (event['user_id'] == us_id && event['service_id'] == service_id) {

                            setTimeout(() => {
                                element[0].setAttribute('class', ' activeUser fc-day-grid-event fc-h-event fc-event fc-start fc-end');
                                element[0].setAttribute('active', 'activeUser');
                                let div = document.getElementsByClassName('fc-content-col');
                                let aArray = div[0].childNodes[1].childNodes;
                                // console.log('5555555555',aArray[0]?.getAttribute('active'));
                                for (let key of aArray) {
                                    if (key.getAttribute('active') === 'activeUser') {
                                        let aDiv = document.createElement('div');
                                        aDiv.setAttribute('class', 'fc-event-container');
                                        aDiv.appendChild(element[0])
                                        div[0].childNodes[1].appendChild(aDiv)
                                    }
                                }
                            }, 20)
                        }
                        if (event['user_id'] != us_id) {
                            setTimeout(() => {
                                element[0].setAttribute('class', 'DeactiveUser fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable');
                            }, 10)
                        }

                        if (event['service_id'] != service_id) {
                            setTimeout(() => {
                                element[0].setAttribute('class', 'DeactiveUser fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable');
                            }, 10)
                        }
                    }
                    @endif



                    // Display none booking date
                    setTimeout(() => {
                        $(".DeactiveUser" ).css( "display", "none" );
                        $(".DeactiveUser" ).next().css( "display", "none" );
                    }, 20);
                },

                eventClick:function(event)
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


                    // fc-event-container

                    if(AuthID === user_id) {
                        if(DiffHours <= 12)
                        {
                            $("#editHour").modal("show");
                        }else {

                            // if (confirm("Are you sure you want to remove it?")) {

                                $.ajax({
                                    url: "{{ route('zoom-delete',app()->getLocale()) }}",
                                    type: "POST",
                                    data: {
                                        delete_id: id,
                                        delete_meeting_id: meeting_id,
                                        type: "delete"
                                    },
                                    success: function (response) {
                                        calendar.fullCalendar('refetchEvents');
                                        // alert("Event Deleted Successfully");

                                        // Show Success Delete
                                        $("#delete-success").modal('show');

                                        // Close Select Meeting
                                        $("#myModal").modal('hide');
                                    },
                                    error: function (returnval) {
                                      //  alert('Your appointment has not been deleted');

                                        // Show Error Delete
                                        $("#delete-error").modal('show');

                                        // Close Select Meeting
                                        $("#myModal").modal('hide');
                                    }
                                })
                          //  }
                        }
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
    <script type="text/javascript" src="{{ asset('web_sayt/js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('web_sayt/js/star-rating.js') }}"></script>
    <script src="{{ asset('web_sayt/js/star-run.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_sayt/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('web_sayt/js/carusel.js') }}"></script>
{{--    <script type="text/javascript" src="{{ asset('web_sayt/js/script.js') }}"></script>--}}
    <script type="text/javascript" src="{{ asset('web_sayt/js/readMoreJS.min.js') }}"></script>
    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDtOVd66AerMgd0A-mwKEFqdBQTrKGfngc&callback=initMap&libraries=places&v=weekly"
        async
    ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <script src="{{ asset('web_sayt/js/filter.js') }}"></script>

@endsection
