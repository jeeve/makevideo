<?php

$tempfile = 'tmp/timelapse.mpg';
$shellline = "ffmpeg -f image2 -i video/E%2d.jpg -r 24 " . $tempfile;

exec($shellline);

echo '<a href="' . $tempfile . '">fichier</a>'; 

echo '<video controls="controls">';
echo '<source src="' . $tempfile . '" type="video/mp4">';
echo '</video>';

?>
