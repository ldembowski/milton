<?php
function __autoload($class){
require_once '../../lib/class/'.$class.'.php';
}

$cr = new Courier();

if(!isset($_SESSION["name"]) || !$cr->VerifySession() ) {
     echo "FALSE";
} else {

    
        // add new item  idCourier
   if($cr->get_get("add") && $cr->get_get("add") == 1 && is_numeric($cr->get_get("add")) && $cr->get_post("action") == "add" ){
           $errors = array();
           if(!$cr->get_post("Couriername")) {
                array_push($errors, "user name not exists");
                exit();
            }
            
            if(strlen($cr->get_post("Couriername")) <2) {
                array_push($errors, "Couriername min 2 characters");
            }
            
            if(count($errors) == 0) {
                    if($cr->CreateCourier($cr->get_post("Couriername"), $cr->get_post("Courierinfo"))) {
                        echo "true"; }
                    else {
                        echo'<p class="text-danger">Saving filed.. please try again later....</p>';
                    }    
            } else {
                foreach($errors as $e){
                    echo'<p class="text-danger">'.$e.'</p>';
                }
            }
            
       } //save end
       
       
       // Update courier
       if($cr->get_get("add") && $cr->get_get("add") == 1 && is_numeric($cr->get_get("add")) && $cr->get_post("action") == "update" ){
   
           $errors = array();
           if(!$cr->get_post("Couriername")) {
                array_push($errors, "user name not exists");
                exit();
            }
            
            if(strlen($cr->get_post("Couriername")) <2) {
                array_push($errors, "Couriername min 2 characters");
            }
            
            if(count($errors) == 0) {
                    if($cr->UpdateCourier($cr->get_post("idCourier"), 
                                          $cr->get_post("Couriername"), 
                                          $cr->get_post("Courierinfo"))) {
                        echo "true"; }
                    else {
                        echo'<p class="text-danger">Saving failed.. please try again later....</p>';
                    }    
            } else {
                foreach($errors as $e){
                    echo'<p class="text-danger">'.$e.'</p>';
                }
            }
            
            
       } // upadte end
       
       
       //delete courier
       if($cr->get_get("del") && $cr->get_get("del") == 1 && is_numeric($cr->get_get("del"))){
           
           if($cr->get_post("idCourier") && is_numeric($cr->get_post("idCourier"))) {
             
               if($cr->DeleteCourier($cr->get_post("idCourier"))) {
                        echo "true"; }
                    else {
                        echo'<p class="text-danger">Can not delete... please try again later....</p>';
                    } 
               
           } else {
               echo'<p class="text-danger">Can not delete... please try again later....</p>';
           }
       }
       
       
       
       
}
