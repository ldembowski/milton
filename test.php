<?php

function __autoload($class){
require_once 'lib/class/'.$class.'.php';
}

$cr = new Users();


//var_dump($cr->AddUserToDB("testy", "testy"));

var_dump($cr->GetUserFromDB("admin"));

var_dump($cr->UpdateUserPassword(14, "lukasz", "admin"));

var_dump($cr->GetUserFromDB("lukasz"));