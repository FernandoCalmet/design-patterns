<?php

require 'vendor/autoload.php';

use App\{Store, BankApi, BankApiAdapter, PaypalApi, PaypalApiAdapter};

//Store -> Interfaz -> Adaptador -> Api
$store = new Store(new BankApiAdapter(new BankApi));
$store->process();

$store = new Store(new PaypalApiAdapter(new PaypalApi));
$store->process();
