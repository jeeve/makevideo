<?php

require('vendor/autoload.php');


$ffmpeg = FFMpeg\FFMpeg::create();

$mov = $ffmpeg->open('video/video.avi');

echo $mov->getPathfile(); 

echo 'makevideo';

$tempfile = 'tmp/timelapse.mp4';
$shellline = "ffmpeg -f image2 -framerate 25 -i video/E%2d.jpg -r 25 -an -vcodec mpeg4 -b 15000k " . $tempfile;

echo "Starting ffmpeg...\n\n";
echo exec($shellline);
echo "Done.\n";

echo '<a href="' . $tempfile . '">fichier</a>'; 

echo '<video controls="controls">';
echo '<source src="' . $tempfile . '" type="video/mp4"/>';
echo '</video>';

?>
