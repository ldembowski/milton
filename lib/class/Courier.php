<?php

class Courier extends Users {
    
    public $couriers = array();
    
    
    public function __construct() {
        parent::__construct();
        $this->GenerateCouriersList();
    }
    
   // Save new item in DB 
    public function CreateCourier($name, $text){
        
        if(strlen($name)<2) {
            return false;
        }      
        $query = 'insert into courier (idCourier, Couriername, Courierinfo) '
                .'values(NULL, "'.$this->MySQLSanitizeString($name).'", "'.  mysql_real_escape_string($text).'")';    
        return $this->AddTo($query);
    }
    
    
    //Take all from DB and store to public array
    public function GenerateCouriersList(){
        $query = "select * from courier order by Couriername";
        
        if($result = $this->GetFrom($query)){
            while($row = mysql_fetch_assoc($result)) {
                $this->couriers[] = $row;
            }
            return true;
        } else return false;
    }
    
    
}
