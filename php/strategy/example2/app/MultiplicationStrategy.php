<?php

namespace App;

class MultiplicationStrategy implements OperationInterface
{
    public function doOperation($a, $b)
    {
        return $a * $b;
    }
}
