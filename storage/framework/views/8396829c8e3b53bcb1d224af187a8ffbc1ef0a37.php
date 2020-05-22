<?php $__env->startSection('content'); ?>





            <div class="content">



              <!-- Styles -->
                <link href="/css/loader.css" rel="stylesheet">







                  <div class="loader-wrapper">


                    <ul style="align-self:center;padding:0 2px; font-size: 40px;">

                      <ul>
                      <img  src ="https://www.wits.ac.za/media/wits-university-style-assets/images/wits-logo.png" alt="wits logo">
                    </ul>
                    <div class="title m-b-md">
                      Exam Scheduler -
                      <?php if(Route::has('login')): ?>
                        <!--  <div class="top-right links">-->
                              <?php if(auth()->guard()->check()): ?>
                                  <a href="<?php echo e(url('/home')); ?>" style="color:silver;">Home</a>
                              <?php else: ?>
                                  <a href="<?php echo e(route('login')); ?>" style="color:silver;">Login</a>

                                <!--  <?php if(Route::has('register')): ?>
                                      <a href="<?php echo e(route('register')); ?>">Register</a>
                                  <?php endif; ?>
                                -->
                              <?php endif; ?>
                        <!--  </div>-->
                      <?php endif; ?>
                    </div>

                          <span class="loader">
                            <span class="loader-inner">

                          </span>

                        </span>



                    </ul>



                  </div>

                  <!--Loading cube-->
                  <script>
                    $(window).on("load",function(){
                      $(".loader-wrapper").fadeOut("slow");
                      });
                  </script>

                  <footer>
                    copyright 2020 - CodeName: Kids Nextdoor
                  </footer>






            </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/parrotphish/yu3/Projects/escheduler/resources/views/welcome.blade.php ENDPATH**/ ?>