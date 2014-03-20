
<?php
class Core extends _mySQL {
  

    
    
    
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
   
           
            
    //Sanitize string        
    public function SanitizeString($string) {
        $string = strip_tags($string);
        return htmlentities($string);
        } 
        
        
    // Prepare String to DB
    public function MySQLSanitizeString($string){
            if (get_magic_quotes_gpc())
            $string = stripslashes($string);
            $string = $this->SanitizeString($string);
            return mysql_real_escape_string($string);
     }
            
 
            
            
            
            
	public function __destruct() {
	//	mysql_close() or die("Database not disconnected");
	}

}


