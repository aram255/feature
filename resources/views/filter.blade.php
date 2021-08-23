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

    {{--    calendar script--}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />

    <style>
        .create__checkbox input.lg-sg__checkin + label::before {
            border: solid 1px #8BA9EE;
            background: white;
            border-radius: 3px;
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
                        <input  type="radio" name="gender" id="male" value="Male" class="lg-sg__checkin"  @if(!empty($Gender)) @if($Gender == 'Male') checked="checked"  @endif @endif  />
                        <label for="male" class="ml-2">Male</label>
                        <input  type="radio" name="gender"  id="female" value="Famale" class="lg-sg__checkin" @if(!empty($Gender)) @if($Gender == 'Famale') checked="checked"  @endif @endif />
                        <label for="female" class="ml-2">Female</label>
                    </div>
                    <div class="create__checkbox">
                        <p>Avalible appointments this week</p>

                        <input type="radio" name="yesNo" value="Yes" id="yes" @if(!empty($Week)) @if($Week == 'Yes') checked="checked"  @endif @endif class="lg-sg__checkin">
                        <label for="yes" class="ml-2">Yes</label>
                        <input type="radio" name="yesNo" value="No"  id="no" @if(!empty($Week)) @if($Week == 'No') checked="checked"  @endif @endif class="lg-sg__checkin">
                        <label for="no" class="ml-2">No</label>

                    {{--                    @foreach($TegManagements as $key=>$TegManagement)--}}
                    {{--                            <input  type="checkbox" name="teg_management[{{$TegManagement->id}}]" @if(!empty($Tag)) @if(in_array($TegManagement->id, $Tag)) checked="checked"  @endif @endif value="{{$TegManagement->id}}" class="lg-sg__checkin">--}}
                    {{--                            <label for="remember">{{$TegManagement->name}}</label>--}}
                    {{--                    @endforeach--}}
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

        @foreach($Practitioners as $Result)

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

    <div class="modal" tabindex="-1" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
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


            var practitionerId = $(this).attr('data-id');
            var calendar = null;

            var practitionerID = $(this).prev().val();
            var phone_number   = $(this).prev().prev().val();
            var last_name      = $(this).prev().prev().prev().val();
            var first_name     = $(this).prev().prev().prev().prev().val();
            var email          = $(this).prev().prev().prev().prev().prev().val();
            var service_id     = $(this).prev().prev().prev().prev().prev().prev().val();
            var durationn      = $(this).prev().prev().prev().prev().prev().prev().prev().val();
            var password       = $(this).prev().prev().prev().prev().prev().prev().prev().prev().val();
            var join_url       = $(this).prev().prev().prev().prev().prev().prev().prev().prev().prev().val();

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
                events:'/en/Search/'+ practitionerId+'/'+service_id,
                selectable:true,
                selectHelper: true,
                select:function(start, end, allDay)
                {

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

                        var title       = prompt('Event Title:');
                        var pasword     = prompt('Event password:');
                        var duration    = prompt('Event Duration:');
                            @if(isset(Auth::user()->id))
                        var add_user_id = "{{Auth::user()->id}}";
                            @endif





                        if(title !== "" && pasword !== "" && duration !== ""){

                            $.ajax({
                                url: "{{ route('add-zoom-meeting',app()->getLocale()) }}",
                                type: "POST",
                                data: {
                                    title: title,
                                    start: start,
                                    end: end,
                                    practitionerId: practitionerId,
                                    add_user_id: add_user_id,
                                    phone_number: phone_number,
                                    last_name: last_name,
                                    first_name: first_name,
                                    email: email,
                                    duration: duration,
                                    password: pasword,
                                    practitionerID: practitionerID,
                                    service_id: service_id,
                                    LiveDateTime:LiveDateTime,
                                    type: 'add'
                                },
                                success: function (data) {
                                    calendar.fullCalendar('refetchEvents');
                                    alert("Event Created Successfully");
                                    console.log(data)
                                },
                                error: function(returnval) {
                                    alert('Your appointment has not been created');
                                }
                            });

                        }else{
                            alert('Empty');
                        }
                    }else{
                        alert('You can not make appointments with back date.');
                    }

                },
                editable:true,
                // eventDrop: function(event) {
                //
                //     var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                //     var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
                //
                //     // Check live DateTime
                //     var today = new Date();
                //     var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
                //     var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
                //     var LiveDateTime = date + ' ' + time;
                //
                //
                //     // compare
                //
                //     var d1 = new Date(start);
                //     var d2 = new Date(LiveDateTime);
                //
                //     if (d1 >= d2) {
                //
                //         var id = event.id;
                //         var user_id = event.user_id;
                //         var meeting_id = event.meeting_id;
                //         var duration = event.duration;
                //         var password = event.password;
                //         var title = event.title;
                //
                //
                //
                //         if (confirm("Do you want to change your meeting details?")) {
                //
                //             var title = prompt('Edit Title:', title);
                //             var password = prompt('Edit Password:', password);
                //             var duration = prompt('Edit Title:', duration);
                //
                //             // submitTimeChanges(event.id);
                //             $.ajax({
                //                 url: "/en/update-zoom-meeting",
                //                 type: "POST",
                //                 data: {
                //                     title: title,
                //                     start: start,
                //                     end: end,
                //                     meeting_id: meeting_id,
                //                     password: password,
                //                     duration: duration,
                //                     phone_number: phone_number,
                //                     last_name: last_name,
                //                     first_name: first_name,
                //                     email:email,
                //                     join_url:join_url,
                //                     type: 'update'
                //                 },
                //                 success: function (response) {
                //                     calendar.fullCalendar('refetchEvents');
                //                     alert("Event Updated Successfully");
                //                 }
                //             })
                //         }
                //     }else{
                //         alert('You can not make appointments with back date.');
                //     }
                //
                // },

                eventClick:function(event)
                {
                    var id         = event.id;
                    var user_id    = event.user_id;
                    var meeting_id = event.meeting_id;


                        @if(!empty(Auth::user()->id))

                    var AuthID = {{Auth::user()->id}}


                if(AuthID === user_id) {

                    if (confirm("Are you sure you want to remove it?")) {

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
                                alert("Event Deleted Successfully");
                            },
                            error: function(returnval) {
                                alert('Your appointment has not been deleted');
                            }
                        })
                    }
                }else{
                    alert('You can not delete this meeting because you did not add it.')
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
        <script type="text/javascript" src="{{ asset('web_sayt/js/script.js') }}"></script>
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
