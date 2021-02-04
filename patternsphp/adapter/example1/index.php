<?php

use App\AudioPlayer;

require 'vendor/autoload.php';

$audioplayer = new AudioPlayer();

$audioplayer->play("mp3", "beyond the horizon.mp3");
$audioplayer->play("mp4", "alone.mp4");
$audioplayer->play("vlc", "far far away.vlc");
$audioplayer->play("avi", "mind me.avi");
