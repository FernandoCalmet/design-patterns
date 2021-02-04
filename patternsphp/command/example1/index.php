<?php

use App\{Lamp, OnCommand, OffCommand, MySwitch};

require 'vendor/autoload.php';

// El receptor
$lamp = new Lamp();

// El comando
$onCommand = new OnCommand($lamp);
$offCommand = new OffCommand($lamp);

// El invocador
$switch = new MySwitch($onCommand, $offCommand);

// El cliente
$switch->on();
$switch->off();
