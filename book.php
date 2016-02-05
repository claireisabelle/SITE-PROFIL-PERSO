<!DOCTYPE html>
<html>
<head>
<title>Book : références en création de site Internet et en gestion de projets</title>
<meta name="description" content="Présentation de quelques références en création de site Web et en gestion de projets" />

<?php include('inc/head.php'); ?>
	
<?php include('inc/menu.php'); ?>


	<div class="page-contenu"><!-- Tout le contenu en-dessous du header -->
		<div class="container">
			
			<div class="col-xs-12">
				<h1>Book</h1>
				<blockquote>Ci-dessous une sélection de quelques références en création de site Internet, administration de structure, gestion de projets, organisation événementielle</blockquote>
			</div>



		<?php 
			include('inc/connexion.php');
			$req = $bdd->query('SELECT * FROM claire_book ORDER BY annee DESC');

			while($donnee = $req->fetch())
			{?>



			<div class="row"><!-- Row BOOK -->
				<div class="hidden-xs col-sm-2">
					<p class="thumbnail"><img src="upload/<?php echo $donnee['image']; ?>" alt="Illustration référence" title="" /></p>
				</div>
				<div class="col-xs-12 col-sm-10">
					<h4><?php echo stripslashes(htmlspecialchars($donnee['titre'])); ?></h4>
					
					<p>
					<?php	
					if($donnee['tag_gestion'] == 'oui'){
						echo '<span class="label label-default">GESTION</span> ';
					}

					if($donnee['tag_web'] == 'oui'){
						echo '<span class="label label-primary">WEB</span> ';
					}

					if($donnee['tag_evenement'] == 'oui'){
						echo '<span class="label label-warning">EVENEMENTIEL</span> ';
					}

					?>	
					</p>
					
					<p><?php echo stripslashes(nl2br($donnee['description'])); ?></p>
				</div>
			</div><!-- Fin du Row BOOK -->

			<?php
			}
			$req->closeCursor();
			?>

			

		</div><!-- fin du container -->

<?php include('inc/footer.php'); ?>