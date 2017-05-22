<?php

set_time_limit(0);

function suppression($dossier_traite , $extension_choisie)
{
// On ouvre le dossier.
$repertoire = opendir($dossier_traite);
 
// On lance notre boucle qui lira les fichiers un par un.
        while(false !== ($fichier = readdir($repertoire)))
        {
        // On met le chemin du fichier dans une variable simple
        $chemin = $dossier_traite."/".$fichier;
                
                // Les variables qui contiennent toutes les infos nécessaires.
                $infos = pathinfo($chemin);
                $extension = $infos['extension'];
 
                $age_fichier = time() - filemtime($chemin);
                
// On n'oublie pas LA condition sous peine d'avoir quelques surprises. :p
                if($fichier!="." AND $fichier!=".." AND !is_dir($fichier)
$extension == $extension_choisie)
                {
                unlink($chemin);
                }
        }
closedir($repertoire); // On ferme !
}

suppression("tmp", "jpg");
suppression("tmp", "mp4");

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
$shellline = "ffmpeg -f image2 -i tmp/P%04d.jpg -r 25 -vcodec libx264 -crf 25 " . $tempfile;

exec($shellline);
/*
echo '<a href="' . $tempfile . '">Timelapse lac de Léry-Poses</a>'; 
*/
echo '<video controls="controls">';
echo '<source src="' . $tempfile . '" type="video/mp4">';
echo '</video>';

?>
