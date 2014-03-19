<?php

/**
 * Description of Email
 *
 * @author lukasz
 */
class Email extends Core{
    
     
    public $errors = Array();
    
    public $from, $phone, $email, $message;
    
    public $admin = 'lukasz@dembowski.co.uk';
    public $subject = 'Web message';
    
    public function ValidateEmail($email) {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $domain = substr($email, strpos($email, '@')+1, strlen($email)-strpos($email, '@'));
            if ((checkdnsrr($domain,"MX") || checkdnsrr($domain,"A"))) {
                return true;
            } else return 'Domain - ('.$domain.') -  is invalid!';

            } else return 'Email address - ('.$email.') is invalid!';
     }
    
     
     public function SendEmail(/*$to, $name, $from, $subject, $message, $template*/) {
        #mail('lukasz@loklanie.co.uk', 'mail attempt', 'warrning');
         
         $to = $this->admin;
         $name = $this->from;
         $from = $this->email;
       //  $subject = 'Web Form - wwww.makaroncleaning.co.uk';
         $message = $this->message;
         $template = 'main';
         $headers = "From: ".$this->email; 
         ini_set("sendmail_from", "lukasz@dembowski.co.uk");
            mail('lukasz@dembowski.co.uk', 'Bezposrednio ze strony', $message, $headers);
         ini_set("SMTP", "mail.dembowski.co.uk");
         ini_set("sendmail_from", "lukasz@dembowski.co.uk");
         ini_set("password","Zbgn3221!");  
         ini_set("smtp_port", "25");
         
         
         $subject = $this->subject;
         
       //  mail('ldembowski@gmail.com', 'My Subject', $message, $headers);
         
        if(file_exists('../../lib/mails/'.$template.'.php')) {
            require_once '../../lib/mails/'.$template.'.php';
            
                    try{ 
                     mail($to,$this->subject,$text,$headers);
                    }catch (Exception $e) {
                     echo 'Caught exception: ',  $e->getMessage(), "\n";
                 }
           
        } else return false;
        
        
        
/*
        if(mail($to,$subject,$text,$headers)) {
            #echo'<h3>Wiadomość wysłana do - '.$to.'</h3>';
        return true; } else return false;*/

    }
    
    
    
    
    
    public function StringLength($str, $max, $min) {
        
        $lgh = strlen($str);
     
        if($lgh > ($max+1) || $min> $lgh) {
            return false;
        } else {     
            return true;
        }
      
    }
    
    
    public function SaveMsg ($name, $email, $msg, $id_visit){
        
        $query = 'insert into contact (id_email, name, email, msg, id_visit) value (
                    NULL, 
                    "'.mysql_real_escape_string($name).'", 
                    "'.mysql_real_escape_string($email).'",
                    "'.mysql_real_escape_string($msg).'",
                    '.mysql_real_escape_string($id_visit).')';
        
        #var_dump($query);
        
        return $this->AddTo($query);
    }
    
    
     
}

?>
