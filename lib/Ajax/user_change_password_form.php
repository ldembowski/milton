<?php
function __autoload($class){
require_once '../../lib/class/'.$class.'.php';
}

$cr = new Users();

if(!isset($_SESSION["name"]) || !$cr->VerifySession() ) {
     echo "FALSE";
} else {
    
    
    if(!$cr->get_post("idUser")) {
        echo "false";
        die();
    }
    
?>


<div id="ChangePasswordForm">
    
                    <button type="button" class="close emptyForm1" aria-hidden="true">&times; Close</button>
                   
                    <div class="changePassErrorsMsg">
                        
                    </div>
                <form class="form-horizontal" role="form">      
                    <input type="hidden" name="idUser" value="<?php echo $cr->get_post("idUser"); ?>" />
                

                <div class="form-group">
           
                  <div class="col-sm-10">
                      <input type="password" class="form-control" id="inputPassword" placeholder="New password" min="5" required >
                  </div>
                </div>
                    
                 <div class="form-group">
   
                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputPasswordConfirm" placeholder="Confirm password" min="5" required >
                  </div>
                </div>                  
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default" id="changePass">Change</button>
                  </div>
                </div>
              </form>
</div>
<?php } ?>

