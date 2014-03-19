
<?php
class Core extends _mySQL {
  

    private $salt1 = "F^&£g:^&%^&ęśćó";
    private $salt2 = "9*hz!";
    
    
   public function __construct() {
       parent::__construct();   //use only if using MySQl!!!!   [must extends _mySQL]

   }
    
   
   // Add User to Database id, name, pass
   public function AddUserToDB($name,$pass){
            
            $query = "SELECT * FROM users WHERE name='$name'";
            if (mysql_num_rows(mysql_query($query)) == 1) return false;
            
            $pass = md5($this->salt1.$pass.$this->salt2.$name);
            
            $query = "INSERT INTO users VALUES(NULL, '".$this->MySQLSanitizeString($name)."', '".$this->MySQLSanitizeString($pass)."')";
            if (mysql_query($query)) return true;
            else return false;
            }
            
            
   // Get * user data from DB 
    public function GetUserFromDB($name) {
        $query = "SELECT * FROM users WHERE name='$this->MySQLSanitizeString($name)'";
        $result = mysql_query($query);
        if (mysql_num_rows($result) == 0) return FALSE;
        else return array(TRUE, mysql_fetch_assoc($result));
        } 
        
        
   // If user exists check password
    public function VerifyUserInDB($name, $pass){
        $result = $this->GetUserFromDB($name);
        if ($result[0] == FALSE) return FALSE;
        elseif ($result[1]["pass"] == md5($this->salt1 .$pass .$this->salt2.$name))
        return TRUE;
        else return FALSE;
        }        
            
    //Sanitize string        
    private function SanitizeString($string) {
        $string = strip_tags($string);
        return htmlentities($string);
        } 
        
        
    // Prepare String to DB
    private function MySQLSanitizeString($string){
            if (get_magic_quotes_gpc())
            $string = stripslashes($string);
            $string = $this->SanitizeString($string);
            return mysql_real_escape_string($string);
     }
            
 
            
            
            
            
	public function __destruct() {
	//	mysql_close() or die("Database not disconnected");
	}

}


