<!DOCTYPE html>
<html>
<head>
<title>Ajouter une référence au book</title>
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

<?php
// SCRIPT POUR INSERER LES VALEURS DEJA RENTREES LORS D'UN BESOIN DE MODIFICATION

// Connexion à la base de données
include('../inc/connexion.php'); 



if (isset($_GET['modifier_reference']))
{

	$_GET['modifier_reference'] = htmlspecialchars($_GET['modifier_reference']);
	$modifier_reference = (int) $_GET['modifier_reference'];

	// On récupère les infos de la référence à modifier
	$req = $bdd->prepare('SELECT * FROM claire_book WHERE id = :modifier_reference');
	$req->execute(array('modifier_reference' => $modifier_reference ));
	$donnees = $req->fetch();

    
	// Création de variables simples - stripslashes enlève les antislash \
	$annee = stripslashes($donnees['annee']);
	$titre = stripslashes($donnees['titre']);
	$description = stripslashes($donnees['description']);
	$tag_web = stripslashes($donnees['tag_web']);
	$tag_gestion = stripslashes($donnees['tag_gestion']);
	$tag_evenement = stripslashes($donnees['tag_evenement']);
	$image = stripslashes($donnees['image']);

	$id_entree = $donnees['id']; // Cette variable va servir pour se souvenir que c'est une modification

	$req->closeCursor(); // Fin de la requête
}
else // Sinon création d'une nouvelle référence
{
	// Les variables sont vides, puisque c'est une nouvelle référence
	$annee = '';
	$titre = '';
	$description = '';
	$tag_web = '';
	$tag_gestion = '';
	$tag_evenement = '';
	$image = '';

	$id_entree = 0; // La variable vaut 0, donc on se souviendra que ce n'est pas une modification
}

?>



	<div class="page-contenu">
	<div class="container">
		<h2>Ajout d'une nouvelle référence au book</h2>

		<form method="post" action="lister-reference.php" enctype="multipart/form-data">

			<p><label>Année : </label><br /><input type="text" name="annee" maxlength="4" value="<?php echo $annee; ?>" /></p>
			<p><label>Titre : </label><br /><input type="text" name="titre" size="100" placeholder="Titre" value="<?php echo $titre; ?>" /></p>
			<p><label>Tag Web : </label> 
				<select name="tag_web">
					<option value="<?php echo $tag_web; ?>"><?php echo $tag_web; ?></option>
					<option value="non">non</option>
					<option value="oui">oui</option>
				</select>
				| |
				<label>Tag Gestion : </label> 
				<select name="tag_gestion">
					<option value="<?php echo $tag_gestion; ?>"><?php echo $tag_gestion; ?></option>
					<option value="non">non</option>
					<option value="oui">oui</option>
				</select>
				| |
				<label>Tag Evénement : </label> 
				<select name="tag_evenement">
					<option value="<?php echo $tag_evenement; ?>"><?php echo $tag_evenement; ?></option>
					<option value="non">non</option>
					<option value="oui">oui</option>
				</select>
			</p>

			<p><label>Description : </label><br /><textarea name="description" cols="100"><?php echo $description; ?></textarea></p>
			

			<h4>Ajout d'une image</h4>

			<p><em>Carré de 200 x 200</em><br /><input type="file" name="mon_image" /></p>

			<p>Nom de l'image précédemment téléchargée : <?php echo $image; ?> </p>

			<p><label>Modifier l'image : </label>
				<select name="modifier_image">
					<option value="non">non</option>
					<option value="oui">oui</option>
				</select></p>

			<p><input type="hidden" name="image" value="<?php echo $image; ?>" /></p>
			<p><input type="hidden" name="id_entree" value="<?php echo $id_entree; ?>" /></p>

			<p><input type="submit" value="Valider" /></p>

		</form>
	</div>
	</div>




</body>

</html>

