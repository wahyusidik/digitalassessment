<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Mailer 
{
    var $CI;
    var $active;
    
    /**
     * Constructor - Sets up the object properties.
     */
    function __construct()
    {
        $this->CI       =& get_instance();
        $this->active   = TRUE;

        $this->host = 'sg1.fcomet.com';
        $this->port = 465;
        $this->type = 'ssl';
        $this->username = 'admin@sdmpolri.virtueable.com';
        $this->password = '12345qwerty!';
        
        require_once SWIFT_MAILSERVER;
    }
    
    /**
     * Send email function.
     *
     * @param string    $to         (Required)  To email destination
     * @param string    $subject    (Required)  Subject of email
     * @param string    $message    (Required)  Message of email
     * @param string    $from       (Optional)  From email
     * @param string    $from_name  (Optional)  From name email
     * @return Mixed
     */
    function send($to, $subject, $message, $from = '', $from_name = ''){
        if (!$this->active) return false;
        try{
            //Create the Transport
            $transport = Swift_SmtpTransport::newInstance($this->host, $this->port, $this->type)
                ->setUsername($this->username)
                ->setPassword($this->password);
            //Create the message
            $mail       = Swift_Message::newInstance();
            //Give the message a subject
            $mail->setSubject($subject)
                 ->setFrom(array($from => $from_name))
                 ->setTo($to)
                 ->setBody($message->plain)
                 ->addPart($message->html, 'text/html');
            
            //Create the Mailer using your created Transport
            $mailer     = Swift_Mailer::newInstance($transport);
            //Send the message
            $result     = $mailer->send($mail); 
            
            return $result;
        }catch (Exception $e){
            // should be database log in here
            return $e->getMessage(); // 'failed to gather MAILDATA';
        }

        return false;
    }
    
    /**
     * Send email testing.
     *
     */
    function send_email_test($to='', $debug=false){
        // $invest             = absint(get_option('investment'));
        // $email              = trim($member->email);

        $plain_down         = "Test email untuk user";
        
        $html_down          = "<h1> Test email untuk user</h1>";
        
        $message            = new stdClass();
        $message->plain     = $plain_down;
        $message->html      = $html_down;
        
        $send               = $this->send('wahyurohman95@gmail.com', 'Tes Informasi Pendaftaran', $message, $this->username, 'Admin ');
        
        if( $debug ){
            print_r($send);
        }else{
            return $send;
        }
    }
    function send_email_assessment($to='',$assessment, $debug=false){
        // $invest             = absint(get_option('investment'));
        // $email              = trim($member->email);

        $plain_down         = "Informasi Assessment Baru";
        
        $html_down          = "<h1> Informasi Assessment Baru </h1>
                               <br>
                               <br>
                               <table>
                               <tr><td><p>Tanggal </p></td><td>:</td><td><p>".$assessment->date."</p></td><tr>
                               <tr><td><p>Jam </p></td><td>:</td><td><p>".$assessment->time."</p></td><tr>
                               <tr><td><p>Ruangan </p></td><td>:</td><td><p>".$assessment->room."</p></td><tr>
                               <tr><td><p>Nomor Assessment</p></td><td>:</td><td><p>".$assessment->assessment_number."</p></td><tr>
                               <tr><td><p>Jenis Assessment</p></td><td>:</td><td><p>".$assessment->assessment_name."</p></td><tr>
                               <tr><td><p>Jabatan</p></td><td>:</td><td><p>".$assessment->position."</p></td><tr>
                               </table>";
        
        $message            = new stdClass();
        $message->plain     = $plain_down;
        $message->html      = $html_down;
        
        $send               = $this->send($to, 'Informasi Assessment Baru', $message, $this->username, 'Admin ');
        
        if( $debug ){
            print_r($send);
        }else{
            return $send;
        }
    }
    function send_email_feedback($to='',$assessment,$user, $debug=false){
        // $invest             = absint(get_option('investment'));
        // $email              = trim($member->email);

        $plain_down         = 'Laporan Assessment '.$assessment->reg_name.'\r\n\r\n\r\n';
        $plain_down         .= 'Data Assessment \r\n';
        $plain_down         .= "Nomor Assessment ".$assessment->assessment_number.'\r\n';
        $plain_down         .= "Tanggal Assessment ".get_date_text($assessment->date).'\r\n';
        $plain_down         .= "Jam Assessment ".get_time_text($assessment->assessment_name).'\r\n';
        $plain_down         .= "Posisi ".$assessment->position.'\r\n';
        $CI =& get_instance();
        $data['assessment'] = $assessment;
        $html_down          = $CI->load->view(VIEW_BACK.'feedbackmail',$data,true);
        // $html_down          = "<h1> Informasi Laporan Assessment</h1>";
        
        $message            = new stdClass();
        $message->plain     = $plain_down;
        $message->html      = $html_down;
        
        $send               = $this->send($to, 'Informasi Laporan Assessment ', $message, $this->username, 'Admin ');
        
        if( $debug ){
            print_r($send);
        }else{
            return $send;
        }
    }
    
  
}
