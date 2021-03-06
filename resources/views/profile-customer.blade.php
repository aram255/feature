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
    <script src="{{ asset('web_sayt/js/jquery.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('web_sayt/maps/style.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        html, body {
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
            font-size: 14px;
        }

        #calendar {
            max-width: 1100px;
            margin: 40px auto;
        }

        .fc-timegrid-event .fc-event-resizer {
            color: #fff;
            text-align: center;
            font-family: monospace;
        }
        .fc-timegrid-event:hover .fc-event-resizer:after {
            content: "=";
            display: inline-block;
            vertical-align: top;
            line-height: 0px;
        }

        .activeNull{
            background-color: #569e66 !important;
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
            <div class="profile-customer">
                <div class="profile-customer__blok1 nl">
                    <div class="profile-customer__blok1-info">
                        <div class="person__info-cont1">
                            <div class="edit-profile__contact-img" style="border-radius:0;">
                                <label for="img-file"><img class="upload info_imgg" src="@if(auth()->user()->img){{ asset('web_sayt/img_customer/'.auth()->user()->img) }} @else {{ asset('web_sayt/img/img-file.svg') }}@endif" alt=""></label>
                            </div>
                            <div class="person__info-name">
                                <span class="person-customer-name">{{auth()->user()->first_name }} {{auth()->user()->last_name }}</span>
                                <span class="edit-pen"><a href="{{route('edit-profile-customer',[app()->getLocale()])}}"><img src="{{ asset('web_sayt/img/edit-pen.svg') }}" alt=""></a></span>
                            </div>
                            <div class="person-customer-my-pay"><a href="{{route('my-appointments-customer',[app()->getLocale(),'id'=>1])}}">My Appointments</a></div>
                            <div class="person-customer-my-pay">My payments</div>
                            <div class="person-customer__payments">
                                <div class="person-customer__payments-phone d-none">
                                    <p class="person-customer-number">Phone Number</p>
                                    <p class="person-customer-tel">{{auth()->user()->phone_number }}</p>
                                </div>
                                <div class="person-customer__payments-email d-none">
                                    <p class="person-customer-email">Email</p>
                                    <p class="person-customer-email-addres">{{auth()->user()->email }}</p>
                                </div>
                                <div class="person-customer__payments-methods " onclick="customerPayment()">
                                    <div class="person-customer__payments-methods-a">
                                        Payment Methods <i class="fa fa-caret-down"></i>
                                    </div>
                                    <div class="person-customer__payments-methods-dropdown d-none">
                                        <p class="x person-customer-x" aria-hidden="true">&times;</p>
                                        <div class="person-customer__payments-methods-dropdown-cards">
                                            <input type="radio">
                                            <img class="card-category" src="{{ asset('web_sayt/img/cards-visa.svg') }}" alt="">
                                            <div class="person-customer__payments-methods-dropdown-cards-number">
                                                <p>**** **** **** 4578</p>
                                                <p>Amex</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="person-customer__payments-support">
                                    <a class="person-customer__payments-support-a" href="">Support <img
                                            class="person-customer__payments-support-img" src="{{ asset('web_sayt/img/headphones.svg') }}" alt="">
                                    </a>
                                </div><br>
                                @if(!empty(Auth::user()->api_secret))
                                <div class="person-customer__payments-support">
                                    <a class="person-customer__payments-support-a" href="{{route('meetings-list-zoom',[app()->getLocale()])}}">My Meetings List
                                    </a>
                                </div>
                                 @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="profile-customer__blok2 nl">
                    <div class="profile-customer-my-appointments">
                        <div class="d-flex align-items-center justify-content-between">
                                <div class="my-appointments__title">
                                    <p class="mr-5 mb-0">My Appointments</p>
                                </div>
                                <div>
                                    <a href="#" class="fs-18">Complete</a> | <a href="#" class="fs-18">In Process</a>
                                </div>
                            </div>

                        @if(count($InProcess)>0)
                            @foreach($InProcess as $InProcessVal)

                              <div class="my-appointments__complete-process">
                                <div class="my-appointments__complete-process-content">
                                    <div class="my-appointments__complete-process-content-flex">
                                        <div class="my-appointments-person__info">
                                            <div class="my-appointments-person__info-cont1 mr-4">
                                                <div style="width: 150px; height: 150px; overflow: hidden;">
                                                    <img class="my-appointments-person__info-img w-100" src="{{ asset('web_sayt/img_practitioners/'.$InProcessVal->img) }}" alt="">
                                                </div>
                                            </div>
                                            <div class="my-appointments-person__info-cont2">
                                                <div class="my-appointments-person__info-name">{{$InProcessVal->first_name}} {{$InProcessVal->last_name}}</div>
                                                <div class="my-appointments-person__info-specialist">{{$InProcessVal->service_name}}</div>
                                                <div class="my-appointments-person__info-data">{{date('M-jS, Y  h:i A', strtotime($InProcessVal->start)) }}</div>
                                            </div>
                                        </div>

                                        <button
                                            class="profile-customer__my-appointments-button-edit my-appointments-person__complete-process-button btn bg-blue-white ">
                                            <a target="_blank" href="{{route('customer-type-form-practitioner-view',[app()->getLocale(),'id'=>$InProcessVal->type_form_id,'meeting_id'=>1])}}">Fill
                                                Intake Form</a>
                                        </button>


                                        <div class="profile-customer__my-appointments my-appointments-person__complete-process">
                                            <div class="profile-customer__my-appointments-time my-appointments-person__complete-process-time">{{$InProcessVal->duration}} Mins
                                                Consultation</div>
                                            <div class="profile-customer__my-appointments-session  my-appointments-person__complete-process-session">
                                                <a target="_blank" href="{{$InProcessVal->join_url}}">Join session</a>
                                            </div>

                                            <div class="profile-customer__my-appointments-button-fill">
                                                <input type="hidden"  class="user_email" value="@if(isset(Auth::user()->email)){{Auth::user()->email}}@endif">
                                                <input type="hidden" name="service_name_myapp" class="service_name_appointments" value="{{$InProcessVal->service_name}}">
                                                <input type="hidden" name="join_url" value="{{$InProcessVal->create}}">
                                                <input type="hidden" name="join_url" value="{{$InProcessVal->join_url}}">
                                                <input type="hidden" name="password" value="{{$InProcessVal->password}}">
                                                <input type="hidden" name="duration" value="{{$InProcessVal->duration}}">
                                                <input type="hidden" name="service_id" value="{{$InProcessVal->service_id}}">
                                                <input type="hidden" name="email" value="{{$InProcessVal->email}}">
                                                <input type="hidden" name="first_name" value="{{$InProcessVal->first_name}}">
                                                <input type="hidden" name="last_name" value="{{$InProcessVal->last_name}}">
                                                <input type="hidden" name="phone_number" value="{{$InProcessVal->phone_number}}">
                                                <input type="hidden" name="practitioner_id" value="{{$InProcessVal->id}}">

                                                @php
                                                    $date1 = $InProcessVal->create;
                                                    $date2 = now()->toDateTimeString();
                                                    $timestamp1 = strtotime($date1);
                                                    $timestamp2 = strtotime($date2);
                                                    $hour = abs($timestamp2 - $timestamp1)/(60*60);
                                                     $ChekHour = number_format($hour);
                                                    @endphp

                                      <button class="profile-customer__my-appointments-button my-appointments-person__complete-process-button btn bg-yellow detail-btn" data-toggle="modal"
                                               data-target="<?php if($ChekHour <= 12){echo "#editHour"; }else{echo "#myModal";}?>"
                                              data-id="{{ $InProcessVal->id }}">Edit
                                        </button>

                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @endif


                        @if(count($InProcess)>0)
                            {{ $InProcess->links() }}
                        @endif
                    </div>

                    <div class="profile-customer-favorites">
                        <div class="profile-customer-favorites__title">
                            <p>Favorites</p>
                        </div>
                        @foreach($PractitionerFavorite as $key => $PractitionerFavoriteVal)
                           <div class="find-result">
                            <div class="person">
                                <div class="person__info">
                                    <div class=" d-flex flex-column">
                                        @php $rt = floor($Rate[$key]);  @endphp
                                        <div class="person__info-cont1" style="width: 150px; height: 150px; overflow: hidden;">
                                            <img class="my-appointments-person__info-img w-100" src="{{ asset('web_sayt/img_practitioners/'.$PractitionerFavoriteVal->img) }}" alt="">
                                        </div>
                                        <div>
                                            <div class="person__info-rating">
                              <span class="gl-star-rating gl-star-rating--ltr" data-star-rating="">
                                  <select class="star-rating">
                                       @for($rt; $rt >=1 ; $rt--)
                                          <option value="{{$rt}}">{{$rt}}.0</option>
                                      @endfor
                                 </select>
                                  <span class="gl-star-rating--stars s50" role="tooltip" aria-label="5.0">
                                        @for($r = 1; $r <= $rt; $r++)
                                          <span  data-value="{{$r}}" class="gl-selected"></span>
                                      @endfor
                                   </span>
                              </span>
                                            </div>
                                            <p class="perion__info-session">{{$SessionCountFavorite[$key]}} <span>Sessions</span></p>
                                            <a href=""   class="btn bg-yellow" data-toggle="modal" data-target="#service-modal{{$PractitionerFavoriteVal->partit_id}}">Book</a>
                                        </div>
                                    </div>
                                    <div class="person__info-cont2">
                                        <div class="person__info-name">{{$PractitionerFavoriteVal->first_name}} {{$PractitionerFavoriteVal->last_name}}</div>
                                        <div class="person__info-specialist">

                                            @foreach($SpecialitiesFavorite[$key] as $ValSpecialitiesFavorite)
                                                {{$ValSpecialitiesFavorite->title}}
                                            @endforeach
                                        </div>
                                        <div class="person__info-skin">
                                            @foreach($Teg->where("practitioner_id",$PractitionerFavoriteVal->partit_id) as $TegVal)
                                             <span class="person__info-skin-tag">{{$TegVal->name}}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                        <div class="person__info-heart active active-pr" id="{{$PractitionerFavoriteVal->partit_id}}"></div>
                                </div>
                                <div class="person__content">
                                    <ul class="person__content-nav">
                                        <li class="borderbg"><a class="person__content-nav-category active">Video</a></li>
                                        <li class="borderbg"><a class="person__content-nav-category">Intro</a></li>
                                    </ul>

                                    <div class="person__content-video">
                                        <div class="video_wrapper video_wrapper_full js-videoWrapper">
                                            <iframe class="videoIframe js-videoIframe" src="" frameborder="0" allowtransparency="true"
                                                    allowfullscreen="" data-src="{{ asset('web_sayt/video_practitioners/'.$PractitionerFavoriteVal->video) }}"></iframe>
                                            <button class="videoPoster js-videoPoster"></button>
                                        </div>
                                    </div>
                                    <div class="person__content-intro ds-none">
                                        <p>{{$PractitionerFavoriteVal->description}}</p>
                                    </div>


                                    <div class="profile-customer-favorites-social">
                                        <a class="profile-customer-favorites-social-a" href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a class="profile-customer-favorites-social-a" href="#"><i class="fab fa-instagram"></i></a>
                                        <a class="profile-customer-favorites-social-a" href="#"><i class="fab fa-linkedin-in"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                            @include('profile-customer.service-list')
                        @endforeach
                    </div>
                    <div class="profile-customer-reviews">
                        <div class="profile-customer-reviews__title">
                            <p>My Reviews</p>
                        </div>

               @if(count($Review)>0)
                    @foreach($Review as $keyReview => $ReviewVal)

                        <div class="profile-customer-reviews-cont">
                            <div class="profile-customer-reviews-cont__info">
                                <div class="profile-customer-reviews-cont__info-cont1">
                                    <div style="width: 150px; height: 150px; overflow: hidden; ">
                                        <img class="profile-customer-reviews-cont__info-img w-100" src="{{asset('web_sayt/img_practitioners/'.$ReviewVal->img)}}" alt="">
                                    </div>
                                </div>

                                <div class="profile-customer-reviews-cont__info-cont2">
                                    <div class="profile-customer-reviews-cont__info-name">
                                        <p>{{$ReviewVal->first_name}} {{$ReviewVal->last_name}}</p>
                                        <div class="profile-customer-reviews-cont__info-name-rat-clock">
                                            <div class="profile-customer-cont-rat">
                                 <span class="gl-star-rating gl-star-rating--ltr " data-star-rating="">
                                    <select class="star-rating">

                                     @for($ReviewVal->rate; $ReviewVal->rate >=1 ; $ReviewVal->rate--)
                                            <option value="{{$ReviewVal->rate}}">{{$ReviewVal->rate}}.0</option>
                                        @endfor
                                    </select>
                                    <span class="gl-star-rating--stars s50" role="tooltip" aria-label="">
                                       @for ($i = 0; $i < $ReviewVal->rate; $i++)
                                            <span data-index="{{$i}}" data-value="{{$i}}" class="gl-active"
                                                  style="font-size: 28px;"></span>
                                       @endfor
                                    </span>
                                 </span>
                                            </div>
                                            <div class="profile-customer-cont-clock">
                                                <img src="{{ asset('web_sayt/img/clock.svg') }}" alt="" srcset="">
                                                <span class="reviews-clock-data"> {{ date('M-d',strtotime($ReviewVal->created_at)) }}</span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="profile-customer-reviews-cont__info-specialist">

                                        @foreach($SpecialitiesReview[$keyReview] as $ValSpecialitiesReview)
                                            {{$ValSpecialitiesReview->title}}
                                        @endforeach
                                    </div>
                                    <div class="profile-customer-reviews-cont__info-text">
                                        {{$ReviewVal->description}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
               @endif
                    </div>
                    <div class="profile-customer__button">
                        <a href="#" class="btn bg-yellow">View All</a>
                    </div>
                </div>
            </div>
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
                <div class="modal__form lg-header-form modal__formm lg-header-formm">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="x" aria-hidden="true">??</span>
                    </button>
                    <div class="lg-sg__form">
                        <div class="lg-sg__form-text">You can change the date only <span style="color: red;">12 hours in advance</span></div>
                    </div>
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
                    <button type="button" class="close position-absolute" data-dismiss="modal" aria-hidden="true" style="right: 20px; top: 16px">??</button>
                    <div class="w-100 text-center mt-4">
                        <h3 id="myModalLabel" class="text-center title">Communication Tool</h3>

                        <div class="info-text text-center">
                            Please choose your preferred communication tool
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-column my-5">
                    <div class="d-flex flex-row">
                        <div id="zoom" class="modal-body mx-4 flex-1">
                            <a href="#">
                                <img src="{{ asset('web_sayt/img/zoom-icon-logo.png') }}" alt="">
                                zoom
                            </a>
                        </div>
                        <div id="open_map" class="modal-body mx-4 flex-1">
                            <a href="#">
                                <img src="{{ asset('web_sayt/img/Group 2013.svg') }}" alt="" style="width: 32px; height: 32px">
                                In-person visit
                            </a>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>






    <div id="open_map_modal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <button type="button" class="position-absolute back-btn" data-dismiss="modal" aria-hidden="true" style="left: 20px; top: 16px">
                        <i class="fa fa-angle-left"></i> Back
                    </button>
                    <button type="button" class="close position-absolute" data-dismiss="modal" aria-hidden="true" style="right: 20px; top: 16px">??</button>
                    <div class="w-100 text-center mt-4">
                        <h3 id="myModalLabel" class="text-center title">View location on map</h3>

                        <div class="info-text text-center"  style="display: flex;justify-content: center;align-items: center">
                            <img src="{{ asset('web_sayt/img/map-pin.svg') }}" alt="" style="width: 15px; height: 18px;margin-right: 10px">

                            <span>3056 W County Line Rd, Littleton, CO 80129, United States</span>
                        </div>
                    </div>
                </div>
                <div id="map" style="width:100%;max-width: 924px;height: 453px;margin:0 auto;border-radius: 10px"></div>
                <div style="display:flex;justify-content: flex-end;margin-right: 10px">
                    <a href="#" class="btn bg-yellow" style="margin:20px 0;border-radius: 10px;width: 124px;" id="offline">Done</a>
                </div>

                <div id="infowindow-content">
                    <span id="place-name" class="title"></span><br />
                    <span id="place-address"></span>
                </div>
            </div>
        </div>
    </div>
    </div>



    @include('modal-list')
@endsection

@section('style')



    <script src="{{ asset('web_sayt/maps/map.js') }}"></script>
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
            var join_url       = $(this).prev().prev().prev().prev().prev().prev().prev().prev().prev().val();
            var serviceName    = $(this).prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().val();
            var user_email     =  $(this).prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().val();

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
                events:'/en/Search/'+ practitionerId,
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



                        if(join_url === "")
                        {


                            $.ajax({
                                url: "/en/update-offline-meeting",
                                type: "POST",
                                data: {
                                    title: serviceName,
                                    start: start,
                                    end: end,
                                    id: id,
                                    duration: duration,
                                    phone_number: phone_number,
                                    last_name: last_name,
                                    first_name: first_name,
                                    email:email,
                                    user_email:user_email,
                                    LiveDateTime:LiveDateTime,
                                    type: 'update'
                                },
                                success: function (response) {

                                    calendar.fullCalendar('refetchEvents');


                                    if(response.select_error == null)
                                    {
                                        if(response.Hour != null)
                                        {
                                            alert(response.Hour)
                                        }else{
                                            // Show Success Delete
                                            $("#update-success").modal('show');

                                            // Close Select Meeting
                                            $("#myModal").modal('hide');
                                        }
                                    }else{
                                        // Show Error No Repeat Service
                                        $("#select_error").modal('show');

                                        // Close Select Meeting
                                        $("#myModal2").modal('hide');
                                    }

                                },
                                error: function(data) {
                                    // Show Error No not been created
                                    $("#not-been-created").modal('show');

                                    // Close Select Meeting
                                    $("#myModal2").modal('hide');
                                }

                            })
                        }

                        // Zoom update meeting
                            $.ajax({
                                url: "/en/update-zoom-meeting",
                                type: "POST",
                                data: {
                                    title: serviceName,
                                    start: start,
                                    end: end,
                                    meeting_id: meeting_id,
                                    duration: duration,
                                    phone_number: phone_number,
                                    last_name: last_name,
                                    first_name: first_name,
                                    email:email,
                                    user_email:user_email,
                                    LiveDateTime:LiveDateTime,
                                    type: 'update'
                                },
                                success: function (response) {

                                    calendar.fullCalendar('refetchEvents');
                                    console.log(response.select_error)

                                    if(response.select_error == null)
                                    {
                                        if(response.Hour != null)
                                        {
                                            alert(response.Hour)
                                        }else{
                                            // Show Success Delete
                                            $("#update-success").modal('show');

                                            // Close Select Meeting
                                            $("#myModal").modal('hide');
                                        }
                                    }else{
                                        // Show Error No Repeat Service
                                        $("#select_error").modal('show');

                                        // Close Select Meeting
                                        $("#myModal2").modal('hide');
                                    }

                                },
                                error: function(data) {
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

                                // Show Success Delete
                                $("#delete-success").modal('show');

                                // Close Select Meeting
                                $("#myModal").modal('hide');
                            },
                            error: function(returnval) {
                                // Show Error Delete
                                $("#delete-error").modal('show');

                                // Close Select Meeting
                                $("#myModal").modal('hide');
                            }
                        })
                }
                }else{
                    // Show Error Delete
                    $("#delete-did-not-add-it").modal('show');

                    // Close Select Meeting
                    $("#myModal").modal('hide');
                }
                    @endif
                },
                eventColor: '#378006',
            });
        });
    </script>

    <script src="{{ asset('web_sayt/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('web_sayt/js/filter.js') }}"></script>
    <script src="{{ asset('web_sayt/js/script.js') }}"></script>
    <script src="{{ asset('web_sayt/js/star-rating.js') }}"></script>
    <script src="{{ asset('web_sayt/js/star-run.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_sayt/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('web_sayt/js/carusel.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_sayt/js/script.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_sayt/js/readMoreJS.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDtOVd66AerMgd0A-mwKEFqdBQTrKGfngc&callback=initMap&libraries=places&v=weekly"
        async
    ></script>

@endsection
