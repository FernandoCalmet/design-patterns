<?php

namespace App;

class PaypalApiAdapter implements PaymentProcessor
{
    protected PaypalApi $paypalApi;

    public function __construct(PaypalApi $paypalApi)
    {
        $this->paypalApi = $paypalApi;
    }

    public function getClientData()
    {
        $this->paypalApi->getClientData();
    }

    public function charge()
    {
        $this->paypalApi->pay();
    }
}
