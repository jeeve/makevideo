<?php



use FFMpeg;

$mov = $ffmpeg->open('video/video.avi');

echo $mov->getPathfile(); 

echo 'makevideo';


?>