<?php

namespace App;

class AdditionStrategy implements OperationInterface
{
    public function doOperation($a, $b)
    {
        return $a + $b;
    }
}
