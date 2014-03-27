<?php
function __autoload($class){
require_once 'lib/class/'.$class.'.php';
}

$cr = new Users();

   
 
    if(!isset($_SESSION["name"]) || !$cr->VerifySession() ) {
     header("Location:index.php?system=fail_login");
    }
    
$courier = new Courier();    
$in = new GoodsIn();

?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Goods in</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="js/vendor/bootstrap/css/bootstrap.min.css">
        
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 9]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
<img src="img/gif-load.gif" id="loading" alt="loading" /> 
        
        <?php
        require_once './lib/modules/header/header.php';
        ?>
        
        <section id="Form" >
          
        </section>

                <div  id="closeContent">
                        <h5>Close order:</h5>
                
                            <form class="form-horizontal" role="form" id="CloseOrder">

                                        <div class="form-group">
                                          <label for="idGood" class="col-sm-2 control-label">order no:</label>
                                          <div class="col-sm-10">
                                              <input type="text" class="form-control" id="idGood" placeholder="Field 1" required >
                                          </div>
                                        </div>  
                                        
                                
                                        <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                          <button type="submit" class="btn btn-default" name="submit"  >Find</button>
                                        </div>
                                      </div>
                                
                            </form>
                        
                        <div id="Searchresult"></div>     
                        
                </div>

     
                
            <div id="allIn">

                
                <?php
                    $in->GetOpenGoodsIn();
                    
                    if(isset($in->closed) && count($in->closed)>0) {
                ?>
                
                        <table class="table table-condensed">
                                <thead>
                                <tr class="active">
                                    <td>order no</td>
                                    <td>Company</td>
                                    <td>Field1</td>
                                    <td>Courier</td>
                                    <td>Field2</td>
                                    <td>Field3</td>
                                    <td>Field4</td>
                                    <td>Extra1</td>
                                    <td>Extra2</td>
                                    <td>Status</td>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                            foreach($in->closed as $t) {
                                               $i++;
                                               
                                               if($t["Company"] == 1) {
                                                   $comp = "Company one";
                                               } else  if($t["Company"] == 2) {
                                                   $comp = "Company two";
                                               } else { $comp = "error01"; }
                                               
                                               if($t["ExField1"] == "NULL") { $t["ExField1"] = ""; }
                                               if($t["ExField2"] == "NULL") { $t["ExField2"] = ""; }
                                               
                                          /*     if($t["status"] == "open") { $alert = 'class="danger"'; } 
                                               else { $alert = ''; } */
                                               
                                                echo'<tr>
                                                        <td>'.$t["idGood"].'</td>
                                                        <td>'.$comp.'</td>
                                                        <td>'.$t["Field1"].'</td>
                                                        <td>'.$courier->GetCourierNameById($t["idCourier"]).'</td>
                                                        <td>'.$t["Field2"].'</td>
                                                        <td>'.$t["Field3"].'</td>
                                                        <td>'.$t["Field4"].'</td>
                                                        <td>'.$t["ExField1"].'</td>
                                                        <td>'.$t["ExField2"].'</td>
                                                        <td>'.$t["status"].'</td>
                                                    </tr>';
                                                
                                            }
                                    ?>
                                    
                                </tbody>
                                
                        </table>
                
                
             <?php   
                }
                ?>
            </div> <!-- all in [end] -->
            
      

            

<footer>
    
</footer>
<?php
        require_once './lib/modules/js_section/js_section.php';
?>
        <script src="js/closeOrder.js"></script>

    </body>
</html>
