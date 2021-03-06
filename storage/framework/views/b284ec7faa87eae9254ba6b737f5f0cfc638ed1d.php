<?php $__env->startSection('style header'); ?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
          integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
          crossorigin="anonymous" />
    <link rel="stylesheet" href="<?php echo e(asset('web_sayt/css/owl-carousel-min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('web_sayt/css/owl.theme.default.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('web_sayt/css/bootstrap/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('web_sayt/css/star-rating.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('web_sayt/css/css/main.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('web_sayt/maps/style.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('web_sayt/css/service.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('web_sayt/css/css/responsive.css')); ?>">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">


<?php $__env->stopSection(); ?>

<?php $__env->startSection('title', __('site.Home') ); ?>



<?php $__env->startSection('content'); ?>
    <script>var body = document.body; body.classList.add("body");</script>

    <section>
        <div class="container">
            <div class="profile-customer">
                <div class="profile-customer__blok1 nl">
                    <div class="profile-customer__blok1-info">
                        <div class="person__info-cont1">
                            <div class="edit-profile__contact-img">


                                <label for="img-file"><img class="upload" src="<?php if(auth()->user()->img): ?><?php echo e(asset('web_sayt/img_customer/'.auth()->user()->img)); ?> <?php else: ?> <?php echo e(asset('web_sayt/img/img-file.svg')); ?><?php endif; ?>" alt=""></label>
                            </div>
                            <div class="person__info-name">
                                <span class="person-customer-name"><?php echo e(auth()->user()->first_name); ?> <?php echo e(auth()->user()->last_name); ?></span>
                                <span class="edit-pen"><a href="<?php echo e(route('edit-profile-customer',[app()->getLocale()])); ?>"><img src="<?php echo e(asset('web_sayt/img/edit-pen.svg')); ?>" alt=""></a></span>
                            </div>
                            <div class="person-customer-my-pay">My payments</div>
                            <div class="person-customer__payments">
                                <div class="person-customer__payments-phone d-none">
                                    <p class="person-customer-number">Phone Number</p>
                                    <p class="person-customer-tel"><?php echo e(auth()->user()->phone_number); ?></p>
                                </div>
                                <div class="person-customer__payments-email d-none">
                                    <p class="person-customer-email">Email</p>
                                    <p class="person-customer-email-addres"><?php echo e(auth()->user()->email); ?></p>
                                </div>
                                <div class="person-customer__payments-methods " onclick="customerPayment()">
                                    <div class="person-customer__payments-methods-a">
                                        Payment Methods <i class="fa fa-caret-down"></i>
                                    </div>
                                    <div class="person-customer__payments-methods-dropdown d-none">
                                        <p class="x person-customer-x" aria-hidden="true">&times;</p>
                                        <div class="person-customer__payments-methods-dropdown-cards">
                                            <input type="radio">
                                            <img class="card-category" src="<?php echo e(asset('web_sayt/img/cards-visa.svg')); ?>" alt="">
                                            <div class="person-customer__payments-methods-dropdown-cards-number">
                                                <p>**** **** **** 4578</p>
                                                <p>Amex</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="person-customer__payments-support">
                                    <a class="person-customer__payments-support-a" href="">Support <img
                                            class="person-customer__payments-support-img" src="<?php echo e(asset('web_sayt/img/headphones.svg')); ?>" alt="">
                                    </a>
                                </div><br>
                                <?php if(!empty(Auth::user()->api_secret)): ?>
                                <div class="person-customer__payments-support">
                                    <a class="person-customer__payments-support-a" href="<?php echo e(route('meetings-list-zoom',[app()->getLocale()])); ?>">My Meetings List
                                    </a>
                                </div>
                                 <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="profile-customer__blok2 nl">
                    <div class="profile-customer-my-appointments">
                        <div class="my-appointments__title">
                            <p>My Appointments</p>
                        </div>
                        <?php if(count($InProcess)>0): ?>
                            <?php $__currentLoopData = $InProcess; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $InProcessVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                              <div class="my-appointments__complete-process">
                                <div class="my-appointments__complete-process-content">
                                    <div class="my-appointments__complete-process-content-flex">
                                        <div class="my-appointments-person__info">
                                            <div class="my-appointments-person__info-cont1 mr-4">
                                                <img class="my-appointments-person__info-img" src="<?php echo e(asset('web_sayt/img_practitioners/'.$InProcessVal->img)); ?>" alt="">
                                            </div>
                                            <div class="my-appointments-person__info-cont2">
                                                <div class="my-appointments-person__info-name"><?php echo e($InProcessVal->first_name); ?> <?php echo e($InProcessVal->last_name); ?></div>
                                                <div class="my-appointments-person__info-specialist"><?php echo e($InProcessVal->service_name); ?></div>
                                                <div class="my-appointments-person__info-data"><?php echo e(date('M-jS, Y  H:i:s', strtotime($InProcessVal->start))); ?></div>
                                            </div>
                                        </div>

                                        <button
                                            class="profile-customer__my-appointments-button-edit my-appointments-person__complete-process-button btn bg-blue-white ">
                                            <a target="_blank" href="<?php echo e(route('customer-type-form-practitioner-view',[app()->getLocale(),'id'=>$InProcessVal->type_form_id])); ?>">Fill
                                                Intake Form</a>
                                        </button>


                                        <div class="profile-customer__my-appointments my-appointments-person__complete-process">
                                            <div class="profile-customer__my-appointments-time my-appointments-person__complete-process-time"><?php echo e($InProcessVal->duration); ?> Mins
                                                Consultation</div>
                                            <div class="profile-customer__my-appointments-session  my-appointments-person__complete-process-session">
                                                <a target="_blank" href="<?php echo e($InProcessVal->join_url); ?>">Join session</a>
                                            </div>
                                            <div class="profile-customer__my-appointments-button-fill">
                                                <input type="hidden" name="join_url" value="<?php echo e($InProcessVal->create); ?>">
                                                <input type="hidden" name="join_url" value="<?php echo e($InProcessVal->join_url); ?>">
                                                <input type="hidden" name="password" value="<?php echo e($InProcessVal->password); ?>">
                                                <input type="hidden" name="duration" value="<?php echo e($InProcessVal->duration); ?>">
                                                <input type="hidden" name="service_id" value="<?php echo e($InProcessVal->service_id); ?>">
                                                <input type="hidden" name="email" value="<?php echo e($InProcessVal->email); ?>">
                                                <input type="hidden" name="first_name" value="<?php echo e($InProcessVal->first_name); ?>">
                                                <input type="hidden" name="last_name" value="<?php echo e($InProcessVal->last_name); ?>">
                                                <input type="hidden" name="phone_number" value="<?php echo e($InProcessVal->phone_number); ?>">
                                                <input type="hidden" name="practitioner_id" value="<?php echo e($InProcessVal->id); ?>">



                                                <?php
                                                    $date1 = $InProcessVal->create;
                                                    $date2 = now()->toDateTimeString();
                                                    $timestamp1 = strtotime($date1);
                                                    $timestamp2 = strtotime($date2);
                                                    $hour = abs($timestamp2 - $timestamp1)/(60*60);
                                                     $ChekHour = number_format($hour);
                                                    ?>

                                      <button class="profile-customer__my-appointments-button my-appointments-person__complete-process-button btn bg-yellow detail-btn" data-toggle="modal"
                                               data-target="<?php if($ChekHour <= 12){echo "#editHour"; }else{echo "#myModal";}?>"
                                              data-id="<?php echo e($InProcessVal->id); ?>">Edit
                                        </button>

                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>


                        <?php if(count($InProcess)>0): ?>
                            <?php echo e($InProcess->links()); ?>

                        <?php endif; ?>









                    </div>

                    <div class="profile-customer-favorites">
                        <div class="profile-customer-favorites__title">
                            <p>Favorites</p>
                        </div>
                        <?php $__currentLoopData = $PractitionerFavorite; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $PractitionerFavoriteVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <div class="find-result">
                            <div class="person">
                                <div class="person__info">
                                    <div class="person__info-cont1">
                                        <img class="person__info-img" src="<?php echo e(asset('web_sayt/img/person-foto.png')); ?>" alt="">
                                        <div class="person__info-rating">
                              <span class="gl-star-rating gl-star-rating--ltr" data-star-rating=""><select class="star-rating">

                                    <option value="5">5.0</option>
                                    <option value="4">4.0</option>
                                    <option value="3">3.0</option>
                                    <option value="2">2.0</option>
                                    <option value="1">1.0</option>
                                 </select><span class="gl-star-rating--stars s50" role="tooltip" aria-label="5.0"><span data-index="0"
                                                                                                                        data-value="1" class="gl-active"></span><span data-index="1" data-value="2"
                                                                                                                                                                      class="gl-active"></span><span data-index="2" data-value="3" class="gl-active"></span><span
                                          data-index="3" data-value="4" class="gl-active"></span><span data-index="4" data-value="5"
                                                                                                       class="gl-active gl-selected"></span></span></span>
                                        </div>
                                        <p class="perion__info-session">256<span> Sessions</span></p>
                                        <a href=""  class="btn bg-yellow" data-toggle="modal" data-target="#service-modal<?php echo e($PractitionerFavoriteVal->partit_id); ?>">View Services</a>
                                    </div>
                                    <div class="person__info-cont2">
                                        <div class="person__info-name"><?php echo e($PractitionerFavoriteVal->first_name); ?> <?php echo e($PractitionerFavoriteVal->last_name); ?></div>
                                        <div class="person__info-specialist">Acne Specialist &amp; Holistic nutritionist (CNP)</div>
                                        <div class="person__info-skin">
                                            <?php $__currentLoopData = $Teg->where("practitioner_id",$PractitionerFavoriteVal->partit_id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $TegVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="person__info-skin-tag"><?php echo e($TegVal->name); ?></span>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                        <div class="person__info-rate">HOURLY RATE FROM</div>
                                        <div class="person__info-aed">AED <span class="person__info-aed-number">42.24</span></div>
                                    </div>
                                        <div class="person__info-heart active active-pr" id="<?php echo e($PractitionerFavoriteVal->partit_id); ?>"></div>
                                </div>
                                <div class="person__content">
                                    <ul class="person__content-nav">
                                        <li class="borderbg"><a class="person__content-nav-category active">Video</a></li>
                                        <li class="borderbg"><a class="person__content-nav-category">Intro</a></li>

                                    </ul>

                                    <div class="person__content-video">
                                        <div class="video_wrapper video_wrapper_full js-videoWrapper">
                                            <iframe class="videoIframe js-videoIframe" src="" frameborder="0" allowtransparency="true"
                                                    allowfullscreen="" data-src="<?php echo e(asset('web_sayt/video_practitio/'.$PractitionerFavoriteVal->video)); ?>"></iframe>
                                            <button class="videoPoster js-videoPoster"></button>
                                        </div>
                                    </div>
                                    <div class="person__content-intro ds-none">
                                        <p><?php echo e($PractitionerFavoriteVal->description); ?></p>
                                    </div>


                                    <div class="profile-customer-favorites-social">
                                        <a class="profile-customer-favorites-social-a" href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a class="profile-customer-favorites-social-a" href="#"><i class="fab fa-instagram"></i></a>
                                        <a class="profile-customer-favorites-social-a" href="#"><i class="fab fa-linkedin-in"></i></a>
                                    </div>
                                </div>
                                <!-- <div class="profile-customer-favorites-social"> -->

                                <!-- </div> -->

                            </div>
                        </div>
                            <?php echo $__env->make('profile-customer.service-list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>









                    </div>
                    <div class="profile-customer-reviews">
                        <div class="profile-customer-reviews__title">
                            <p>My Reviews</p>
                        </div>

               <?php if(count($Review)>0): ?>
                    <?php $__currentLoopData = $Review; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ReviewVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="profile-customer-reviews-cont">
                            <div class="profile-customer-reviews-cont__info">
                                <div class="profile-customer-reviews-cont__info-cont1">
                                    <img class="profile-customer-reviews-cont__info-img" src="<?php echo e(asset('web_sayt/img_practitioners/'.$ReviewVal->img)); ?>" alt="">
                                </div>
                                <div class="profile-customer-reviews-cont__info-cont2">
                                    <div class="profile-customer-reviews-cont__info-name">
                                        <p><?php echo e($ReviewVal->first_name); ?> <?php echo e($ReviewVal->last_name); ?></p>
                                        <div class="profile-customer-reviews-cont__info-name-rat-clock">
                                            <div class="profile-customer-cont-rat">
                                 <span class="gl-star-rating gl-star-rating--ltr " data-star-rating="">
                                    <select class="star-rating">

                                       <option value="5"></option>
                                       <option value="4"></option>
                                       <option value="3"></option>
                                       <option value="2"></option>
                                       <option value="1"></option>
                                    </select>
                                    <span class="gl-star-rating--stars s50" role="tooltip" aria-label="">
                                       <?php for($i = 0; $i < $ReviewVal->rate; $i++): ?>
                                            <span data-index="<?php echo e($i); ?>" data-value="<?php echo e($i); ?>" class="gl-active"
                                                  style="font-size: 28px;"></span>
                                        <?php endfor; ?>
                                    </span>
                                 </span>
                                            </div>
                                            <div class="profile-customer-cont-clock">
                                                <img src="<?php echo e(asset('web_sayt/img/clock.svg')); ?>" alt="" srcset="">
                                                <span class="reviews-clock-data"><?php echo e(date('M-d',strtotime($ReviewVal->created_at))); ?></span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="profile-customer-reviews-cont__info-specialist">Acne Specialist &amp; Holistic nutritionist (CNP)
                                    </div>
                                    <div class="profile-customer-reviews-cont__info-text">
                                        <?php echo e($ReviewVal->description); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               <?php endif; ?>
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


    <div class="modal fade show" id="editHour" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-modal="true" >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal__form lg-header-form">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="x" aria-hidden="true">??</span>
                    </button>
                    <div class="lg-sg__form">
                        <div class="lg-sg__form-text">You can change the date only <span style="color: red;">12 hours in advance.</span</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>

    <script src="<?php echo e(asset('web_sayt/js/jquery.js')); ?>"></script>
    <script>
        // $(document).on('click','.detail-btn', function(){

            // var create         = $(this).prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().val();
            //
            //
            // // Check live DateTime
            // var today = new Date();
            // var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
            // var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
            // var LiveDateTime = date + ' ' + time;
            //
            //
            // function diff_hours(dt2, dt1)
            // {
            //     var diff =(dt2.getTime() - dt1.getTime()) / 1000;
            //     diff /= (60 * 60);
            //     return Math.abs(Math.round(diff));
            // }
            //
            // var d1 = new Date(create);
            // var d2 = new Date(LiveDateTime);
            //
            // var diff = diff_hours(d1, d2);
            //
            // if(diff<14)
            // {
            //     alert('Yes');
            // }
            //
            //
            // })
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


// alert('practitionerID => '+practitionerID);
// alert('phone_number => '+phone_number);
// alert('last_name => '+last_name);
// alert('first_name => '+first_name);
// alert('email => '+email);
//  alert('service_id => '+service_id);
// alert('durationn => '+durationn);
// alert('password => '+password);
// alert('join_url => '+join_url);
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
                            <?php if(isset(Auth::user()->id)): ?>
                        var add_user_id = "<?php echo e(Auth::user()->id); ?>";
                        <?php endif; ?>





                        if(title !== "" && pasword !== "" && duration !== ""){

                            $.ajax({
                                url: "<?php echo e(route('add-zoom-meeting',app()->getLocale())); ?>",
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

                                    if(data.NoRepeatService != null)
                                    {
                                        alert(data.NoRepeatService)
                                    }else{
                                        alert("Event Created Successfully");
                                    }

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

                        var id = event.id;
                        var user_id = event.user_id;
                        var meeting_id = event.meeting_id;
                        var duration = event.duration;
                        var password = event.password;
                        var title = event.title;



                        if (confirm("Do you want to change your meeting details?")) {

                            var title = prompt('Edit Title:', title);
                            var password = prompt('Edit Password:', password);
                            var duration = prompt('Edit Title:', duration);

                            // submitTimeChanges(event.id);
                            $.ajax({
                                url: "/en/update-zoom-meeting",
                                type: "POST",
                                data: {
                                    title: title,
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
                                    type: 'update'
                                },
                                success: function (response) {
                                    calendar.fullCalendar('refetchEvents');
                                    //alert("Event Updated Successfully");

                                    if(response.Hour != null)
                                    {
                                        alert(response.Hour)
                                    }else{
                                        alert("Event Updated Successfully");
                                    }
                                }
                            })
                        }
                    }else{
                        alert('You can not make appointments with back date.');
                    }

                },

                eventClick:function(event)
                {
                    var id         = event.id;
                    var user_id    = event.user_id;
                    var meeting_id = event.meeting_id;


                        <?php if(!empty(Auth::user()->id)): ?>

                    var AuthID = <?php echo e(Auth::user()->id); ?>



                if(AuthID === user_id) {

                    if (confirm("Are you sure you want to remove it?")) {

                        $.ajax({
                            url: "<?php echo e(route('zoom-delete',app()->getLocale())); ?>",
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
                    <?php endif; ?>
                },

                eventColor: '#378006'
            });

        });
    </script>

    <script src="<?php echo e(asset('web_sayt/js/bootstrap/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('web_sayt/js/filter.js')); ?>"></script>
    <script src="<?php echo e(asset('web_sayt/js/script.js')); ?>"></script>
    <script src="<?php echo e(asset('web_sayt/js/star-rating.js')); ?>"></script>
    <script src="<?php echo e(asset('web_sayt/js/star-run.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('web_sayt/js/owl.carousel.min.js')); ?>"></script>
    <script src="<?php echo e(asset('web_sayt/js/carusel.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('web_sayt/js/script.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('web_sayt/js/readMoreJS.min.js')); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>







    <script>
        alert(diff)
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('app.layouts.app_home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OpenServer\domains\feature.loc\resources\views/profile-customer.blade.php ENDPATH**/ ?>