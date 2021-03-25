<?php
    echo "<pre>";
    print_r($days);
    echo "</pre>";
    die;
if (isset($days)) {

?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Content Row -->
        <!-- Begin Page Content -->

        <!-- Page Heading -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Driving Day Details</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Driver Name</th>
                                <th>Station</th>
                                <th>Start kilometer</th>
                                <th>End kilometer</th>
                                <th>car</th>
                                <th>Start Fuel Level</th>
                                <th>End Fuel Level</th>
                                <th>Accident Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Driver Name</th>
                                <th>Station</th>
                                <th>Start kilometer</th>
                                <th>End kilometer</th>
                                <th>car</th>
                                <th>Start Fuel Level</th>
                                <th>End Fuel Level</th>
                                <th>Accident Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            if (isset($days)) {
                                foreach ($days as $row) {
                                    echo "<tr>";
                                    echo "<td>{$row['user_id']}</td>";
                                    // $driver_id=$db->table('tbl_car_transaction')->select('first_name,last_name')->join('tbl_user', 'tbl_user.user_id=tbl_car_transaction.driver_id')->where("car_id", $row['car_id'])->get()->getRowArray();
                                    // if (!empty($driver_id)) {
                                    //     echo "<td>{$driver_id['first_name']} {$driver_id['last_name']}</td>";
                                    // } else {
                                    //     echo "<td>No driver allocated</td>";
                                    // }
                                    echo "<td>{$row['destincation_id']}</td>";
                                    echo "<td>{$row['start_kilometer']}</td>";
                                    echo "<td>{$row['end_kilometer']}</td>";
                                    echo "<td>{$row['car_id']}</td>";
                                    echo "<td>{$row['start_fuel_level']}</td>";
                                    echo "<td>{$row['end_fuel_level']}</td>";
                                    echo "<td>{$row['accident_status']}</td>";
                                    echo "<td><a href=" . site_url() . "/dashboard/editcar/{$row['day_id']} class='btn btn-success'  ><i class='fas fa-edit'></i></a></td>";
                                    echo "<td><a href='#' class='btn btn-danger deletecar' id={$row['day_id']} ><i class='fas fa-trash'></i></a></td>";
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