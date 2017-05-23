<?php

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
		
					
						unlink($chemin);
										
                }
        }
closedir($repertoire); 
}
