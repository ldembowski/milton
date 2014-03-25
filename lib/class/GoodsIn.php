<?php


class GoodsIn extends Core{
    
    public $good = array(
                        "idGood"    =>'',
                        "Company"   =>'',
                        "Field1"    =>'',
                        "idCourier" =>'',
                        "Field2"    =>'',
                        "Field3"    =>'',
                        "Field4"    =>'',
                        "ExField1"  =>'',
                        "ExField2"  =>'',
                        "dateIn"    =>''
    );  
    
    public $errors = array();
    public $todayIn = array();
    public $allIn = array();
    
    
    public function __construct() {
        parent::__construct();
    }
    
    //verify data form form
    public function CheckGoodInData() {
        
                if(!$this->good["Field1"]) { $this->errors[] = 'Please check Field1 field again.'; }
                if(!$this->good["Field2"]) { $this->errors[] = 'Please check Field2 field again.'; }
                if(!$this->good["Field3"]) { $this->errors[] = 'Please check Field3 field again.'; }
                if(!$this->good["Field4"]) { $this->errors[] = 'Please check Field4 field again.'; }
                
                if($this->good["Company"]==2 && !$this->good["ExField1"]) { $this->errors[] = 'Please check ExField1 field again.'; }
                if($this->good["Company"]==2 && !$this->good["ExField2"]) { $this->errors[] = 'Please check ExField2 field again.'; }
            
          
            if(count($this->errors)>0) {
                return false;
            } else return true;
            
    }
   // save good in DB 
    public function SaveGoodInDB() {
        $this->good["idGood"] = "NULL";
        $this->good["dateIn"] = date('Y-m-d', time());
        
        $into = '';
        $values = '';
        
        foreach($this->good as $key=>$data){
            $into .= $key.',';
            
            if(!$data) {
                $values .= '"NULL",';
            } else {
                $values .= '"'.$this->MySQLSanitizeString($data).'",';
            }
        }
        
        $into = rtrim($into, ',');
        $values = rtrim($values, ',');
        
        $query = 'insert into goodsin values('.$values.')';
        
        return $this->AddTo($query);
        
    }
    
    
    //get goodsin added today
    
    public function AddedToday() {
        
        $query = 'select * from goodsin where dateIn = "'.date('Y-m-d', time()).'"';
        
        if($result = $this->GetFrom($query)){
                while($row = mysql_fetch_assoc($result)){
                    $this->todayIn[] = $row;
                }
                return true;
            }   else return false;
    } 
    
    //Get all goods in 
    public function GetAllGoodsIn() {
       $query = 'select * from goodsin order by dateIn desc';
        
        if($result = $this->GetFrom($query)){
                while($row = mysql_fetch_assoc($result)){
                    $this->allIn[] = $row;
                }
                return true;
            }   else return false;
    }  
    
    
    
        

    
    
    
}
