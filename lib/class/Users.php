<?php

class Users extends Core{
    //put your code here
    
    private $salt1 = "F^&£g:^&%^&ęśćó";
    private $salt2 = "9*hz!";
    
    private $sleeptime = 0;
    
    public function __construct() {
        parent::__construct();
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
            sleep($this->sleeptime);
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
            
            if(strlen($name)<5 || strlen($pass)<5) return false;
       
            $query = "SELECT * FROM users WHERE name='$name'";
            if (mysql_num_rows(mysql_query($query)) == 1) return false;
            
            $pass = md5($this->salt1.$pass.$this->salt2.$name);
            
            $query = "INSERT INTO users VALUES(NULL, '".$this->MySQLSanitizeString($name)."', '".$this->MySQLSanitizeString($pass)."')";
            if (mysql_query($query)) return true;
            else return false;
            }
            
            
   // Get * user data from DB by name
    public function GetUserFromDB($name) {
        $query = "SELECT * FROM users WHERE name='".$this->MySQLSanitizeString($name)."'";
        $result = mysql_query($query);
        if (mysql_num_rows($result) == 0) return FALSE;
        else return array(TRUE, mysql_fetch_assoc($result));
        } 
        
    // Get * user data from DB  by ID 
    public function GetUserFromDBbyID($id) {
        $query = "SELECT * FROM users WHERE idUser=".$this->MySQLSanitizeString($id)." limit 1";
        $result = mysql_query($query);
        if (mysql_num_rows($result) == 0) return FALSE;
        else return array(TRUE, mysql_fetch_assoc($result));
        }     
        
        
   // If user exists check password
    private function VerifyUserInDB($name, $pass){
        sleep($this->sleeptime);
        $result = $this->GetUserFromDB($name);
        if ($result[0] == FALSE) return FALSE;
        elseif ($result[1]["pass"] == md5($this->salt1 .$pass .$this->salt2.$name)){
                $this->name = $name;
                return TRUE;
                
        }
        else return FALSE;
        }
    
    //Get users table
        public function GetUsersTable(){
            $query = "select idUser, name from users order by name";
            $usersTable = array();
            if($result = $this->GetFrom($query)){
                    while($row = mysql_fetch_assoc($result)){
                        $usersTable[] = $row;
                    }
                    return $usersTable;
            } else return false;
        }
        
     //Delete user from DB
        public function DeleteUser($id){
            $id = (int)$id;
            
            $users = (int)$this->CountUsers();

            if($users === false) {
                return "Can count users. Please try again later";
            }
            if($users <= 1) {
                return "Only one user one user in DB left";
            }
            
            else{
                $query = "delete from users where idUser = ".$this->MySQLSanitizeString($id)." limit 1";
                return $this->Delete($query); 
            }
        }
    
    //check qty of users in db    
        public function CountUsers() {
            $query = "select count(name) from users ";
            if($result = $this->GetFrom($query)){
                    $row = mysql_fetch_row($result);
                    return $row[0];
                    
            } else return false;
        }
        
      //update user password
        public function UpdateUserPassword($id, $pass) {
           
            if(strlen($pass)<5) {
                return false;
            }
            
            $name = $this->GetUserFromDBbyID($id);
            if(!$name[0]) {
                return false;
            }
            $pass = md5($this->salt1.$pass.$this->salt2.$name[1]["name"]);
            $query = 'update users set pass = "'.$pass.'" where idUser = '.$this->MySQLSanitizeString($id).' limit 1';
      
           sleep(1);
            if( $this->Upadte($query)) {
                return true;
               
            } else {
                return false;
                
            }
           
            
        }
        
    
} //class end
