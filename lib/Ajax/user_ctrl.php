<?php
function __autoload($class){
require_once '../../lib/class/'.$class.'.php';
}

$cr = new Users();

if(!isset($_SESSION["name"]) || !$cr->VerifySession() ) {
     echo "FALSE";
} else {
  // add new user
       if($cr->get_get("add") && $cr->get_get("add") == 1 && is_numeric($cr->get_get("add"))){
           $errors = array();
            
            if(!$cr->get_post("name")) {
                array_push($errors, "user name not exists");
                exit();
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
            
            
       } // end adding user
       
     //delte user  
       if($cr->get_get("del") && $cr->get_get("del") == 8 && is_numeric($cr->get_get("del"))){
           if($cr->get_post("idUser") && is_numeric($cr->get_post("idUser"))) {
              
               $idUser = $cr->get_post("idUser");

               $res =$cr->DeleteUser($idUser);
               if($res === true) {
                   echo 'true';
               } else {
                  echo '<p class="text-danger">'.$res.'</p>';
               }
               
           } else {
               echo'<p class="text-danger">Input data error.... </p>';
           }
       }
    //update password     
        if($cr->get_get("changep") && $cr->get_get("changep") == 2 && is_numeric($cr->get_get("changep"))){
            $errors = array();
 
           if(!$cr->get_post("idUser") || !is_numeric($cr->get_post("idUser"))) {
                array_push($errors, "Input data error....");
            }
            
            if(strlen($cr->get_post("pass1")) <5) {
                array_push($errors, "password min 5 characters");
            }
  
            if(!$cr->get_post("pass1") || !$cr->get_post("pass2") || $cr->get_post("pass1")!= $cr->get_post("pass2") ){
                array_push($errors, "password not exists or passwords not maching");
            }
                
            if(count($errors) == 0) {
                            $cr->UpdateUserPassword($cr->get_post("idUser"), $cr->get_post("pass1"));
                            echo"true";
                               
            } else {
                foreach($errors as $e){
                    echo'<p class="text-danger">'.$e.'</p>';
                }
            }
        }   
           

       
}  //end of checking if user loged in
?>

