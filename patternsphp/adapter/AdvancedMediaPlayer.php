<?php

declare(strict_types=1);

interface AdvancedMediaPlayer
{
    public function playVlc(string $fileName): void;
    public function playMp4(string $fileName): void;
}
