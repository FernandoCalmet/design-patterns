<?php

use App\SingleObject;

require 'vendor/autoload.php';

//illegal construct
//Compile Time Error: The constructor SingleObject() is not visible
//$object = new SingleObject();

//Get the only object available
$object = SingleObject::getInstance();

//show the message
$object->showMessage();
