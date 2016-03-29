<?php

function uploaderImage(){

//-----------------------------------------------------------
//  DEFINITION DES VARIABLES
//-----------------------------------------------------------

$target     = "../upload/";  // Repertoire cible
$max_size   = 1000000;     // Taille max en octets du fichier
$width_max  = 600;        // Largeur max de l'image en pixels
$height_max = 600;        // Hauteur max de l'image en pixels



//------------------------------------------------------------
//  DEFINITION DES VARIABLES LIEES AU FICHIER
//------------------------------------------------------------

$nom_file   = $_FILES['mon_image']['name'];
$taille     = $_FILES['mon_image']['size'];
$tmp        = $_FILES['mon_image']['tmp_name'];
$temps = time();
$nom_image = $temps.$nom_file;
$chemin     = $target.$nom_image;



//-----------------------------------------------------------
//  SCRIPT D'UPLOAD
//-----------------------------------------------------------


if($_FILES['mon_image']['name'])
{
	$infosfichier = pathinfo($_FILES['mon_image']['name']);
	$extension_upload = strtolower($infosfichier['extension']);
	$extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');

	if(in_array($extension_upload, $extensions_autorisees)) // Si l'extension est ok, on continue
    {
        $infos_img = getimagesize($_FILES['mon_image']['tmp_name']); // Récupération des dimentions de l'image
            
		if(($infos_img[0] <= $width_max) && ($infos_img[1] <= $height_max) && ($taille <= $max_size)) // Si les dimensions sont ok, on continue
        {

			if(move_uploaded_file($tmp,$chemin)) // Si le déplacement du fichier réussi alors on peut attribuer la variable $image
			{
				$image = $nom_image;
				return $image;
			}
			else
			{
				$image = 'erreur1';
				return $image;
 			}
		}
		else
		{
			$image = 'erreur2';
			return $image;
		}
	}
	else
	{
		$image = 'erreur3'; 
		return $image;
	}
   
}
else // pas d'image envoyée
{
	$image = 'defaut.png';
	return $image;
}

}// fin de la fonction

