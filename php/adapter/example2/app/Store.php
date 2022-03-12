<?php

namespace App;

class Store
{
    protected PaymentProcessor $api;

    public function __construct(PaymentProcessor $api)
    {
        $this->api = $api;
    }

    public function process()
    {
        $this->api->getClientData();
        $this->api->charge();
    }
}
