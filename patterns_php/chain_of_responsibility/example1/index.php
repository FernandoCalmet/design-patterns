<?php

use App\{BalanceChecker, FiftyHundredBillDispenser, FiveHundredBillDispenser, MultipleOfFifty, OneHundredBillDispenser, Transaction, TwoHundredBillDispenser};

require 'vendor/autoload.php';

$transaction = new Transaction();
$transaction->amount = 1300;
$transaction->balance = 5000;

$multiple = new MultipleOfFifty();
$balance = new BalanceChecker();
$fiveHundred = new FiveHundredBillDispenser();
$twoHundred = new TwoHundredBillDispenser();
$oneHundred = new OneHundredBillDispenser();
$fifty = new FiftyHundredBillDispenser();

$multiple->then($balance);
$balance->then($fiveHundred);
$fiveHundred->then($twoHundred);
$twoHundred->then($oneHundred);
$oneHundred->then($fifty);

$multiple->process($transaction);
