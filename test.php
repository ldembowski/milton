<?php

function __autoload($class){
require_once 'lib/class/'.$class.'.php';
}


$t = new GoodsIn();

var_dump($t->AddedToday());


$c = new Courier();

var_dump($c->couriers);




/*
$cr = new Courier();
/*
var_dump($cr->couriers);

$cr->UpdateCourier(17, 'kupa45', 'kupa45');

$cr->GenerateCouriersList();

var_dump($cr->couriers);*/


/*
$good = array(
                        "idGood"    =>'jeden',
                        "Company"   =>'dwa',
                        "Field1"    =>'trzy',
                        "idCourier" =>'czerty',
                        "Field2"    =>'pierc',
                        "Field3"    =>'szesc',
                        "Field4"    =>'siedem',
                        "ExField1"  =>'osiem',
                        "ExField2"  =>'dziewiec',
                        "dateIn"    =>'dziesiec'
    );  


var_dump($good);



foreach($good as $g){
               var_dump($g);
           }  //as $key=>$data
           
           
foreach($good as $key=>$data){
               $good[$key] = $data.'XXXX';
           }  
           
var_dump($good);    */       