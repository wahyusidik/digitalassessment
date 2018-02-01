<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backend extends CI_Controller {

	public function __construct()
    {
            parent::__construct();
    }

	public function index()
	{
		auth_redirect();
    	$curent_user				= get_current_login();
		$data['title']          	= TITLE . 'Dashboard';
        $data['user']         		= $curent_user;
        $data['login_type']         = get_login_type();
        $data['main_content']      = 'dashboard';
        
        $this->load->view(VIEW_BACK . 'template', $data);
	}

	public function documentlist($id_reg = 0 ){
		auth_redirect();
    	$curent_user				= get_current_login();
    	$data['id_reg']            = $id_reg;
		$data['title']          	= TITLE . 'Data Dokumen';
        $data['user']         		= $curent_user;
        $data['main_content']   	= 'documentlist';
        
        $this->load->view(VIEW_BACK . 'template', $data);
	}


    function user_documentlist ($id_reg = 0 ){
        $curent_user				= get_current_login();

        $condition          = ' WHERE 1 = 1 ';
        if ( $id_reg != 0 ) $condition = ' WHERE %id_registration% = '.$id_reg.' ';

        $order_by ='';
        ( $id_reg == 0 ) ? $group = TRUE : $group = FALSE;;

        $iDisplayLength = intval($_REQUEST['length']);
        $iDisplayLength = $iDisplayLength < 0 ? 0 : $iDisplayLength; 
        $iDisplayStart = intval($_REQUEST['start']);
        $iTotalRecords = 0;
        $records = array();
        $records["data"] = array(); 

        $sort               = $_REQUEST['order'][0]['dir'];
        $column             = intval($_REQUEST['order'][0]['column']);

        $limit              = ( $iDisplayLength == '-1' ? 0 : $iDisplayLength );
        $offset             = $iDisplayStart;

        $s_number           = $this->input->post('search_number');
        $s_name             = $this->input->post('search_name');
        $s_position         = $this->input->post('search_position');
        $s_type         	= $this->input->post('search_type');
        $s_status         	= $this->input->post('search_status');


        if( !empty($s_name) )       	{ $condition .= str_replace('%s%', $s_name, ' AND %name% LIKE "%%s%%"'); }
        if( !empty($s_namefile) )       { $condition .= str_replace('%s%', $s_namefile, ' AND %file_name% LIKE "%%s%%"'); }
        if( !empty($s_number) )     	{ $condition .= str_replace('%s%', $s_number, ' AND %number% LIKE "%%s%%"'); }
        if( !empty($s_position) )     	{ $condition .= str_replace('%s%', $s_position, ' AND %position% LIKE "%%s%%"'); }
        if( !empty($s_type) )     		{ $condition .= str_replace('%s%', $s_type, ' AND %type% LIKE "%%s%%"'); }
        if( !empty($s_status) )     	{ $condition .= str_replace('%s%', $s_status, ' AND %status% LIKE "%%s%%"'); }

        if ( $id_reg == 0 ) {
        	if( $column == 1 )      { $order_by .= '%number% ' . $sort; }
        	elseif( $column == 2 )  { $order_by .= '%name% ' . $sort; }
        	elseif( $column == 3 )  { $order_by .= '%position% ' . $sort; }
        } else {
        	if( $column == 1 )      { $order_by .= '%number% ' . $sort; }
        	elseif( $column == 2 )  { $order_by .= '%type% ' . $sort; }
        	elseif( $column == 3 )  { $order_by .= '%file_name% ' . $sort; }
        	elseif( $column == 4 )  { $order_by .= '%status% ' . $sort; }
        }
        $file_list         = $this->model_member->get_all_user_file('', '', $condition, '', $group);
        if( !empty($file_list) ){
            $iTotalRecords  = get_last_found_rows();
            
            $i = $iDisplayStart + 1;
            foreach($file_list as $row){
            	if($row->status == 0)       
        		{ 
        			$status = '<center><span class="label label-sm label-warning">Dicek</span></center>'; 
        		}
                elseif($row->status == 1)   
        		{ 
        			$status = '<center><span class="label label-sm label-success">Diterima</span></center>'; 
        		}
        		elseif($row->status == 2)   
        		{ 
        			$status = '<center><span class="label label-sm label-danger">Ditolak</span></center>'; 
        		}

                $detailbutton   = '<a href="'.base_url('backend/documentlist/'.$row->id_registration).'" class="btn btn-xs btn-primary">Detail</a>';
                $downloadbutton   = '<a href="'.base_url().'backend/download/'.$row->number.'/'.$row->file_name.'" title="Unduh" class="btn btn-xs btn-primary"><i class="fa fa-download"></i></a>';
                $approvebutton   = '<a href="'.base_url().'backend/approvefile/'.$row->id.'" title="Terima"  class="btn btn-xs btn-success approvefile "><i class="fa fa-check"></i></a>';
                $rejectbutton   = '<a href="'.base_url().'backend/rejectfile/'.$row->id.'" title="Tolak" class="btn btn-xs btn-danger rejectfile "><i class="fa fa-times"></i></a>';
        		if ( $id_reg == 0 ) {
                    $records["data"][]    = array(
                        '<center>'.$row->number.'</center>',
                        '<center>'.$row->name.'</center>',
                        '<center>'.$row->position.'</center>',
                        '<center>'.$detailbutton.'</center>',
                    );
                } else{
                	$records["data"][]    = array(
                        '<center>'.$row->number.'</center>',
                        '<center>'.$row->type.'</center>',
                        '<center>'.$row->file_name.'</center>',
                        $status,
                        ( get_login_type() == '0' ) ? '<center>'.$downloadbutton.' '.$approvebutton.' '.$rejectbutton.'</center>' : '',
                    );
                }
                $i++;
            }   
        }
        // $iTotalRecords = 178;

        $sEcho = intval($_REQUEST['draw']);
        $end = $iDisplayStart + $iDisplayLength;
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;

        if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
        $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
        $records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
        }

        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;

        echo json_encode($records);
    }

    public function download($folder,$filename) {
    	$name =  urldecode($filename);
    	$path = './uploads/'.$folder.'/'.$name;	
    	$data = file_get_contents($path);		
		force_download($path,NULL);
	}

	function approvefile($id){
		auth_redirect();
    	$curent_user				= get_current_login();

    	$datetime		= date('Y-m-d H:i:s');
        $con['id'] = $id;
        $file = $this->model_member->get_data('files',$con);

        if ( !$file ){
            // Set JSON data
            $data = array(
                'message'   => 'error',
                'data'      => '<button class="close" data-close="alert"></button>Data file tidak ditemukan.',
            );
            die(json_encode($data));
		}

		if ( $file->status == 1 ){
			// Set JSON data
            $data = array(
                'message'   => 'error',
                'data'      => '<button class="close" data-close="alert"></button>File ini sudah disetujui.',
            );
            die(json_encode($data));
		}

		$data_update = array (
			'status' 		=> 1,
			'datemodified' 	=> $datetime
		);

		if ($this->model_member->update_data('files',$con,$data_update)) {
			// Set JSON data
            $data = array(
                'message'   => 'success',
                'data'      => '<button class="close" data-close="alert"></button>Status file berhasil diubah menjadi "diterima".',
            );
            die(json_encode($data));
		} else {
			// Set JSON data
            $data = array(
                'message'   => 'error',
                'data'      => '<button class="close" data-close="alert"></button>Ubah status file gagal.',
            );
            die(json_encode($data));
		}
	}

	function rejectfile($id){
		auth_redirect();
    	$curent_user				= get_current_login();

    	$datetime		= date('Y-m-d H:i:s');
        $con['id'] = $id;
        $file = $this->model_member->get_data('files',$con);

        if ( !$file ){
            // Set JSON data
            $data = array(
                'message'   => 'error',
                'data'      => '<button class="close" data-close="alert"></button>Data file tidak ditemukan.',
            );
            die(json_encode($data));
		}

		if ( $file->status == 2 ){
			// Set JSON data
            $data = array(
                'message'   => 'error',
                'data'      => '<button class="close" data-close="alert"></button>Tidak bisa mengubah status file.',
            );
            die(json_encode($data));
		}

		$data_update = array (
			'status' 		=> 2,
			'datemodified' 	=> $datetime
		);

		if ($this->model_member->update_data('files',$con,$data_update)) {
			// Set JSON data
            $data = array(
                'message'   => 'success',
                'data'      => '<button class="close" data-close="alert"></button>Status file berhasil diubah menjadi "ditolak".',
            );
            die(json_encode($data));
		} else {
			// Set JSON data
            $data = array(
                'message'   => 'error',
                'data'      => '<button class="close" data-close="alert"></button>Ubah status file gagal.',
            );
            die(json_encode($data));
		}
	}

	// ASSESMENT FUNCTION
	function addassessment(){
		auth_redirect();
    	$curent_user				= get_current_login();
		$data['title']          	= TITLE . 'Tambah Assessment';
        $data['user']         		= $curent_user;
        $data['assessors']          = $this->model_member->get_data('assessor');
        $data['main_content']   	= 'addassessment';
        $data['participants']       = $this->model_member->get_participant();
        
        $this->load->view(VIEW_BACK . 'template', $data);
	}

    // Process Add Assessment
	function addassessmentact(){
        // auth_redirect();
        //   	$curent_user				= get_current_login();

    	$number 		= $this->input->post('number');
    	$type 			= $this->input->post('type');
    	$year 			= $this->input->post('year');
    	$position 		= $this->input->post('position');

    	$date 			= $this->input->post('date');
    	$time 			= $this->input->post('time');
    	$room 			= $this->input->post('room');

    	$participants 	= $this->input->post('participants[]');
    	$assessors 		= $this->input->post('assessors[]');
    	$moderator 		= $this->input->post('moderator');


    	// Validate Input
    	// $this->form_validation->set_rules('number','Nomor','required');
     //    $this->form_validation->set_rules('type','Jenis','required');
     //    $this->form_validation->set_rules('year','Tahun','required');
     //    $this->form_validation->set_rules('position','Jabatan','required');
     //    $this->form_validation->set_rules('date','Tanggal','required');
     //    $this->form_validation->set_rules('time','Jam','required');
     //    $this->form_validation->set_rules('room','Ruangan','required');
     //    $this->form_validation->set_rules('participants','Peserta','required');
     //    $this->form_validation->set_rules('assessors','Assessor','required');
     //    $this->form_validation->set_rules('moderator','moderator','required');
        
     //    $this->form_validation->set_message('required', '%s harus di isi');
     //    $this->form_validation->set_error_delimiters('', '');
        
     //    if($this->form_validation->run() == FALSE){
     //        // Set JSON data
     //        $data = array(
     //            'message'       => 'error',
     //            'data'          => '<button class="close" data-close="alert"></button>Pendaftaran anggota baru tidak berhasil. '.validation_errors().'',
     //        );
     //        // JSON encode data
     //        die(json_encode($data));
     //    }

        $this->db->trans_begin();
        $datetime = date('Y-m-d H:i:s');
    	// Save assessment Item
        $data_assessment = array (
        	'number' 		=> $number,
        	'type' 			=> $type,
        	'year' 			=> $year,
        	'position' 		=> $position,
        	'date' 			=> $date,
        	'time' 			=> $time,
            'room'          => $room,
        	'status' 		=> 0,
        	'id_moderator'	=> $moderator,
            'datecreated'   => $datetime,
            'datemodified'   => $datetime,

        );


        if ( $assessment_id = $this->model_member->save_data('assessment',$data_assessment) ){
        	$part_count = count($participants);
            $seat_number = 0;
        	for ($i=0; $i < $part_count ; $i++) { 
        		

                if ( !empty($participants[$i]) && !empty($assessors[$i]) ) {
                    $data_assessment_part = array (
                        'id_assessment'     => $assessment_id,
                        'id_registration'   => $participants[$i],
                        'id_assessor'       => $assessors[$i],
                        'seat_number'       => $seat_number+=1,
                        'status'            => 0,
                        'datecreated'       => $datetime,
                        'datemodified'      => $datetime,
                    );
                    if ( !$assessment_part =  $this->model_member->save_data('assessment_data',$data_assessment_part) ){
                        $this->db->trans_rollback();
                        // Set JSON data
                        $data = array(
                            'message'       => 'error',
                            'data'          => '<button class="close" data-close="alert"></button>Tambah Assesment tidak berhasil.1',
                        );
                        // JSON encode data
                        die(json_encode($data));
                    } 
                    // else{

                    // }
                } elseif ( empty($participants[$i]) && empty($assessors[$i]) ){
                    continue;
                } elseif ( (!empty($participants[$i]) && empty($assessors[$i])) || (empty($participants[$i]) && !empty($assessors[$i]))){ 
                    $this->db->trans_rollback();
                    // Set JSON data
                    $data = array(
                        'message'       => 'error',
                        'data'          => '<button class="close" data-close="alert"></button>Tambah Assesment tidak berhasil. Data peserta dan assessor tidak lengkap',
                    );
                    // JSON encode data
                    die(json_encode($data));
                }
        	}
        } else {
        	$this->db->trans_rollback();
        	 // Set JSON data
            $data = array(
                'message'       => 'error',
                'data'          => '<button class="close" data-close="alert"></button>Tambah Assesment tidak berhasil.3',
            );
            // JSON encode data
            die(json_encode($data));
        }
        $parent         = $this->input->post('parent');
        $param          = $this->input->post('param');
        $paramtext      = $this->input->post('paramtext');

        foreach ($parent as $key => $value) {
            foreach ($param[$key] as $i => $field) {
                $data_report_form = array(
                    'id_assessment'         => $assessment_id,
                    'id_assessment_data'    => 0,
                    'field'                 => strtolower($field),
                    'field_text'            => $paramtext[$key][$i],
                    'value'                 => 0,
                    'field_parent'          => strtolower($value),
                    'owner'                 => 0,
                    'datecreated'           => $datetime,
                    'datemodified'          => $datetime,
                );
                $report_form =  $this->model_member->save_data('assessment_report_data',$data_report_form);
                if (!$report_form){
                    $this->db->trans_rollback();
                     // Set JSON data
                    $data = array(
                        'message'       => 'error',
                        'data'          => '<button class="close" data-close="alert"></button>Tambah assesment tidak berhasil.4',
                    );
                    // JSON encode data
                    die(json_encode($data));
                }
            }
        }
        $this->db->trans_commit();


        $con = " WHERE %id_assessment% = ".$assessment_id.' ';
        $assess = $this->model_member->get_assessment_data($con);
        foreach ($assess as $row) {
            $this->mailer->send_email_assessment($row->reg_email,$row);
        }
       // Set JSON data
        $data = array(
            'message'       => 'success',
            'data'          => '<button class="close" data-close="alert"></button>Tambah Assesment berhasil.',
        );
        // JSON encode data
        die(json_encode($data));
	}

    function assessmentdata($id = '' ){
        auth_redirect();
        $curent_user                = get_current_login();
        $data['title']              = TITLE . 'Detail Data Assessment';
        $data['user']               = $curent_user;
        $data['assessment']         = get_assessment_detail($id);
        $data['main_content']       = 'assessmentdata';
        
        if ($id == '' || empty($id) ) {
             redirect('backend/assessmentlist');
        } else {
            $this->load->view(VIEW_BACK . 'template', $data);
        }
    }
    // get assesment list
    function assessmentlistdata ($id = 0 ){

        $curent_user                = get_current_login();
        $order_by           = '';

        $condition          = ' WHERE 1 = 1 ';

        $iDisplayLength = intval($_REQUEST['length']);
        $iDisplayLength = $iDisplayLength < 0 ? 0 : $iDisplayLength; 
        $iDisplayStart = intval($_REQUEST['start']);
        $iTotalRecords = 0;
        $records = array();
        $records["data"] = array(); 

        $sort               = $_REQUEST['order'][0]['dir'];
        $column             = intval($_REQUEST['order'][0]['column']);

        $limit              = ( $iDisplayLength == '-1' ? 0 : $iDisplayLength );
        $offset             = $iDisplayStart;

        $s_number           = $this->input->post('search_number');
        $s_position         = $this->input->post('search_position');
        $s_type             = $this->input->post('search_type');
        $s_status           = $this->input->post('search_status');
        $s_room             = $this->input->post('search_room');
        $s_time_min         = $this->input->post('search_time_min');
        $s_time_max         = $this->input->post('search_time_max');
        $s_date_min         = $this->input->post('search_date_min');
        $s_date_max         = $this->input->post('search_date_max');

        if( !empty($s_number) )         { $condition .= str_replace('%s%', $s_number, ' AND %number% LIKE "%%s%%"'); }
        if( !empty($s_position) )       { $condition .= str_replace('%s%', $s_position, ' AND %position% LIKE "%%s%%"'); }
        if( !empty($s_type) )           { $condition .= str_replace('%s%', $s_type, ' AND %type% = "%s%"'); }
        if( !empty($s_status) )         { $condition .= str_replace('%s%', $s_status, ' AND %status% LIKE "%%s%%"'); }
        if( !empty($s_room) )           { $condition .= str_replace('%s%', $s_room, ' AND %room% LIKE "%%s%%"'); }
        if( !empty($s_time_min) )       { $condition .= str_replace('%s%', $s_time_min, ' AND %time% >= "%s%:00"'); }
        if( !empty($s_time_max) )       { $condition .= str_replace('%s%', $s_time_max, ' AND %time% <= "%s%:00"'); }
        if( !empty($s_date_min) )       { $condition .= str_replace('%s%', $s_date_min, ' AND %date% >= "%s%"'); }
        if( !empty($s_date_max) )       { $condition .= str_replace('%s%', $s_date_max, ' AND %date% <= "%s%"'); }


        // if ( $id_reg == 0 ) {
         if( $column == 0 )      { $order_by .= '%number% ' . $sort; }
         elseif( $column == 1 )  { $order_by .= '%type% ' . $sort; }
         elseif( $column == 2 )  { $order_by .= '%date% ' . $sort; }
         elseif( $column == 3 )  { $order_by .= '%time% ' . $sort; }
         elseif( $column == 4 )  { $order_by .= '%room% ' . $sort; }
        // } else {
        //  if( $column == 1 )      { $order_by .= '%number% ' . $sort; }
        //  elseif( $column == 2 )  { $order_by .= '%type% ' . $sort; }
        //  elseif( $column == 3 )  { $order_by .= '%file_name% ' . $sort; }
        //  elseif( $column == 4 )  { $order_by .= '%status% ' . $sort; }
        // }
        $assessment_data         = $this->model_member->get_all_assessment('', '', $condition, $order_by);
        if( !empty($assessment_data) ){
            $iTotalRecords  = get_last_found_rows();

            $i = $iDisplayStart + 1;
            foreach($assessment_data as $row){
                // if($row->status == 0)       
                // { 
                // $status = '<center><span class="label label-sm label-warning">Dicek</span></center>'; 
                // }
                // elseif($row->status == 1)   
                // { 
                // $status = '<center><span class="label label-sm label-success">Diterima</span></center>'; 
                // }
                // elseif($row->status == 2)   
                // { 
                // $status = '<center><span class="label label-sm label-danger">Ditolak</span></center>'; 
                // }

                $detailbutton   = '<a href="'.base_url('backend/assessmentdata/'.$row->id).'" class="btn btn-xs btn-primary">Detail</a>';
            
                $records["data"][]    = array(
                    '<center>'.$row->number.'</center>',
                    '<center>'.$row->name.'</center>',
                    '<center>'.$row->date.'</center>',
                    '<center>'.$row->time.'</center>',
                    '<center>'.$row->room.'</center>',
                    '<center>'.$detailbutton.'</center>',
                );               
                $i++;
            }   
        }

        $sEcho = intval($_REQUEST['draw']);
        $end = $iDisplayStart + $iDisplayLength;
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;

        if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
        $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
        $records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
        }

        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;

        echo json_encode($records);
    }

    function assessmentlist($id = 0 ){
        auth_redirect();
        $curent_user                = get_current_login();
        $data['title']              = TITLE . 'Data Assessment';
        $data['user']               = $curent_user;
        $data['main_content']       = 'assessmentlist';
        
        $this->load->view(VIEW_BACK . 'template', $data);
    }

    function assessmentreport($id = '' ){
        auth_redirect();
        $curent_user                = get_current_login();
        $data['title']              = TITLE . 'Laporan Assessment';
        $data['user']               = $curent_user;
        $data['main_content']       = 'assessmentreport';
        $this->load->view(VIEW_BACK . 'template', $data);
    }

    function addassessmentreport($id = '' ){
        auth_redirect();
        $curent_user                = get_current_login();
        $data['title']              = TITLE . 'Detail Data Assessment';
        $data['user']               = $curent_user;
        $data['is_admin']           = is_admin($curent_user);

        $con = ' where %id% = '.$id.' ';
        $data['assessment']         = $this->model_member->get_assessment_report($con)[0];
        $data['main_content']       = 'addassessmentreport';
        
        if ($id == '' || empty($id) ) {
             redirect('backend/assessmentlist');
        } else {
            $this->load->view(VIEW_BACK . 'template', $data);
        }
    }

    function report(){
        auth_redirect();
        $curent_user                = get_current_login();
        $login_type                 = get_login_type();
        $data['title']              = TITLE . 'Detail Data Assessment';
        $data['user']               = $curent_user;
        $data['is_admin']           = is_admin($curent_user);
        $data['login_type']         = $login_type;
        $data['main_content']       = 'reportlead';
        if ($login_type != 3) {
            redirect('registerlogin');
        } else {
            $this->load->view(VIEW_BACK . 'template', $data);
        }

    }
    function assessmentlistlead ($id = '' ){

        $curent_user                = get_current_login();

        $order_by           = '';
        $condition          = ' WHERE 1 = 1 and %status% = 2';

        $iDisplayLength = intval($_REQUEST['length']);
        $iDisplayLength = $iDisplayLength < 0 ? 0 : $iDisplayLength; 
        $iDisplayStart = intval($_REQUEST['start']);
        $iTotalRecords = 0;
        $records = array();
        $records["data"] = array(); 

        $sort               = $_REQUEST['order'][0]['dir'];
        $column             = intval($_REQUEST['order'][0]['column']);

        $limit              = ( $iDisplayLength == '-1' ? 0 : $iDisplayLength );
        $offset             = $iDisplayStart;

        $s_number           = $this->input->post('search_number');
        $s_position         = $this->input->post('search_position');
        $s_type             = $this->input->post('search_type');
        // $s_status           = $this->input->post('search_status');
        // $s_room             = $this->input->post('search_room');
        $s_time_min         = $this->input->post('search_time_min');
        $s_time_max         = $this->input->post('search_time_max');
        $s_date_min         = $this->input->post('search_date_min');
        $s_date_max         = $this->input->post('search_date_max');

        if( !empty($s_number) )         { $condition .= str_replace('%s%', $s_number, ' AND %number% LIKE "%%s%%"'); }
        if( !empty($s_position) )       { $condition .= str_replace('%s%', $s_position, ' AND %position% LIKE "%%s%%"'); }
        if( !empty($s_type) )           { $condition .= str_replace('%s%', $s_type, ' AND %type% = "%s%"'); }
        if( !empty($s_status) )         { $condition .= str_replace('%s%', $s_status, ' AND %status% LIKE "%%s%%"'); }
        // if( !empty($s_room) )           { $condition .= str_replace('%s%', $s_room, ' AND %room% LIKE "%%s%%"'); }
        if( !empty($s_time_min) )       { $condition .= str_replace('%s%', $s_time_min, ' AND %time% >= "%s%:00"'); }
        if( !empty($s_time_max) )       { $condition .= str_replace('%s%', $s_time_max, ' AND %time% <= "%s%:00"'); }
        if( !empty($s_date_min) )       { $condition .= str_replace('%s%', $s_date_min, ' AND %date% >= "%s%"'); }
        if( !empty($s_date_max) )       { $condition .= str_replace('%s%', $s_date_max, ' AND %date% <= "%s%"'); }



         if( $column == 0 )      { $order_by .= '%number% ' . $sort; }
         elseif( $column == 1 )  { $order_by .= '%type% ' . $sort; }
         elseif( $column == 2 )  { $order_by .= '%date% ' . $sort; }
         elseif( $column == 3 )  { $order_by .= '%time% ' . $sort; }
         elseif( $column == 4 )  { $order_by .= '%room% ' . $sort; }

        $assessment_data         = $this->model_member->get_all_assessment($limit, $offset, $condition, $order_by);
        if( !empty($assessment_data) ){
            $iTotalRecords  = get_last_found_rows();

            $i = $iDisplayStart + 1;
            foreach($assessment_data as $row){
                if($row->status == 0) { 
                    $status = '<center><span class="label label-md label-primary">Berjalan</span></center>'; 
                } elseif($row->status == 1){ 
                    $status = '<center><span class="label label-md label-primary">Berjalan</span></center>'; 
                } elseif($row->status == 2){ 
                    $status = '<center><span class="label label-md label-success">Selesai</span></center>'; 
                }

                $detailbutton   = '<a href="'.base_url('backend/reportdetail/'.$row->id).'" class="btn btn-s btn-primary">Lihat Laporan Akhir</a>';
            
                $records["data"][]    = array(
                    '<center>'.$row->number.'</center>',
                    '<center>'.$row->name.'</center>',
                    '<center>'.$row->date.'</center>',
                    '<center>'.$row->time.'</center>',
                    '<center>'.$status.'</center>',
                    '<center>'.$detailbutton.'</center>',
                );               
                $i++;
            }   
        }

        $sEcho = intval($_REQUEST['draw']);
        $end = $iDisplayStart + $iDisplayLength;
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;

        if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
        $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
        $records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
        }

        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;

        echo json_encode($records);
    }

    function reportdetail($id = '' ){
        auth_redirect();
        $curent_user                = get_current_login();
        $data['title']              = TITLE . 'Laporan Akhir Assessment';
        $data['user']               = $curent_user;
        $data['is_admin']           = is_admin($curent_user);
        $data['login_type']         = get_login_type();

        $con = ' where %id_assessment% = '.$id.' ';
        $data['assessment_report']         = $this->model_member->get_assessment_report($con);
        $data['main_content']       = 'assessmentreportfinal';
        
        if ($id == '' || empty($id) ) {
             redirect('backend/assessmentlist');
        } else {
            $this->load->view(VIEW_BACK . 'template', $data);
        }
    }

    function sendfeedbackreport($id_assessment_data){
        auth_redirect();
        $user               = get_current_login();
        $login_type         = get_login_type();
        $con = ' where %id% = '.$id_assessment_data.' ';
        $assessmentdata        = $this->model_member->get_assessment_report($con);
        // $assessmentdata = $assessmentdata[0];
        $a = $this->mailer->send_email_feedback($assessmentdata[0]->reg_email_feedback, $assessmentdata[0], $user);
        if($a==1){
            $data = array(
            'message'       => 'success',
            'data'          => 'Berhasil mengirim email feedback',
            // 'log'           => print_r($a),
            );
            // JSON encode data
            die(json_encode($data));
        } else{
            $data = array(
            'message'       => 'error',
            'data'          => 'Tidak Berhasil mengirim email feedback. Silakan mencoba kembali beberapa saat',
            'log'           => print_r($a).'from:'.$assessmentdata[0]->reg_email_feedback.'to'.$user->email.var_dump($assessmentdata[0]),
            );
            // JSON encode data
            die(json_encode($data));
        }
    }

    function addassessmentreportfinal($id = '' ){
        auth_redirect();
        $curent_user                = get_current_login();
        $data['title']              = TITLE . 'Laporan Akhir Assessment';
        $data['user']               = $curent_user;
        $data['is_admin']           = is_admin($curent_user);
        $data['login_type']         = get_login_type();

        $con = ' where %id_assessment% = '.$id.' ';
        $data['assessment_report']         = $this->model_member->get_assessment_report($con);
        $data['main_content']       = 'assessmentreportfinal';
        
        if ($id == '' || empty($id) ) {
             redirect('backend/assessmentlist');
        } else {
            $this->load->view(VIEW_BACK . 'template', $data);
        }
    }

        // Process Add Report Assessment
    function addreportact(){
        // auth_redirect();
        //      $curent_user                = get_current_login();
        $datetime               = date('Y-m-d H:i:s');
        $type                   = $this->input->post('assessment_type');
        $id_assessment_data     = $this->input->post('id_assessment_data');
        $id_assessment          = $this->input->post('id_assessment');
        $id_assessor          = $this->input->post('id_assessor');

        // Data Competence Report
        $parent         = $this->input->post('parent');
        $param          = $this->input->post('param[]');
        $paramtext      = $this->input->post('paramtext[]');
        $level          = $this->input->post('level[]');
        $data_report = array();
        // input form for assesment LGD
        if ($type == 1 ) {
            $note_assesse           = $this->input->post('note_assesse');
            $note_assesse           = isset_input($note_assesse ,'' );
            $note_assesse_other     = $this->input->post('note_assesse_other');
            $note_assesse_other     = isset_input($note_assesse_other, '' );

            $data_report = array (
                'id_assessment_data'    => $id_assessment_data,
                'note_assesse'          => $note_assesse,
                'note_assesse_other'    => serialize($note_assesse_other),
                'datecreated'           => $datetime,
                'datemodified'          => $datetime,
            );
        } elseif ($type == 2) {
            $notes                  = $this->input->post('notes');
            $notes                  = isset_input($notes, '' );

            $data_report = array (
                'id_assessment_data'    => $id_assessment_data,
                'notes'                 => $notes,
                'datecreated'           => $datetime,
                'datemodified'          => $datetime,
            );
        } elseif ($type == 3) {
            $note_assesse           = $this->input->post('note_assesse');
            $note_assesse           = isset_input($note_assesse ,'' );
            $note_assesse_other     = $this->input->post('note_assesse_other');
            $note_assesse_other     = isset_input($note_assesse_other, array() );
            $notes                  = $this->input->post('notes');
            $notes                  = isset_input($notes, '' );

            $data_report = array (
                'id_assessment_data'    => $id_assessment_data,
                'note_assesse'          => $note_assesse,
                'note_assesse_other'    => serialize($note_assesse_other),
                'notes'                 => $notes,
                'datecreated'           => $datetime,
                'datemodified'          => $datetime,
            );
        } 
        // Validate Input
        // $this->form_validation->set_rules('number','Nomor','required');
     //    $this->form_validation->set_rules('type','Jenis','required');
     //    $this->form_validation->set_rules('year','Tahun','required');
     //    $this->form_validation->set_rules('position','Jabatan','required');
     //    $this->form_validation->set_rules('date','Tanggal','required');
     //    $this->form_validation->set_rules('time','Jam','required');
     //    $this->form_validation->set_rules('room','Ruangan','required');
     //    $this->form_validation->set_rules('participants','Peserta','required');
     //    $this->form_validation->set_rules('assessors','Assessor','required');
     //    $this->form_validation->set_rules('moderator','moderator','required');
        
     //    $this->form_validation->set_message('required', '%s harus di isi');
     //    $this->form_validation->set_error_delimiters('', '');
        
     //    if($this->form_validation->run() == FALSE){
     //        // Set JSON data
     //        $data = array(
     //            'message'       => 'error',
     //            'data'          => '<button class="close" data-close="alert"></button>Pendaftaran anggota baru tidak berhasil. '.validation_errors().'',
     //        );
     //        // JSON encode data
     //        die(json_encode($data));
     //    }

        $this->db->trans_begin();

        if ( $report_id = $this->model_member->save_data('assessment_report',$data_report) ){
            $update_assessment_data = array(
                'status'    => 1,
                'datemodified' => $datetime,
            );
            $con = array( 'id' => $id_assessment_data);
            if (!$update_status = $this->model_member->update_data('assessment_data',$con,$update_assessment_data)){
                $this->db->trans_rollback();
                 // Set JSON data
                $data = array(
                    'message'       => 'error',
                    'data'          => '<button class="close" data-close="alert"></button>Tambah laporan assesment tidak berhasil.',
                );
                // JSON encode data
                die(json_encode($data));
            } else {
                foreach ($parent as $key => $value) {
                    foreach ($param[$key] as $i => $field) {
                        $data_report_form = array(
                            'id_assessment'         => $id_assessment,
                            'id_assessment_data'    => $id_assessment_data,
                            'field'                 => strtolower($field),
                            'field_text'            => $paramtext[$key][$i],
                            'value'                 => ($level[$key][0] == $field ? 1 : 0 ),
                            'field_parent'          => strtolower($value),
                            'owner'                 => $id_assessor,
                            'datecreated'           => $datetime,
                            'datemodified'          => $datetime,
                        );
                        $report_form =  $this->model_member->save_data('assessment_report_data',$data_report_form);
                        if (!$report_form){
                            $this->db->trans_rollback();
                             // Set JSON data
                            $data = array(
                                'message'       => 'error',
                                'data'          => '<button class="close" data-close="alert"></button>Tambah laporan assesment tidak berhasil.',
                            );
                            // JSON encode data
                            die(json_encode($data));
                        }
                    }
                }
            }
        } else {
            $this->db->trans_rollback();
             // Set JSON data
            $data = array(
                'message'       => 'error',
                'data'          => '<button class="close" data-close="alert"></button>Tambah laporan assesment tidak berhasil.',
            );
            // JSON encode data
            die(json_encode($data));
        }
        if (!update_assessment_status($id_assessment)){
            $this->db->trans_rollback();
             // Set JSON data
            $data = array(
                'message'       => 'error',
                'data'          => '<button class="close" data-close="alert"></button>Tambah laporan assesment tidak berhasil.',
            );
            // JSON encode data
            die(json_encode($data));
        }
        $this->db->trans_commit();

       // Set JSON data
        $data = array(
            'message'       => 'success',
            'data'          => '<button class="close" data-close="alert"></button>Laporan assesment berhasil dibuat.',
        );
        // JSON encode data
        die(json_encode($data));
    }

    function addreportfinalact(){
        // auth_redirect();
        $curent_user                = get_current_login();
        $datetime               = date('Y-m-d H:i:s');
        $type                   = $this->input->post('assessment_type');
        $id_assessment_data     = $this->input->post('id_assessment_data');
        $id_assessment          = $this->input->post('id_assessment');
        $id_assessor            = $this->input->post('id_assessor');

        $parent         = $this->input->post('parent');
        $param          = $this->input->post('param[]');
        $paramtext      = $this->input->post('paramtext[]');
        $level          = $this->input->post('level[]');

        $data_report = array();
        // input form for assesment LGD
        if ($type == 1 ) {
            $note_assesse           = $this->input->post('note_assesse');
            $note_assesse           = isset_input($note_assesse ,'' );
            $note_assesse_other     = $this->input->post('note_assesse_other');
            $note_assesse_other     = isset_input($note_assesse_other, '' );
            $notes     = $this->input->post('notes');
            $notes     = isset_input($note_assesse_other, '' );
            $data_report = array (
                'id_assessment'         => $id_assessment,
                'id_assessment_data'    => $id_assessment_data,
                'note_assesse'          => $note_assesse,
                'note_assesse_other'    => serialize($note_assesse_other),
                'notes'                 => $notes,
                'datecreated'           => $datetime,
                'datemodified'          => $datetime,
            );
        } elseif ($type == 2) {
            $notes                  = $this->input->post('notes');
            $notes                  = isset_input($notes, '' );

            $data_report = array (
                'id_assessment'         => $id_assessment,
                'id_assessment_data'    => $id_assessment_data,
                'notes'                 => $notes,
                'datecreated'           => $datetime,
                'datemodified'          => $datetime,
            );
        } elseif ($type == 3) {
            $note_assesse           = $this->input->post('note_assesse');
            $note_assesse           = isset_input($note_assesse ,'' );
            $note_assesse_other     = $this->input->post('note_assesse_other');
            $note_assesse_other     = isset_input($note_assesse_other, array() );
            $notes                  = $this->input->post('notes');
            $notes                  = isset_input($notes, '' );

            $data_report = array (
                'id_assessment'         => $id_assessment,
                'id_assessment_data'    => $id_assessment_data,
                'notes'                 => $notes,
                'datecreated'           => $datetime,
                'datemodified'          => $datetime,
            );
        } 
        
        

        // Validate Input
        // $this->form_validation->set_rules('number','Nomor','required');
     //    $this->form_validation->set_rules('type','Jenis','required');
     //    $this->form_validation->set_rules('year','Tahun','required');
     //    $this->form_validation->set_rules('position','Jabatan','required');
     //    $this->form_validation->set_rules('date','Tanggal','required');
     //    $this->form_validation->set_rules('time','Jam','required');
     //    $this->form_validation->set_rules('room','Ruangan','required');
     //    $this->form_validation->set_rules('participants','Peserta','required');
     //    $this->form_validation->set_rules('assessors','Assessor','required');
     //    $this->form_validation->set_rules('moderator','moderator','required');
        
     //    $this->form_validation->set_message('required', '%s harus di isi');
     //    $this->form_validation->set_error_delimiters('', '');
        
     //    if($this->form_validation->run() == FALSE){
     //        // Set JSON data
     //        $data = array(
     //            'message'       => 'error',
     //            'data'          => '<button class="close" data-close="alert"></button>Pendaftaran anggota baru tidak berhasil. '.validation_errors().'',
     //        );
     //        // JSON encode data
     //        die(json_encode($data));
     //    }

        $this->db->trans_begin();

        if ( $report_final_id = $this->model_member->save_data('assessment_report_final',$data_report) ){
            $update_assessment_data = array(
                'status'    => 2,
                'datemodified' => $datetime,
            );
            $con = array( 'id' => $id_assessment_data);
            if (!$update_status = $this->model_member->update_data('assessment_data',$con,$update_assessment_data)){
                $this->db->trans_rollback();
                 // Set JSON data
                $data = array(
                    'message'       => 'error',
                    'data'          => '<button class="close" data-close="alert"></button>Tambah laporan assesment tidak berhasil.',
                );
                // JSON encode data
                die(json_encode($data));
            }
            foreach ($parent as $key => $value) {
                    foreach ($param[$key] as $i => $field) {
                        $data_report_form = array(
                            'id_assessment'         => $id_assessment,
                            'id_assessment_data'    => $id_assessment_data,
                            'field'                 => $field,
                            'field_text'            => $paramtext[$key][$i],
                            'value'                 => ($level[$key][0] == $field ? 1 : 0 ),
                            'field_parent'          => $value,
                            'owner'                 => $id_assessor,
                            'datecreated'           => $datetime,
                            'datemodified'          => $datetime,
                        );
                        $report_form =  $this->model_member->save_data('assessment_report_final_data',$data_report_form);
                        if (!$report_form){
                            $this->db->trans_rollback();
                             // Set JSON data
                            $data = array(
                                'message'       => 'error',
                                'data'          => '<button class="close" data-close="alert"></button>Tambah laporan assesment tidak berhasil.',
                            );
                            // JSON encode data
                            die(json_encode($data));
                        }
                    }
                }
        } else {
            $this->db->trans_rollback();
             // Set JSON data
            $data = array(
                'message'       => 'error',
                'data'          => '<button class="close" data-close="alert"></button>Tambah laporan assesment tidak berhasil.',
            );
            // JSON encode data
            die(json_encode($data));
        }
        update_assessment_status($id_assessment);
        $this->db->trans_commit();
       // Set JSON data
        $data = array(
            'message'       => 'success',
            'data'          => '<button class="close" data-close="alert"></button>Laporan assesment berhasil dibuat.',
        );
        // JSON encode data
        die(json_encode($data));
    }


    function assessmentmine($id = 0 , $week = 0 ){
        
      $curent_user  = get_current_login();
      $login_type   = get_login_type();
      $order_by = '';
      // if ($login_type == 0 ) $id = 0;
      $iDisplayLength = intval($_REQUEST['length']);
      $iDisplayLength = $iDisplayLength < 0 ? 0 : $iDisplayLength; 
      $iDisplayStart = intval($_REQUEST['start']);
      $iTotalRecords = 0;
      $records = array();
      $records["data"] = array(); 
      $condition = ' WHERE 1 = 1 ';
      if($login_type != 0 ) {if ($id != 0) { $condition .= ' AND %id_assessor% = '.$id.' '; } }
    if ($week != 0) { $condition .= ' AND YEARWEEK(D.date) = YEARWEEK(NOW()) '; }

        $limit              = ( $iDisplayLength == '-1' ? 0 : $iDisplayLength );
        $offset             = $iDisplayStart;
        $sort               = $_REQUEST['order'][0]['dir'];
        $column             = intval($_REQUEST['order'][0]['column']);

        $limit              = ( $iDisplayLength == '-1' ? 0 : $iDisplayLength );
        $offset             = $iDisplayStart;

        $s_number           = $this->input->post('search_number');
        $s_position         = $this->input->post('search_position');
        $s_type             = $this->input->post('search_type');
        $s_status           = $this->input->post('search_status');
        $s_room             = $this->input->post('search_room');
        $s_time_min         = $this->input->post('search_time_min');
        $s_time_max         = $this->input->post('search_time_max');
        $s_date_min         = $this->input->post('search_date_min');
        $s_date_max         = $this->input->post('search_date_max');

        if( !empty($s_number) )         { $condition .= str_replace('%s%', $s_number, ' AND %number% LIKE "%%s%%"'); }
        if( !empty($s_position) )       { $condition .= str_replace('%s%', $s_position, ' AND %position% LIKE "%%s%%"'); }
        if( !empty($s_type) )           { $condition .= str_replace('%s%', $s_type, ' AND %type% = "%s%"'); }
        if( !empty($s_status) )         { $condition .= str_replace('%s%', $s_status, ' AND %status% LIKE "%%s%%"'); }
        if( !empty($s_room) )           { $condition .= str_replace('%s%', $s_room, ' AND %room% LIKE "%%s%%"'); }
        if( !empty($s_time_min) )       { $condition .= str_replace('%s%', $s_time_min, ' AND %time% >= "%s%:00"'); }
        if( !empty($s_time_max) )       { $condition .= str_replace('%s%', $s_time_max, ' AND %time% <= "%s%:00"'); }
        if( !empty($s_date_min) )       { $condition .= str_replace('%s%', $s_date_min, ' AND %date% >= "%s%"'); }
        if( !empty($s_date_max) )       { $condition .= str_replace('%s%', $s_date_max, ' AND %date% <= "%s%"'); }


        // if ( $id_reg == 0 ) {
         if( $column == 0 )      { $order_by .= '%number% ' . $sort; }
         elseif( $column == 1 )  { $order_by .= '%type% ' . $sort; }
         elseif( $column == 2 )  { $order_by .= '%date% ' . $sort; }
         elseif( $column == 3 )  { $order_by .= '%time% ' . $sort; }
         elseif( $column == 4 )  { $order_by .= '%room% ' . $sort; }
        if($id == 0 || $login_type == 0 ) $condition .=' GROUP by A.id_assessment ';

      $assessment_assessor = $this->model_member->get_assessment_data($condition,$week);
      if( !empty($assessment_assessor) ){
            $iTotalRecords  = get_last_found_rows();
            
            $i = $iDisplayStart + 1;
            foreach($assessment_assessor as $row){
                $addfinalreportbutton = '';

                if ( $row->date > date('Y-m-d') && $row->status < 2  ) {
                    $status = '<center><span class="label label-sm label-warning">Belum dibuka</span></center>';
                } else if ( $row->date == date('Y-m-d') && $row->status < 2  ){
                    $status = '<center><span class="label label-sm label-success">Dibuka</span></center>';
                } else if ( $row->date < date('Y-m-d') && $row->status < 2  ){
                    $status = '<center><span class="label label-sm label-warning">Ditutup</span></center>';
                } else if ( $row->status == 2 ) {
                    $status = '<center><span class="label label-sm label-success">Selesai</span></center>';
                }

                if ( $login_type == 2 && $curent_user->id == $row->id_moderator ) {
                    if ( $row->assessment_status == 0 ) {
                        $status = '<center><span class="label label-sm label-warning">Laporan Belum Lengkap</span></center>';
                    } elseif ($row->assessment_status == 1) {
                        $status = '<center><span class="label label-sm label-warning">Laporan Lengkap</span></center>';
                        $addfinalreportbutton = '<a href="'.base_url('backend/addassessmentreportfinal/'.$row->id_assessment).'" class="btn btn-xs btn-primary">Buat laporan akhir </a>';
                    } elseif ($row->assessment_status == 2 ){
                        $status = '<center><span class="label label-sm label-warning">Selesai</span></center>';
                        $addfinalreportbutton = '<a href="'.base_url('backend/addassessmentreportfinal/'.$row->id_assessment).'" class="btn btn-xs btn-primary">Lihat laporan akhir </a>';
                    }
                        $addfinalreportbutton = '<a href="'.base_url('backend/addassessmentreportfinal/'.$row->id_assessment).'" class="btn btn-xs btn-primary">Lihat laporan akhir </a>';
                } else {
                    if ($row->assessment_status == 2 ){
                        $addfinalreportbutton = '<a href="'.base_url('backend/addassessmentreportfinal/'.$row->id_assessment).'" class="btn btn-xs btn-primary">Lihat laporan akhir </a>';
                    }
                }
                if ($login_type == 0 ) {
                    $addreportbutton   = '<a href="'.base_url('backend/addassessmentreport/'.$row->id).'" class="btn btn-xs btn-primary">Edit Laporan</a>';
                } else {
                    $addreportbutton   = '<a href="'.base_url('backend/addassessmentreport/'.$row->id).'" class="btn btn-xs btn-primary">Laporan</a>';
                }
                // $viewbutton   = '<a href="'.base_url().'backend/download/'.$row->number.'/'.$row->file_name.'" title="Unduh" class="btn btn-xs btn-primary"><i class="fa fa-download"></i></a>';

                $records["data"][]    = array(
                    '<center>'.$row->date.'</center>',
                    '<center>'.$row->time.'</center>',
                    '<center>'.$row->assessment_number.'</center>',
                    '<center>'.$row->assessment_name.'</center>',
                    '<center>'.$row->position.'</center>',
                    '<center>'.$row->room.'</center>',
                    '<center>'.$status.'</center>',
                    '<center>'.$addreportbutton.$addfinalreportbutton.'</center>',
                );
                $i++;
            }   
        }
        // $iTotalRecords = 178;
     
      $sEcho = intval($_REQUEST['draw']);
      $end = $iDisplayStart + $iDisplayLength;
      $end = $end > $iTotalRecords ? $iTotalRecords : $end;

      if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
        $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
        $records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
      }

      $records["draw"] = $sEcho;
      $records["recordsTotal"] = $iTotalRecords;
      $records["recordsFiltered"] = $iTotalRecords;
      
      echo json_encode($records);
    
    }

    // END ASSESMENT FUNCTION

    public function get_assessor(){
        $assessors = $this->model_member->get_data('assessor');

        if (!$assessors || empty($assessors)){
            // Set JSON data
            $data = array(
                'result'    => '<option value="">Tidak Ada Pilihan Assessor</option>',
            );
        } else {
            foreach($assessors as $row){
                $assessor .= '<option value="'.$row->id.'">'.$row->name.'</option>';
            }
            // Set JSON data
            $data = array(
                'result'    => $assessor,
            );
        }
    }
	
    function test_note($id){
        $data = get_othernote_data($id);
        var_dump($data);
    }

    function test_email(){
        $a = $this->mailer->send_email_test();
        var_dump($a);
    }

    function test_comp($id_assessment){
        $con['conditions'] = array(
                'id_assessment'   => $id_assessment,
                'owner'          => 0, 
            );
        $data['parent'] = array();
        $data['param'] = array();
        // $data['paramtext'] = array();
        $dataexist = $this->model_member->get_data('assessment_report_data',$con);
        if ($dataexist) {
            foreach ($dataexist as $key => $value) {
                if ( !in_array($value->field_parent, $data['parent']) ) array_push($data['parent'], $value->field_parent);
                $data['param'][$value->field_parent][$value->field] = $value->value;
            }
            // return $data;
            var_dump($data);
        } else{
            // return false;
            echo "false";
        }
    }

    //======================================
    function addassessmentprogram(){
        auth_redirect();
        $curent_user                = get_current_login();
        $data['title']              = TITLE . 'Tambah Program Assessment';
        $data['user']               = $curent_user;
        $data['is_admin']           = is_admin($curent_user);
        $data['login_type']         = get_login_type();

        $data['main_content']       = 'addassessmentprogram';

        $this->load->view(VIEW_BACK . 'template', $data);
    }

    // Process Add Assessment
    function addassessmentprogramact(){
        auth_redirect();
        $curent_user                = get_current_login();

        $number                     = input_isset($this->input->post('number'),'');
        $title                     = input_isset($this->input->post('title'),'');
        $year                       = input_isset($this->input->post('year'),'');
        $position               = input_isset($this->input->post('position'),'');
        $datestart              = input_isset($this->input->post('datestart'),'');
        $dateend         = input_isset($this->input->post('dateend'),'');
        $uploadstart         = input_isset($this->input->post('uploadstart'),'');
        $uploadend         = input_isset($this->input->post('uploadend'),'');
        $docs         = input_isset($this->input->post('docs[]'),'');
        $tools         = input_isset($this->input->post('tools[]'),'');


        // Validate Input
        // $this->form_validation->set_rules('number','Nomor','required');
     //    $this->form_validation->set_rules('type','Jenis','required');
     //    $this->form_validation->set_rules('year','Tahun','required');
     //    $this->form_validation->set_rules('position','Jabatan','required');
     //    $this->form_validation->set_rules('date','Tanggal','required');
     //    $this->form_validation->set_rules('time','Jam','required');
     //    $this->form_validation->set_rules('room','Ruangan','required');
     //    $this->form_validation->set_rules('participants','Peserta','required');
     //    $this->form_validation->set_rules('assessors','Assessor','required');
     //    $this->form_validation->set_rules('moderator','moderator','required');
        
     //    $this->form_validation->set_message('required', '%s harus di isi');
     //    $this->form_validation->set_error_delimiters('', '');
        
     //    if($this->form_validation->run() == FALSE){
     //        // Set JSON data
     //        $data = array(
     //            'message'       => 'error',
     //            'data'          => '<button class="close" data-close="alert"></button>Pendaftaran anggota baru tidak berhasil. '.validation_errors().'',
     //        );
     //        // JSON encode data
     //        die(json_encode($data));
     //    }

        $this->db->trans_begin();
        $datetime = date('Y-m-d H:i:s');
        // Save assessment Item
        $data_assessment_program = array (
            'number'        => $number,
            'title'        => $title,
            'year'          => $year,
            'position'      => $position,
            'datestart'     => $datestart,
            'dateend'       => $dateend,
            'doc_upload'    => 0,
            'status'        => 0,
            'uploadstart'   => $uploadstart,
            'tools'         => implode(',', $tools),
            'uploadend'     => $uploadend,
            'created_by'    => $curent_user->username,
            'created_by'    => $curent_user->username,
            'datecreated'   => $datetime,
            'datemodified'  => $datetime,
        );


        if ( $program_id = $this->model_member->save_data('assessment_program',$data_assessment_program) ){
            $code = 1;
            foreach ($docs as $doc) {
                 $data_doc = array (
                        'id_template'       => $program_id,
                        'code'              => $code,
                        'field_text'        => $doc,
                        'field_name'        => trim(strtolower($doc)),
                        'datecreated'       => $datetime,
                        'datemodified'      => $datetime,
                    );
                 $id_doc = $this->model_member->save_data('doc_template',$data_doc);
                 if (!$id_doc) {
                    $this->db->trans_rollback();
                     // Set JSON data
                    $data = array(
                        'message'       => 'error',
                        'data'          => '<button class="close" data-close="alert"></button>Tambah Program Assesment tidak berhasil',
                    );
                    // JSON encode data
                    die(json_encode($data));
                }
                 $code++;
            }
        } else {
            $this->db->trans_rollback();
             // Set JSON data
            $data = array(
                'message'       => 'error',
                'data'          => '<button class="close" data-close="alert"></button>Tambah Assesment tidak berhasil.',
            );
            // JSON encode data
            die(json_encode($data));
        }

        $this->db->trans_commit();

       // Set JSON data
        $data = array(
            'message'       => 'success',
            'data'          => '<button class="close" data-close="alert"></button>Tambah Assesment berhasil.',
        );
        // JSON encode data
        die(json_encode($data));
    }

    function toolget(){
        $id_program        = $this->input->post('id_program');

        $tools = '';
        $pinorder = '';
        $data = array();
        $pindata = '';

        if (!$id_program || empty($id_program)) {
            // Set JSON data
            $data = array(
                'result' => '<option value="">Tidak ada pilihan Tools 1</option>',
            );
        } else {
            // jumlah PIN yg tersedia
            $toolsdata = get_program_tools($id_program);
            if ($toolsdata || !empty($toolsdata)) {
                foreach ($toolsdata as $tool) {
                    $tools .= '<option value="' . $tool->id . '">' . $tool->name . '</option>';
                }
                // Set JSON data
                $data = array(
                    'result' => $tools,
                );
            } else {
                // Set JSON data
                $data = array(
                    'result' => '<option value="">Tidak ada pilihan Tools2</option>',
                );
            }
        }
        // JSON encode data
        die(json_encode($data));
    }

    function formget(){
        $id_position        = $this->input->post('id_position');

        $fields = '';
        $data = array();

        if (!$id_position || empty($id_position)) {
            // Set JSON data
            $data = array(
                'result' => 'Belum ada template form penilaian',
            );
        } else {
            // jumlah PIN yg tersedia
            $toolsdata = get_program_tools($id_program);
            if ($toolsdata || !empty($toolsdata)) {
                foreach ($toolsdata as $tool) {
                    $tools .= '<option value="' . $tool->id . '">' . $tool->name . '</option>';
                }
                // Set JSON data
                $data = array(
                    'result' => $tools,
                );
            } else {
                // Set JSON data
                $data = array(
                    'result' => '<option value="">Tidak ada pilihan Tools2</option>',
                );
            }
        }
        // JSON encode data
        die(json_encode($data));
    }

}
