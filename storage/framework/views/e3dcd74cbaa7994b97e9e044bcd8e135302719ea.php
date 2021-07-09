<?php $__env->startSection('style header'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
          integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
          crossorigin="anonymous" />
    <link rel="stylesheet" href="<?php echo e(asset('web_sayt/css/bootstrap/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('web_sayt/css/css/main.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('web_sayt/css/css/responsive.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title', __('site.Home') ); ?>




<?php $__env->startSection('content'); ?>



    <section class="section1">
        <div class="container">
            <div class="find">
                <div class="find__title">
                    <p>Get <span>Balancd</span> for a<br> healthier more fulfilling life</p>
                </div>
                <div class="find__text">
                    <p>Find health and wellness tools</p>
                </div>
                <div class="find__form">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend ">
                            <img src="<?php echo e(asset('web_sayt/img/Group 1763.svg')); ?>" alt="" width="24px" height="25px">
                        </div>

                        <input type="text" class="find__input" placeholder="Service, Symptom or Practitioners"
                               aria-label="Service" aria-describedby="basic-addon1">

                    </div>
                    <div class="find__form-settings">
                        <button class="settings-button" ml-3="" data-toggle="modal" data-target="#find__filter"><i
                                class="fas fa-sliders-h"></i></button>
                    </div>

                </div>
                <div class="find__button">
                    <a href="<?php echo e(route('search',[app()->getLocale()])); ?>" class="btn bg-yellow">Lets go</a>
                </div>
            </div>
        </div>
        <!-- Login  -->
        <div class="modal fade show" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal__form lg-header-form">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="x" aria-hidden="true">×</span>
                        </button>
                        <div class="lg-sg__form">
                            <div class="lg-sg__form-text">Login</div>
                            <form method="POST">
                                <p class="lg-sg-p">E-mail</p>
                                <input type="text" class="fadeIn email" name="emali">
                                <p class="lg-sg-p">Password</p>
                                <input type="password" class="fadeIn" name="password">
                                <div class="lg-sg__check">
                                    <input type="checkbox" name="remember" value="Remember me" id="lg-sg__check"><label
                                        for="remember"> Remember
                                        me</label>
                                </div>
                                <div class="lg-sg__forgot">
                                    <p class="lg-sg__forgot-p"><button><span aria-hidden="true">Forgot your
                                    password?</span></button></p>
                                </div>

                                <div class="lg-sg__button">
                                    <input type="submit" form="auth" class="btn bg-yellow" value="Log In">
                                </div>
                                <div class="lg-sg__signup">
                                    <p class="lg-sg-p lg-sg-overflow"> Don't have an account? <a class="lg-sg-overflow" href="#"
                                                                                                 aria-label="Close" data-toggle="modal" data-dismiss="modal"
                                                                                                 data-target="#sign-up"><span aria-hidden="true"> Sign
                                    Up </span></a>
                                    </p>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign Up -->
        <div class="modal fade show" id="sign-up" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal__form sg-header-form">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="x" aria-hidden="true">×</span>
                        </button>
                        <div class="lg-sg__form">
                            <div class="lg-sg__form-text">Create Account</div>
                            <form id="auth" method="POST">
                                <p class="lg-sg-p">First Name</p>
                                <input type="text" id="name-sign-up" class="fadeIn" name="name">
                                <p class="lg-sg-p">Last Name</p>
                                <input type="text" id="last-name-sign-up" class="fadeIn" name="last-name">
                                <p class="lg-sg-p">E-mail</p>
                                <input type="text" id="email" class="fadeIn" name="emali">
                                <p class="lg-sg-p">Password</p>
                                <input type="password" id="password" class="fadeIn" name="password">
                                <p class="lg-sg-p">Confirm Password</p>
                                <input type="password" id="confirm-password" class="fadeIn" name="confirm-password">
                                <div class="lg-sg__button">
                                    <input type="submit" form="auth" class="btn bg-yellow" value="Sign Up">
                                </div>
                                <div class="lg-sg__signup">
                                    <p class="lg-sg-p"> Already have an account? <a class="lg-sg-overflow" href="#"
                                                                                    aria-label="Close" data-toggle="modal" data-dismiss="modal" data-target="#login"><span
                                                aria-hidden="true"> Sign In </span></a></p>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Find Setting Window -->
        <div class="modal fade show" id="find__filter" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal__form ">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="x" aria-hidden="true">×</span>
                        </button>
                        <p class="main-title">Filters</p>
                        <p class="main-title2">Get it right for you</p>

                        <form method="POST" action="<?php echo e(route('search',[app()->getLocale()])); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="create__checkbox">
                                <p>Mode of delivery</p>
                                <input type="checkbox" name="vir" value="virtual" id="virtual" class="lg-sg__checkin"><label
                                    for="virtual">Virtual</label>
                                <input type="checkbox" name="per" value="in_persion"  id="in_persion" class="lg-sg__checkin"><label for="in_persion">
                                    In Person</label>
                            </div>
                            <div class="user-info">
                                <p class="create-p">Language</p>
                                <select class="fadeIn" name="state" id="state">
                                    <option value="">Select Language</option>
                                    <?php $__currentLoopData = $Languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($lang->id); ?>"><?php echo e($lang->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="create__checkbox">
                                <p>Preferred Practitioner Gender</p>
                                <input type="radio" name="gender" value="Male" id="male" class="lg-sg__checkin">
                                <label for="male" class="ml-2">Male</label>
                                <input type="radio" name="gender" value="Famale"  id="female" class="lg-sg__checkin">
                                <label for="female" class="ml-2">
                                    Female</label>
                            </div>
                            <div class="create__checkbox">
                                <p>Avalible appointments this week</p>
                                <?php $__currentLoopData = $TegManagements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$TegManagements): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <input type="checkbox" id="check"  name="teg_management[<?php echo e($key); ?>]" value="<?php echo e($TegManagements->id); ?>" class="lg-sg__checkin">
                                    <label for="check"><?php echo e($TegManagements->name); ?></label>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>


                            <div class="lg-sg__button">
                                <a><input type="submit"  class="btn bg-yellow"
                                          value="Lets Go"></a>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="live__chat">
            <img src="<?php echo e(asset('web_sayt/img/chat.svg')); ?>" alt="">
        </div>
    </section>
    <section class="section2" id="all-services">
        <div class="container">
            <div class="card-container">
                <div class="practit__title">
                    <span><?php echo e($TitleCategory->title); ?></span>
                    <div class="practit__border bg-yellow"></div>
                </div>
                <div class="card__flex">
                    <?php $__currentLoopData = $Category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="cd">
                        <div class="cd__content">
                            <img src="<?php echo e(asset('web_sayt/img_category/'.$category->img)); ?>" alt="">
                            <p><?php echo e($category->title); ?></p>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<script type="text/javascript" src="<?php echo e(asset('web_sayt/js/jquery.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('web_sayt/js/bootstrap/bootstrap.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('web_sayt/js/script.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('app.layouts.app_home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OpenServer\domains\feature.loc\resources\views/index.blade.php ENDPATH**/ ?>