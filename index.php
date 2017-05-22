<?php

$jour = "21-05-2017";

$d = new DateTime('2017-05-21');
$d->SetTime(10, 0);

for ($i = 0; $i < 10; $i++) {
	$imgSrc = "http://imagebankleryposes.appspot.com/dispimg?date=21-05-2017&time=";	
	$imgSrc = $imgSrc . $d->format('H') . ':' . $d->format('i');
	
	copy($imgSrc, "tmp/P" . sprintf('%03d', $i) . ".jpg");
	
	$d->add(new DateInterval('PT1M'));
}

$tempfile = 'tmp/timelapse.mp4';
$shellline = "ffmpeg -f image2 -i tmp/P%3d.jpg -r 24 -vcodec mpeg4 -b 15000k " . $tempfile;

exec($shellline);

echo '<a href="' . $tempfile . '">fichier</a>'; 

echo '<video controls="controls">';
echo '<source src="' . $tempfile . '" type="video/mp4">';
echo '</video>';

?>
