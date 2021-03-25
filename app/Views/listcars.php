<?php
if (isset($listcar)) {

?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Content Row -->
        <!-- Begin Page Content -->

        <!-- Page Heading -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Car Details</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Car License plate</th>
                                <th>Current Driver</th>
                                <th>Make</th>
                                <th>Model</th>
                                <th>Year</th>
                                <th>Rental Company</th>
                                <th>Return Date</th>
                                <th>Car Mileage</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th> Car License plate</th>
                                <th>Current Driver</th>
                                <th>Make</th>
                                <th>Model</th>
                                <th>Year</th>
                                <th>Rental Company</th>
                                <th>Return Date</th>
                                <th>Car Mileage</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            if (isset($listcar)) {
                                foreach ($listcar as $row) {
                                    echo "<tr>";
                                    echo "<td>{$row['car_noplate']}</td>";
                                    // $driver_id=$db->table('tbl_car_transaction')->select('first_name,last_name')->join('tbl_user', 'tbl_user.user_id=tbl_car_transaction.driver_id')->where("car_id", $row['car_id'])->get()->getRowArray();
                                    if (!empty($driver_id)) {
                                        echo "<td>{$driver_id['first_name']} {$driver_id['last_name']}</td>";
                                    } else {
                                        echo "<td>No driver allocated</td>";
                                    }
                                    echo "<td>{$row['make']}</td>";
                                    echo "<td>{$row['model']}</td>";
                                    echo "<td>{$row['year']}</td>";
                                    echo "<td>{$row['rentalcompany']}</td>";
                                    echo "<td>{$row['returndate']}</td>";
                                    echo "<td>{$row['car_mileage']}</td>";
                                    echo "<td><a href=" . site_url() . "/dashboard/editcar/{$row['car_id']} class='btn btn-success'  ><i class='fas fa-edit'></i></a></td>";
                                    echo "<td><a href='#' class='btn btn-danger deletecar' id={$row['car_id']} ><i class='fas fa-trash'></i></a></td>";
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
<?php
}
?>