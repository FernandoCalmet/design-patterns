<?php

declare(strict_types=1);

namespace App;

class Context
{
    private $strategy;

    public function __construct(Strategy $strategy)
    {
        $this->strategy = $strategy;
    }

    public function executeStrategy(int $num1, int $num2): int
    {
        return $this->strategy->doOperation($num1, $num2);
    }
}
