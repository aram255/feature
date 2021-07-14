<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
          integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
          crossorigin="anonymous" />
    <link rel="stylesheet" href="<?php echo e(asset('web_sayt/css/bootstrap/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('web_sayt/css/css/main.css')); ?>">
    <title>Login</title>
</head>

<body>
<section>
    <div class="container">
        <div class="mt-5">
            <a href="<?php echo e(route('index')); ?>" style="color: #585858; font-size: 26px">
                <i class="fas fa-times"></i>

            </a>
        </div>
        <div class="lg-sg">
            <div class="lg-sg__img">
                <img src="<?php echo e(asset('web_sayt/img/Group 1613.svg')); ?>" alt="">
            </div>
            <?php if(session('status')): ?><a style="color: red"><?php echo e(session('status')); ?></a>  <?php endif; ?>
            <div class="lg-sg__form">
                <div class="lg-sg__form-text">Login For Practitioner</div>
                <form method="POST" action="<?php echo e(route('login.custom',[app()->getLocale()])); ?>">
                    <?php echo csrf_field(); ?>
                    <p class="lg-sg-p">E-mail</p>
                    <input type="email" class="fadeIn email" name="email" value="<?php echo e(old('email')); ?>">
                    <a style="color: red;"><?php if($errors->has('email')): ?><?php echo e($errors->first('email')); ?><?php endif; ?></a>
                    <p class="lg-sg-p">Password</p>
                    <input type="password" class="fadeIn" name="password">
                    <a style="color: red;"><?php if($errors->has('password')): ?><?php echo e($errors->first('password')); ?><?php endif; ?></a>
                    <div class="lg-sg__check">
                        <input type="checkbox" name="remember" value="Remember me" id="remember" class="lg-sg__check-lg" />
                        <label for="remember"> Remember me</label>
                    </div>
                    <div class="lg-sg__forgot">
                        <a class="lg-sg__forgot-pass" href="<?php echo e(route('forget-password-view',[app()->getLocale()])); ?>" >Forgot your password?</a>
                    </div>

                    <div class="lg-sg__button">
                        <input type="submit"  class="btn bg-yellow" value="Log In">
                    </div>
                    <div class="lg-sg__signup">
                        <p class="lg-sg-p"> Don't have an account? <a href="<?php echo e(route('register-practitioners',[app()->getLocale()])); ?>"><span> Sign Up
                           </span></a></p>
                    </div>
                </form>
            </div>

            <!-- Change Pass -->
            <div class="change-pass lg-sg__form" style="display: none;">
                <div class="lg-sg__form-text">Change Password</div>
                <form method="POST" action="<?php echo e(route('forget-password-practitioners',[app()->getLocale()])); ?>">
                    <?php echo csrf_field(); ?>
                    <p class="lg-sg-p">New Password</p>
                    <input class="change-control fadeIn" id="password_1" name="password" type="password" >
                    <img src="./img/eye.svg" alt="" toggle="#password_1" class="fa fa-fw fa-eye field-icon toggle-password">

                    <p class="lg-sg-p">Confirm New Password</p>
                    <input class="change-control fadeIn" id="password_2" name="password_2" type="password">
                    <img src="./img/eye.svg" alt="" toggle="#password_2" class="fa fa-fw fa-eye field-icon toggle-password">



                    <div class="lg-sg__button">
                        <a href="./index.html"><input type="submit" form="auth" class="btn bg-yellow" value="Save Password"></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<script src="<?php echo e(asset('web_sayt/js/jquery.js')); ?>"></script>
<script src="<?php echo e(asset('web_sayt/js/change-pass.js')); ?>"></script>
</body>
</html>




<?php /**PATH C:\OpenServer\domains\feature.loc\resources\views/login-practitioners.blade.php ENDPATH**/ ?>