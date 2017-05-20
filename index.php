<?php

echo 'makevideo';

use FFMpeg\FFMpeg;

$mov = $ffmpeg->open('/video/video.avi');

echo sprintf('<p>Duration : %.1d</p>',
                $mov->getWidth())




?>