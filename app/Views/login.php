<body class="bg-gradient-primary">



  <div class="container">



    <!-- Outer Row -->

    <div class="row justify-content-center">



      <div class="col-xl-8 col-lg-12 col-md-6">



        <div class="card o-hidden border-0 shadow-lg my-5">

          <div class="card-body p-5">

            <!-- Nested Row within Card Body -->

            <div class="row">

           

              <div class="col-lg-12">

                <div class="p-5">

                  <div class="text-center">

                    <h1 class="h4 text-gray-900 mb-4">Welcome To LUCA BRASI!</h1>

                  </div>

                  <form class="user" method="post" action="<?php echo base_url();?>/index.php/home/login">

                    <div class="form-group">

                      <input type="text" class="form-control form-control-user" id="txtusername" name="txtusername" aria-describedby="emailHelp" placeholder="Enter Username"  required  value=<?php if(isset($username)) { echo $username ;} ?> >

                    </div>

                    <div class="form-group">

                      <input type="password" class="form-control form-control-user" id="txtpassword" name="txtpassword" placeholder="Password" required  value=<?php if(isset($password)) { echo $password ;}?>  >

                    </div>

                    <!-- <div class="form-group">

                      <div class="custom-control custom-checkbox small">

                        <input type="checkbox" class="custom-control-input" name="chkremember" id="customCheck">

                        <label class="custom-control-label" for="customCheck" <?php if(isset($password) && isset($username)) { echo "checked";}?> >Remember Me</label>

                      </div>

                    </div> -->

                    <input type="submit" name="brnlogin"  class="btn btn-primary btn-user btn-block" value="Login" />

                  

                 

                   

                  </form>

                  <hr>

                  <div class="text-center">

                    <a class="small" href="#" data-toggle="modal" data-target="#forgetpassword" >Forgot Password?</a>

                  </div>

                  

                </div>

              </div>

            </div>

          </div>

        </div>



      </div>



    </div>



  </div>



 



</body>