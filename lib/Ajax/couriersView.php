<?php
function __autoload($class){
require_once '../../lib/class/'.$class.'.php';
}

$cr = new Courier();

if(!isset($_SESSION["name"]) || !$cr->VerifySession() ) {
     echo "FALSE";
} else {
    
?>

<div id="CourierForm" class="clearfix">
    
                    <button type="button" class="close emptyForm" aria-hidden="true">&times; Close</button>
                   
                    <div class="Couriererrors">
                        
                    </div>

                <form class="form-horizontal" role="form">
                                                        <input type="hidden" name="idCourier" value="" id="idCourier" />
                                                        <input type="hidden" name="actionMake" value="add" id="actionMake" />
                <div class="form-group">
                  <label for="inputCourierName" class="col-sm-2 control-label">Courier</label>
                  <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputCourierName" placeholder="Courier name" min="3"  required >
                  </div>
                </div>
                 
                <div class="form-group">
                  <label for="inputExtraInfo" class="col-sm-2 control-label">Info</label>
                  <div class="col-sm-10">
                      <textarea class="form-control" rows="3" placeholder="extra info" id="inputExtraInfo" ></textarea>
                  </div>
                </div>    
                    
                    
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default" id="addNewCourier" name="submit" value="submit" >Submit</button>
                  </div>
                </div>
              </form>
</div>

<div id="CouriersList">
    <table class="table table-hover">
    <thead>
        <tr class="text-center">
            <td>Id</td>
            <td>Courer</td>
            <td>Info</td>
            <td>Edit</td>
        </tr>
    </thead>
    <tbody>
    <?php
        if(isset($cr->couriers) && count($cr->couriers)>0) {
            $i = 1;
            foreach($cr->couriers as $c){
                echo'<tr>'
                    .'<td>'.$i.''      //$c["idCourier"]
                    .'<td class="cn">'.$c["Couriername"].''
                    .'<td class="ci">'.$c["Courierinfo"].''
                    .'<td class="courierTableMenu"><img src="img/icons/option.png" alt=""  />'
                        .'<div>'
                        .'<span class="editCourier"><img src="img/icons/edit.png" alt="'.$c["idCourier"].'" />edit</span>'
                        .'<span class="deleteCourier"><img src="img/icons/delete.png" alt="'.$c["idCourier"].'" />delete</span>'
                        .'</div></td>'
                    .'</tr>';
                $i++;
            }
        }
    ?>
    </tbody>
    </table>
</div>


<?php } ?>
