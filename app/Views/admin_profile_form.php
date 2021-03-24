 
 <?php

?>
<style>
  @media only screen and (max-width: 767px) {
    .modiletd {
      display: inline-flex;
    }
  }
  .error_msg{
    color:red;
  }    
</style>
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">

  </div>
  <!-- Content Row -->
  <div class="row">

    <div class="container-fluid">


      <!-- Content Row -->

      <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-7">
          <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Administrator Profile</h6>

            </div>
            <!-- Card Body -->
            <!-- <?php $validation = \Config\Services::validation(); ?> -->
            <div class="card-body">
              <form method="post" action="<?php echo base_url();  ?>/dashboard/update_admin_data">
                <div class="form-group row">

                  <div class="col-sm-5 mb-3 mb-sm-0">
                    <input type="hidden" name="id" value="<?php echo $adminprofile['user_id']; ?>" />
                    <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Username" value="<?php echo  $adminprofile['username']; ?>" title="username" disabled="ture" required>
                    <!-- Error -->
                    <?php if ($validation->getError('username')) { ?>
                      <p class='error_msg'>
                        <?= $error = $validation->getError('username'); ?>
                      </p>
                    <?php } ?>
                  </div>
               

                </div>
                <br />
                <div class="row">
                <div class="col-sm-5 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" id="password" name="password" title="Please enter Password" placeholder="New Password">
                   <!-- Error -->
                   <?php if ($validation->getError('password')) { ?>
                     <p class='error_msg'>
                        <?= $error = $validation->getError('password'); ?>
                      </p>
                    <?php } ?>
                  </div>
                  <div class="col-sm-5 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" id="c_password" name="c_password" title="Please Confirm Password" placeholder="Confirm Password" >
                       <!-- Error -->
                       <?php if ($validation->getError('c_password')) { ?>
                       <p class='error_msg'>
                        <?= $error = $validation->getError('c_password'); ?>
                      </p>
                    <?php } ?>
                  </div>
                </div>
                <br/>
                <div class="row">
                  <div class="col-sm-2 mb-3 mb-sm-0">
                    <input type="submit" class="btn btn-primary btn-user btn-block" id="btncount" value="Update" name="btncount" />
                  </div>
                </div>

              </form>

            </div>
          </div>
        </div>


      </div>

    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- End of Main Content -->







</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->