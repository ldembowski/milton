<?php
function __autoload($class){
require_once '../../lib/class/'.$class.'.php';
}

$cr = new Users();

if(!isset($_SESSION["name"]) || !$cr->VerifySession() ) {
     echo "FALSE";
} else {

    
    if($users = $cr->GetUsersTable() /*&& count($users)>0*/){
       
    
    
?>
<div class="clearfix Bigborder" id="useresContent" > 
    <button type="button" class="close emptyForm" aria-hidden="true">&times; Close</button>
    
    <p class="text-muted">Manage users:</p>
    
    <div class="errorsMsg">
                        
    </div>
<table class="table table-hover">
    <thead>
        <tr class="text-center">
            <td></td>
            <td>Name</td>
            <td>Change password</td>
            <td>Delete</td>
        </tr>
    </thead>
    <tbody>
        <?php
                foreach($users as $u){
                    
                    
                    echo'<tr class="text-center"> '
                        .'<td><img src="img/icons/infouser.png" alt="'.$u["idUser"].'" class="tableIcon" /></td>'
                        .'<td>'.$u["name"].'</td>'
                        .'<td><img src="img/icons/lock.png" alt="'.$u["idUser"].'" title="Change password" class="changePassIcon" /></td>'
                        .'<td><img src="img/icons/deleteuser.png" alt="'.$u["idUser"].'" title="Delete user" class="actionIcon" />'
                        . '<button type="button" class="btn btn-danger btn-xs confirmDelete" value="'.$u["idUser"].'" >confirm</button> </td>';
                }
        ?>
    </tbody>
</table>

    <div>



<?php 
} else {
        echo'<p>Something wrong here... :(   Please try again</p>';
    }

    } ?>
