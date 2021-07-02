<?php $__env->startSection('style header'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('web_sayt/css/bootstrap/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('web_sayt/css/owl-carousel-min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('web_sayt/css/owl.theme.default.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('web_sayt/css/star-rating.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('web_sayt/css/css/main.css')); ?>">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('title', __('site.Home') ); ?>




<?php $__env->startSection('content'); ?>
    <script>var body = document.body; body.classList.add("body");</script>

    <h2>Added Teg List</h2><br>

    <form method="post" action="<?php echo e(route('add-tag-my-list-management',[app()->getLocale()])); ?>">
        <?php echo csrf_field(); ?>

            <?php $__currentLoopData = $TagManagements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $TagManagement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <?php if($TagManagement->published == 1): ?>
                        <input type="checkbox" name="teg_management[<?php echo e($index); ?>]" value="<?php echo e($TagManagement->id); ?>">
                    <?php endif; ?>
                <span <?php if($TagManagement->published == 0): ?>style="color: red;" <?php endif; ?>><?php echo e($TagManagement->name); ?></span><br>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <input type="submit" value="Add Teg To my list">


    </form> <br>
    <section>


        <div class="form-group">
            <form method="post" action="<?php echo e(route('add-tag-management',[app()->getLocale()])); ?>">
                <?php echo csrf_field(); ?>
            <p>Add Tag</p>
            <input style="border: 1px solid black" type="text" name="add_teg">
            <button type="submit" class="btn btn-gradient-primary mr-2" style="background-color: #28a745; color: white;">Add</button>
            </form><br>

            <h1>Delete</h1>
            <form method="post" action="<?php echo e(route('delete-tag-management',[app()->getLocale()])); ?>">
                <?php echo csrf_field(); ?>
                

                <?php $__currentLoopData = $MyTagManagements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ind => $GetTagManagements): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <input style="border: 1px solid black" type="checkbox" value="<?php echo e($GetTagManagements->teg_managements_id); ?>" name="teg_management[<?php echo e($ind); ?>]"><?php echo e($GetTagManagements->name); ?><br>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><br>
                <button type="submit" class="btn btn-gradient-primary mr-2" style="background-color: #28a745; color: white;">Delete</button>
            </form>
        </div><br>







        <div class="container">
            <div class="profile-practitioner">
                <div class="profile-practitioner__user nl">
                    <div class="person__info">
                        <div class="person__info-cont1">
                            <img class="person__info-img" src="<?php if(session()->get('UserImg')): ?><?php echo e(asset('web_sayt/img/'.session()->get('UserImg'))); ?><?php else: ?><?php echo e(asset('web_sayt/img/person-foto.png')); ?><?php endif; ?>" alt="">
                            <div class="person__info-name">
                                <span class="profile-practitioner-name"><?php echo e(session()->get('UserName')); ?>  <?php echo e(session()->get('UserLastName')); ?></span>
                                <span class="edit-pen"><a href="<?php echo e(route('edit-profile-practitioner',[app()->getLocale()])); ?>"><img src="<?php echo e(asset('web_sayt/img/edit-pen.svg')); ?>" alt=""></a></span>


                            </div>
                            <div class="person__info-specialist">Acne Specialist &amp; Holistic nutritionist (CNP)</div>
                            <div class="person__info-skin">
                                <?php $__currentLoopData = $MyTagManagements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $GetTagManagements): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="person__info-skin-tag"><?php echo e($GetTagManagements->name); ?></span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="person__info-my">
                                <p><a href="<?php echo e(route('my-appointments-practitioners',[app()->getLocale()])); ?>">My Appointments</a></p>
                                <p>My Protocols</p>
                                <p><a href="<?php echo e(route('type-form-practitioner',[app()->getLocale()])); ?>">My Intake Forms</a></p>
                                <p><a target="_blank" href="https://typeform.com/">Create Intake Forms</a></p>

                            </div>
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
                              <span data-index="0" data-value="1" class="" style="font-size: -28px;"></span>
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
                    <div class="profile__reviews">
                        <p class="profile__reviews-title">REVIEWS</p>
                        <div class="profile__reviews-block">
                            <p class="profile__reviews-border"></p>
                            <div class="profile__reviews-person">

                                <img src="<?php echo e(asset('web_sayt/img/reviews-person.png')); ?>" alt="" srcset="">
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
                                    <span data-index="0" data-value="1" class="gl-active"
                                          style="font-size: -28px;"></span>
                                    <span data-index="1" data-value="2" class="gl-active"></span>
                                    <span data-index="2" data-value="3" class="gl-active"></span>
                                    <span data-index="3" data-value="4" class="gl-active"></span>
                                    <span data-index="4" data-value="5" class="gl-selected gl-active"></span>
                                 </span>
                              </span>
                                    </div>

                                    <div class="profile__reviews-content-clock">
                                        <img src="<?php echo e(asset('web_sayt/img/clock.svg')); ?>" alt="" srcset="">
                                        <span class="reviews-clock-data">January 02</span>
                                    </div>
                                    <div class="reviews-cooment">
                                        Morbi commodo sagittis euismod. Donec non facilisis dolor, sed facilisis risus. Praesent
                                        vitae posuere ante.
                                        Donec
                                        risus
                                        dui, feugiat pretium
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="profile__reviews-block">
                            <p class="profile__reviews-border"></p>
                            <div class="profile__reviews-person">

                                <img src="<?php echo e(asset('web_sayt/img/reviews-person-second.png')); ?>" alt="" srcset="">
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
                                    <span data-index="0" data-value="1" class="gl-active"
                                          style="font-size: -28px;"></span>
                                    <span data-index="1" data-value="2" class="gl-active"></span>
                                    <span data-index="2" data-value="3" class="gl-active"></span>
                                    <span data-index="3" data-value="4" class="gl-active"></span>
                                    <span data-index="4" data-value="5" class="gl-selected gl-active"></span>
                                 </span>
                              </span>
                                    </div>

                                    <div class="profile__reviews-content-clock">
                                        <img src="<?php echo e(asset('web_sayt/img/clock.svg')); ?>" alt="" srcset="">
                                        <span class="reviews-clock-data">January 02</span>
                                    </div>
                                    <div class="reviews-cooment">
                                        Morbi commodo sagittis euismod. Donec non facilisis dolor, sed facilisis risus. Praesent
                                        vitae posuere ante.
                                        Donec
                                        risus
                                        dui, feugiat pretium
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Calendar -->







































































































































































































                <!-- Calendar -->
                <div class="profile-practitioner__consultation nl">
                    <div class="profile-practitioner__consultation-video">
                        <input type="file" id="video-file" name="video-file">
                        <label for="video-file"><img class="upload" src="<?php echo e(asset('web_sayt/img/video-file.svg')); ?>" alt=""></label>
                    </div>
                    <div class="profile-practitioner__consultation-time">
                        <div class="profile-practitioner__consultation-time-content">
                            <p class="time-content-title">VIDEO CONSULTATION <img src="<?php echo e(asset('web_sayt/img/zoom-icon-logo.png')); ?>" alt=""></p>
                            <button class="btn bg-yellow">03:00 PM <span class="x" aria-hidden="true">×</span></button>
                            <button class="btn bg-yellow">04:00 PM <span class="x" aria-hidden="true">×</span></button>
                            <button class="btn bg-yellow">ADD</button>
                        </div>
                    </div>
                    <div class="profile-practitioner__consultation-carusel">
                        <div class="profile-practitioner__consultation-carusel-block">
                            <p>SERVICES</p>
                            <div id="customer-testimonals" class="owl-carousel owl-theme owl-loaded owl-drag">
                                <div class="owl-stage-outer">
                                    <div class="owl-stage"
                                         style="transition: all 0s ease 0s; width: 1963px; transform: translate3d(-367px, 0px, 0px);">
                                        <div class="owl-item cloned" style="width: 210.297px; margin-right: 35px;">
                                            <div class="item">
                                                <div class="services__content">
                                                    <div class="services__content-title">
                                                        First Consultation <span class="x" aria-hidden="true">×</span>
                                                    </div>
                                                    <div class="services__content-text">
                                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                                        Lorem Ipsum has been the
                                                    </div>
                                                    <div class="services__content-aed">
                                                        <p>1 hour <span>AED</span> <span>42.24</span></p>
                                                    </div>
                                                    <div class="services__content-book">
                                                        <a href="#" class="btn bg-yellow"> Book This Service</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="owl-item cloned" style="width: 210.297px; margin-right: 35px;">
                                            <div class="item">
                                                <div class="services__content">
                                                    <div class="services__content-title">
                                                        First Consultation <span class="x" aria-hidden="true">×</span>
                                                    </div>
                                                    <div class="services__content-text">
                                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                                        Lorem Ipsum has been the
                                                    </div>
                                                    <div class="services__content-aed">
                                                        <p>1 hour <span>AED</span> <span>42.24</span></p>
                                                    </div>
                                                    <div class="services__content-book">
                                                        <a href="#" class="btn bg-yellow"> Book This Service</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="owl-item active center" style="width: 210.297px; margin-right: 35px;">
                                            <div class="item">
                                                <div class="services__content">
                                                    <div class="services__content-title">
                                                        First Consultation <span class="x" aria-hidden="true">×</span>
                                                    </div>
                                                    <div class="services__content-text">
                                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                                        Lorem Ipsum has been the
                                                    </div>
                                                    <div class="services__content-aed">
                                                        <p>1 hour <span>AED</span> <span>42.24</span></p>
                                                    </div>
                                                    <div class="services__content-book">
                                                        <a href="#" class="btn bg-yellow"> Book This Service</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="owl-item active" style="width: 210.297px; margin-right: 35px;">
                                            <div class="item">
                                                <div class="services__content">
                                                    <div class="services__content-title">
                                                        First Consultation <span class="x" aria-hidden="true">×</span>
                                                    </div>
                                                    <div class="services__content-text">
                                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                                        Lorem Ipsum has been the
                                                    </div>
                                                    <div class="services__content-aed">
                                                        <p>1 hour <span>AED</span> <span>42.24</span></p>
                                                    </div>
                                                    <div class="services__content-book">
                                                        <a href="#" class="btn bg-yellow"> Book This Service</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="owl-item" style="width: 210.297px; margin-right: 35px;">
                                            <div class="item">
                                                <div class="services__content">
                                                    <div class="services__content-title">
                                                        First Consultation <span class="x" aria-hidden="true">×</span>
                                                    </div>
                                                    <div class="services__content-text">
                                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                                        Lorem Ipsum has been the
                                                    </div>
                                                    <div class="services__content-aed">
                                                        <p>1 hour <span>AED</span> <span>42.24</span></p>
                                                    </div>
                                                    <div class="services__content-book">
                                                        <a href="#" class="btn bg-yellow"> Book This Service</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="owl-item" style="width: 210.297px; margin-right: 35px;">
                                            <div class="item">
                                                <div class="services__content">
                                                    <div class="services__content-title">
                                                        First Consultation <span class="x" aria-hidden="true">×</span>
                                                    </div>
                                                    <div class="services__content-text">
                                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                                        Lorem Ipsum has been the
                                                    </div>
                                                    <div class="services__content-aed">
                                                        <p>1 hour <span>AED</span> <span>42.24</span></p>
                                                    </div>
                                                    <div class="services__content-book">
                                                        <a href="#" class="btn bg-yellow"> Book This Service</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="owl-item cloned" style="width: 210.297px; margin-right: 35px;">
                                            <div class="item">
                                                <div class="services__content">
                                                    <div class="services__content-title">
                                                        First Consultation <span class="x" aria-hidden="true">×</span>
                                                    </div>
                                                    <div class="services__content-text">
                                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                                        Lorem Ipsum has been the
                                                    </div>
                                                    <div class="services__content-aed">
                                                        <p>1 hour <span>AED</span> <span>42.24</span></p>
                                                    </div>
                                                    <div class="services__content-book">
                                                        <a href="#" class="btn bg-yellow"> Book This Service</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="owl-item cloned" style="width: 210.297px; margin-right: 35px;">
                                            <div class="item">
                                                <div class="services__content">
                                                    <div class="services__content-title">
                                                        First Consultation <span class="x" aria-hidden="true">×</span>
                                                    </div>
                                                    <div class="services__content-text">
                                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                                        Lorem Ipsum has been the
                                                    </div>
                                                    <div class="services__content-aed">
                                                        <p>1 hour <span>AED</span> <span>42.24</span></p>
                                                    </div>
                                                    <div class="services__content-book">
                                                        <a href="#" class="btn bg-yellow"> Book This Service</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="owl-nav disabled"><button type="button" role="presentation" class="owl-prev"><span
                                            aria-label="Previous">‹</span></button><button type="button" role="presentation"
                                                                                           class="owl-next"><span aria-label="Next">›</span></button></div>
                            </div>
                        </div>
                    </div>
                </div
            </div>
        </div>

    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>

    <script src="<?php echo e(asset('web_sayt/js/star-rating.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('web_sayt/js/jquery.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('web_sayt/js/bootstrap/bootstrap.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('web_sayt/js/bootstrap/bootstrap.bundle.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('web_sayt/js/owl.carousel.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('web_sayt/js/carusel.js')); ?>"></script>
    <script src="<?php echo e(asset('web_sayt/js/filter.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('web_sayt/js/script.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('app.layouts.app_home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OpenServer\domains\feature.loc\resources\views/profile-practitioner.blade.php ENDPATH**/ ?>