<?php

namespace App;

interface PaymentProcessor
{
    public function getClientData();
    public function charge();
}
