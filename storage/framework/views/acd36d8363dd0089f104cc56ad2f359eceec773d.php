<div class="modal fade show" id="loginn" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
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
                            <input type="checkbox" name="remember" value="Remember me" class="lg-sg__check-lg" ><label
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

<footer class="footer">
    <div class="container">
        <div class="footer__content">
            <div class="footer__content-logo">
                <a href="#">Balancd</a>
            </div>
            <div class="footer__content-link">
                <div class="footer-link">
                    <p>Company</p>
                    <p>Resources</p>
                </div>
                <div class="footer-link">
                    <p>Browse</p>
                    <p>Feedback</p>
                </div>
                <div class="footer-link">
                    <p>Privacy</p>
                    <p>Work with us</p>
                </div>
                <div class="footer-link">
                    <p>Follow us ---</p>
                    <div class="footer-link__social">
                        <i class="fab fa-facebook-f"></i>
                        <i class="fab fa-instagram"></i>
                        <i class="fab fa-linkedin-in"></i>
                        <i class="fab fa-twitter"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>
</footer>


<?php /**PATH C:\OpenServer\domains\feature.loc\resources\views/include/footer.blade.php ENDPATH**/ ?>