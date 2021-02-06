<?php

namespace App;

class BankApiAdapter implements PaymentProcessor
{
    protected BankApi $bankApi;

    public function __construct(BankApi $bankApi)
    {
        $this->bankApi = $bankApi;
    }

    public function getClientData()
    {
        $this->bankApi->getClientInformation();
    }

    public function charge()
    {
        $this->bankApi->chargeClient();
    }
}
