<?php

require('vendor\autoload.php');


$ffmpeg = FFMpeg\FFMpeg::create();

$mov = $ffmpeg->open('video/video.avi');

echo $mov->getPathfile(); 

echo 'makevideo';


?>