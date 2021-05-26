<?php

namespace App;

abstract class OperationAbstract
{
    protected $operation;

    public function then(OperationAbstract $operation)
    {
        $this->operation = $operation;
    }

    public function next(Transaction $transaction)
    {
        $this->operation->process($transaction);
    }

    abstract public function process(Transaction $transaction);
}
