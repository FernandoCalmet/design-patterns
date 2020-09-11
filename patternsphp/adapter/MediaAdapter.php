<?php

declare(strict_types=1);

include_once __DIR__ . '/MediaPlayer.php';
include_once __DIR__ . '/VlcPlayer.php';
include_once __DIR__ . '/Mp4Player.php';

class MediaAdapter implements MediaPlayer
{
    private $advancedMusicPlayer;

    public function __construct(string $audioType)
    {
        if (strcasecmp($audioType, "vlc")) {
            $this->advancedMusicPlayer = new VlcPlayer();
        } else if (strcasecmp($audioType, "mp4")) {
            $this->advancedMusicPlayer = new Mp4Player();
        }
    }

    public function play(string $audioType, string $filename): void
    {
        if (strcasecmp($audioType, "vlc")) {
            $this->advancedMusicPlayer->playVlc($filename);
        } else if (strcasecmp($audioType, "mp4")) {
            $this->advancedMusicPlayer->playMp4($filename);
        }
    }
}
