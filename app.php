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
        <title>Logged in</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="js/vendor/bootstrap/css/bootstrap.min.css">
        
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
    <body id="app">
        <!--[if lt IE 9]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
<img src="img/gif-load.gif" id="loading" alt="loading" /> 
         <?php
        require_once './lib/modules/header/header.php';
        ?>
        
        
        <section id="Form" >
                <!--
            <h3> Hello <?php  echo $_SESSION["name"]; ?> </h3>
                <a href="index.php?logout=1">Logout</a>  -->
        </section>

        

        <section id="goodsIn" class="Bigborder">
            
            
            <h4 class="text-muted">Goods in:</h4>
                                
            <form class="form-horizontal" role="form" id="goodsInForm">
                            
                            <div class="form-group">
                              <label for="inputOption1" class="col-sm-2 control-label">Item</label>
                              <div class="col-sm-10">

                                <select class="form-control" id="inputOption1" name="select1">
                                    <option value="1" >Company one</option>
                                    <option value="2" >Company two</option>
                                </select>
                                
                              </div>
                            </div>
                            
                
                            <div class="form-group">
                              <label for="inputField1" class="col-sm-2 control-label">Field 1</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" id="inputField1" placeholder="Field 1" required >
                              </div>
                            </div>                                    
                                
                            <div class="form-group">
                              <label for="inputOption2" class="col-sm-2 control-label">Courier</label>
                              <div class="col-sm-10">
                            
                                
                                <select class="form-control" id="inputOption2" name="select1">
                                    <?php
                                            if(isset($courier->couriers) && count($courier->couriers)>0){
                                                foreach($courier->couriers as $c){
                                                    echo'<option value="'.$c["idCourier"].'" >'.$c["Couriername"].'</option>';
                                                }
                                            }
                                    ?>
                                </select>
                                
                              </div>
                            </div>
                        
                
                
                            <div class="form-group">
                              <label for="inputField2" class="col-sm-2 control-label">Field 2</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputField2" placeholder="Field 2" required >
                              </div>
                            </div>
                            
                            <div class="form-group">
                              <label for="inputField3" class="col-sm-2 control-label">Field 3</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputField3" placeholder="Field 3" required >
                              </div>
                            </div>
                            
                            <div class="form-group">
                              <label for="inputField4" class="col-sm-2 control-label">Field 4</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputField4" placeholder="Field 4" required >
                              </div>
                            </div>
                
                    <section id="extraInfo">        
                            <div class="form-group">
                              <label for="inputFieldExtra1" class="col-sm-2 control-label">Exrta Field 1</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputFieldExtra1" placeholder="Extra Field 1" >
                              </div>
                            </div>
                
                            <div class="form-group">
                              <label for="inputFieldExtra2" class="col-sm-2 control-label">Exrta Field 1</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputFieldExtra2" placeholder="Extra Field 2"  >
                              </div>
                            </div>
                    </section>       
                            
                            
                            <div class="form-group">
                              <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default" name="submit"  >Save</button>
                              </div>
                            </div>
          </form>
                
            
            
        </section>  <!-- goodsin [end]-->

            
        <div id="todayIn">
                
                <p class="text-muted">Added today:</p>
                
                <?php
                    $in->AddedToday();
                    
                    if(isset($in->todayIn) && count($in->todayIn)>0) {
                ?>
                
                        <table class="table table-condensed">
                                <thead>
                                <tr class="active">
                                    <td>#</td>
                                    <td>Company</td>
                                    <td>Field1</td>
                                    <td>Courier</td>
                                    <td>Field2</td>
                                    <td>Field3</td>
                                    <td>Field4</td>
                                    <td>Extra1</td>
                                    <td>Extra2</td>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                            foreach($in->todayIn as $t) {
                                               $i++;
                                               
                                               if($t["Company"] == 1) {
                                                   $comp = "Company one";
                                               } else  if($t["Company"] == 2) {
                                                   $comp = "Company two";
                                               } else { $comp = "error01"; }
                                               
                                               if($t["ExField1"] == "NULL") { $t["ExField1"] = ""; }
                                               if($t["ExField2"] == "NULL") { $t["ExField2"] = ""; }
                                               
                                                echo'<tr>
                                                        <td>'.$i.'</td>
                                                        <td>'.$comp.'</td>
                                                        <td>'.$t["Field1"].'</td>
                                                        <td>'.$courier->GetCourierNameById($t["idCourier"]).'</td>
                                                        <td>'.$t["Field2"].'</td>
                                                        <td>'.$t["Field3"].'</td>
                                                        <td>'.$t["Field4"].'</td>
                                                        <td>'.$t["ExField1"].'</td>
                                                        <td>'.$t["ExField2"].'</td>
                                                    </tr>';
                                                
                                            }
                                    ?>
                                    
                                </tbody>
                                
                        </table>
                
                
             <?php   
                }
                ?>
            </div> <!-- today in [end] -->
        

<footer>
    
</footer>
<?php
        require_once './lib/modules/js_section/js_section.php';
?>
    </body>
</html>
