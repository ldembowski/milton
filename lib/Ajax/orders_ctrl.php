<?php
function __autoload($class){
require_once '../../lib/class/'.$class.'.php';
}

$good = new GoodsIn();
$courier = new Courier();
$cr = new Users();


if(!isset($_SESSION["name"]) || !$cr->VerifySession() ) {
     echo "FALSE";
} else {
    
    // find opened order
       if($cr->get_get("find") && $cr->get_get("find") == 1 && is_numeric($cr->get_get("find"))){
           
           $id = $cr->get_post("idGood");

           if($row =$good->GetSingleOpenGoodsIn($id)) {
               
               echo '<table class="table table-condensed">
                                <thead>
                                <tr class="active">
                                    <td>order no</td>
                                    <td>Company</td>
                                    <td>Field1</td>
                                    <td>Courier</td> 
                                    <td>Date added</td> 
                                    <td>Act</td>
                                </tr>
                                </thead>
                                <tbody>';
                                
                                if($row["Company"] == 1) {
                                                   $comp = "Company one";
                                               } else  if($row["Company"] == 2) {
                                                   $comp = "Company two";
                                               } else { $comp = "error01"; }
               
                                                    echo'<tr>
                                                        <td>'.$row["idGood"].'</td>
                                                        <td>'.$comp.'</td>
                                                        <td>'.$row["Field1"].'</td>
                                                        <td>'.$courier->GetCourierNameById($row["idCourier"]).'</td> 
                                                        <td>'.$row["dateIn"].'</td>
                                                        <td><form class="closeBtn" method="POST" ><button type="submit" class="btn btn-warning btn-xs" name="close" value="'.$row["idGood"].'" >close</button></form></td>    
                                                    </tr>';
               
               echo'</tbody></table>';
                   
               }else {
               echo '<p class="text-danger">Order not exists</p>';
               
           } 
           }
           
           
           
       // update opened order
       if($cr->get_get("update") && $cr->get_get("update") == 1 && is_numeric($cr->get_get("update"))){
           $id = $cr->get_post("idGood");
           
           if($good->CloseOrder($id)) {
               echo "true";
           } else {
               echo '<p class="text-danger">Status NOT changed.... Please try again later....</p>';
           }
           
       }
    
}