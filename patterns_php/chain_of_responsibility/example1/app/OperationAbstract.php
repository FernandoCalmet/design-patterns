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
        if ($this->operation) {
            $this->operation->process($transaction);
        }
    }

    abstract public function process(Transaction $transaction);
}
