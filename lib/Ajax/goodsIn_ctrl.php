<?php
function __autoload($class){
require_once '../../lib/class/'.$class.'.php';
}

$good = new GoodsIn();
$cr = new Users();


if(!isset($_SESSION["name"]) || !$cr->VerifySession() ) {
     echo "FALSE";
} else {
    
     // save new
       if($cr->get_get("add") && $cr->get_get("add") == 1 && is_numeric($cr->get_get("add"))){
           
           
           
           foreach($good->good as $key=>$data){
               $good->good[$key] = $cr->get_post($key);
           }
           
           if($good->CheckGoodInData()){
               if($good->SaveGoodInDB()) {
                 echo "true";  
               } else {
                   echo'<p class="text-danger">Please try again... Error 0xffffff </p>';
               }
               
           } else {
               foreach($good->errors as $e){
                    echo'<p class="text-danger">'.$e.'</p>';
                }
           }
       }
    
    
}