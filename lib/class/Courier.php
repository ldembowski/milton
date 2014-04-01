<?php

class Courier extends Users {
    
    public $couriers = array();
    
    
    public function __construct() {
        //parent::__construct();
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
        $this->couriers = array();
        if($result = $this->GetFrom($query)){
            while($row = mysql_fetch_assoc($result)) {
                $this->couriers[] = $row;
            }
            return true;
        } else return false;
    }
    
    
    //Get Courier name by if - user id output table
    public function GetCourierNameById($id) {
        $query = "select Couriername from courier where idCourier = ".$this->MySQLSanitizeString($id)." limit 1";
        if($result = $this->GetFrom($query)) {
                $row = mysql_fetch_row($result);
                return $row[0];
        } else return false;
    }
    
    
    //Update sigle company information  Courierinfo
    public function UpdateCourier($id, $name, $text){
        
        $id = (int)$id;
        
        $query = 'update courier set Couriername="'.$this->MySQLSanitizeString($name).'", Courierinfo="'.mysql_real_escape_string($text).'" '
                .'where idCourier = '.$this->MySQLSanitizeString($id).' limit 1';
              
        return $this->Upadte($query);
          
    }
    
    //delete Courier from DB
    public function DeleteCourier($id){
        $id = (int)$id;
        $query = 'delete from courier where idCourier = '.$this->MySQLSanitizeString($id).' limit 1';
        return $this->Delete($query);
    }
    
    
    
}
