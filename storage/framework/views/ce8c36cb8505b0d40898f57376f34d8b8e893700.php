<?php echo $__env->make('include.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<body>
    <?php echo $__env->make('include.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



              <?php echo $__env->yieldContent('content'); ?>




  <?php echo $__env->make('include.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


            <?php echo $__env->yieldContent('style'); ?>

</body>

</html>
<?php /**PATH C:\OpenServer\domains\feature.loc\resources\views/app/layouts/app_home.blade.php ENDPATH**/ ?>