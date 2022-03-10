<?php

namespace App;

class FiftyHundredBillDispenser extends OperationAbstract
{
    public function process(Transaction $transaction)
    {
        if ($transaction->amount < 50) {
            $this->next($transaction);
            return;
        }

        $bills = intval($transaction->amount / 50);
        $remain = $transaction->amount % 50;

        echo "Entrega de billetes de $50: {$bills}\n";

        if ($remain != 0) {
            $transaction->amount = $remain;
            $this->next($transaction);
        }
    }
}
