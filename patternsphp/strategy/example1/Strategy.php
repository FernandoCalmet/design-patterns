<?php

declare(strict_types=1);

interface Strategy
{
    public function doOperation(int $num1, int $num2): int;
}
