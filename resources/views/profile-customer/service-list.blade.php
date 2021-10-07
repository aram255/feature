
<div class="modal fade modal-service" id="service-modal{{$PractitionerFavoriteVal->partit_id}}">
    <div class="modal-dialog mx-auto " style="max-width: max-content; width: 100%">
        <div class="modal-content">

            <button type="button" class="close ml-auto pt-4 pr-4" data-dismiss="modal">&times;</button>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="service pb-5 container">

                    <?php
                    $count =  count($Service->where('practitioner_id',$PractitionerFavoriteVal->partit_id));

                    if(!empty(count($Service->where('practitioner_id',$PractitionerFavoriteVal->partit_id))))
                    {
                        echo   '<h2 class="text-center" >My Services</h2>
                            <h4 class="text-uppercase text-center" >ONE ON ONE PROGRAMS</h4>';
                    }
                    else{
                        echo '<h2 class="text-center" >No services yet</h2>';
                    }

                    ?>

                    <div class="col-lg-12">
                        <div class="">

                            <!-- 1 -->

                            <div class="profile-practitioner__consultation-carusel-block">
                                <div id="customer-testimonals1" class="service_carousel owl-carousel owl-theme owl-loaded owl-drag ">
                                    @foreach($Service->where('practitioner_id',$PractitionerFavoriteVal->partit_id) as $Value)
                                        @php
                                            $array = array("item light-green","item light-yellow");
                                            $k = array_rand($array);
                                            $color = $array[$k];
                                        @endphp
                                        <div class="@php  echo $color; @endphp flex-1 mx-1" >
                                            <div class="d-flex flex-column align-items-center">
                                                <h4  class="mb-3">{{$Value->title}}</h4>

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
                                                    <span class="">$</span> <span >{{ $Value->price }}</span>
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
                                            <input type="hidden" name="user_email" value="@if(isset(Auth::user()->email)){{Auth::user()->email}}@endif">
                                            <input type="hidden" name="service_name" class="service_name" value="{{$Value->title}}">
                                            <input type="hidden" name="service_id" value="{{$Value->id}}">
                                            <input type="hidden" name="email" value="{{$PractitionerFavoriteVal->email}}">
                                            <input type="hidden" name="first_name" value="{{$PractitionerFavoriteVal->first_name}}">
                                            <input type="hidden" name="last_name" value="{{$PractitionerFavoriteVal->last_name}}">
                                            <input type="hidden" name="phone_number" value="{{$PractitionerFavoriteVal->phone_number}}">
                                            <input type="hidden" name="practitioner_id" value="{{$PractitionerFavoriteVal->partit_id}}">
{{--                                            @if($PractitionerFavoriteVal->service_id != $Value->id)--}}
                                                <button class="bg-yellow br-10 px-4 py-2 mt-4 fs-16 view-more detail-btn-favorite" data-toggle="modal" @if(isset(Auth::user()->id))data-target="#myModal" @else data-target="#loginn" @endif" data-id="{{ $PractitionerFavoriteVal->partit_id }}" >Book</button>
{{--                                            @else--}}
{{--                                                <button class="bg-yellow br-10 px-4 py-2 mt-4 fs-16 view-more detail-btn" data-toggle="modal" @if(isset(Auth::user()->id))data-target="#myModal" @else data-target="#loginn" @endif" data-id="{{ $PractitionerFavoriteVal->partit_id }}">Service Reserved</button>--}}
{{--                                            @endif--}}
                                        </div>


                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('click','.detail-btn-favorite', function()  {

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
        var user_email    = $(this).prev().prev().prev().prev().prev().prev().prev().prev().val();

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
           // events:'/en/Search/'+ practitionerId+'/'+service_id,
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
                                    //alert('Your appointment has not been created');

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

            // eventDrop: function(event) {
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
            //          if (confirm("Do you want to change your meeting details?")) {
            //
            //
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
            //                     //alert("Event Updated Successfully");
            //
            //                     if(response.Hour != null)
            //                     {
            //                         alert(response.Hour)
            //                     }else{
            //                         alert("Event Updated Successfully");
            //                     }
            //                 }
            //             })
            //         }
            //     }else{
            //         alert('You can not make appointments with back date.');
            //     }
            //
            // },

            eventRender: function(event, element,start, end, allDay) {

              //   uniqueCount = [event.start];
              //   var count = {};
              //   uniqueCount.forEach(function(i) { count[i] = (count[i]||0) + 1;});
               //  console.log(event);

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
                    $($(element[0]).find('.DeactiveUser')).prepend('<div class="kkkkkkkkkkkk">'+element[0]+'</div>');

                    console.log($(element[0]).find('.DeactiveUser').prepend('<ol>eeeeeee</ol>'))
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
                    // }
                }
            }else{
               // alert('You can not delete this meeting because you did not add it.')

                // Show Error Delete
                $("#delete-did-not-add-it").modal('show');

                // Close Select Meeting
                $("#myModal").modal('hide');
            }
                @endif
            },
            // businessHours: {
            //     allDay: false,
            //     // days of week. an array of zero-based day of week integers (0=Sunday)
            //   //  daysOfWeek: [1, 2, 3, 4], // Monday - Thursday
            //     startTime: "10:00", // a start time (10am in this example)
            //     endTime: "11:00" // an end time (6pm in this example)
            // },


            eventColor: '#378006',

        });

    });
</script>
