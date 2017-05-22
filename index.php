<?php

$imgSrc = "http://imagebankleryposes.appspot.com/dispimg?date=21-05-2017&time=10:00";
copy($imgSrc, "tmp/P001.jpg");

$imgSrc = "http://imagebankleryposes.appspot.com/dispimg?date=21-05-2017&time=10:01";
copy($imgSrc, "tmp/P002.jpg");

$tempfile = 'tmp/timelapse.mp4';
$shellline = "ffmpeg -f image2 -i tmp/P%3d.jpg -r 24 -vcodec mpeg4 -b 15000k " . $tempfile;

exec($shellline);

echo '<a href="' . $tempfile . '">fichier</a>'; 

echo '<video controls="controls">';
echo '<source src="' . $tempfile . '" type="video/mp4">';
echo '</video>';

?>
