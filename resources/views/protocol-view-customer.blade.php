@section('style header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
          integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/star-rating.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/ProtocolViewAsACustomer.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/service.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{--    calendar css--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <style>
        .my-protocol-product-img{
            display: flex;
            align-items: center;
            border-radius: 10px;
            width: 150px;
            height: 150px;
            overflow: hidden;
            justify-content: center;
        }
        .protocol_imgg{
            width: 100%;
        }

        .ThisActiveMeeting{
            background: #1f44c7 !important;
            color: white !important;
            border: 1px solid #abab95 !important;

        }

    </style>
@endsection

@section('title', __('site.Home') )

@extends('app.layouts.app_home')


@section('content')
    <script>var body = document.body; body.classList.add("body");</script>

    <main class="main mt-5">
        <div class="container">
            <h1 class="protoco ml-5">Protocol</h1>
            <div class="d-flex justify-content-between  mt-5 ">
                <div class="plan ml-5">
                    <a href="#" class="my-plan">My Plan</a>
                    <i class="fas fa-chevron-right"></i>
                    <a href="#" class="acne">{{$Services->title}}</a>
                </div>
                <div type="button" class="btn-arrow d-flex justify-content-center">
                    <i class="fas fa-arrow-down mt-3"></i>
                </div>
                <div class="duration mr-4">Duration {{$Week}} week</div>
            </div>
        <div class="my-plan-background">
            <img class="load img-fluid" src="{{ asset('web_sayt/img/Group 2004.svg') }}" alt="img">
            <div class="text mt-5">5 Days left until check-in</div>
            <div class="d-flex justify-content-center align-items-center mt-5">
                <div class="content">
                    <input type="hidden" id="service_name" value="{{$Services->title}}">
                    <form action="{{route('add-select-another',[app()->getLocale(),'practitioner_id' => Request::segment(5),'service_id' => Request::segment(3)])}}"  method="post">
                        @csrf
                        <div class="content-background">
                            <div class="d-block content-checkbox">

                             @if(count($ProtocolAnother) > 0)

                                @foreach($ProtocolAnother as $key => $value)

                                <div class="form-group form-check mt-3">
                                    <input  type="hidden"  value="{{$value->service_id}}">
                                    <input  type="hidden"  value="{{$value->user_id}}">
                                    <input type="hidden" name="another_id[]" value="{{$value->id}}">
                                    <input type="checkbox" value="yes" @if($value->selected == 'yes') checked @endif class="form-check-input" name="another[]" id="exampleCheck{{$key}}">
                                    <label class="form-check-label ml-4" for="exampleCheck{{$key}}">{{$value->name}}</label>
                                </div>
                                @endforeach

                                @endif

                            </div>
                              @if($CheckCountSelected == 0)
                                    <div class="d-flex justify-content-center mt-5">

                                        <input type="hidden"  value="{{$Services->price}}">
                                        <input type="hidden"  value="{{$Practitioner->first_name}} {{$Practitioner->last_name}}">
                                        <input type="hidden"  value="{{$meetingID}}">
                                        <input type="hidden"  value="{{auth()->user()->first_name}}">
                                        <input type="hidden"  value="{{auth()->user()->last_name}}">
                                        <input type="hidden"  value="{{auth()->user()->phone_number}}">
                                        <input type="hidden"  value="{{$Practitioner->id}}">
                                        <input type="hidden"  value="{{auth()->user()->id}}">
                                        <input type="hidden"  value="{{$Practitioner->email}}">
                                        <button type="button" class="follow-up-btn detail-btn" data-toggle="modal" data-target="#myModal" data-id="ff">Book follow-up appointment Calendar</button>
                                    </div>
                              @else
                                <div class="d-flex justify-content-center mt-5">
                                    <button type="submit" class="follow-up-btn">Book follow-up appointment </button>
                                </div>
                              @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="container">
            <h6 class="heading ml-5">Heading</h6>
            <h3 class="diet ml-5 mt-5">Diet:</h3>
            <div class="d-block diet-content">
                @foreach($ProtocolHeading as $ValHeading)
                <div class="d-flex mt-3">
                    <i class="far fa-arrow-alt-circle-right mr-4"></i>
                    <div>{{$ValHeading->text_heading}}</div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="container">
            <h4 class="product ml-5">Product :</h4>
            <div class="d-flex justify-content-center flex-wrap mt-5 mb-5 product-items">
                @foreach($ProtocolProduct as $ValProduct)

                <div class="product-item1 m-2">
                    <div class="item1-topside d-flex justify-content-around">
                        <div class="product-image">
                            <img src="{{ asset('web_sayt/img_protocol/'.$ValProduct->img) }}" alt="img">
                        </div>
                        <div class="mt-4">{{$ValProduct->title_product}}</div>
                    </div>
                    <div class="item1-bottomside d-flex justify-content-center">
                        <input class="form-control" type="url" placeholder="{{$ValProduct->product_link}}" readonly>
                        <a href="{{$ValProduct->product_link}}"><i type="button" class="fas fa-arrow-alt-circle-right mt-2"></i></a>
                    </div>
                </div>
                @endforeach


            </div>
        </div>
        <div class="link-background">
            <div class="container">
                <h4 class="mt-5 ml-5">Links:</h4>
                @php
                    $array = array("class='card' style='width: 18rem;'","class='card card-bottom1 mt-5' style='width: 18rem;'","class='card card-bottom2 mt-5' style='width: 18rem;'");
                    $k = array_rand($array);
                    $class = $array[$k];
                @endphp
                <div class="d-flex justify-content-around mt-5 flex-wrap align-items-center">
                    @foreach($ProtocolLink as $ValLink)
                    <div @php echo $class; @endphp>
                        <iframe class="card-img-top" width="291" height="152" src="https://www.youtube.com/embed/9uIk_91GQYI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
                        <div class="card-body">
                            <h5 class="card-title">{{$ValLink->link_title}}</h5>
                            <div class="d-flex ">
                                <img src="{{ asset('web_sayt/img/youtube-icon.svg') }}" alt="">
                                <a href="{{$ValLink->link_link}}" class="btn card-btn">{{\Illuminate\Support\Str::limit($ValLink->link_link, 25)}}</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>

        </div>

    </main>



    {{--    full calendar modal--}}
    <div class="modal" tabindex="-1" id="myModal">
        <div class="modal-dialog max-dialog">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
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

@section('style')
    <script type="text/javascript" src="{{ asset('web_sayt/js/jquery.js') }}"></script>
    <script src="{{ asset('web_sayt/maps/index.js') }}"></script>

    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

    {{--     Calendar--}}
    <script>


        $(document).on('click','.detail-btn', function()  {


            var calendar = null;

            var user_email = $(this).prev().val();
            var practitionerID = $(this).prev().prev().prev().val();
            var phone_number = $(this).prev().prev().prev().prev().val();
            var last_name =    $(this).prev().prev().prev().prev().prev().val();
            var first_name =    $(this).prev().prev().prev().prev().prev().prev().val();
            var meetings_id =    $(this).prev().prev().prev().prev().prev().prev().prev().val();


            var practitioner =    $(this).prev().prev().prev().prev().prev().prev().prev().prev().val();
            var price =    $(this).prev().prev().prev().prev().prev().prev().prev().prev().prev().val();


            var  service_id = $(this).parent().prev().children().children().val();
            var  serviceName =    $("#service_name").val();


            // alert('title ' +title)
            // alert('start ' +start)
            // alert('end ' +end)
            // alert('practitionerId ' +practitionerId)
            // alert('phone_number ' +phone_number)
            // alert('last_name ' +last_name)
            // alert('first_name ' +first_name)
            // alert('email ' +email)
            // alert('duration ' +duration)
            // alert('password ' +pasword)
            // alert('service_id ' +service_id)
            // alert('LiveDateTime ' +LiveDateTime)
            // alert('add_user_id ' +add_user_id)



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
              //  events:'/en/Search/'+ practitionerID+'/'+service_id,
             //  events:'/en/Search/'+ practitionerID+'/'+service_id+'/'+meetings_id,
               events:'/en/Search/'+ practitionerID,
                selectable:true,
                selectHelper: true,
                timeFormat: 'hh:mm a',
                select:function(start, end, allDay)
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

                    var start = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');

                    var end   = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');


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

                    if (d1 >= d2) {

                        $("#myModal2").modal("show");

                        // Close Calendar
                        $("#myModal").modal('hide');

                        // Offline Meeting
                        {{--$('#offline').click(function () {--}}
                        {{--    alert('sddsd')--}}
                        {{--    var  duration = diff_time/(60000);--}}
                        {{--    //alert(password)--}}

                        {{--    // var title       = prompt('Event Title:');--}}
                        {{--    //  var pasword     = prompt('Event password:');--}}
                        {{--    // var duration    = prompt('Event Duration:');--}}
                        {{--        @if(isset(auth()->user()->id))--}}
                        {{--    var add_user_id = "{{auth()->user()->id}}";--}}
                        {{--    @endif--}}


                        {{--    $.ajax({--}}
                        {{--        url: "{{ route('add-offline-meeting',app()->getLocale()) }}",--}}
                        {{--        type: "POST",--}}
                        {{--        // data: {--}}
                        {{--        //     title: serviceName,--}}
                        {{--        //     start: start,--}}
                        {{--        //     end: end,--}}
                        {{--        //     practitionerId: practitionerId,--}}
                        {{--        //     add_user_id: add_user_id,--}}
                        {{--        //     phone_number: phone_number,--}}
                        {{--        //     last_name: last_name,--}}
                        {{--        //     first_name: first_name,--}}
                        {{--        //     email: email,--}}
                        {{--        //     duration: duration,--}}
                        {{--        //     practitionerID: practitionerID,--}}
                        {{--        //     service_id: service_id,--}}
                        {{--        //     LiveDateTime:LiveDateTime,--}}
                        {{--        //     user_email:user_email,--}}
                        {{--        //     type: 'add'--}}
                        {{--        // },--}}
                        {{--        data: {--}}
                        {{--            title: serviceName,--}}
                        {{--            start: start,--}}
                        {{--            end: end,--}}
                        {{--            practitionerID: practitionerID,--}}
                        {{--            add_user_id: add_user_id,--}}
                        {{--            phone_number: phone_number,--}}
                        {{--            last_name: last_name,--}}
                        {{--            first_name: first_name,--}}
                        {{--            user_email: user_email,--}}
                        {{--            email: "{{Auth::user()->email}}",--}}
                        {{--            duration: duration,--}}
                        {{--            service_id: service_id,--}}
                        {{--            LiveDateTime:LiveDateTime,--}}
                        {{--            type: 'add-add',--}}
                        {{--            too_meet: 'yes'--}}
                        {{--        },--}}
                        {{--        success: function (data) {--}}

                        {{--            calendar.fullCalendar('refetchEvents');--}}


                        {{--            if(data.select_error == null)--}}
                        {{--            {--}}
                        {{--                if(data.NoRepeatService != null)--}}
                        {{--                {--}}
                        {{--                    // alert(data.NoRepeatService)--}}

                        {{--                    // Show Error No Repeat Service--}}
                        {{--                    $("#error-NoRepeatService").modal('hide');--}}

                        {{--                    // Close Select Meeting--}}
                        {{--                    $("#myModal2").modal('hide');--}}
                        {{--                }else{--}}
                        {{--                    // Show Success Meeting--}}
                        {{--                    $('#succes-meeting').modal('show');--}}

                        {{--                    // Close Select Meeting--}}
                        {{--                    $("#myModal2").modal('hide');--}}
                        {{--                    //alert("Event Created Successfully");--}}
                        {{--                }--}}
                        {{--            }else{--}}
                        {{--                // Show Error No Repeat Service--}}
                        {{--                $("#select_error").modal('show');--}}

                        {{--                // Close Select Meeting--}}
                        {{--                $("#myModal2").modal('hide');--}}
                        {{--                //  alert(data.select_error);--}}
                        {{--            }--}}

                        {{--        },--}}
                        {{--        error: function(data) {--}}
                        {{--            // alert('Your appointment has not been created');--}}

                        {{--            // Show Error No not been created--}}
                        {{--            $("#not-been-created").modal('show');--}}

                        {{--            // Close Select Meeting--}}
                        {{--            $("#myModal2").modal('hide');--}}
                        {{--        }--}}
                        {{--    });--}}
                        {{--})--}}


                        // Zoom Meeting
                        $("#zoom").click(function () {

                         var  duration = diff_time/(60000);
                         //alert(password)

                       // var title       = prompt('Event Title:');
                      //  var pasword     = prompt('Event password:');
                       // var duration    = prompt('Event Duration:');
                            @if(isset(auth()->user()->id))
                        var add_user_id = "{{auth()->user()->id}}";
                        @endif

                     //   if(title !== "" && pasword !== "" && duration !== ""){

                            $.ajax({
                                url: "{{ route('add-zoom-meeting',app()->getLocale()) }}",
                                type: "POST",
                                data: {
                                    title: serviceName,
                                    start: start,
                                    end: end,
                                    practitionerID: practitionerID,
                                    add_user_id: add_user_id,
                                    phone_number: phone_number,
                                    last_name: last_name,
                                    first_name: first_name,
                                    user_email: user_email,
                                    email: "{{Auth::user()->email}}",
                                    duration: duration,
                                    password: password,
                                    service_id: service_id,
                                    LiveDateTime:LiveDateTime,
                                    type: 'add-add',
                                    too_meet: 'yes'
                                },
                                success: function (data) {

                                //     calendar.fullCalendar('refetchEvents');
                                //     alert("Event Created Successfully");
                                //     console.log(data)
                                // },
                                // error: function(returnval) {
                                //     alert('Your appointment has not been created');
                                // }
                                    calendar.fullCalendar('refetchEvents');
                                   // console.log(data.select_error)

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
                                           // alert("Event Created Successfully");
                                            // Show Success Meeting
                                            $('#succes-meeting-my-app').modal('show');

                                            // Close Select Meeting
                                            $("#myModal2").modal('hide');
                                            $('#practition').text(practitioner)
                                            $('#service_n').text(serviceName)
                                            $('#date_time').text(start)
                                            $('#prc').text(price)

                                                setTimeout(() => {
                                                    var newURL = window.location.protocol + "//" + window.location.host;
                                                    location.replace(newURL+"/en/my-appointments-customer/2");
                                                            //location.replace(newURL+"/en/my-appointments-customer/2/Practitioner/Service_name/Date-time/price");
                                                }, 3000)


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
                                    //alert('Your appointment has not been created');

                                    // Show Error No not been created
                                    $("#not-been-created").modal('show');

                                    // Close Select Meeting
                                    $("#myModal2").modal('hide');

                                }
                            });

                        // }else{
                        //     alert('Empty');
                        // }
                        });
                    }else{
                        // alert('You can not make appointments with back date.');

                        // Show Error with back date
                        $("#with-back-date").modal('show');

                        // Close Select Meeting
                        $("#myModal2").modal('hide');
                    }

                },
  {{--              eventRender: function(event, element,start, end, allDay) {--}}
  {{--                  var us_id = "{{Auth::user()->id}}";--}}
  {{--                  if(event['status'] == null) {--}}

  {{--// console.log(event)--}}
  {{--                      setTimeout(() => {--}}

  {{--                          element[0].setAttribute('class', 'activeNull  fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable');--}}

  {{--                          // let day = document.getElementsByClassName('fc-day-grid-event');--}}
  {{--                          //--}}
  {{--                          // for (let a of day) {--}}
  {{--                          //     a.setAttribute('izNull', `${event.id}`)--}}
  {{--                          //     console.log(a);--}}
  {{--                          // }--}}

  {{--                          let x = document.querySelector('.fc-event-container');--}}
  {{--                          x.removeAttribute('class');--}}


  {{--                          // let y = document.querySelector('div .fc-event-container');--}}
  {{--                          // y.removeAttribute('class');--}}
  {{--                          // alert('edede')--}}
  {{--                          // x.style.backgroundColor = "red";--}}
  {{--                          // x.style.color = "white";--}}

  {{--                          // for (let a of day) {--}}
  {{--                          //     if (event.id === a.getAttribute('id')) {--}}
  {{--                          //         console.log('000000000000000000', a);--}}
  {{--                          //         a.style.backgroundColor = "#FED638";--}}
  {{--                          //         a.style.color = "black";--}}
  {{--                          //         a.style.border = "1px solid #abab95";--}}
  {{--                          //     }--}}
  {{--                          //--}}
  {{--                          // }--}}

  {{--                      }, 10)--}}

  {{--                      // var ssss =  document.querySelector('.fc-time-grid-event');--}}
  {{--                      //  ssss.style.backgroundColor = "#00d210ba";--}}
  {{--                  }else{--}}

  {{--                      if(event['user_id'] == us_id)--}}
  {{--                      {--}}

  {{--                          setTimeout(() => {--}}
  {{--                              element[0].setAttribute('class', ' activeUser fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable');--}}
  {{--                              element[0].setAttribute('active', 'activeUser');--}}
  {{--                              let div = document.getElementsByClassName('fc-content-col');--}}
  {{--                              let aArray = div[0].childNodes[1].childNodes;--}}
  {{--                              // console.log('5555555555',aArray[0]?.getAttribute('active'));--}}
  {{--                              for(let key of aArray) {--}}
  {{--                                  if (key.getAttribute('active') === 'activeUser') {--}}
  {{--                                      let aDiv = document.createElement('div');--}}
  {{--                                      aDiv.setAttribute('class', 'fc-event-container');--}}
  {{--                                      aDiv.appendChild(element[0])--}}
  {{--                                      div[0].childNodes[1].appendChild(aDiv)--}}
  {{--                                  }--}}
  {{--                              }--}}
  {{--                             // console.log( '***************************************', aArray)--}}

  {{--                          }, 20)--}}
  {{--                      }--}}
  {{--                      if(event['user_id'] != us_id)--}}
  {{--                          {--}}
  {{--                              setTimeout(() => {--}}
  {{--                                  // let x = document.querySelector('.fc-event-container');--}}
  {{--                                  // x.removeAttribute('class');--}}

  {{--                                  element[0].setAttribute('class', 'DeactiveUser fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable');--}}
  {{--                              }, 10)--}}
  {{--                          }--}}

  {{--                      if(event['service_id'] != service_id)--}}
  {{--                      {--}}
  {{--                          setTimeout(() => {--}}
  {{--                              element[0].setAttribute('class', 'DeactiveUser fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable');--}}
  {{--                          }, 10)--}}
  {{--                      }--}}
  {{--                      $($(element[0]).find('.DeactiveUser')).prepend('<div class="kkkkkkkkkkkk">'+element[0]+'</div>');--}}

  {{--                      //console.log($(element[0]).find('.DeactiveUser').prepend('<ol>eeeeeee</ol>'))--}}

  {{--                      // Display none booking date--}}
  {{--                      setTimeout(() => {--}}
  {{--                          $(".DeactiveUser" ).css( "display", "none" );--}}
  {{--                          $(".DeactiveUser" ).next().css( "display", "none" );--}}
  {{--                      }, 20);--}}

  {{--                      }--}}
  {{--              },--}}

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

                  for (let key of aArray) {
                      console.log(key.getAttribute('active'))
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

          if (event['id'] == meetings_id) {
              setTimeout(() => {
                  element[0].setAttribute('class', 'ThisActiveMeeting fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable');
              }, 50)
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
                                    delete_meeting_id:meeting_id,
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
                                error: function(returnval) {
                                    //alert('Your appointment has not been deleted');

                                    // Show Error Delete
                                    $("#delete-error").modal('show');

                                    // Close Select Meeting
                                    $("#myModal").modal('hide');
                                }
                            })
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


    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDtOVd66AerMgd0A-mwKEFqdBQTrKGfngc&callback=initMap&libraries=places&v=weekly"
        async
    ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>

@endsection
