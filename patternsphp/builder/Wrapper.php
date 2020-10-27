<?php

declare(strict_types=1);

include_once __DIR__ . '/Packing.php';

class Wrapper implements Packing
{
    public function pack(): string
    {
        return "Wrapper";
    }
}
