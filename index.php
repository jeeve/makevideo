<?php

require('vendor/autoload.php');


$ffmpeg = FFMpeg\FFMpeg::create();

$mov = $ffmpeg->open('video/video.avi');

echo $mov->getPathfile(); 

echo 'makevideo';

echo "Starting ffmpeg...\n\n";
echo shell_exec("ffmpeg -f image2 -framerate 25 -i video/E%2d.jpg -r 25 -an -vcodec mpeg4 -b 15000k video/rendu_final.mp4");
echo "Done.\n";

?>