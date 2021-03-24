<?php

if($admin_details!=="")

{

  

   ?>

    <!-- Begin Page Content -->

 <div class="container-fluid">





   <!-- Content Row -->



   <div class="row">



<!-- Area Chart -->

<div class="col-xl-12 col-lg-7">

  <div class="card shadow mb-4">

    <!-- Card Header - Dropdown -->

    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

      <h6 class="m-0 font-weight-bold text-primary">Profile</h6>

    

    </div>

    <!-- Card Body -->

    <div class="card-body">

    <div class="form-group row">

                  <div class="col-sm-4 mb-3 mb-sm-0">

                  <img src="<?php echo base_url();?>/assets/img/admin.png" alt="Admin Profile"  style="width:150px; border-radius: 50%;">



                  </div>

                  <div class="col-sm-4">

                  <label><b>First name : </b><?php echo $admin_details[0]['first_name']; ?></label><br>

                  <label><b>Last name : </b><?php echo $admin_details[0]['last_name']; ?></label><br>

                  <label><b>Username : </b><?php echo $admin_details[0]['username']; ?></label>       

                </div>

                 

                </div>

              

            

                       

             

    </div>

  </div>

</div>





</div>



</div>

<!-- /.container-fluid -->



</div>

<!-- End of Main Content -->



   <?php

}

?>