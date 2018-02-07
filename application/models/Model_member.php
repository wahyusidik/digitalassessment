<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class model_member extends CI_Model{
    /**
     * Initialize table and primary field variable
     */
    var $registration                   = "sdmp_registration";
    var $files                          = "sdmp_files";
    var $assessment                     = "sdmp_assessment";
    var $assessment_data                = "sdmp_assessment_data";
    var $assessor                       = "sdmp_assessor";
    var $assessment_type                = "sdmp_assessment_type";
    var $assessment_report              = "sdmp_assessment_report";
    var $assessment_report_data         = "sdmp_assessment_report_data";
    var $assessment_report_tool         = "sdmp_assessment_report_tool";
    var $assessment_report_tool_data    = "sdmp_assessment_report_tool_data";
    var $assessment_report_final        = "sdmp_assessment_report_final";
    var $assessment_report_final_data   = "sdmp_assessment_report_final_data";
    var $user                           = "sdmp_user";
    var $position                       = "sdmp_position";
    var $assessment_program             = "sdmp_assessment_program";
    var $competence                     = "sdmp_competence";
    var $competence_level               = "sdmp_competence_level";
    var $competence_profile_template     = "sdmp_competence_profile_template";
    var $doc_template               = "sdmp_doc_template";
    var $tools_template               = "sdmp_tools_template";


    
    
    /**
	* Constructor - Sets up the object properties.
	*/
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Sign In
     * 
     * Authenticate member .
     * 
     * @author  Wahyu
     * @param   Array   $credential     (Optional)  Associative array of member credential. It contains email, password, and remember
     * @return  Mixed   False on invalid member, otherwise object of member.
     */
	function signon($credentials)
	{
		if ( empty($credentials) || !is_array($credentials) ) return false;
        

		$member = $this->authenticate( $credentials['username'], $credentials['password'] );
        
		if ( empty($member) ) 
			return false;
        
        if(!empty($member->id)) mw_set_auth_cookie( $member->id, $credentials['remember'], '' );
		
		return $member;
	}

    function get_rows($params = array()){
        $this->db->select('*');
        $this->db->from($this->registration);
        
        //fetch data by conditions
        if(array_key_exists("conditions",$params)){
            foreach ($params['conditions'] as $key => $value) {
                $this->db->where($key,$value);
            }
        }
        
        if(array_key_exists("id",$params)){

            $this->db->where('id',$params['id']);
            $query = $this->db->get();
            $result = ($query->num_rows() > 0) ? $query->row() : FALSE;
            

        }else{
            //set start and limit
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            } elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }

            $query = $this->db->get();

            if(array_key_exists("return_type",$params) && $params['return_type'] == 'count'){
                $result = $query->num_rows();
            }elseif(array_key_exists("return_type",$params) && $params['return_type'] == 'single'){

                $result = ($query->num_rows() > 0) ? $query->row() : FALSE;
                // $result = $result[0];

            }else{

                $result = ($query->num_rows() > 0) ? $query->result() : FALSE;
            }
        }

        //return fetched data
        return $result;
    }

    /**
     * Save data 
     * 
     * @author  Wahyu
     * @param   Array   $data   (Required)  Array data
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function save_data($table,$data){
        if( empty($table) ) return false;
        if( empty($data) ) return false;
        if( $this->db->insert($this->$table,$data) ) {
            $id = $this->db->insert_id();
            return $id;
        };
        return false;
    }
    /**
     * Save data 
     * 
     */
    function save_data_file($data){
        if( empty($data) ) return false;

        if( $this->db->insert($this->$table,$data) ) {
            $id = $this->db->insert_id();
            return $id;
        };
        return false;
    }

    function get_data($table , $params = array() ){
        $this->db->select('*');
        $this->db->from($this->$table);
        
        //fetch data by conditions
        if(array_key_exists("conditions",$params)){
            foreach ($params['conditions'] as $key => $value) {
                $this->db->where($key,$value);
            }
        }

        if(array_key_exists("id",$params)){

            $this->db->where('id',$params['id']);
            $query = $this->db->get();
            $result = ($query->num_rows() > 0) ? $query->row() : FALSE;
        }else{
            //set start and limit
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            } elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }

            $query = $this->db->get();

            if(array_key_exists("return_type",$params) && $params['return_type'] == 'count'){
                $result = $query->num_rows();
            }elseif(array_key_exists("return_type",$params) && $params['return_type'] == 'single'){

                $result = ($query->num_rows() > 0) ? $query->row() : FALSE;
                // $result = $result[0];

            }else{

                $result = ($query->num_rows() > 0) ? $query->result() : FALSE;
            }
        }

        //return fetched data
        return $result;
    }

    function update_data($table, $params = array(), $data){

        //fetch data by conditions
        if(array_key_exists("conditions",$params)){
            foreach ($params['conditions'] as $key => $value) {
                $this->db->where($key,$value);
            }
        }

        if(array_key_exists("id",$params)){

            $this->db->where('id',$params['id']);
            $this->db->update($this->$table, $data);

        }else{
            $this->db->update($this->$table, $data);
        }

        //return fetched data
        return true;
    }

    /**
     * Retrieve all file
     * 
     */
    function get_all_user_file($limit=0, $offset=0, $conditions='', $order_by='', $group = false ){
        if( !empty($conditions) ){
            $conditions = str_replace("%id%",                   "A.id", $conditions);
            $conditions = str_replace("%id_registration%",      "A.id_registration", $conditions);
            $conditions = str_replace("%type%",                 "A.type", $conditions);
            $conditions = str_replace("%status%",               "A.status", $conditions);
            $conditions = str_replace("%file_name%",            "A.file_name", $conditions);
            $conditions = str_replace("%username%",             "B.username", $conditions);
            $conditions = str_replace("%name%",                 "B.name", $conditions);
            $conditions = str_replace("%number%",               "B.number", $conditions);
            $conditions = str_replace("%position%",               "B.position", $conditions);
        }
        
        if( !empty($order_by) ){
            $order_by = str_replace("%id%",                   "A.id", $order_by);
            $order_by = str_replace("%id_registration%",      "A.id_registration", $order_by);
            $order_by = str_replace("%type%",                 "A.type", $order_by);
            $order_by = str_replace("%status%",               "A.status", $order_by);
            $order_by = str_replace("%file_name%",            "A.file_name", $order_by);
            $order_by = str_replace("%username%",             "B.username", $order_by);
            $order_by = str_replace("%name%",                 "B.name", $order_by);
            $conditions = str_replace("%number%",               "B.number", $conditions);
            $conditions = str_replace("%position%",               "B.position", $conditions);
        }
        
        $sql = '
            SELECT SQL_CALC_FOUND_ROWS A.*, B.username, B.name,B.number,B.position, B.email
            FROM ' . $this->files . ' AS A 
            LEFT JOIN '.$this->registration.' AS B
            ON B.id = A.id_registration ';
        
        if( !empty($conditions) )   { $sql .= $conditions; }
        if ($group) $sql .= ' GROUP BY A.id_registration ';

        $sql   .= ' ORDER BY '. ( !empty($order_by) ? $order_by : 'A.datecreated DESC');
        
        if( $limit ) $sql .= ' LIMIT ' . $offset . ', ' . $limit;
        
        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;
        
        return $query->result();
    }

    function get_participant($status='',$position=''){
        $sql =' select * from '.$this->registration.' where 1=1 ';
        if(!empty($status)) $sql.=' AND status = '.$status;
        if(!empty($position)) $sql.=' AND position like "%'.$position.'%"';
        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;
        return $query->result();

    }

    function get_assessor($status=''){
        $sql =' select * from '.$this->assessor.' where 1=1 ';
        if(!empty($status)) $sql.=' AND status = '.$status;
        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;
        return $query->result();

    }

    function get_position($id=''){
        $sql =' select * from '.$this->position.' where 1=1 ';
        if(!empty($id)) $sql.=' AND id = '.$id;
        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;
        if(!empty($id)) {
            return $query->row();
        }
        return $query->result();

    }

    function get_competence_profil($id_position=''){
        $sql =' select * from '.$this->competence_profile_template.' where 1=1 ';
        if(!empty($id_position)) $sql.=' AND id_position = '.$id_position;
        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;
        return $query->row();
    }
    function get_competence($id=''){
        $sql =' select * from '.$this->competence.' where 1=1 ';
        if(!empty($id)) $sql.=' AND id = '.$id;
        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;
        return $query->row();
    }
    function get_competence_level($id_competence){
        if (!$id_competence) return false;
        $sql =' select * from '.$this->competence_level.' where 1=1 ';
        if(!empty($id_competence)) $sql.=' AND id_competence = '.$id_competence;
        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;
        return $query->result();
    }

    /**
     * Retrieve all Assessment
     * 
     */
    function get_all_assessment($limit=0, $offset=0, $conditions='', $order_by='' ){
        if( !empty($conditions) ){
            $conditions = str_replace("%id%",                   "A.id", $conditions);
            $conditions = str_replace("%number%",               "A.number", $conditions);
            $conditions = str_replace("%type%",                 "A.type", $conditions);
            $conditions = str_replace("%status%",               "A.status", $conditions);
            $conditions = str_replace("%room%",                 "A.room", $conditions);
            $conditions = str_replace("%date%",                 "A.date", $conditions);
            $conditions = str_replace("%time%",                 "A.time", $conditions);
            $conditions = str_replace("%status%",               "A.status", $conditions);
            $conditions = str_replace("%datecreated%",          "A.datecreated", $conditions);
            $conditions = str_replace("%datemodified%",         "A.datemodified", $conditions);
        }
        
        if( !empty($order_by) ){
            $order_by = str_replace("%id%",                   "A.id", $order_by);
            $order_by = str_replace("%number%",               "A.number", $order_by);
            $order_by = str_replace("%type%",                 "A.type", $order_by);
            $order_by = str_replace("%status%",               "A.status", $order_by);
            $order_by = str_replace("%room%",                 "A.room", $order_by);
            $order_by = str_replace("%date%",                 "A.date", $order_by);
            $order_by = str_replace("%time%",                 "A.time", $order_by);
            $order_by = str_replace("%status%",               "A.status", $order_by);
            $order_by = str_replace("%datecreated%",          "A.datecreated", $order_by);
            $order_by = str_replace("%datemodified%",         "A.datemodified", $order_by);
        }
        
        $sql = '
            SELECT SQL_CALC_FOUND_ROWS A.* , B.name
            FROM ' . $this->assessment . ' AS A 
            LEFT JOIN '.$this->assessment_type.' AS B
            ON B.id = A.type ';
        
        if( !empty($conditions) )   { $sql .= $conditions; }

        $sql   .= ' ORDER BY '. ( !empty($order_by) ? $order_by : 'A.datecreated DESC');
        
        if( $limit ) $sql .= ' LIMIT ' . $offset . ', ' . $limit;
        
        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;
        
        return $query->result();
    }
    function get_assignment_participant($id){
        if (!$id || empty($id)) return false;

        $sql = '
            SELECT A.* , B.name as reg_name , B.number as reg_number, C.name as assessor_name, E.name as mod_name
            FROM ' . $this->assessment_data . ' AS A 
            LEFT JOIN ' . $this->registration . ' AS B
            ON B.id = A.id_registration 
            LEFT JOIN ' . $this->assessor . ' AS C
            ON C.id = A.id_assessor
            LEFT JOIN ' . $this->assessment . ' AS D
            ON D.id = A.id_assessment
            LEFT JOIN ' . $this->assessor . ' AS E
            ON E.id = D.id_moderator
            WHERE A.id_assessment = '.$id.'
            order by A.seat_number ASC ';
        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;
        return $query->result();
    }
    function get_assessment_report_lgd($id){
        if (!$id || empty($id)) return false;

        $sql = '
            SELECT A.* , 
            B.name as reg_name , 
            B.number as reg_number , 
            C.name as assessor_name ,
             D.*,
             E.*,
             F.name as assessment_name
            FROM ' . $this->assessment_data . ' AS A
            LEFT JOIN ' . $this->registration . ' AS B
                ON B.id = A.id_registration 
            LEFT JOIN ' . $this->assessor . ' AS C
                ON C.id = A.id_assessor
            LEFT JOIN ' . $this->assessment_report . ' AS D
                ON D.id_assessment_data = A.id
            LEFT JOIN ' . $this->assessment . ' AS E
                ON E.id = A.id_assessment
            LEFT JOIN ' . $this->assessment_type . ' AS F
                ON E.type = F.id
            WHERE A.id = '.$id;
        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;
        return $query->row();
    }

    function get_assessment_assessor($id_assessor=0,$weekly = 0 ){
        // if (!$id_assessor || empty($id_assessor)) return false;
        $sql = '
            SELECT A.* ,
            B.name as reg_name , B.number as reg_number,
            C.name as assessor_name,
            D.date , D.time, D.room, D.number as assessment_number, D.type, D.status as assessment_status, D.position, D.id_moderator,
            E.name as mod_name, F.name as type_name
            FROM ' . $this->assessment_data . ' AS A 
            LEFT JOIN ' . $this->registration . ' AS B
            ON B.id = A.id_registration 
            LEFT JOIN ' . $this->assessor . ' AS C
            ON C.id = A.id_assessor
            LEFT JOIN ' . $this->assessment . ' AS D
            ON D.id = A.id_assessment
            LEFT JOIN ' . $this->assessor . ' AS E
            ON E.id = D.id_moderator
            LEFT JOIN ' . $this->assessment_type . ' AS F
            ON F.id = D.type
            WHERE 1 = 1 ';
            if($id_assessor != '0') $sql .=' AND A.id_assessor = '.$id_assessor;
            if($weekly == '0') $sql.=' AND YEARWEEK(D.date) = YEARWEEK(NOW()) ';
            if($id_assessor == '0') $sql .=' GROUP by A.id_assessment ';

            $sql .=' order by D.DATE ASC ';
        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;
        return $query->result();
    }
    function get_assessment_data($conditions='',$order_by=''){

        if( !empty($conditions) ){
            $conditions = str_replace("%id%",                   "A.id", $conditions);
            $conditions = str_replace("%id_assessment%",        "A.id_assessment", $conditions);
            $conditions = str_replace("%id_assessor%",        "A.id_assessor", $conditions);
            $conditions = str_replace("%number%",               "D.number", $conditions);
            $conditions = str_replace("%type%",                 "D.type", $conditions);
            $conditions = str_replace("%status%",               "A.status", $conditions);
            $conditions = str_replace("%assessment_status%",    "D.status", $conditions);
            $conditions = str_replace("%time%",                 "D.time", $conditions);
            $conditions = str_replace("%date%",                 "D.date", $conditions);
            $conditions = str_replace("%room%",                 "D.room", $conditions);
            $conditions = str_replace("%position%",              "D.position", $conditions);
            $conditions = str_replace("%datecreated%",          "A.datecreated", $conditions);
            $conditions = str_replace("%datemodified%",         "A.datemodified", $conditions);
        }
        if( !empty($order_by) ){
            $order_by = str_replace("%id%",                   "A.id", $order_by);
            $order_by = str_replace("%id_assessment%",        "A.id_assessment", $order_by);
            $order_by = str_replace("%number%",               "D.number", $order_by);
            $order_by = str_replace("%type%",                 "D.type", $order_by);
            $order_by = str_replace("%status%",               "A.status", $order_by);
            $order_by = str_replace("%assessment_status%",    "D.status", $order_by);
            $order_by = str_replace("%time%",                 "D.time", $order_by);
            $order_by = str_replace("%date%",                 "D.date", $order_by);
            $order_by = str_replace("%datecreated%",          "A.datecreated", $order_by);
            $order_by = str_replace("%datemodified%",         "A.datemodified", $order_by);
            $order_by = str_replace("%room%",                 "D.room", $order_by);
            $order_by = str_replace("%position%",              "D.position", $order_by);
        }

        $sql = '
            SELECT A.* ,
            B.name as reg_name , B.number as reg_number, B.email as reg_email,
            C.name as assessor_name, C.email as assessor_email,
            D.date , D.time, D.room, D.number as assessment_number, D.type, D.status as assessment_status, D.position, D.year, D.id_moderator,
            E.name as mod_name, F.name as assessment_name ,
            G.name as position_name
            FROM ' . $this->assessment_data . ' AS A 
            LEFT JOIN ' . $this->registration . ' AS B
            ON B.id = A.id_registration 
            LEFT JOIN ' . $this->assessor . ' AS C
            ON C.id = A.id_assessor
            LEFT JOIN ' . $this->assessment . ' AS D
            ON D.id = A.id_assessment
            LEFT JOIN ' . $this->assessor . ' AS E
            ON E.id = D.id_moderator
            LEFT JOIN ' . $this->assessment_type . ' AS F
            ON F.id = D.type
            LEFT JOIN ' . $this->position . ' AS G
            ON G.id = B.position ';
            if($conditions || !empty($conditions)) $sql.=$conditions;
            $sql .=' order by D.DATE DESC ';
        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;
        return $query->result();
            // return $sql;
    }


    function get_assessment_report($conditions=''){

        if( !empty($conditions) ){
            $conditions = str_replace("%id%",                   "A.id", $conditions);
            $conditions = str_replace("%id_assessment%",        "A.id_assessment", $conditions);
            $conditions = str_replace("%number%",               "A.number", $conditions);
            $conditions = str_replace("%type%",                 "D.type", $conditions);
            $conditions = str_replace("%status%",               "A.status", $conditions);
            $conditions = str_replace("%assessment_status%",    "D.status", $conditions);
            $conditions = str_replace("%time%",                 "D.time", $conditions);
            $conditions = str_replace("%date%",                 "D.date", $conditions);
            $conditions = str_replace("%datecreated%",          "A.datecreated", $conditions);
            $conditions = str_replace("%datemodified%",         "A.datemodified", $conditions);
        }

        $sql = '
            SELECT A.* ,
            B.name as reg_name , B.number as reg_number, B.email_feedback as reg_email_feedback,
            C.name as assessor_name,
            D.date , D.time, D.room, D.number as assessment_number, D.type, D.id_program, D.status as assessment_status, D.position, D.year, D.id_moderator,D.type,
            E.name as mod_name, F.name as assessment_name, F.form_type as form_type,
            G.* ,G.id as report_id,H.name as position_name, A.id
            FROM ' . $this->assessment_data . ' AS A 
            LEFT JOIN ' . $this->registration . ' AS B
            ON B.id = A.id_registration 
            LEFT JOIN ' . $this->assessor . ' AS C
            ON C.id = A.id_assessor
            LEFT JOIN ' . $this->assessment . ' AS D
            ON D.id = A.id_assessment
            LEFT JOIN ' . $this->assessor . ' AS E
            ON E.id = D.id_moderator
            LEFT JOIN ' . $this->assessment_type . ' AS F
            ON F.id = D.type
            LEFT JOIN ' . $this->assessment_report . ' AS G
            ON G.id_assessment_data = A.id 
            LEFT JOIN ' . $this->position . ' AS H
            ON H.id = D.position ';
            if($conditions || !empty($conditions)) $sql.=$conditions;
            $sql .=' order by A.seat_number ASC ';
        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;
        return $query->result();
    }

    function get_assessment_detail($conditions=''){

        if( !empty($conditions) ){
            $conditions = str_replace("%id%",                   "A.id", $conditions);
            $conditions = str_replace("%number%",               "A.number", $conditions);
            $conditions = str_replace("%type%",                 "D.type", $conditions);
            $conditions = str_replace("%status%",               "A.status", $conditions);
            $conditions = str_replace("%assessment_status%",    "D.status", $conditions);
            $conditions = str_replace("%time%",                 "D.time", $conditions);
            $conditions = str_replace("%date%",                 "D.date", $conditions);
            $conditions = str_replace("%datecreated%",          "A.datecreated", $conditions);
            $conditions = str_replace("%datemodified%",         "A.datemodified", $conditions);
        }

        $sql = '
            SELECT A.* ,
            C.name as assessor_name , 
            D.name as reg_name,
            E.name as mod_name,
            F.name as name
            FROM ' . $this->assessment . ' AS A 
            LEFT JOIN ' . $this->assessment_data . ' AS B
            ON B.id_assessment = A.id
            LEFT JOIN ' . $this->assessor . ' AS C
            ON C.id = B.id_assessor
            LEFT JOIN ' . $this->registration . ' AS D
            ON D.id = B.id_registration
            LEFT JOIN ' . $this->assessor . ' AS E
            ON E.id = A.id_moderator
            LEFT JOIN ' . $this->assessment_type . ' AS F
            ON F.id = A.type ';
            if($conditions || !empty($conditions)) $sql.=$conditions;
            $sql .=' order by A.DATE ASC ';
        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;
        return $query->result();
    }

    function get_report_comp($id_assessment, $owner, $id_assessment_data='' ){
        $sql = '
            SELECT *
            FROM ' . $this->assessment_report_data .' 
            WHERE id_assessment = '.$id_assessment.' ';
            // if($owner && !empty($owner)){ $sql .= ' AND owner = '.$owner.' ' ;}
            if($owner == 'admin' ) {
                $sql.= ' AND owner = 0 ';
            } elseif ($owner == 'all'){
                $sql.= ' AND owner != "0"';
            } else{
                $sql.= ' AND owner = "'.$owner.'" ';
            }
            if($id_assessment_data && !empty($id_assessment_data)) $sql.= ' AND id_assessment_data = '.$id_assessment_data.' ';
            
            $sql .=' order by id ASC ';
            $query = $this->db->query($sql);
            if(!$query || !$query->num_rows()) return false;
            return $query->result();
        // return $sql;
    }

    function search_position($clue){
            $this->db->select('*');
            $this->db->like('name', $clue);
            $data = $this->db->from($this->position)->get();
            return $data->result_array();
        }
    function get_program_position($id_program,$posname='' ){
        $ids = 0;
        $sql = '
            SELECT position
            FROM ' . $this->assessment_program .' 
            WHERE id = '.$id_program.' ';
        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;
        $result = $query->row();
        (!empty($result->position) ? $ids = $result->position : 0);
        $sql = ' SELECT *
                FROM '.$this->position.'
                WHERE id in ('.$ids.') AND name LIKE "%'.$posname.'%"';
        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;
        $position = $query->result();
        return $position;
    }
    function get_position_tools($id_position,$toolname='' ){
        if(!$id_position) return false;
        $ids = 0;
        $sql = '
            SELECT tools
            FROM ' . $this->tools_template .' 
            WHERE id_position = '.$id_position.' ';
        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;
        $result = $query->row();
        (!empty($result->tools) ? $ids = $result->tools : 0);
        $sql = ' SELECT *
                FROM '.$this->assessment_type.'
                WHERE id in ('.$ids.') AND name LIKE "%'.$toolname.'%"';
        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;
        $tools = $query->result();
        return $tools;
    }
    function search_participant($id_program,$id_position,$name='' ){
        if(!$id_position || !$id_program) return false;
        $sql = '
            SELECT *
            FROM ' . $this->registration .' 
            WHERE position = '.$id_position.' AND id_assessment_program = '.$id_program.' ';
            if (!empty($name)) $sql .=' AND name LIKE "%'.$name.'%" ';
            
        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;
        $participant = $query->result();
        return $participant;
    }
    function get_competence_report($id_assessment,$id_assessment_data='' , $id_competence=''){
        $sql = '
            SELECT *
            FROM ' . $this->assessment_report_data .' as A
            LEFT JOIN '.$this->competence.' as C
            ON C.id = A.id_competence
            WHERE A.id_assessment = '.$id_assessment.' ';
            if($id_assessment_data && !empty($id_assessment_data)) $sql.= ' AND A.id_assessment_data = '.$id_assessment_data.' ';
            if($id_competence && !empty($id_competence)) $sql.= ' AND A.id_competence = '.$id_competence.' ';
            $sql .=' order by C.id ASC ';
            $query = $this->db->query($sql);
            if(!$query || !$query->num_rows()) return false;
            if($id_competence && !empty($id_competence)) {
                return $query->row();
            } else{
                return $query->result();
            }
        // return $sql;
    }

    function get_competence_report_tool($id_assessment,$id_registration='' , $id_competence=''){
        $sql = '
            SELECT *
            FROM ' . $this->assessment_report_tool_data .' as A
            LEFT JOIN '.$this->competence.' as C
            ON C.id = A.id_competence
            LEFT JOIN '.$this->assessment_report_tool.' AS D
            ON D.id = A.id_report_tool
            WHERE A.id_assessment = '.$id_assessment.' ';
            if($id_registration && !empty($id_registration)) $sql.= ' AND D.id_registration = '.$id_registration.' ';
            if($id_competence && !empty($id_competence)) $sql.= ' AND A.id_competence = '.$id_competence.' ';
            $sql .=' order by C.id ASC ';
            $query = $this->db->query($sql);
            if(!$query || !$query->num_rows()) return false;
            if($id_competence && !empty($id_competence)) {
                return $query->row();
            } else{
                return $query->result();
            }
        // return $sql;
    }

    function get_competence_report_final($id_program,$id_registration='' , $id_competence=''){
        $sql = '
            SELECT *
            FROM ' . $this->assessment_report_final_data .' as A
            LEFT JOIN '.$this->competence.' as C
            ON C.id = A.id_competence
            LEFT JOIN '.$this->assessment_report_final.' AS D
            ON D.id = A.id_report_final
            WHERE D.id_program = '.$id_program.' ';
            if($id_registration && !empty($id_registration)) $sql.= ' AND D.id_registration = '.$id_registration.' ';
            if($id_competence && !empty($id_competence)) $sql.= ' AND A.id_competence = '.$id_competence.' ';
            $sql .=' order by C.id ASC ';
            $query = $this->db->query($sql);
            if(!$query || !$query->num_rows()) return false;
            if($id_competence && !empty($id_competence)) {
                return $query->row();
            } else{
                return $query->result();
            }
        // return $sql;
    }

    function get_assessment_type($id=''){
        $sql =' select * from '.$this->assessment_type.' where 1=1 ';
        if(!empty($id)) $sql.=' AND id = '.$id;
        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;
        return $query->row();
    }

    function get_assessment_report_tools($conditions=''){

        if( !empty($conditions) ){
            $conditions = str_replace("%id%",                   "A.id", $conditions);
            $conditions = str_replace("%id_assessment%",        "A.id_assessment", $conditions);
            $conditions = str_replace("%number%",               "A.number", $conditions);
            $conditions = str_replace("%type%",                 "D.type", $conditions);
            $conditions = str_replace("%status%",               "A.status", $conditions);
            $conditions = str_replace("%assessment_status%",    "D.status", $conditions);
            $conditions = str_replace("%time%",                 "D.time", $conditions);
            $conditions = str_replace("%date%",                 "D.date", $conditions);
            $conditions = str_replace("%datecreated%",          "A.datecreated", $conditions);
            $conditions = str_replace("%datemodified%",         "A.datemodified", $conditions);
        }

        $sql = '
            SELECT A.* ,
            B.name as reg_name , B.number as reg_number, B.email_feedback as reg_email_feedback,
            C.name as assessor_name,
            D.date , D.time, D.room, D.number as assessment_number, D.type, D.status as assessment_status, D.position, D.year, D.id_moderator,
            E.name as mod_name, F.name as assessment_name, F.form_type as form_type,
            G.* ,G.id as report_id,H.name as position_name, A.id
            FROM ' . $this->assessment_data . ' AS A 
            LEFT JOIN ' . $this->registration . ' AS B
            ON B.id = A.id_registration 
            LEFT JOIN ' . $this->assessor . ' AS C
            ON C.id = A.id_assessor
            LEFT JOIN ' . $this->assessment . ' AS D
            ON D.id = A.id_assessment
            LEFT JOIN ' . $this->assessor . ' AS E
            ON E.id = D.id_moderator
            LEFT JOIN ' . $this->assessment_type . ' AS F
            ON F.id = D.type
            LEFT JOIN ' . $this->assessment_report_tool . ' AS G
            ON G.id_assessment_data = A.id 
            LEFT JOIN ' . $this->position . ' AS H
            ON H.id = D.position ';
            if($conditions || !empty($conditions)) $sql.=$conditions;
            $sql .=' order by A.seat_number ASC ';
        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;
        return $query->result();
    }

    function get_assessment_report_int($conditions='',$order_by=''){

        if( !empty($conditions) ){
            $conditions = str_replace("%id%",                   "A.id", $conditions);
            $conditions = str_replace("%id_program%",           "A.id_program", $conditions);
            $conditions = str_replace("%id_assessment%",        "A.id_assessment", $conditions);
            $conditions = str_replace("%id_registration%",      "A.id_registration", $conditions);
            $conditions = str_replace("%id_moderator%",         "A.id_moderator", $conditions);
            $conditions = str_replace("%id_assessor%",          "A.id_assessor", $conditions);
            $conditions = str_replace("%number%",               "D.number", $conditions);
            $conditions = str_replace("%status%",               "A.status", $conditions);
            $conditions = str_replace("%room%",                 "D.room", $conditions);
            $conditions = str_replace("%position%",              "D.position", $conditions);
            $conditions = str_replace("%datecreated%",          "A.datecreated", $conditions);
            $conditions = str_replace("%datemodified%",         "A.datemodified", $conditions);
        }
        if( !empty($order_by) ){
            $order_by = str_replace("%id%",                   "A.id", $order_by);
            $order_by = str_replace("%id_assessment%",        "A.id_assessment", $order_by);
            $order_by = str_replace("%number%",               "D.number", $order_by);
            $order_by = str_replace("%type%",                 "D.type", $order_by);
            $order_by = str_replace("%status%",               "A.status", $order_by);
            $order_by = str_replace("%assessment_status%",    "D.status", $order_by);
            $order_by = str_replace("%time%",                 "D.time", $order_by);
            $order_by = str_replace("%date%",                 "D.date", $order_by);
            $order_by = str_replace("%datecreated%",          "A.datecreated", $order_by);
            $order_by = str_replace("%datemodified%",         "A.datemodified", $order_by);
            $order_by = str_replace("%room%",                 "D.room", $order_by);
            $order_by = str_replace("%position%",              "D.position", $order_by);
        }

        $sql = '
            SELECT A.* ,
            B.name as reg_name , B.number as reg_number, B.email_feedback as reg_email_feedback,
            C.name as assessor_name,
            D.date , D.time, D.room, D.number as assessment_number, D.type, D.status as assessment_status, D.position, D.year, D.id_moderator,
            E.name as mod_name, F.name as assessment_name, F.form_type as form_type,
            G.* ,G.id as report_id,H.name as position_name, A.id
            FROM ' . $this->assessment_data . ' AS A 
            LEFT JOIN ' . $this->registration . ' AS B
            ON B.id = A.id_registration 
            LEFT JOIN ' . $this->assessor . ' AS C
            ON C.id = A.id_assessor
            LEFT JOIN ' . $this->assessment . ' AS D
            ON D.id = A.id_assessment
            LEFT JOIN ' . $this->assessor . ' AS E
            ON E.id = D.id_moderator
            LEFT JOIN ' . $this->assessment_type . ' AS F
            ON F.id = D.type
            LEFT JOIN ' . $this->assessment_report_tool . ' AS G
            ON G.id_assessment_data = A.id 
            LEFT JOIN ' . $this->position . ' AS H
            ON H.id = D.position ';
            if($conditions || !empty($conditions)) $sql.=$conditions;
            $sql .=' order by A.seat_number ASC ';
        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;
        return $query->result();
            // return $sql;
    }
    function get_assessment_program_list($conditions='',$order_by=''){

        // if( !empty($conditions) ){
        //     $conditions = str_replace("%id%",                   "A.id", $conditions);
        //     $conditions = str_replace("%id_program%",           "A.id_program", $conditions);
        //     $conditions = str_replace("%id_assessment%",        "A.id_assessment", $conditions);
        //     $conditions = str_replace("%id_registration%",      "A.id_registration", $conditions);
        //     $conditions = str_replace("%id_moderator%",         "A.id_moderator", $conditions);
        //     $conditions = str_replace("%id_assessor%",          "A.id_assessor", $conditions);
        //     $conditions = str_replace("%number%",               "D.number", $conditions);
        //     $conditions = str_replace("%status%",               "A.status", $conditions);
        //     $conditions = str_replace("%room%",                 "D.room", $conditions);
        //     $conditions = str_replace("%position%",              "D.position", $conditions);
        //     $conditions = str_replace("%datecreated%",          "A.datecreated", $conditions);
        //     $conditions = str_replace("%datemodified%",         "A.datemodified", $conditions);
        // }
        // if( !empty($order_by) ){
        //     $order_by = str_replace("%id%",                   "A.id", $order_by);
        //     $order_by = str_replace("%id_assessment%",        "A.id_assessment", $order_by);
        //     $order_by = str_replace("%number%",               "D.number", $order_by);
        //     $order_by = str_replace("%type%",                 "D.type", $order_by);
        //     $order_by = str_replace("%status%",               "A.status", $order_by);
        //     $order_by = str_replace("%assessment_status%",    "D.status", $order_by);
        //     $order_by = str_replace("%time%",                 "D.time", $order_by);
        //     $order_by = str_replace("%date%",                 "D.date", $order_by);
        //     $order_by = str_replace("%datecreated%",          "A.datecreated", $order_by);
        //     $order_by = str_replace("%datemodified%",         "A.datemodified", $order_by);
        //     $order_by = str_replace("%room%",                 "D.room", $order_by);
        //     $order_by = str_replace("%position%",              "D.position", $order_by);
        // }

        $sql = '
            SELECT SQL_CALC_FOUND_ROWS A.*
            FROM ' . $this->assessment_program . ' AS A ';
            if($conditions || !empty($conditions)) $sql.=$conditions;
            $sql .=' order by A.datecreated ';
            $query = $this->db->query($sql);
            if(!$query || !$query->num_rows()) return false;
            return $query->result();
    }

    function get_assessment_program_position_list($conditions='',$order_by=''){

        if( !empty($conditions) ){
            $conditions = str_replace("%id%",                   "A.id", $conditions);
            $conditions = str_replace("%id_program%",           "A.id_assessment_program", $conditions);
            // $conditions = str_replace("%id_assessment%",        "A.id_assessment", $conditions);
            // $conditions = str_replace("%id_registration%",      "A.id_registration", $conditions);
            // $conditions = str_replace("%id_moderator%",         "A.id_moderator", $conditions);
            // $conditions = str_replace("%id_assessor%",          "A.id_assessor", $conditions);
            // $conditions = str_replace("%number%",               "D.number", $conditions);
            // $conditions = str_replace("%status%",               "A.status", $conditions);
            // $conditions = str_replace("%room%",                 "D.room", $conditions);
            // $conditions = str_replace("%position%",              "D.position", $conditions);
            // $conditions = str_replace("%datecreated%",          "A.datecreated", $conditions);
            // $conditions = str_replace("%datemodified%",         "A.datemodified", $conditions);
        }
        // if( !empty($order_by) ){
        //     $order_by = str_replace("%id%",                   "A.id", $order_by);
        //     $order_by = str_replace("%id_assessment%",        "A.id_assessment", $order_by);
        //     $order_by = str_replace("%number%",               "D.number", $order_by);
        //     $order_by = str_replace("%type%",                 "D.type", $order_by);
        //     $order_by = str_replace("%status%",               "A.status", $order_by);
        //     $order_by = str_replace("%assessment_status%",    "D.status", $order_by);
        //     $order_by = str_replace("%time%",                 "D.time", $order_by);
        //     $order_by = str_replace("%date%",                 "D.date", $order_by);
        //     $order_by = str_replace("%datecreated%",          "A.datecreated", $order_by);
        //     $order_by = str_replace("%datemodified%",         "A.datemodified", $order_by);
        //     $order_by = str_replace("%room%",                 "D.room", $order_by);
        //     $order_by = str_replace("%position%",              "D.position", $order_by);
        // }

        $sql = '
            SELECT SQL_CALC_FOUND_ROWS A.id as reg_id, A.id_assessment_program , A.number as reg_number, A.name as reg_name, B.name as position_name, C.number as program_number , C.title as program_title
            FROM ' . $this->registration. ' AS A 
            LEFT JOIN '.$this->position.' AS B
            ON B.id = A.position
            LEFT JOIN '.$this->assessment_program.' AS C
            ON C.id = A.id_assessment_program';
            if($conditions || !empty($conditions)) $sql.=$conditions;
            $sql .=' order by A.number ';
            $query = $this->db->query($sql);
            if(!$query || !$query->num_rows()) return false;
            return $query->result();
    }

        function get_competence_report_int($id_program,$id_registration='' , $id_assessment='' ,$id_competence=''){
        $sql = '
            SELECT A.*, C.name as competence_name , F.name as assessment_name, E.type as assessment_type
            FROM ' . $this->assessment_report_tool_data .' as A
            LEFT JOIN '.$this->competence.' as C
            ON C.id = A.id_competence
            LEFT JOIN '.$this->assessment_report_tool.' AS D
            ON D.id = A.id_report_tool
            LEFT JOIN '.$this->assessment.' AS E
            ON E.id = D.id_assessment
            LEFT JOIN '.$this->assessment_type.' AS F
            ON F.id = E.type
            WHERE D.id_program = '.$id_program.' ';
            if($id_registration && !empty($id_registration)) $sql.= ' AND D.id_registration = '.$id_registration.' ';
            if($id_assessment && !empty($id_assessment)) $sql.= ' AND D.id_assessment = '.$id_assessment.' ';
            if($id_competence && !empty($id_competence)) $sql.= ' AND A.id_competence = '.$id_competence.' ';
            $sql .=' order by C.id ASC ';
            $query = $this->db->query($sql);
            if(!$query || !$query->num_rows()) return false;
            if($id_competence && !empty($id_competence)) {
                return $query->row();
            } else{
                return $query->result();
            }
        // return $sql;
    }

    function get_report_tools_int($id_program,$id_registration='',$id_assessment=''){
        $sql = '
            SELECT A.*,B.position, B.type,B.status as assessment_status, C.name as reg_position, D.id as reg_id,D.status as reg_status, D.number as reg_number, D.name as reg_name, E.name as mod_name,
            F.number as program_number, F.title as program_title, F.year as program_year
            FROM ' . $this->assessment_report_tool .' as A
            LEFT JOIN '.$this->assessment.' as B
            ON B.id = A.id_assessment
            LEFT JOIN '.$this->position.' AS C
            ON C.id = B.position
            LEFT JOIN '.$this->registration.' AS D
            ON D.id = A.id_registration
            LEFT JOIN '.$this->assessor.' AS E
            ON E.id = B.id_moderator
            LEFT JOIN '.$this->assessment_program.' AS F
            ON F.id = B.id_program
            WHERE A.id_program = '.$id_program.' ';
            if($id_registration && !empty($id_registration)) $sql.= ' AND A.id_registration = '.$id_registration.' ';
            // if($id_assessment && !empty($id_assessment)) $sql.= ' AND A.id_assessment = '.$id_assessment.' ';
            $sql .=' order by C.id ASC ';
            $query = $this->db->query($sql);
            if(!$query || !$query->num_rows()) return false;
                return $query->result();
        // return $sql;
    }

     function get_report_program($id_program,$id_registration='',$position='' ){
        $sql = '
            SELECT A.*, B.position, B.name as reg_name , C.title as program_name ,C.number as program_number, C.year as program_year,
            D.name as position_name, E.name as assessor_name
            FROM ' . $this->assessment_report_final .' as A
            LEFT JOIN '.$this->registration.' as B
            ON B.id = A.id_registration
            LEFT JOIN '.$this->assessment_program.' AS C
            ON C.id = A.id_program
            LEFT JOIN '.$this->position.' AS D
            ON D.id = B.position
            LEFT JOIN '.$this->assessor.' AS E
            ON E.id = A.id_lead
            WHERE A.id_program = '.$id_program.' ';
            if($id_registration && !empty($id_registration)) $sql.= ' AND D.id_registration = '.$id_registration.' ';
            if($position && !empty($position)) $sql.= ' AND B.position = '.$position.' ';
            $sql .=' order by B.id ASC ';
            $query = $this->db->query($sql);
            if(!$query || !$query->num_rows()) return false;
            
                return $query->result();
        // return $sql;
    }
    function get_program_data($id=''){
        $sql =' select * from '.$this->assessment_program.' where 1=1 ';
        if(!empty($id)) $sql.=' AND id = '.$id;
        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;
        if(!empty($id)) return $query->row();
        return $query->result();
    }

}