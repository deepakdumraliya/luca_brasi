<?php

namespace App\Controllers;

class Home extends BaseController
{
	/**
	 * index method is the first method to be getting loaded and display login page
	 */
	    /**
	 * Instance of the main Request object.
	 *
	 * @var HTTP\IncomingRequest
	 */
	protected $request;
	public function __construct()
	{
	}
	public function index()
	{
		if ($this->session->has('admin_id')) {
			return redirect()->to(base_url() . '/dashboard');
		} else {

			echo view('header');

			echo view('login');

			echo view('footer');
		}
	}
	/**
	 * An login function is used for admin login from where admin will get authenticated
	 */
	public function login()
	{


		// get cookie value
		// get_cookie("username");
		if ($this->request->getPost()) {
			if ($this->request->getPost('chkremember') !== "") {
				// store a cookie value
				set_cookie("username", $this->request->getPost("txtusername"), 3600);
				set_cookie("password", $this->request->getPost("txtpassword"), 3600);
			} else {
				delete_cookie("username");
				delete_cookie("password");
			}
			$credentials = array(
				'username' => trim($this->request->getPost("txtusername")),
				"password" => md5(trim($this->request->getPost("txtpassword"))),


			);

			$validate = $this->usermodel->where($credentials)->findall();
			//
			if (!empty($validate)) {
				if ($validate[0]['type_id'] = 0 || $validate[0]['type_id'] = 2) {
					$this->session->set('admin_id', $validate[0]['user_id']);

					return redirect()->to(base_url() . '/dashboard');
				} else {
					//$this->session->set("wrongpassword", "<script>swal('Username or Password  Is Wrong!', {icon: 'error',});</script>");

					return redirect()->to(base_url() . '/home');
				}
			} else {
				$this->session->set("wrongpassword", "<script>swal('Username or Password  Is Wrong!', {icon: 'error',});</script>");

				return redirect()->to(base_url() . '/home');
			}
		}
	}



	//--------------------------------------------------------------------

}
