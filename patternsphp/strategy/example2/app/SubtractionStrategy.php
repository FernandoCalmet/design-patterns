<?php

namespace App;

class SubtractionStrategy implements OperationInterface
{
    public function doOperation($a, $b)
    {
        return $a - $b;
    }
}
