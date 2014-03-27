<?php
function __autoload($class){
require_once '../../lib/class/'.$class.'.php';
}

$cr = new Users();

if(!isset($_SESSION["name"]) || !$cr->VerifySession() ) {
     echo "FALSE";
} else {
    
?>

<div id="AddUserForm" class="Bigborder">
    
                    <button type="button" class="close emptyForm" aria-hidden="true">&times; Close</button>
                    <p class="text-muted">Add new user:</p>             
                    <div id="errors">
                        
                    </div>
                    
                <form class="form-horizontal" role="form">
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-2 control-label">User name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputUserName" placeholder="User name" min="5" required >
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword" class="col-sm-2 control-label">Password</label>
                  <div class="col-sm-10">
                      <input type="password" class="form-control" id="inputPassword" placeholder="Password" min="5" required >
                  </div>
                </div>
                    
                 <div class="form-group">
                  <label for="inputPasswordConfirm" class="col-sm-2 control-label">Password confirm</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputPasswordConfirm" placeholder="Confirm password" min="5" required >
                  </div>
                </div>   
                
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default" id="addNewUserBtn">Submit</button>
                  </div>
                </div>
              </form>
</div>


<?php } ?>
