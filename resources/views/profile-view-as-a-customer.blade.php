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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title', __('site.Home') )

@extends('app.layouts.app_home')


@section('content')
    <script>var body = document.body; body.classList.add("body");</script>
{{--    @if(isset(Auth::user()->id))--}}
    <!---  0000000  ---->
    <main>
        <div class="container">
            <div class="profile-practitioner">
                <div class="profile-practitioner__user nl">
                    <div class="person__info">
                        <div class="person__info-cont1">
                            <img class="person__info-img" src="@if($Practitioner->img){{asset('web_sayt/img_practitioners/'.$Practitioner->img)}}@else{{asset('web_sayt/img/person-foto.png')}}@endif" alt="">
                            <div class="person__info-name">
                                <span class="profile-practitioner-name">{{$Practitioner->first_name}} {{$Practitioner->last_name}}</span>

                            </div>
                            <div class="person__info-specialist">Acne Specialist &amp; Holistic nutritionist (CNP)</div>
                            <div class="person__info-skin">
                                @foreach($MyTagManagements as $GetTagManagements)
                                    <span class="person__info-skin-tag">{{$GetTagManagements->name}}</span>
                                @endforeach
                            </div>

                            <input type="hidden" id="practitioner_id" value="{{$Practitioner->id}}">
{{--                            <div class="person__info-my">--}}

{{--                            <div class="person__info-my">--}}



{{--                                <a href="{{route('view-type-form-practitioner',[app()->getLocale(),$Practitioner->id])}}" class="mb-4 text-black d-block">My Intake Forms</a>--}}
{{--                                <div role="button" class="mb-3 cursor-pointer bg-yellow px-3 py-2 br-5 text-center" data-toggle="modal" data-target="#myProtocolsModal">My Protocols</div>--}}
{{--                                {{$Practitioner->description}}--}}
{{--                            </div>--}}
                            <div class="person__info-rating qew">
                        <span class="gl-star-rating gl-star-rating--ltr " data-star-rating="">
                           <select class="star-rating">

                              <option value="5">5.0</option>
                              <option value="4">4.0</option>
                              <option value="3">3.0</option>
                              <option value="2">2.0</option>
                              <option value="1">1.0</option>
                           </select>
                           <span class="gl-star-rating--stars s50" role="tooltip" aria-label="5.0">
                              <span data-index="0" data-value="1" class="" style="font-size: 28px;"></span>
                              <span data-index="1" data-value="2" class=""></span>
                              <span data-index="2" data-value="3" class=""></span>
                              <span data-index="3" data-value="4" class=""></span>
                              <span data-index="4" data-value="5" class="gl-selected gl-active"></span>
                           </span>
                        </span>
                            </div>
                            <p class="perion__info-session">256<span> Sessions</span></p>
                        </div>

                    </div>
                </div>
                <div class="profile-practitioner__consultation nl">
                    <div class="d-flex align-items-start">
                        <div class="d-flex flex-md-row flex-column flex-1">
                            <div class="profile-practitioner__consultation-video flex-1 mr-md-3">
                                {{--                            <input type="file" id="video-file" name="video-file">--}}
                                {{--                            <label for="video-file"><img class="upload" src="{{ asset('web_sayt/img/video-file.svg') }}" alt=""></label>--}}
                                <div class="profile-practitioner__consultation-video flex-1 mr-md-3 p-0 overflow-hidden">
                                    <video id="video" src="{{asset('web_sayt/video_practitioners/'.$Practitioner->video)}}" width="100%" height="100%" controls="">

                                    </video>
                                </div>
                            </div>

                        </div>
                        <div class="profile-practitioner__consultation-time m-0 flex-1">
                            <div class="profile-practitioner__consultation-time-content">
                                <p class="time-content-title">VIDEO CONSULTATION <img src="{{ asset('web_sayt/img/zoom-icon-logo.png') }}" alt=""></p>
                                @foreach($ThisWeekMeetingsList as $Value)
                                    <button class="btn bg-yellow">{{date('H:i:s', strtotime($Value->start)) }}</button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="profile__reviews">
                        <p class="profile__reviews-title">REVIEWS</p>
                        <div class="d-flex flex-lg-row flex-column">
                       @if(count($Review)>0)
                         @foreach($Review as $valR)
                             @if(!empty($valR->practitoner_id))

                                    @if(!empty($valR->description))
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
                                @endif
                                    @else
                                        No reviews yet
                                    @endif
                                @endforeach
                           @endif
                        </div>
                    </div>
                </div>
            </div>

            @if(@isset($Service) and  @count($Service) > 0 )

                <div class="service pb-5 container">

                    <?php
//                    $count =  count($Service->where('practitioner_id',$Result->id));
//
//                    if(!empty(count($Service->where('practitioner_id',$Result->id))))
//                    {
//                        echo   '<h2 class="text-center" >My Services</h2>
//                            <h4 class="text-uppercase text-center" >ONE ON ONE PROGRAMS</h4>';
//                    }
//                    else{
//                        echo '<h2 class="text-center" >No services yet</h2>';
//                    }

                    ?>

                    <div class="col-lg-12">
                        <div class="">

                            <!-- 1 -->

                            <div class="profile-practitioner__consultation-carusel-block">
                                <div id="customer-testimonals1" class="service_carousel owl-carousel owl-theme owl-loaded owl-drag ">
                                    @foreach($Service as $Value)

                                        @php
                                            $array = array("item light-green","item light-yellow");
                                            $k = array_rand($array);
                                            $color = $array[$k];
                                        @endphp

                                        <div class="@php echo $color; @endphp flex-1 mx-1" >
                                            <div class="d-flex flex-column align-items-center">
                                                <h4  class="mb-3">{{ $Value->title }}</h4>

                                                <div class="d-flex flex-column mx-auto align-items-center mb-3 italic-text">
                                                    @foreach($ServiceSession as $valS)
                                                        @foreach($valS->where('services_id',$Value->id) as $valSS)
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
                                                    @foreach($valD->where('services_id',$Value->id) as $valDD)
                                                        @if($valDD->services_id == $Value->id)
                                                            <li style="margin-bottom: 4px !important;"><i class="fas fa-angle-right mr-2"  ></i> <span>{{$valDD->description}}</span></li>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            </ul>
{{--                                            ($ServizeID->where('practitioner_id',$Practitioner->id)->where('service_id',$Value->id))}}--}}
                                            <input type="hidden" name="user_email" value="@if(isset(Auth::user()->email)){{Auth::user()->email}}@endif">
                                            <input type="hidden" name="service_name" value="{{$Value->title}}">
                                            <input type="hidden" name="service_id" value="{{$Value->id}}">
                                            <input type="hidden" name="email" value="{{$Practitioner->email}}">
                                            <input type="hidden" name="first_name" value="{{$Practitioner->first_name}}">
                                            <input type="hidden" name="last_name" value="{{$Practitioner->last_name}}">
                                            <input type="hidden" name="phone_number" value="{{$Practitioner->phone_number}}">
                                            <input type="hidden" name="practitioner_id" value="{{$Practitioner->id}}">
{{--                                            @if(count($ServizeID)>0)--}}

{{--                                                @foreach($ServizeID->where('practitioner_id',$Practitioner->id) as $v)--}}

{{--                                                    {{dd($v->service_id)}}--}}
{{--                                            @if($Value->id == $v->service_id)--}}
{{--                                                    <button class="bg-yellow br-10 px-4 py-2 mt-4 fs-16 view-more detail-btn" data-toggle="modal" @if(isset(Auth::user()->id))data-target="#myModal" @else data-target="#loginn" @endif" data-id="{{ $Practitioner->id }}" >Service Reserved</button>--}}
{{--                                            @else--}}
{{--                                            <button class="bg-yellow br-10 px-4 py-2 mt-4 fs-16 view-more detail-btn" data-toggle="modal" @if(isset(Auth::user()->id))data-target="#myModal" @else data-target="#loginn" @endif" data-id="{{ $Practitioner->id }}" >Book</button>--}}
{{--                                                @endif--}}
{{--                                                @endforeach--}}
{{--                                            @endif--}}
{{--                                            @if(count($ServizeID)<0)--}}
{{--                                                <button class="bg-yellow br-10 px-4 py-2 mt-4 fs-16 view-more detail-btn" data-toggle="modal" @if(isset(Auth::user()->id))data-target="#myModal" @else data-target="#loginn" @endif" data-id="{{ $Practitioner->id }}" >Book</button>--}}
{{--                                            @endif--}}
                                            <button class="bg-yellow br-10 px-4 py-2 mt-4 fs-16 view-more detail-btn" data-toggle="modal" @if(isset(Auth::user()->id))data-target="#myModal" @else data-target="#loginn" @endif" data-id="{{ $Practitioner->id }}" >Book</button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @endif
        </div>
    </main>
    <!---  0000000 ----->


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

    <div id="myModal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 id="myModalLabel">Modal 2</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div id="zoom" class="modal-body">
                    <a href="#">Zoom</a>
                </div>
                <div id="offline" class="modal-body">
                    <a href="#">Offline</a>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
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

    </script>



<script type="text/javascript" src="{{ asset('web_sayt/js/jquery.js') }}"></script>
<script src="{{ asset('web_sayt/maps/index.js') }}"></script>

<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
{{--     Calendar--}}
<script>
    $(document).ready(function() {

        // Add Star
        $('.gl-active').click(function () {

            var star = $(this).attr('data-value');
            var _token = $('input[name="_token"]').val();


            $.ajax({
                url: "{{route('add-star',[app()->getLocale()])}}",
                type: "POST",
                data: {
                    star: star,
                    practitioner_id: $("#practitioner_id").val(),
                    _token:_token
                },
                success: function (data) {
                    console.log(data)
                    // alert("The tag you selected has been added to your list.");
                },
                error: function(returnval) {
                    // alert('The tag you selected has not been added to your list, or it has already been added.');
                }
            });
        })

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
        var service_name   = $(this).prev().prev().prev().prev().prev().prev().prev().val();
        var user_email     = $(this).prev().prev().prev().prev().prev().prev().prev().prev().val();

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
                                title: service_name,
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
                                user_email:user_email,
                                LiveDateTime:LiveDateTime,
                                type: 'add'
                            },
                            success: function (data) {
                                calendar.fullCalendar('refetchEvents');
                                console.log(data.select_error)

                                if(data.select_error == null)
                                {
                                    if(data.NoRepeatService != null)
                                    {
                                        //alert(data.NoRepeatService)
                                        // Show Error No Repeat Service
                                        $("#error-NoRepeatService").modal('hide');

                                        // Close Select Meeting
                                        $("#myModal2").modal('hide');
                                    }else{
                                        //alert("Event Created Successfully");

                                        // Show Success Meeting
                                        $('#succes-meeting').modal('show');

                                        // Close Select Meeting
                                        $("#myModal2").modal('hide');
                                    }
                                }else{
                                   // alert(data.select_error);

                                    // Show Error No Repeat Service
                                    $("#select_error").modal('show');

                                    // Close Select Meeting
                                    $("#myModal2").modal('hide');
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
                  //  alert('You can not make appointments with back date.');

                    // Show Error with back date
                    $("#with-back-date").modal('show');

                    // Close Select Meeting
                    $("#myModal2").modal('hide');
                }

            },
            editable:true,
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


            if(AuthID === user_id) {
                if(DiffHours <= 12)
                {
                    $("#editHour").modal("show");
                }else {

                    if (confirm("Are you sure you want to remove it?")) {

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
                                //alert("Event Deleted Successfully");

                                // Show Success Delete
                                $("#delete-success").modal('show');

                                // Close Select Meeting
                                $("#myModal").modal('hide');
                            },
                            error: function (returnval) {
                                //alert('Your appointment has not been deleted');

                                // Show Error Delete
                                $("#delete-error").modal('show');

                                // Close Select Meeting
                                $("#myModal").modal('hide');
                            }
                        })
                    }
                }
            }else{
                //alert('You can not delete this meeting because you did not add it.')

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
