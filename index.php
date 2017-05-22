<?php

$dateJour = "21-05-2017";
$horaire1 = "13:00";
$horaire2 = "15:00";

$jj = substr($dateJour, 0, 2);
$mm = substr($dateJour, 3, 2);
$aa = substr($dateJour, 6, 4);

$h1 = substr($horaire1, 0, 2);
$m1 = substr($horaire1, 3, 2);
$h2 = substr($horaire2, 0, 2);
$m2 = substr($horaire2, 3, 2);

$d = new DateTime($aa . '-' . $mm . '-' . $jj);
$d->SetTime(intval($h1), intval($m1));

$d2 = new DateTime($aa . '-' . $mm . '-' . $jj);
$d2->SetTime(intval($h2), intval($m2));

$i = 0;
while ($d < $d2) {
	$imgSrc = "http://imagebankleryposes.appspot.com/dispimg?date=21-05-2017&time=";	
	$imgSrc = $imgSrc . $d->format('H') . ':' . $d->format('i');
	
	copy($imgSrc, "tmp/P" . sprintf('%03d', $i) . ".jpg");
	
	$i = $i + 1;
	$d->add(new DateInterval('PT1M'));
}

$tempfile = 'tmp/timelapse.mp4';
$shellline = "ffmpeg -f image2 -i tmp/P%3d.jpg -r 5 -vcodec mpeg4 -b 15000k " . $tempfile;

exec($shellline);

echo '<a href="' . $tempfile . '">fichier</a>'; 

echo '<video controls="controls">';
echo '<source src="' . $tempfile . '" type="video/mp4">';
echo '</video>';

?>
