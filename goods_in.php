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
        <header id="topNav" class="clearfix">
                <p class="pull-left loggedin">User: <?php  echo $_SESSION["name"]; ?></p>
            
            <img src="img/icons/settings.png" id="settingsMenu" class="pull-right" alt="" />
            <ul id="AdminMenu">                
                <li><a href="app.php"><img src="img/icons/reload.png" alt="" />Main</a></li>
                <li class="adduser"><img src="img/icons/adduser.png" alt="" />Add user</li>
                <li class="editusers"><img src="img/icons/editusers.png" alt="" />Edit users</li>
                <li class="courier"><img src="img/icons/delivery.png" alt="" />Courier Services</li>
                <li><a href="index.php?logout=1"><img src="img/icons/logout.png" alt="" /> Logout</a></li>
            </ul>
            
            
            
            <nav>
                <a href="app.php" class="btn btn-default"> Main</a>
                <a href="goods_in.php" class="btn btn-default"> Goods list</a>
            </nav>
            
        </header>
        
        
        <section id="Form" >
          
        </section>

        

     
                
            <div id="allIn">
                
                <h5>Goods list:</h5>
                
                <?php
                    $in->GetAllGoodsIn();
                    
                    if(isset($in->allIn) && count($in->allIn)>0) {
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
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                            foreach($in->allIn as $t) {
                                               $i++;
                                               
                                               if($t["Company"] == 1) {
                                                   $comp = "Company one";
                                               } else  if($t["Company"] == 2) {
                                                   $comp = "Company two";
                                               } else { $comp = "error01"; }
                                               
                                               if($t["ExField1"] == "NULL") { $t["ExField1"] = ""; }
                                               if($t["ExField2"] == "NULL") { $t["ExField2"] = ""; }
                                               
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

        
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

    </body>
</html>
