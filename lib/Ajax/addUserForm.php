<?php
function __autoload($class){
require_once '../../lib/class/'.$class.'.php';
}

$cr = new Core();

if(!isset($_SESSION["name"]) || !$cr->VerifySession() ) {
     echo "FALSE";
} else {
    
?>

<div id="AddUserForm">
                    <button type="button" class="close emptyForm" aria-hidden="true">&times; Close</button>
                <form class="form-horizontal" role="form">
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-2 control-label">User name</label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" id="inputUserName" placeholder="User name">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword" class="col-sm-2 control-label">Password</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputPassword" placeholder="Password">
                  </div>
                </div>
                    
                 <div class="form-group">
                  <label for="inputPasswordConfirm" class="col-sm-2 control-label">Password confirm</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputPasswordConfirm" placeholder="Confirm password">
                  </div>
                </div>   
                
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Submit</button>
                  </div>
                </div>
              </form>
</div>


<?php } ?>
