<?php

declare(strict_types=1);

namespace App;

interface MediaPlayer
{
    public function play(string $audioType, string $fileName): void;
}
