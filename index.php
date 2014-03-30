<?php
function __autoload($class){
require_once 'lib/class/'.$class.'.php';
}

$cr = new Users();

    if($cr->get_post("Submit")) {
            
        if($cr->LoginUser()) {
            header("Location: app.php");
        } else {
            header("Location: index.php?login=NOok");
        }
    }
    
    
    if(isset($_SESSION["name"]) && is_string($_SESSION["name"]) ) {
    if($cr->VerifySession()) {
        header("Location: app.php");
    }}
    
    
   
        
    if($cr->get_get("logout") == 1) {
        $cr->CloseSession();
    }

?>





<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Login site</title>
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

        <!-- Add your site or application content here -->
        <section id="loginForm" class="bg-info Bigborder">

            <h1 class="lead text-center text-muted">Stock control <small>[demo]</small></h1>
   
                <form class="form-horizontal"  id="contactForm" method="post">
                                                <div class="form-group">
                                                  <label for="inputLogin" class="col-sm-2 control-label">Login</label>
                                                  <div class="col-sm-10">
                                                      <input type="text" class="form-control" name="userName" id="inputLogin" placeholder="Name" required >
                                                  </div>
                                                </div>
                                                <div class="form-group">
                                                  <label for="inputPassword" class="col-sm-2 control-label">Password</label>
                                                  <div class="col-sm-10">
                                                    <input type="password" class="form-control" name="userPassword" id="inputPassword" placeholder="Password">
                                                  </div>
                                                </div>
                    
                                            <!--
                                                <div class="form-group">
                                                  <div class="col-sm-offset-2 col-sm-10">
                                                    <div class="checkbox">
                                                      <label>
                                                        <input type="checkbox" name="remember"> Remember me
                                                      </label>
                                                    </div>
                                                  </div>
                                                </div>
                                            -->
                    
                                                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <button type="submit" name="Submit" value="Submit"  class="btn btn-default" > Login </button>
                    </div>
                  </div>
                            </form>
                
        </section>

        
        
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>

    </body>
</html>
