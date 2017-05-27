<!DOCTYPE html>
<html lang="fr">
  <head>
    <title>Timelapse lac de Léry-Poses</title>
  </head>

<body>  

<?php

$idSession = uniqid();

set_time_limit(0);

function suppression($dossier_traite , $extension_choisie, $contient = false)
{
$repertoire = opendir($dossier_traite);
 
        while(false !== ($fichier = readdir($repertoire)))
        {
        $chemin = $dossier_traite."/".$fichier;
                
                $infos = pathinfo($chemin);
                $extension = $infos['extension'];
				$nomfichier = $infos['filename'];
 
                $age_fichier = time() - filemtime($chemin);
                
                if($fichier!="." AND $fichier!=".." AND !is_dir($fichier) AND $extension == $extension_choisie)
                {
					if ($contient != false) {
						if (stripos($nomfichier, $contient) != false) {
							unlink($chemin);	
						}
					}
					else {
						unlink($chemin);
					}					
                }
        }
closedir($repertoire); 
}

suppression("tmp", "mp4");

$dateJour = '2017-04-16';
$horaire1 = '11:00';
$horaire2 = '13:00';
$rate = 25;

if (isset($_GET['date']) && !empty($_GET['date'])) {
	$dateJour = $_GET['date'];
}
if (isset($_GET['heure-debut']) && !empty($_GET['heure-debut'])) {
	$horaire1 = $_GET['heure-debut'];
}
if (isset($_GET['heure-fin']) && !empty($_GET['heure-fin'])) {
	$horaire2 = $_GET['heure-fin'];
}
if (isset($_GET['r']) && !empty($_GET['r'])) {
	$rate = $_GET['r'];
}

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

$time1 = strtotime($dateJour . $horaire1 . ":00");
$time2 = strtotime($dateJour . $horaire2 . ":00");
$nbSecondes = $time2 - $time1;

//if ($nbSecondes < (4*60*60)) {
	$incMinute = '1';
//}
//else {
//	$incMinute = '2';
//}

if (isset($_GET['inc']) && !empty($_GET['inc'])) {
	$incMinute = $_GET['inc'];
}

$i = 0;
while ($d <= $d2) {
	$imgSrc = "http://imagebankleryposes.appspot.com/dispimg?date=" . $jj . "-" . $mm . "-" . $aa . "&time=";	
	$imgSrc = $imgSrc . $d->format('H') . ':' . $d->format('i');
	
	copy($imgSrc, "tmp/P-$idSession-" . sprintf('%04d', $i) . ".jpg");
	
	$i = $i + 1;
	$d->add(new DateInterval('PT' . $incMinute . 'M'));	
}

$tempfile = "tmp/timelapse-$idSession.mp4";
$shellline = "ffmpeg -f image2 -i tmp/P-$idSession-%04d.jpg -r " . $rate . " -vcodec libx264 -crf 25 " . $tempfile;

exec($shellline);

echo '<a href="' . $tempfile . '">Timelapse lac de Léry-Poses du ' . $jj . '/' . $mm . '/' . $aa . ' entre ' . $h1 . ':' . $m1 . ' et ' . $h2 . ':' . $m2 . '</a>'; 
echo '<br>Une image toutes les ' . $incMinute . ' minutes';

echo '<video controls="controls">';
echo '<source src="' . $tempfile . '" type="video/mp4">';
echo '</video>';

suppression("tmp", "jpg", $idSession);
?>

</body>
</html>
