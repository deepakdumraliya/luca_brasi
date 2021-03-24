 <!-- Begin Page Content -->

 <div class="container-fluid">





   <!-- Content Row -->





   <!-- Page Heading -->





   <!-- DataTales Example -->

   <div class="card shadow mb-4">

     <div class="card-header py-3">

       <h6 class="m-0 font-weight-bold text-primary">Driver Details</h6>

     </div>

     <div class="card-body">

       <div class="table-responsive">

         <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

           <thead>

             <tr>

               <th>First Name</th>

               <th>Last Name</th>

               <th>License No</th>


               <th>Username</th>
               <th>DOB</th>

               <th>Edit</th>

               <th>Delete</th>

             </tr>

           </thead>

           <tfoot>

             <tr>

               <th>First Name</th>

               <th>Last Name</th>

               <th>License No</th>

               <th>Username</th>
               <th>DOB</th>

               <th>Edit</th>

               <th>Delete</th>

             </tr>

           </tfoot>

           <tbody>

             <?php

              if (isset($drivers)) {



                foreach ($drivers as $row) {

                  echo "<tr>";

                  echo "<td>{$row['first_name']}</td>";


                  echo "<td>{$row['last_name']}</td>";

                  echo "<td>{$row['driver_license_no']}</td>";

                  echo "<td>{$row['username']}</td>";
                  if(empty($row['dob'])){
                    echo "<td>Birth Date Not added yet</td>";
                  }
                  else{
                  echo "<td>{$row['dob']}</td>";
                  }

                  echo "<td><a href=" . site_url() . "/dashboard/editdriver/{$row['user_id']} class='btn btn-success'  ><i class='fas fa-edit'></i></a></td>";

                  echo "<td><a href='#' class='btn btn-danger deletedriver' id={$row['user_id']} ><i class='fas fa-trash'></i></a></td>";

                  echo "</tr>";
                }
              }

              ?>

           </tbody>

         </table>

       </div>

     </div>

   </div>



 </div>



 </div>

 <!-- /.container-fluid -->





 <!-- End of Main Content -->