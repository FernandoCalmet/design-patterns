<?php

declare(strict_types=1);

namespace App;

class Bottle implements Packing
{
    public function pack(): string
    {
        return "Bottle";
    }
}
