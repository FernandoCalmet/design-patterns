<?php

use App\{Context, OperationAdd, OperationSubstract, OperationMultiply};

require 'vendor/autoload.php';

$context = new Context(new OperationAdd());
print sprintf("10 + 5 = " . $context->executeStrategy(10, 5) . PHP_EOL);
$context = new Context(new OperationSubstract());
print sprintf("10 - 5 = " . $context->executeStrategy(10, 5) . PHP_EOL);
$context = new Context(new OperationMultiply());
print sprintf("10 * 5 = " . $context->executeStrategy(10, 5) . PHP_EOL);
