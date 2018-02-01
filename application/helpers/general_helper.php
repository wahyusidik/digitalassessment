<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Checks if a user is logged in, if not it redirects them to the login page.
 *
 * @param none
 * @return none
 */
if ( !function_exists('auth_redirect') )
{
    function auth_redirect()
    {
        $CI =& get_instance();

        if ( $user_id = $CI->session->userdata('logged_in')) {
            return;  // The cookie is good so we're done
        }
        
        // clear cookie to prevent redirection loops
        $CI->session->unset_userdata('logged_in');
        $CI->session->unset_userdata('type');
        $CI->session->unset_userdata('data_id');
        $CI->session->sess_destroy();

        $login_url = base_url('register/login');
    
        redirect($login_url);
        exit();
    
    }
}
if ( !function_exists('get_current_login') )
{
    function get_current_login()
    {
        $CI =& get_instance();

        if ( $CI->session->userdata('logged_in') ) {

            $type = $CI->session->userdata('type');

            $con['id'] = $CI->session->userdata('data_id');
            if ( $type == 0 ) {
                $current_user = $CI->model_member->get_data('user',$con);
            } elseif ( $type == 1 ) {
                $current_user = $CI->model_member->get_data('registration',$con);
            } elseif( $type == 2 ) {
                $current_user = $CI->model_member->get_data('assessor',$con);
            } elseif( $type == 3 ) {
                $current_user = $CI->model_member->get_data('user',$con);
            }
            if(isset($current_user->password)) unset($current_user->password);
            return $current_user;
        }
        return false;
    }
}

if ( !function_exists('is_admin') )
{
    function is_admin($userdata)
    {   
        if (!$userdata) return false;
        $CI =& get_instance();
        $con['id'] = $userdata->id;
        if ( $data = $CI->model_member->get_data('user',$con)) {
            if ( $data->type == 0 ) {
                return true;
            } else{
                return false ;
            } 
        } else {
            return false;
        }
    }
}

if ( !function_exists('is_admin_login') )
{

    function is_admin_login()
    {   
        $CI =& get_instance();
        if ( $CI->session->userdata('logged_in') ) {
            if ( $CI->session->userdata('type') == 0 ) {
                return true;
            }
        }
        return false;
    }
}
if ( !function_exists('get_login_type') )
{

    function get_login_type()
    {   
        $CI =& get_instance();
        if ( $CI->session->userdata('logged_in') ) {
            if ( $login_type = $CI->session->userdata('type') ) {
                return $login_type;
            }
        }
        return false;
    }
}

if ( !function_exists('save_data_file') )
{
    function save_data_file($data)
    {
        $CI =& get_instance();

        if( empty($data) || !$data ) return false;

        $con['return_type']     = 'single';
        $con['conditions'] = array(
            'id_registration'   => $data['id_registration'],
            'type'              => $data['type'],
        );


        $dataexist = $CI->model_member->get_data('files',$con);

        if ($dataexist) {
            if ( $CI->model_member->update_data('files',$con,$data) ){
                $id = $dataexist->id;
                return $id;
            }
            return false;
        } else{
            if( $CI->model_member->save_data('files',$data) ) {
                $id = $CI->db->insert_id();
                return $id;
            }
            return false;
        }
    }
}

// get last found rows
if ( !function_exists('get_last_found_rows') )
{
    function get_last_found_rows(){
        $CI =& get_instance();
        
        $total_row  = 0;
        $query      = $CI->db->query('SELECT FOUND_ROWS() AS total_rows');
                    
        if($query && $query->num_rows())
            $total_row = $query->row()->total_rows;
        
        return $total_row;
    }
}

/**
 * Check whether variable exist or not
 *
 * If current variable does not exist, return false then set default return value
 *
 * @param variable name, default value, default on set variable but empty
 * @return value if variable is set, false, or specified default value
 */
if ( !function_exists('input_isset') )
{
    function input_isset( $val, $default=NULL, $default_on_empty=false )
    {
        if(isset($val))
            $tmp = ($default_on_empty && empty($val) ? $default : $val);
        else
            $tmp = $default;
        return $tmp;
    }
}

// get assessment type
if ( !function_exists('get_assessment_type') )
{
    function get_assessment_type(){
        $CI =& get_instance();
        
        $data = $CI->model_member->get_data('assessment_type');
                    
        if(!$data || empty($data)) return false;
        return $data;
    }
}

// get assessment detail
if ( !function_exists('get_assessment_detail') )
{
    function get_assessment_detail($id){
        if(!$id || empty($id)) return false;
        $CI =& get_instance();
        $conditions = ' WHERE %id% = '.$id.' ';
        $assessment = $CI->model_member->get_assessment_detail($conditions);
        if(!$assessment || empty($assessment)) return false;

        $data['assessment_data'] = $assessment[0];

        $assessment_participant = $CI->model_member->get_assignment_participant($id);
        // if(!$assessment_participant || empty($assessment_participant)) return false;
        $data['assessment_participant'] = $assessment_participant;
        return $data;
    }
}

// get assessment detail
if ( !function_exists('update_assessment_status') )
{
    function update_assessment_status($id_assessment){
        if(!$id_assessment || empty($id_assessment)) return false;
        $datetime = date('Y-m-d H:i:s');
        $CI =& get_instance();

        $assessment_data = $CI->model_member->get_data('assessment',array( 'id' => $id_assessment ));

        if (!$assessment_data || empty($assessment_data) ) return false;

        if ( $assessment_data->status == 0) {
            $con['return_type']     = 'single';
            // get assessment data with no report
            $con['conditions'] = array(
                'id_assessment'   => $id_assessment,
                'status'          => 0, 
            );
            // if all assessment data status is not 0 / no report
            if ( !$data = $CI->model_member->get_data('assessment_data',$con) ) {
                $con2['id'] = $id_assessment;
                $data_update = array(
                    'status'        => 1,
                    'datemodified'    => $datetime,
                );
                if ( !$CI->model_member->update_data('assessment',$con2,$data_update) ) {
                    return false;
                }
            }
        // if assessment report is complete but not compiled
        } elseif ($assessment_data->status == 1) {
           $con3['return_type']     = 'single';
            // get assessment data with no report status 1 (not compiled)
            $con3['conditions'] = array(
                'id_assessment'   => $id_assessment,
                'status'          => 1, 
            );
            // if all assessment data status is not 1 / not compiled report
            if ( !$data = $CI->model_member->get_data('assessment_data',$con3) ) {
                $con4['id'] = $id_assessment;
                $data_update = array(
                    'status'        => 2,
                    'datemodified'    => $datetime,
                );
                if ( !$CI->model_member->update_data('assessment',$con4,$data_update) ) {
                    return false;
                }
            }
 
        } 
        
        return true;
    }
}

if ( !function_exists('get_part_by_assessment') )
{
    function get_part_by_assessment($id_assessment)
    {
        $CI =& get_instance();

        if( empty($id_assessment) || !$id_assessment ) return false;

        $dataexist = $CI->model_member->get_assignment_participant($id_assessment);

        if ($dataexist) {
            return $dataexist;
        } else{
            return false;
        }
    }
}

if ( !function_exists('get_othernote_data') )
{
    function get_othernote_data($id_assessment)
    {
        $CI =& get_instance();

        if( empty($id_assessment) || !$id_assessment ) return false;
        $con = ' WHERE %id_assessment% = '.$id_assessment.' ';
        $dataexist = $CI->model_member->get_assessment_report($con);
        $data = array();
        if ($dataexist) {
            foreach ($dataexist as $row ) {
                if ($row->note_assesse_other != NULL && !empty($row->note_assesse_other)){
                    $note_other = unserialize($row->note_assesse_other);
                    foreach ($note_other as $key => $value) {
                        $data[$key][$row->seat_number] = $value;
                    } 
                } else {
                    $part = get_part_by_assessment($id_assessment);
                    foreach ($part as $p) {
                        $data[$p->seat_number][$row->seat_number] = '';
                    } 
                }
            }
            return $data;
        } else{
            return false;
        }
    }
}

if ( !function_exists('get_report_comp') )
{
    function get_report_comp($id_assessment,$owner='',$id_assessment_data='')
    {
        $CI =& get_instance();

        if( empty($id_assessment) || !$id_assessment ) return false;

        if ($owner == 'admin' ){
            $owner = '0';
        }
        $data['parent'] = array();
        $data['param'] = array();
        $dataexist = $CI->model_member->get_report_comp($id_assessment,$owner,$id_assessment_data);
        if ($dataexist) {
            foreach ($dataexist as $key => $value) {
                if ( !in_array($value->field_parent, $data['parent']) ) array_push($data['parent'], $value->field_parent);
                if (!isset($data['param'][$value->field_parent]) ) {
                    $data['param'][$value->field_parent] = array();
                }
                array_push($data['param'][$value->field_parent], array( 'field' => $value->field , 'field_text' => $value->field_text , 'value' => $value->value) );
            }
            return $data;
        } else{
            return false;
        }
    }
}

if ( !function_exists('get_report_comp_report') )
{
    function get_report_comp_report($id_assessment,$owner='',$id_assessment_data='')
    {
        $CI =& get_instance();

        if( empty($id_assessment) || !$id_assessment ) return false;

        $dataexist = $CI->model_member->get_report_comp($id_assessment,$owner,$id_assessment_data);
        $data['parent'] = array();
        $data['param'] = array();
        if ($dataexist) {
            foreach ($dataexist as $key => $value) {
                if ( !in_array($value->field_parent, $data['parent']) ) array_push($data['parent'], $value->field_parent);
                    if (strtolower($owner) != 'admin'){
                        if ($value->value == '1' ){
                            if (!isset($data['param'][$value->field_parent]) ) {
                                $data['param'][$value->field_parent] = array();
                            }
                            $data['param'][$value->field_parent]['field'] = $value->field;
                            $data['param'][$value->field_parent]['field_text'] = $value->field_text;
                            $data['param'][$value->field_parent]['value'] = ($value->value == '1' ) ? $value->value :''; 
                        }
                    } else{
                        if (!isset($data['param'][$value->field_parent]) ) {
                            $data['param'][$value->field_parent] = array();
                        }
                        $data['param'][$value->field_parent]['field'] = $value->field;
                        $data['param'][$value->field_parent]['field_text'] = $value->field_text;
                        $data['param'][$value->field_parent]['value'] = $value->value;
                    }
                } 
            return $data;
        } else{
            return false;
        }
    }
}

if ( !function_exists('get_date_text') )
{
    function get_date_text($date='')
    {   
        $day = date('D', strtotime($date));
        $month = date('M', strtotime($date));
        $day_number = date('j', strtotime($date));
        $year_number = date('Y', strtotime($date));
        $dayList = array(
            'Sun' => 'Minggu',
            'Mon' => 'Senin',
            'Tue' => 'Selasa',
            'Wed' => 'Rabu',
            'Thu' => 'Kamis',
            'Fri' => 'Jumat',
            'Sat' => 'Sabtu'
        );
        $monthList = array(
            'Jan' => 'Januari',
            'Feb' => 'Februari',
            'Mar' => 'Maret',
            'Apr' => 'April',
            'May' => 'Mei',
            'Jun' => 'Juni',
            'Jul' => 'Juli',
            'Aug' => 'Agustus',
            'Sep' => 'September',
            'Oct' => 'Oktober',
            'Nov' => 'November',
            'Dec' => 'Desember',
        );
        $day_name = $dayList[$day];
        $month_name = $monthList[$month];
        $date_info = $day_name.', '.$day_number.' '.$month_name.' '.$year_number;

        return $date_info;
    }
}

if ( !function_exists('get_time_text') )
{
    function get_time_text($time='')
    {   
        $time = date('G:i', strtotime($time));
        return $time;
    }
}

if ( !function_exists('get_program_tools') )
{
    function get_program_tools($id)
    {   
        if(!$id || empty($id)) return false;
        $CI =& get_instance();
        $con['id'] = $id;
        $con['return_type'] = 'single';
        $programdata = $CI->model_member->get_data('assessment_program',$con);
        if(!$programdata || empty($programdata)) return false;
        $tools = (empty($programdata->tools) ? 0: $programdata->tools);
        $sql = ' SELECT * FROM sdmp_assessment_type WHERE id IN('.$tools.') ORDER BY NAME ASC ';
        
        $query = $CI->db->query($sql);
        if(!$query || !$query->num_rows()) return false;
        
        return $query->result();
    }
}