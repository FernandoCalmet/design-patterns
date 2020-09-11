<?php

include_once __DIR__ . '/SingleObject.php';

//illegal construct
//Compile Time Error: The constructor SingleObject() is not visible
//$object = new SingleObject();

//Get the only object available
$object = SingleObject::getInstance();

//show the message
$object->showMessage();
