<?php

declare(strict_types=1);

namespace App;

include_once __DIR__ . '/AdvancedMediaPlayer.php';

class VlcPlayer implements AdvancedMediaPlayer
{
    public function playVlc(string $fileName): void
    {
        print sprintf("Playing vlc file. Name: %s " . PHP_EOL, $fileName);
    }

    public function playMp4(string $fileName): void
    {
        //do nothing
    }
}
