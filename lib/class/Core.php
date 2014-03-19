
<?php
class Core extends _mySQL {
  

    private $salt1 = "F^&£g:^&%^&ęśćó";
    private $salt2 = "9*hz!";
    
    
   public function __construct() {
       parent::__construct();   //use only if using MySQl!!!!   [must extends _mySQL]

   }
    
   
   
   // check GET table
   public function get_get($var) {
 
          if ($search_url = filter_input(INPUT_GET, $var, FILTER_SANITIZE_ENCODED)) {
              return $search_url;
          }
          return false;
    }
    
    // check POST table
    public function get_post($var) {
         if ($search_url = filter_input(INPUT_POST, $var, FILTER_SANITIZE_SPECIAL_CHARS)) {
              return $search_url;
          }
          return false;
    }
   
   //Login user + create session + create cookies
    public function LoginUser(){
        if($this->VerifyUserInDB($this->get_post("userName"), $this->get_post("userPassword"))) {
            $_SESSION['name'] =  $this->name;
            $_SESSION['ipnum'] = getenv("REMOTE_ADDR");
            $_SESSION['agent'] = getenv("HTTP_USER_AGENT");
           return true;
        } else {
            return false;
        } 
    }
   
    public function VerifySession(){
            $ipnum = getenv("REMOTE_ADDR");
            $agent = getenv("HTTP_USER_AGENT");
            sleep(1);
            if (isset($_SESSION['ipnum'])){
                
                if ($ipnum != $_SESSION['ipnum'] || $agent != $_SESSION['agent']) {
                CloseSession();
                return FALSE;
            }
                else return TRUE;
            }
                else return FALSE;
    }
    
    //Destroy Function
    public function CloseSession() {
        $_SESSION = array();
        if (session_id() != "" ||
        isset($_COOKIE[session_name()]))
        setcookie(session_name(), '', time() - 2592000, '/');
        return @session_destroy();
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
    private function GetUserFromDB($name) {
        $query = "SELECT * FROM users WHERE name='".$this->MySQLSanitizeString($name)."'";
        $result = mysql_query($query);
        if (mysql_num_rows($result) == 0) return FALSE;
        else return array(TRUE, mysql_fetch_assoc($result));
        } 
        
        
   // If user exists check password
    private function VerifyUserInDB($name, $pass){
        sleep(1);
        $result = $this->GetUserFromDB($name);
        if ($result[0] == FALSE) return FALSE;
        elseif ($result[1]["pass"] == md5($this->salt1 .$pass .$this->salt2.$name)){
                $this->name = $name;
                return TRUE;
                
        }
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


