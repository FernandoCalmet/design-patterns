<?php

namespace App;

class TwoHundredBillDispenser extends OperationAbstract
{
    public function process(Transaction $transaction)
    {
        if ($transaction->amount < 200) {
            $this->next($transaction);
            return;
        }

        $bills = intval($transaction->amount / 200);
        $remain = $transaction->amount % 200;

        echo "Entrega de billetes de $200: {$bills}\n";

        if ($remain != 0) {
            $transaction->amount = $remain;
            $this->next($transaction);
        }
    }
}
