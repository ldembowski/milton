<?php

function __autoload($class){
require_once 'lib/class/'.$class.'.php';
}

$cr = new Courier();

var_dump($cr->couriers);

$cr->UpdateCourier(17, 'kupa45', 'kupa45');

$cr->GenerateCouriersList();

var_dump($cr->couriers);