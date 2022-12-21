<!-- Back-to-top -->
<a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>
<!-- JQuery min js -->
<script src="<?php echo e(URL::asset('admin-dashboard/assets/plugins/jquery/jquery.min.js')); ?>"></script>
<!-- Bootstrap Bundle js -->
<script src="<?php echo e(URL::asset('admin-dashboard/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<!-- Ionicons js -->
<script src="<?php echo e(URL::asset('admin-dashboard/assets/plugins/ionicons/ionicons.js')); ?>"></script>
<!-- Moment js -->
<script src="<?php echo e(URL::asset('admin-dashboard/assets/plugins/moment/moment.js')); ?>"></script>

<!-- Rating js-->
<script src="<?php echo e(URL::asset('admin-dashboard/assets/plugins/rating/jquery.rating-stars.js')); ?>"></script>
<script src="<?php echo e(URL::asset('admin-dashboard/assets/plugins/rating/jquery.barrating.js')); ?>"></script>

<!--Internal  Perfect-scrollbar js -->
<script src="<?php echo e(URL::asset('admin-dashboard/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('admin-dashboard/assets/plugins/perfect-scrollbar/p-scroll.js')); ?>"></script>
<!--Internal Sparkline js -->
<script src="<?php echo e(URL::asset('admin-dashboard/assets/plugins/jquery-sparkline/jquery.sparkline.min.js')); ?>"></script>
<!-- Custom Scroll bar Js-->
<script src="<?php echo e(URL::asset('admin-dashboard/assets/plugins/mscrollbar/jquery.mCustomScrollbar.concat.min.js')); ?>"></script>
<!-- right-sidebar js -->
<script src="<?php echo e(URL::asset('admin-dashboard/assets/plugins/sidebar/sidebar-rtl.js')); ?>"></script>
<script src="<?php echo e(URL::asset('admin-dashboard/assets/plugins/sidebar/sidebar-custom.js')); ?>"></script>
<!-- Eva-icons js -->
<script src="<?php echo e(URL::asset('admin-dashboard/assets/js/eva-icons.min.js')); ?>"></script>
<?php echo $__env->yieldContent('js'); ?>
<!-- Sticky js -->
<script src="<?php echo e(URL::asset('admin-dashboard/assets/js/sticky.js')); ?>"></script>
<!-- custom js -->
<script src="<?php echo e(URL::asset('admin-dashboard/assets/js/custom.js')); ?>"></script><!-- Left-menu js-->
<script src="<?php echo e(URL::asset('admin-dashboard/assets/plugins/side-menu/sidemenu.js')); ?>"></script>

<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.3/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>

<script>
$(document).ready(function () {
    $('#example').DataTable();
     $(".owl-carousel").owlCarousel();
});
</script>





<?php echo $__env->yieldPushContent('scripts'); ?>
<?php /**PATH D:\xampp\htdocs\laravelprojects\sofra-app\resources\views/dashboard/layouts/footer-scripts.blade.php ENDPATH**/ ?>