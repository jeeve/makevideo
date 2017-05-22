<?php

set_time_limit(0);
/*
function clear_dir($dir, $delete = false) {
    $dossier = $dir;
    $dir = opendir($dossier); 
    while($file = readdir($dir)) { 
        if(!in_array($file, array(".", ".."))){
            if(is_dir("$dossier/$file")) {
                clear_dir("$dossier/$file", true);
            } else {
                unlink("$dossier/$file");
            }     
        }
    } 
    closedir($dir);
     
    if($delete == true) {
        rmdir("$dossier/$file");
    }
}

clear_dir('tmp');
*/
$dateJour = '2017-05-20';
$horaire1 = '13:00';
$horaire2 = '17:00';

$dateJour = $_GET['date'];
$horaire1 = $_GET['heure-debut'];
$horaire2 = $_GET['heure-fin'];

$jj = substr($dateJour, 8, 2);
$mm = substr($dateJour, 5, 2);
$aa = substr($dateJour, 0, 4);

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
	
	copy($imgSrc, "tmp/P" . sprintf('%04d', $i) . ".jpg");
	
	$i = $i + 1;
	$d->add(new DateInterval('PT1M'));
}

$tempfile = 'tmp/timelapse.mp4';
//$shellline = "ffmpeg -f image2 -i tmp/P%4d.jpg -r 5 -vcodec mpeg4 -b 15000k " . $tempfile;
$shellline = "ffmpeg -f image2 -i tmp/P%04d.jpg -r 24 -vcodec libx264 -crf 25 " . $tempfile;

exec($shellline);
/*
echo '<a href="' . $tempfile . '">Timelapse lac de Léry-Poses</a>'; 
*/
echo '<video controls="controls">';
echo '<source src="' . $tempfile . '" type="video/mp4">';
echo '</video>';

?>
