<?php $__env->startSection('content'); ?>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- Normal BOOKINGS -->
                <div class="special"><h1>Bookings</h1></div>




                  <form action="submit" method="POST" >
                    <?php echo csrf_field(); ?>
                    <div class="dash_body">
                     <label >Exam Title</label>
                     <div style="margin-left: 30em;" class="text"> <input type="text" name="title"></div>
                 </div>

                 <div class="dash_body">
                     <label >Add Courses</label>
                    <div style="margin-left: 29.1em;" class="text"> <input type="text" name="course"></div>
                 </div>

                 <div class="discription">
                     <label >Exam Discription</label>
                     <div style="margin-left: 27em;" class="text"><textarea maxlength="250" wrap="hard" type="text" name="discription" id="discription" cols="30" rows="5"></textarea></div>
                 </div>

                 <div class="dash_body">
                     <label >Duration</label>
                     <div style="margin-left: 30.5em;" class="text">
                         <select  type="text" name="duartion" id="">
                            <option >Choose Exam Duration</option>
                            <option value="30 min">30 min</option>
                            <option value="1 Hour">1 Hour</option>
                            <option value="2H ">2H</option>
                            <option value="2 H 30 min ">2 H 30 min</option>
                            <option value="3 H ">3 H </option>
                            <option value="3 H 30 min ">3 H 30 min</option>
                            <option value="4 H">4 H</option>
                            <option value="4 H 30 min ">4 H 30 min</option>
                            <option value="5 H">5 H</option>
                            <option value="5 H ">5 H </option>
                            <option value="5 H 30 min">5 H 30 min</option>
                            <option value="6 H">6 H</option>

                         </select>
                     </div>
                 </div>

                 <div class="dash_body">
                     <label >Venue Request</label>
                    <div style="margin-left: 28em;" class="text"> <input type="text" name="vanue"></div>
                 </div>

                 <div class="dash_body">
                     <label >Paper</label>
                     <div style="margin-left: 31.6em;" class="text">
                         <select type = "text" name="paperno" id="paperno">
                             <option  value="" ></option>
                             <option value="1">1</option>
                             <option value="2">2</option>
                             <option value="3">3</option>
                         </select>
                     </div>
                 </div>
                 <hr>
                 <!-- END Normal BOOKINGS -->

                 <!-- Special Requests -->
                 <div class="special"><h1>Special Request</h1></div>

                 <div class="dash_body">
                   <ol>
                     <label >Time</label>
                  <input type="time" name="startTime"> to <input type="time" name="endTime">
                 </ol>


                 <!--
                   <ol>
                     <label >Venue: </label>
                     <input type="text" name="venue ">
                   </ol>
                 -->



                   <ol>
                     <label >Type Of Table</label>

                         <select  name="tabletype" id="tabletype">
                             <option  value="" ></option>
                             <option value="Single Desk">Single Desk</option>
                             <option value="Double Desk">Double Desk</option>
                             <option value="Drawing Desk">Drawing Desk</option>
                         </select>

                   </ol>
                 </div>

                 <!-- End Special Requests -->

                    <button type="submit" name="button">submit</button>
                  </form>




        </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/parrotphish/yu3/Projects/escheduler/resources/views/home.blade.php ENDPATH**/ ?>