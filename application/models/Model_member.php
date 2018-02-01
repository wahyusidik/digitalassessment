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
    var $assessment_report_final        = "sdmp_assessment_report_final";
    var $assessment_report_final_data   = "sdmp_assessment_report_final_data";
    var $user                           = "sdmp_user";
    var $position                       = "sdmp_position";
    var $assessment_program             = "sdmp_assessment_program";
    var $competence                     = "sdmp_competence";
    var $competence_level               = "sdmp_competence_level";
    var $doc_template               = "sdmp_doc_template";


    
    
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

    function get_participant(){
        $sql =' select * from '.$this->registration.' where number > 200';
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
            E.name as mod_name, F.name as assessment_name
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
            ON F.id = D.type ';
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
            D.date , D.time, D.room, D.number as assessment_number, D.type, D.status as assessment_status, D.position, D.year, D.id_moderator,
            E.name as mod_name, F.name as assessment_name,
            G.* ,G.id as report_id, A.id
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
            ON G.id_assessment_data = A.id ';
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
}