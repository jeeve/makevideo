<?php

echo 'makevideo';

use FFMpeg\FFMpeg;

$mov = $ffmpeg->open('/video/video.avi');

echo $mov->getPathfile(); 




?>