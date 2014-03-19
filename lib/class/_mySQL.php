<?php
/**
 * Description of Query
 *
 * @author lukasz
 */





abstract class _mySQL {
    
    private $host;
    private $user;
    private $pass;
    private $datab;
    
    private $link;    //main link to DB
    
    
    public function __construct() {
        if($this->GetConfigFile()) {
            $this->host= HOST;
            $this->user= USER;
            $this->pass= PASS;
            $this->datab= DATAB;
            $this->BDConnect();
        } else die('DB connection fail...');
    }
    
    
    public function GetConfigFile() {
        if(file_exists('__config/config.php')) {
           require_once'__config/config.php'; 
           return true;
        } else if (file_exists('../__config/config.php')) {
            require_once'../__config/config.php'; 
           return true;
        }
         else if (file_exists('./__config/config.php')) {
            require_once'./__config/config.php'; 
           return true;
        }
         else if (file_exists('../../__config/config.php')) {
            require_once'../../__config/config.php'; 
           return true;
        }
        else if (file_exists('./../../__config/config.php')) {
            require_once'./../../__config/config.php'; 
           return true;
        }
        
         else if (file_exists('../../../__config/config.php')) {
            require_once'../../../__config/config.php'; 
           return true;
        }
        
        else return false; 
    }
    
    
     public function BDConnect()
  	{
		 $this->link = mysql_connect("$this->host","$this->user","$this->pass") or die("DataBase not connected");
   		 mysql_query("SET NAMES 'utf8'");
   		 mysql_select_db( "$this->datab", $this->link) or die("Database not selected");                	
	}
    
    
    public function GetFrom($query) {
       
        $result = @mysql_query($query) or die("wrong query -".mysql_error());
        if(mysql_num_rows($result) == 0) return false;
        else return $result;
    }
    
    public function AddTo($query) {
        @mysql_query($query) or die("wrong query -".mysql_error());
        if(mysql_affected_rows() == 1) {
            return true; }
        else {
            return false; }
    }
    
    public function Delete($query){
        if($this->AddTo($query)) return true;
        else return false;
    }
    
    public function Upadte($query){
        if($this->AddTo($query)) return true;
        else return false;
    }
    
    public function __destruct() {
        try{
		mysql_close($this->link);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
    
    
    

    
}

?>
