<?php

declare(strict_types=1);

include_once __DIR__ . '/Context.php';
include_once __DIR__ . '/OperationAdd.php';
include_once __DIR__ . '/OperationSubstract.php';
include_once __DIR__ . '/OperationMultiply.php';

$context = new Context(new OperationAdd());
print sprintf("10 + 5 = " . $context->executeStrategy(10, 5) . PHP_EOL);
$context = new Context(new OperationSubstract());
print sprintf("10 - 5 = " . $context->executeStrategy(10, 5) . PHP_EOL);
$context = new Context(new OperationMultiply());
print sprintf("10 * 5 = " . $context->executeStrategy(10, 5) . PHP_EOL);
