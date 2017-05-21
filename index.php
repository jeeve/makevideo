<?php

require('FFMpeg/FFMpeg.php');



use FFMpeg\FFMpeg;
$ffmpeg = FFMpeg\FFMpeg::create();
$mov = $ffmpeg->open('video/video.avi');

echo $mov->getPathfile(); 

echo 'makevideo';


?>