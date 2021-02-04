<?php

declare(strict_types=1);

namespace App;

class Wrapper implements Packing
{
    public function pack(): string
    {
        return "Wrapper";
    }
}
