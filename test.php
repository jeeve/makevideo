<!DOCTYPE html>
<html lang="fr">
   <head>      
	  <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
<body>	
<?php


$tempfile = 'tmp/timelapse.mp4';


echo '<a href="' . $tempfile . '">fichier</a>'; 

echo '<video controls="controls">';
echo '<source src="' . $tempfile . '" type="video/mp4">';
echo '</video>';

?>
</body>
</html>