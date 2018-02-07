<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	public function __construct()
    {
            parent::__construct();
    }

    public function index(){

        auth_redirect();
        $curent_user                = get_current_login();
        $data['title']              = TITLE . 'Dashboard';
        $data['user']               = $curent_user;
        // $data['is_admin']        = $is_admin;
        $data['main_content']       = 'dashboardregister';
        
        $this->load->view(VIEW_FRONT . 'templateregister', $data);
    }

    public function login(){
    	// auth_redirect();

    	$data['title']          = TITLE . 'Login';
        // $data['member']         = $current_member;
        // $data['is_admin']       = $is_admin;
        $data['main_content']   = 'loginform';
        
        $this->load->view(VIEW_FRONT . 'loginform');
    }

    public function validate(){

    	$email 			= $this->input->post('email');
    	$password 		= $this->input->post('password');

    	// Form Validation
    	$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'password', 'required');
            if ($this->form_validation->run() == true) {
                $con['return_type'] = 'single';
                $con['conditions'] = array(
                    'email'			=>$email,
                    'password' 		=> md5($password),
                    'status' 		=> '1'
                );
                $login = $this->model_member->get_data('user',$con);
                if($login){
                    $this->session->set_userdata('logged_in',TRUE);
                    $this->session->set_userdata('type',$login->type);
                    $this->session->set_userdata('data_id',$login->data_id);
                    if ($login->type == 0 || $login->type == 2 || $login->type == 4){
                        echo base_url('backend');
                    } elseif($login->type == 3){
                        echo base_url('backend/report');
                    } else {
                        echo base_url('register');
                    }
                }else{
                    echo "Failed";
                }
            }
    }

    /*
     * User logout
     */
    public function logout(){
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('username');
        $this->session->sess_destroy();
        redirect('register/login/');
    }

    public function uploaddoc()
	{	
		auth_redirect();
    	$curent_user				= get_current_login();
		$data['title']          	= TITLE . 'Dashboard';
        $data['user']         	= $curent_user;
        // $data['is_admin']       	= $is_admin;
        $data['main_content']   	= 'documentupload';
        
        $this->load->view(VIEW_FRONT . 'templateregister', $data);
	}

    public function upload()
    {	
    	auth_redirect();
    	$current_user					= get_current_login();
        $config['upload_path']          = './uploads/'.$current_user->number;
        $config['allowed_types']        = 'jpg|png|jpeg|doc|docs|docsx|pdf';
        $config['max_size']             = 20480;
        $config['overwrite']            = TRUE; //o

        $datetime                       = date('Y-m-d H:i:s');
        // create folder
        // $dir_exist = true; // flag for checking the directory exist or not
        if ( !is_dir($config['upload_path'] )){
            mkdir($config['upload_path'], 0777, true);
            // $dir_exist = false; // dir not exist
        }

        $this->upload->initialize($config);
        $type 							= $this->input->post('type[]');
        $files 							= $this->input->post('files');

        foreach ($type as $key ) {
        	if (!empty($key)) {
                

                $info = new SplFileInfo($_FILES[$key]['name']);
                $ext = $info->getExtension();

        		$filename = $current_user->number.'_'.str_replace(" ","",$current_user->name).'_'.$key.'.'.$ext;
        		$_FILES[$key]['name']		= str_replace(" ","",$filename);
		        if (!$this->upload->do_upload($key)) {
		            $error = $this->upload->display_errors();
		            // menampilkan pesan error
		            print_r($error);
		        } else {
                    $result = $this->upload->data();
                    $data_file = array(
                        'id_registration'   => $current_user->id,
                        'file_name'         => $filename,
                        'file_location'     => $result['full_path'],
                        'type'              => $key,
                        'status'            => 0,
                        'datecreated'       => $datetime,
                        'datemodified'      => $datetime,
                    );
                    save_data_file($data_file);
		            // echo "<pre>";
		            // print_r($result);
		            // echo "</pre>";
                    // redirect(base_url('register/uploaddoc'));

		        }
		    }
        }
        redirect(base_url('register/uploaddoc'));

        
    }
    function get_user(){
    	if ( $current_user = get_current_login()) {
            // $con['id'] = $register_id;
            // $current_user = $this->model_member->getRows($con);
            // unset($current_user->password);
            var_dump($current_user) ;
        } else{
        echo "no";

        }
    }
}