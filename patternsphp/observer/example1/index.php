<?php

use App\{Subject, HexaObserver, OctalObserver, BinaryObserver};

require 'vendor/autoload.php';

$subject = new Subject();

new HexaObserver($subject);
new OctalObserver($subject);
new BinaryObserver($subject);

print sprintf("First state change: 15" . PHP_EOL);
$subject->setState(15);
print sprintf("Second state change: 10" . PHP_EOL);
$subject->setState(10);
