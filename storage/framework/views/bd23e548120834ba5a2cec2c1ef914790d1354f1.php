


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
            <div class="lg-sg">
                <div class="lg-sg__img">
                    <img src="<?php echo e(asset('web_sayt/img/Group 1613.svg')); ?>" alt="">
                </div>

                <!-- Forgat Pass -->
                <div>
                    <div class="lg-sg__form-text">Forgot Password?</div>
                    <form method="POST" action="<?php echo e(route('forget-password-practitioners',[app()->getLocale()])); ?>">
                       <?php echo csrf_field(); ?>
                        <p class="lg-sg-p">E-mail</p>
                        <input type="email" class="fadeIn email <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" autocomplete="email" autofocus>
                         <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><a style="color: red"><?php echo e($message); ?></a><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <?php if(session('status')): ?><a style="color: red"><?php echo e(session('status')); ?></a>  <?php endif; ?>
                        <?php if(session('success')): ?><a style="color: green"><?php echo e(session('success')); ?></a>  <?php endif; ?>
                        <a class="lg-sg__forgot-back " href="<?php echo e(route('login-practitioners',[app()->getLocale()])); ?>">Back to again</a>
                        <div class="lg-sg__button reset-pass">
                            <input type="submit"  class="btn bg-yellow" value="Reset Password">
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




<?php /**PATH C:\OpenServer\domains\feature.loc\resources\views/customauth/passwords/email.blade.php ENDPATH**/ ?>