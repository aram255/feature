<header class="navigation-wrap">
    <nav class="navbar navbar-expand-lg nav-top">
        <div class="container">
            <a class="navbar-brand" href="<?php echo e(route('index',[app()->getLocale()])); ?>">Balancd</a>










            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <img src="<?php echo e(asset('web_sayt/img/menu.svg')); ?>" alt="">
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto nav-content">
                    <li class="nav-items border-blue">
                        <a class="nav-link" href="#">All Services</a>
                    </li>
                    <li class="nav-items border-blue">
                        <a class="nav-link" href="<?php echo e(route('blog',[app()->getLocale()])); ?>">Blog</a>
                    </li>
                    <?php if(!isset(auth()->user()->id) and !Session::has('UserID')): ?>
                    <li class="nav-items border-blue">
                        <a class="nav-link" href="./login-practitioners.html" ml-3="" data-toggle="modal"
                           data-target="#login">Login</a>
                    </li>
                    <li class="nav-items">
                        <a class="nav-link" href="#" ml-3="" data-toggle="modal" data-target="#sign-up">Sign Up</a>
                    </li>
                    <?php endif; ?>










                    <?php if(Session::has('UserID') and  !empty(session()->get('UserID'))): ?>
                    <li class="nav-items">
                        <a class="nav-link" href="<?php echo e(route("logout.custom",[app()->getLocale()])); ?>" ml-3="" >Log Out</a>
                     </li>
                    <li class="nav-items">
                        <a class="nav-link" href="<?php echo e(route('profile-practitioner',[app()->getLocale()])); ?>" ml-3=""  ><?php echo e(session()->get('UserLastName')); ?></a>
                    </li>
                    <?php endif; ?>
                    <?php if(!empty(Auth::user()->first_name)): ?>
                    <li class="nav-items">
                        <a class="nav-link" href="<?php echo e(route('profile-customer',[app()->getLocale()])); ?>" ml-3=""  >Hello <?php echo e(Auth::user()->first_name); ?></a>

                    </li>
                    <?php endif; ?>
                    <?php if(!Session::has('UserID') and !isset(auth()->user()->id)): ?>
                    <li class="nav-items">
                        <a class="nav-link " href="<?php echo e(route('login-practitioners',[app()->getLocale()])); ?>">For Practitioners</a>
                    </li>
                    <?php endif; ?>
































                    </li>

                    <li class="nav-items">
                        <?php if(isset(auth()->user()->id) and !empty(auth()->user()->id)): ?>
                            <form class="nav-items" method="POST" action="<?php echo e(route("logout",[app()->getLocale()])); ?>">
                                <?php echo csrf_field(); ?>
                                <a class="nav-link" href="<?php echo e(route("logout",[app()->getLocale()])); ?>" onclick="event.preventDefault();
                                                this.closest('form').submit();">Log Out</a>
                            </form>
                    </li>
                    <?php endif; ?>

                </ul>
            </div>
        </div>
    </nav>

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
                        <form method="POST" action="<?php echo e(route('login',[app()->getLocale()])); ?>">
                            <?php echo csrf_field(); ?>
                            <p class="lg-sg-p">E-mail</p>
                            <input type="email" class="email pt fadeIn" name="email" required autocomplete="email" autofocus>
                            <p class="lg-sg-p">Password</p>
                            <!-- id="password" -->
                            <input type="password" class="fadeIn" name="password" required>
                            <div class="lg-sg__check">
                                <input type="checkbox" name="remember" value="Remember me" class="lg-sg__check-lg" required><label
                                    for="remember"> Remember
                                    me</label>
                            </div>
                            <div class="lg-sg__forgot">
                                <a class="lg-sg__forgot-pass lg-sg-overflow" aria-label="Close"  href="<?php echo e(route('forget-password',[app()->getLocale()])); ?>"><span aria-hidden="true">Forgot your
                                 password?</span></a>
                            </div>

                            <div class="lg-sg__button">
                                <input type="submit"  class="btn bg-yellow" value="Log In">
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
                        <form method="POST" action="<?php echo e(route('register',[app()->getLocale()])); ?>">
                            <?php echo csrf_field(); ?>
                            <p class="lg-sg-p">First Name</p>
                            <input type="text" class="fadeIn" name="first_name" required autocomplete="first_name" autofocus>
                            <p class="lg-sg-p">Last Name</p>
                            <input type="text" class="fadeIn" name="last_name" required autocomplete="last_name" autofocus>
                            <p class="lg-sg-p">E-mail</p>
                            <input type="email" class="fadeIn email" name="email" required autocomplete="email" autofocus>
                            <p class="lg-sg-p">Password</p>
                            <input type="password" class="fadeIn" name="password" required>
                            <p class="lg-sg-p">Confirm Password</p>
                            <input type="password" class="fadeIn" name="password_confirmation" required>
                            <div class="lg-sg__button">
                                <input type="submit"  class="btn bg-yellow" value="Sign Up">
                            </div>
                            <div class="lg-sg__signup">
                                <p class="lg-sg-p"> Already have an account? <a class="lg-sg-overflow" href="#"
                                                                                aria-label="Close" data-toggle="modal" data-dismiss="modal" data-target="#login"><span
                                            aria-hidden="true"> Sign
                                    In </span></a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Forgat Password -->
    <div class="modal fade show" id="forgat-user-pass" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal__form sg-header-form">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="x" aria-hidden="true">×</span>
                    </button>
                    <div class="forgot-pass lg-sg__form ">
                        <div class="lg-sg__form-text">Forgot Password?</div>
                        <form method="POST">
                            <p class="lg-sg-p">E-mail</p>
                            <input type="text" class="fadeIn email" name="emali">
                            <a class="lg-sg__forgot-back lg-sg-overflow" aria-label="Close" data-toggle="modal"
                               data-dismiss="modal" data-target="#login"><span aria-hidden="true">Back to again</span></a>

                            <div class="lg-sg__button reset-pass lg-sg-overflow">
                                <input type="submit" form="auth" class="btn bg-yellow" value="Reset Password"
                                       aria-label="Close" data-toggle="modal" data-dismiss="modal"
                                       data-target="#reset-user-pass"><span aria-hidden="true">
                           </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Reset Password -->
    <div class="modal fade show" id="reset-user-pass" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal__form sg-header-form">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="x" aria-hidden="true">×</span>
                    </button>
                    <div class="change-pass lg-sg__form">
                        <div class="lg-sg__form-text">Change Password</div>
                        <form method="POST">

                            <p class="lg-sg-p">New Password</p>
                            <input class="change-control fadeIn" id="password_1" name="password" type="password">
                            <img src="<?php echo e(asset('web_sayt/img/eye.svg')); ?>" alt="" toggle="#password_1"
                                 class="fa fa-fw fa-eye field-icon toggle-password">

                            <p class="lg-sg-p">Confirm New Password</p>
                            <input class="change-control fadeIn" id="password_2" name="password_2" type="password">
                            <img src="<?php echo e(asset('web_sayt/img/eye.svg')); ?>" alt="" toggle="#password_2"
                                 class="fa fa-fw fa-eye field-icon toggle-password">



                            <div class="lg-sg__button">
                                <a href="./index.html"><input type="submit" form="auth" class="btn bg-yellow"
                                                              value="Save Password"></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<?php /**PATH C:\OpenServer\domains\feature.loc\resources\views/include/header.blade.php ENDPATH**/ ?>