<?php

declare(strict_types=1);

namespace App;

class AudioPlayer implements MediaPlayer
{
    private $mediaAdapter;

    public function play(string $audioType, string $filename): void
    {
        //inbuilt support to play mp3 music files
        if (strcasecmp($audioType, "mp3") == 0) {
            print sprintf("Playing mp3 file. Name: %s: " . PHP_EOL, $filename);
        }
        //mediaAdapter is providing support to play other file formats
        else if (strcasecmp($audioType, "vlc") == 0 || strcasecmp($audioType, "mp4") == 0) {
            $this->mediaAdapter = new MediaAdapter($audioType);
            $this->mediaAdapter->play($audioType, $filename);
        } else {
            print sprintf("Invalid media. %s formate not supported" . PHP_EOL, $audioType);
        }
    }
}
