<?php

declare(strict_types=1);

interface MediaPlayer
{
    public function play(string $audioType, string $fileName): void;
}
