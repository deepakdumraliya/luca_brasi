<?php

namespace App\Controllers;



class Dashboard extends BaseController

{
    /**
     * Instance of the main Request object.
     *
     * @var HTTP\IncomingRequest
     */
    protected $request;

    /**

     * index method is the first method to be getting loaded and display login page

     */

    public function __construct()
    {
        $this->session = \Config\Services::session();
        if (!session()->get('admin_id')) {

            echo view('header');
            echo view("login");
            echo view('footer');
            die;
        }
    }


    public function header()
    {
        if ($this->session->has('admin_id')) {

            $credentials = array(

                'user_id' => $this->session->get('admin_id')




            );

            $admin_details['admin_details'] = $this->usermodel->where($credentials)->findall();


            echo view('adminsidebar', $admin_details);
        }
    }
    public function index()
    {

        $this->header();
        echo view('dashboard_new');
        $this->footer();
    }

    public function footer()
    {
        echo view('footer');
    }
    /**

     * listdriver method is the used to load drivers lists

     */

    public function listdriver()
    {
        $credentials = array(
            "type_id" => 0
        );

        $driver_lists['drivers'] = $this->usermodel->where($credentials)->findall();
        $this->header();
        echo view('listdrivers', $driver_lists);
        $this->footer();
    }
    /**

     * newdriver method is the used to load add driver screen

     */

    public function newdriver()
    {
        $this->header();
        echo view('newdriver');
        $this->footer();
    }

    /**
     * adddriver method is the used to add driver details in database
     */

    public function adddriver()
    {
        helper(['form', 'url']);
        if ($this->request->getPost() != "") {
            $rules = [
                "txtfirstname" => ['label' => 'First Name', "rules" => "required"],
                "txtlastname" => ['label' => 'Make', "rules" => "required"],
                "txtemail" => ['label' => 'Email id', "rules" => "required|is_unique[tbl_user.username]"],
                "txtpassword" => ['label' => 'Password', "rules" => "required"],
                "txtrepeatpassword" => ['label' => 'Repeat Password', "rules" => "required|matches[txtpassword]"],
                "txtlicenseno" => ['label' => 'License No', "rules" => "required"],


            ];
            if (!$this->validate($rules)) {
                // $validation = \Config\Services::validation();
                // $this->session->set("success_alert_update", "<script>swal('".$validation->geterror('txtfirstname')."', {icon: 'warning',});</script>");
                // $this->session->set("success_alert_update", "<script>swal('".$validation->geterror('txtlastname')."', {icon: 'warning',});</script>");
                $this->session->set("success_alert_update", "<script>swal('" . $this->validator->geterror('txtemail') . "', {icon: 'warning',});</script>");
                // $this->session->set("success_alert_update", "<script>swal('".$validation->geterror('txtpassword')."', {icon: 'warning',});</script>");
                $this->session->set("success_repeate_pass", "<script>swal('" . $this->validator->geterror('txtrepeatpassword') . "', {icon: 'warning',});</script>");
                $this->session->set("success_alert_update", "<script>swal('" . $this->validator->geterror('txtlicenseno') . "', {icon: 'warning',});</script>");
                //return redirect()->to(site_url() . '/dashboard/newdriver');
                $this->newdriver();
            } else {


                $driverdetails = array(

                    'first_name'            => ucwords(trim($this->request->getPost('txtfirstname'), " ")),
                    'last_name'             => ucwords(trim($this->request->getPost('txtlastname'), " ")),
                    'username'              => trim($this->request->getPost('txtemail'), " "),
                    "dob"                   => trim($this->request->getPost('txtdob')),
                    'license_expiry_date'   => trim($this->request->getPost('dtexpdate')),
                    //   'password'=>$password,
                    'driver_license_no' => ucwords(trim($this->request->getPost('txtlicenseno'), " ")),
                    'type_id' => 0
                );



                $value = $this->usermodel->insert($driverdetails);

                if ($value != "") {
                    $this->session->set("success_alert", "<script>swal('Driver has been Added!', {icon: 'success',});</script>");
                    return redirect()->to(base_url() . '/dashboard/newdriver');
                } else {
                    $this->session->set("success_alert", "<script>swal('Something went wrong!', {icon: 'error',});</script>");
                    return redirect()->to(base_url() . '/dashboard/newdriver');
                }
            }
        }
    }

    /**
     * deletedriver method is the used to deleted driver details in database
     */

    public function deletedriver()
    {

        if ($this->request->getPost('driverid')) {

            $delete_driver = array(

                'user_id' => $this->request->getPost('driverid'),

                'type_id' => 0

            );

            if ($this->usermodel->where($delete_driver)->delete()) {

                echo true;
            } else {

                echo false;
            }
        }
    }

    /**
     * editdriver method is the used to load  edit driver view 
     */

    public function editdriver($editid)
    {

        if ($editid !== "") {
            $driver_details['car_list'] = $this->db->table('tbl_car')->select('car_id,car_noplate')->get()->getResultArray();

            $driver_details['driver_details'] = $this->usermodel->where('user_id', $editid)->findall();

            // $driver_details['car_details'] = $this->db->table('tbl_car_transaction')
            // ->select('*')
            // ->where('driver_id', $editid)
            // ->orderBy('car_id', 'desc')
            // ->limit(1)
            // ->get()->getRowArray();

            $this->header();
            echo view('editdriverdetails', $driver_details);

            $this->footer();
        }
    }

    /**
     * editdetails method is the used to edit driver details in database
     */

    public function editdetails()
    {
        helper(['form', 'url']);
        // $rules = [
        //     "txtfirstname" => ['label' => 'First Name',"rules"=>"required|alpha_numeric_space"],
        //     "txtlastname" => ['label' => 'Make',"rules"=>"required"],
        //     "txtemail" => ['label' => 'Email id',"rules"=>"required|is_unique[tbl_user.username]"],
        //     // "txtpassword" => ['label' => 'Password',"rules"=>"required"],
        //     // "txtrepeatpassword" => ['label' => 'Repeat Password',"rules"=>"required|matches[txtpassword]"],
        //     "txtlicenseno" => ['label' => 'License No',"rules"=>"required"],

        // ];
        // if (!$this->validate($rules)) {
        //     $validation = \Config\Services::validation();
        //     $this->session->set("success_alert_update", "<script>swal('".$validation->geterror('txtfirstname')."', {icon: 'warning',});</script>");
        //     $this->session->set("success_alert_update", "<script>swal('".$validation->geterror('txtlastname')."', {icon: 'warning',});</script>");
        // //    $this->session->set("success_alert_update", "<script>swal('".$validation->geterror('txtemail')."', {icon: 'warning',});</script>");
        //     // $this->session->set("success_alert_update", "<script>swal('".$validation->geterror('txtpassword')."', {icon: 'warning',});</script>");
        //     // $this->session->set("success_alert_update", "<script>swal('".$validation->geterror('txtrepeatpassword')."', {icon: 'warning',});</script>");
        //     $this->session->set("success_alert_update", "<script>swal('".$validation->geterror('txtlicenseno')."', {icon: 'warning',});</script>");
        //     //return redirect()->to(site_url() . '/dashboard/newdriver');
        //      $this->adddriver($this->request->getpost('edit_id'));
        // }tbl_car_transaction
        // else{

        if ($this->request->getPost() != "") {

            $password = "";

            if (empty($this->request->getPost('repeatpassword'))) {

                $password = $this->request->getPost('hiddenpassword');
            } else {

                $password = md5($this->request->getPost('repeatpassword'));
            }

            $update_driverdetails = array(

                'first_name' => ucwords(trim($this->request->getPost('txtfirstname'), " ")),

                'last_name' => ucwords(trim($this->request->getPost('txtlastname'), " ")),

                'username' => trim($this->request->getPost('txtemail'), " "),
                "dob" => trim($this->request->getPost('txtdob')),
                'license_expiry_date' => trim($this->request->getPost('dtexpdate')),

                'password' => $password,

                'driver_license_no' => ucwords(trim($this->request->getPost('txtlicenseno'), " "))


            );

            if ($this->usermodel->update(array('user_id' => $this->request->getpost('edit_id')), $update_driverdetails)) {
                $this->session->set("success_alert_update", "<script>swal('Driver has been Updated!', {icon: 'success',});</script>");
                return redirect()->to(base_url() . '/dashboard/listdriver');
            } else {

                $this->session->set("success_alert_update", "<script>swal('Something went wrong!', {icon: 'error',});</script>");

                return redirect()->to('/dashboard/listdriver');
            }
        }
        //  }


    }

    /**

     * listcars method is the used to load cars in datatable

     */

    public function listcars()
    {

        $carlist['listcar'] = $this->carmodel->findall();
        $carlist['db'] = $this->db;


        $this->header();

        echo view('listcars', $carlist);

        $this->footer();
    }

    public function editcar($editid)
    {

        $cardetails['car_details'] = $this->carmodel->where('car_id', $editid)->findall();

        $this->header();

        echo view('editcar', $cardetails);

        $this->footer();
    }

    /**

     * updatecars method is used to update car details in database

     */

    public function updatecar()
    {

        if ($this->session->has('admin_id')) {
            helper(['form', 'url']);

            if ($this->request->getPost() != "") {


                $rules = [
                    "txtnumberplate" => ['label' => 'Number Plate', "rules" => "required|is_unique[tbl_car.car_noplate]"],
                    "txtmake" => ['label' => 'Make', "rules" => "required"],
                    "txtmodel" => ['label' => 'Car Model', "rules" => "required"],
                    "txtmodelyear" => ['label' => 'Car Model year', "rules" => "required"],
                    "txtcolor" => ['label' => 'Color', "rules" => "required"],
                    "txtrentalcompany" => ['label' => 'Rental Company', "rules" => "required"],
                    "txtreturndate" => ['label' => 'Return Date', "rules" => "required"],

                    "txtcountrycode" => ['label' => 'Country Code', "rules" => "required"],
                    "txttrackingnumber" => ['label' => 'GPS Tracking Number', "rules" => "required|is_unique[tbl_car.gpstrackingnumber]"],

                    "txtmileage" => ['label' => 'Mileage', "rules" => "required|numeric"]
                ];
                $car_id = $this->request->getpost('hiddencarid');
                $val = $this->db->table('tbl_car')->where('car_id', $car_id)->get()->getRowArray();

                if ($val['car_noplate'] == strtoupper(trim($this->request->getPost('txtnumberplate'), " "))) {
                    $rules["txtnumberplate"] = ['label' => 'Number Plate', "rules" => "required"];
                }


                if ($val['gpstrackingnumber'] == trim($this->request->getPost('txttrackingnumber'))) {
                    $rules["txttrackingnumber"] = ['label' => 'Number Plate', "rules" => "required"];
                }



                if (!$this->validate($rules)) {
                    $this->session->set("success_alert_update", "<script>swal('" . $this->validator->geterror('txtnumberplate') . "', {icon: 'warning',});</script>");

                    $this->session->set("success_alert_update", "<script>swal('" . $this->validator->geterror('txttrackingnumber') . "', {icon: 'warning',});</script>");

                    $this->editcar($car_id);
                } else {
                    $update_cardetails = array(

                        'car_noplate' => strtoupper(trim($this->request->getPost('txtnumberplate'), " ")),

                        'make' => strtoupper(trim($this->request->getPost('txtmake'), " ")),

                        'model' => trim($this->request->getPost('txtmodel'), " "),

                        'year' => $this->request->getPost("txtmodelyear"),

                        'color' => ucwords(trim($this->request->getPost('txtcolor'), " ")),

                        'rentalcompany' => ucwords(trim($this->request->getPost('txtrentalcompany'), "")),

                        'returndate' => $this->request->getPost('txtreturndate'),
                        'countrycode' => trim($this->request->getPost('txtcountrycode')),
                        'gpstrackingnumber' => trim($this->request->getPost('txttrackingnumber')),

                        'car_mileage' => trim($this->request->getPost('txtmileage'))

                    );

                    if ($this->carmodel->update(array('user_id' => $this->request->getpost('hiddencarid')), $update_cardetails)) {

                        $this->session->set("success_alert_update_car", "<script>swal('Car has been Updated!', {icon: 'success',});</script>");



                        return redirect()->to(base_url() . '/dashboard/listcars');
                    } else {

                        $this->session->set("success_alert_update_car", "<script>swal('Something went wrong!', {icon: 'error',});</script>");



                        return redirect()->to(base_url() . '/dashboard/listcars');
                    }
                }
            }
        }
    }

    /**
     * New car form
     */
    public function newcar()
    {
        $this->header();

        echo view('addcar');

        $this->footer();
    }

    /**

     * addcar method is the used add data in database

     */

    public function addcar()
    {
        helper(['form', 'url']);

        if ($this->session->has('admin_id')) {

            if ($this->request->getPost() !== "") {

                $rules = [
                    "txtnumberplate" => ['label' => 'Number Plate', "rules" => "required|is_unique[tbl_car.car_noplate]"],
                    "txtmake" => ['label' => 'Make', "rules" => "required"],
                    "txtmodel" => ['label' => 'Car Model', "rules" => "required"],
                    "txtmodelyear" => ['label' => 'Car Model year', "rules" => "required"],
                    "txtcolor" => ['label' => 'Color', "rules" => "required"],
                    "txtrentalcompany" => ['label' => 'Rental Company', "rules" => "required"],

                    // "drpfueltype" => ['label' => 'Fuel Type',"rules"=>"required"],
                    "txtcountrycode" => ['label' => 'Country Code', "rules" => "required"],
                    "txttrackingnumber" => ['label' => 'GPS Tracking Number', "rules" => "required|is_unique[tbl_car.gpstrackingnumber]"],

                    "txtmileage" => ['label' => 'Mileage', "rules" => "required|numeric"]
                ];

                //print_r($this->request->getPost());tbl_car_transaction

                if (!$this->validate($rules)) {

                    $this->session->set("success_alert_update", "<script>swal('" . $this->validator->geterror('success_alert_update') . "', {icon: 'warning',});</script>");
                    $this->session->set("txttrackingnumber", "<script>swal('" . $this->validator->geterror('txttrackingnumber') . "', {icon: 'warning',});</script>");
                    $this->session->set("txtmake", "<script>swal('" . $this->validator->geterror('txtmake') . "', {icon: 'warning',});</script>");
                    $this->session->set("txtmodelyear", "<script>swal('" . $this->validator->geterror('txtmodelyear') . "', {icon: 'warning',});</script>");

                    $this->session->set("txtmodel", "<script>swal('" . $this->validator->geterror('txtmodel') . "', {icon: 'warning',});</script>");
                    $this->session->set("txtcolor", "<script>swal('" . $this->validator->geterror('txtcolor') . "', {icon: 'warning',});</script>");

                    $this->session->set("txtrentalcompany", "<script>swal('" . $this->validator->geterror('txtrentalcompany') . "', {icon: 'warning',});</script>");
                    $this->session->set("txtcountrycode", "<script>swal('" . $this->validator->geterror('txtcountrycode') . "', {icon: 'warning',});</script>");
                    $this->session->set("txtmileage", "<script>swal('" . $this->validator->geterror('txtmileage') . "', {icon: 'warning',});</script>");

                    return redirect()->to(site_url() . '/dashboard/newcar');
                } else {
                    $car_details = array(

                        'car_noplate' => strtoupper(trim($this->request->getPost('txtnumberplate'), " ")),
                        'make' => strtoupper(trim($this->request->getPost('txtmake'), " ")),
                        'model' => trim($this->request->getPost('txtmodel'), " "),
                        'year' => $this->request->getPost("txtmodelyear"),
                        'color' => ucwords(trim($this->request->getPost('txtcolor'), " ")),
                        'rentalcompany' => ucwords(trim($this->request->getPost('txtrentalcompany'), "")),
                        'returndate' => $this->request->getPost('txtreturndate'),
                        // 'fuel_type' => $this->request->getPost('drpfueltype'),
                        'countrycode' => trim($this->request->getPost('txtcountrycode')),
                        'gpstrackingnumber' => trim($this->request->getPost('txttrackingnumber')),
                        'car_mileage' => trim($this->request->getPost('txtmileage'))
                    );
                }

                if ($this->carmodel->insert($car_details)) {
                    $this->session->set("success_alert_update", "<script>swal('Car has been Added!', {icon: 'success',});</script>");
                    return redirect()->to(base_url() . '/dashboard/newcar');
                } else {
                    $this->session->set("success_alert_car", "<script>swal('Something went wrong!', {icon: 'error',});</script>");
                    return redirect()->to(base_url() . '/dashboard/newcar');
                }
            }
        } else {
            return redirect()->to(base_url());
        }
    }

    
    /**
     * View days list
     */
    public function view_days()
    {
        $filter_start_date=$this->request->getVar('start_date');
        $filter_end_date=$this->request->getVar('end_date');
        if(!isset($filter_start_date) ) 
        {
            echo "condition1";
            $today=date("Y-m-d");
            $condition=array(
                'start_timestamp >='=>$today
            );
        }
        elseif(isset($filter_start_date))
        {
           echo "condition2";
            $condition=array(
                'start_timestamp >=' => $filter_start_date
            );
        }
        elseif(isset($filter_start_date) && isset($filter_end_date))
        {
            echo "condition3";
            $condition=array(
                'start_timestamp >=' => $filter_start_date,
                'start_timestamp <=' => $filter_end_date
            );
        }
        elseif(isset($filter_start_date) && !isset($filter_end_date))
        {
            echo "condition4";
            $today=date("Y-m-d");
            $condition=array(
                'start_timestamp >=' => $filter_start_date,
                'start_timestamp <=' =>  $today
            );
        }
        $data['days'] = $this->drivingmodel->select()->where($condition)->get()->getResultArray();
        echo $this->db->getLastQuery();
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        // die;
        $data['db'] = $this->db;
        foreach ($data['days'] as $key => $day) {
            //driver name
            $data_user = $this->usermodel->select('first_name,last_name')->where('user_id', $day['user_id'])->get()->getRowArray();
            $name = $data_user['first_name'] . " " . $data_user['last_name'];
            $data['days'][$key]['driver_name'] = $name;

            //station name
            $data_station = $this->stationmodel->select('name')->where('destination_id', $day['destination_id'])->get()->getRowArray();

            $name = $data_station['name'];
            $data['days'][$key]['station'] = $name;

            //station name
            $data_car = $this->carmodel->select('car_noplate')->where('car_id', $day['car_id'])->get()->getRowArray();
            $no_plate = $data_car['car_noplate'];
            $data['days'][$key]['car_noplate'] = $no_plate;

            //day
            $date = $day['start_timestamp'];
            $newDate = date("d-m-Y", strtotime($date));
            $data['days'][$key]['day_date'] = $newDate;
        }


        $this->header();

        echo view('list_days', $data);

        $this->footer();
    }

    /**
     * View messages
     */
    public function messages()
    {

        $this->header();

        echo view('messages');

        $this->footer();
    }

    /**
     * Delete driving day
     */
    public function delete_driving_day()
    {
        if ($this->request->getPost('id')) {
            $delete = array(
                'day_id' => $this->request->getPost('id')
            );
            if ($this->drivingmodel->where($delete)->delete()) {
                echo true;
            } else {
                echo false;
            }
        }
    }

    /**
     * edit driving day details 
     */
    public function editday($day_id)
    {
        $data['day_details'] = $this->drivingmodel->select('*')->where('day_id', $day_id)->get()->getResultArray();



        foreach ($data['day_details'] as $key => $day) {

            //driver name
            $data_user = $this->usermodel->select('first_name,last_name')->where('user_id', $day['user_id'])->get()->getRowArray();
            $name = $data_user['first_name'] . " " . $data_user['last_name'];
            $data['day_details'][$key]['driver_name'] = $name;

            //day
            $date = $day['start_timestamp'];
            $newDate = date("d-m-Y", strtotime($date));
            $data['day_details'][$key]['day_date'] = $newDate;
        }

        $data['db'] = $this->db;

        $this->header();

        echo view('editday', $data);

        $this->footer();
    }

    public function updateday()
    {
        helper(['form', 'url']);
        if ($this->request->getPost() != "") {
            $valudation = array(
                'txtstartkm' => array(
                    "label" => "Start kilometer",
                    "rules" => 'required|numeric'
                ),
                'txtendtkm' => array(
                    "label" => "End Kilometer",
                    "rules" => 'required|numeric'
                ),
                'txtstartfuel' => array(
                    "label" => "Start Fuel",
                    "rules" => 'required|numeric'
                ),
                'txtendfuel' => array(
                    "label" => "End Fuel",
                    "rules" => 'required|numeric'
                ),
            );
            $input = $this->validate($valudation);

            $id = $this->request->getVar('id');

           
            if (!$input) {
                
                $this->header();
                $data['day_details'] = $this->drivingmodel->select('*')->where('day_id', $id)->get()->getResultArray();
                


                foreach ($data['day_details'] as $key => $day) {
                   
                    //driver name
                    $data_user = $this->usermodel->select('first_name,last_name')->where('user_id', $day['user_id'])->get()->getRowArray();
                    $name = $data_user['first_name'] . " " . $data_user['last_name'];
                    $data['day_details'][$key]['driver_name'] = $name;
                    // echo $id;die;
                    //day
                    $date = $day['start_timestamp'];
                    $newDate = date("d-m-Y", strtotime($date));
                    $data['day_details'][$key]['day_date'] = $newDate;
                }

                $data['db'] = $this->db;
                $data['validation'] = $this->validator;
                echo view(
                    'editday',
                    $data
                );

                $this->footer();
                die;
            }
            $accident_status="";
            if(empty($this->request->getPost('accident_status')))
            {
                $accident_status=0;
            }
            else{
                $accident_status=1;
            }
            $data = array(
                'destination_id'    =>$this->request->getPost('station'),

                'start_kilometer' => $this->request->getPost('txtstartkm'),

                'end_kilometer' => $this->request->getPost('txtendtkm'),

                'start_fuel_level' => $this->request->getPost('txtstartfuel'),

                'end_fuel_level' => $this->request->getPost('txtendfuel'),

                'accident_status' =>  $accident_status

            );
            $res=$this->drivingmodel->set($data)->where('day_id',$id)->update();

            if($res)
            {
                $this->session->set("success_alert", "<script>swal('Driving Day Updated Successfully!', {icon: 'success',});</script>");
                return redirect()->to(base_url() . "/dashboard/editday/{$id}");
            }
            else
            {
                $this->session->set("success_alert", "<script>swal('Error: something went wrong!', {icon: 'error',});</script>");
                return redirect()->to(base_url() . "/dashboard/editday/{$id}");
            }

        }
    }

    //========================================================================================================
}
