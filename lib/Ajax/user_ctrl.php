<?php
function __autoload($class){
require_once '../../lib/class/'.$class.'.php';
}

$cr = new Users();

if(!isset($_SESSION["name"]) || !$cr->VerifySession() ) {
     echo "FALSE";
} else {
  
            
    
    
       if($cr->get_get("add") && $cr->get_get("add") == 1 && is_numeric($cr->get_get("add"))){
           $errors = array();
            
            if(!$cr->get_post("name")) {
                array_push($errors, "user name not exists");
            }
            
            if(strlen($cr->get_post("name")) <5) {
                array_push($errors, "user name min 5 characters");
            }
            
            if(!$cr->get_post("pass1") || !$cr->get_post("pass2") || $cr->get_post("pass1")!= $cr->get_post("pass2") ){
                array_push($errors, "password not exists or passwords not maching");
            }
            
            if(count($errors) == 0) {
                if($cr->AddUserToDB($cr->get_post("name"), $cr->get_post("pass1"))) {
                    echo "true";
                } else {
                    echo'<p class="text-danger">Failed to save user</p>';
                    if($cr->GetUserFromDB($cr->get_post("name"))) {
                        echo'<p class="text-danger">User name <b>'.$cr->get_post("name").'</b> already in DB </p>';
                    }
                }
            } else {
                foreach($errors as $e){
                    echo'<p class="text-danger">'.$e.'</p>';
                }
            }
            
            
       }
}  
?>

