<!DOCTYPE html>
<html>
<head>
<title>Listing des références du book</title>
<meta charset="utf-8" />
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../css/design.css">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

<link href='https://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Kalam:700' rel='stylesheet' type='text/css'>
</head>

<body>

<?php include('menu.php'); ?>

	<div class="page-contenu">
	<div class="container">

<?php


// Connexion à la base de données
include('../inc/connexion.php'); 

// Inclusion de la fonction gérant l'upload de l'image
include('fonction.admin.php');

//--------------------------------------------------------------------
// Vérification 1 : est-ce qu'on veut ajouter une nouvelle référence ?
//--------------------------------------------------------------------

if (isset($_POST['annee']) && isset($_POST['titre']) && isset($_POST['description']))
{
	$annee = (int) htmlspecialchars($_POST['annee']);
	$titre = htmlspecialchars($_POST['titre']);
	$description = ($_POST['description']);
	$tag_web = htmlspecialchars($_POST['tag_web']);
	$tag_gestion = htmlspecialchars($_POST['tag_gestion']);
	$tag_evenement = htmlspecialchars($_POST['tag_evenement']);
	$image = htmlspecialchars($_POST['image']);

	$modifier_image = htmlspecialchars($_POST['modifier_image']);
	

	$id_entree = (int) htmlspecialchars($_POST['id_entree']);


    // On vérifie si c'est une nouvelle référence
    if ($id_entree == 0)
    {

    	$image = uploaderImage(); // appel de la fonction uploadant l'image. Si tout va bien, $image est défini avec le nom de l'image uploadée

    	if($image == 'erreur3'){
    		echo '<p><br /><span class="label label-danger">ERREUR : Le fichier ne fait pas parti des images autorisées</span></p>';
    	}
		
		if($image == 'erreur2'){
    		echo '<p><br /><span class="label label-danger">ERREUR : Le fichier est trop grand</span></p>';
    	}

		if($image == 'erreur1'){
    		echo '<p><br /><span class="label label-danger">ERREUR : Problème lors du téléchargement du fichier</span></p>';
    	}

		// Quand id_entree = 0, c'est une nouvelle référence, on insère toutes les données
		$req = $bdd->prepare('INSERT INTO claire_book (annee, tag_web, tag_evenement, tag_gestion, titre, description, image) VALUES (:annee, :tag_web, :tag_evenement, :tag_gestion, :titre, :description, :image)');
		$req->execute(array(
			'annee' => $annee,
			'tag_web' => $tag_web,
			'tag_evenement' => $tag_evenement,
			'tag_gestion' => $tag_gestion,
			'titre' => $titre,
			'description' => $description,
			'image' => $image
			));
		
		$req->closeCursor();
    }


    elseif ($id_entree > 0) // Vérifier que $id_entree est un entier supérieur à 0
    {

    	// Si on souhaite modidier l'image 
    	if($modifier_image == "oui"){
    		
    		$image = uploaderImage(); // appel de la fonction uploadant l'image. Si tout va bien, $image est défini avec le nom de l'image uploadée

	    	if($image == 'erreur3'){
	    		echo '<p><br /><span class="label label-danger">ERREUR : Le fichier ne fait pas parti des images autorisées</span></p>';
	    	}
			
			if($image == 'erreur2'){
	    		echo '<p><br /><span class="label label-danger">ERREUR : Le fichier est trop grand</span></p>';
	    	}

			if($image == 'erreur1'){
	    		echo '<p><br /><span class="label label-danger">ERREUR : Problème lors du téléchargement du fichier</span></p>';
	    	}
    	}

		// C'est une modification, on met juste à jour les informations
    	$req2 = $bdd->prepare('UPDATE claire_book SET annee = :annee, tag_web = :tag_web, tag_evenement = :tag_evenement, tag_gestion = :tag_gestion, titre = :titre, description = :description, image = :image WHERE id = :id_entree');
		$req2->execute(array(
			'annee' => $annee,
			'tag_web' => $tag_web,
			'tag_evenement' => $tag_evenement,
			'tag_gestion' => $tag_gestion,
			'titre' => $titre,
			'description' => $description,
			'image' => $image,
			'id_entree' => $id_entree
			));

		$req2->closeCursor();
	}
}
 

//-------------------------------------------------------------------
// Vérification 2 : est-ce qu'on veut supprimer une référence du book
//-------------------------------------------------------------------

if (isset($_GET['supprimer_reference']))
{

	$supprimer_reference = (int) htmlspecialchars($_GET['supprimer_reference']);
	
	$req3 = $bdd->prepare('DELETE FROM claire_book WHERE id = :id');
	$req3->execute(array('id' => $supprimer_reference));
	$req3->closeCursor();

}



?>




		<h2>Listing des références du book</h2>

		<table class="table table-striped table-condensed">
			<tr>
				<th></th>
				<th></th>
				<th>Titre de la référence</th>
				<th>Année</th>
				<th>Image</th>
			</tr>

			<?php 
			$req4 = $bdd->query('SELECT * FROM claire_book ORDER BY annee DESC');

			while($donnee = $req4->fetch())
			{?>

			<tr>
				<td><a href="ajouter-reference.php?modifier_reference=<?php echo $donnee['id']; ?>" class="label label-primary">Modifier</a></td>
				<td><a href="lister-reference.php?supprimer_reference=<?php echo $donnee['id']; ?>" class="label label-danger">Supprimer</a></td>
				<td><?php echo stripslashes(htmlspecialchars($donnee['titre'])); ?></td>
				<td><?php echo htmlspecialchars($donnee['annee']); ?></td>
				<td><img src="../upload/<?php echo htmlspecialchars($donnee['image']); ?>" alt="image" width="25px" height="25px" /></td>
			</tr>

			<?php	
			}
			$req4->closeCursor();
			?>



		</table>
		
	</div>
	</div>




</body>

</html>

