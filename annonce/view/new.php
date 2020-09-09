<?php
 $title= 'Exemple Annonces Basic PHP: Connexion'; ?>
<?php ob_start(); ?>
<form action="/annonce/index.php/annonces" method="POST" >
	<label> Nouvelle Annonce </label> 
	<br />	
	<label for="idtitle "> Titre : </label> 
	<input type="text" name="titre" id="idtitle"/>
	<br />	
	
	<label for="iddate "> Date : <?php echo date("Y-d-m") ?></label> 
	<br />	
	
	<label for="idcontenu "> Texte : </label> 
	<textarea type="textarea" cols="30" rows="5" name="contenu" id="idcontenu"></textarea>
	<br />
	<br />
    <input type="submit" value="Valider"></form>
	
    <form action="/annonce/index.php/annonces" ><input type="submit" value="Annuler"></form>
<?php $content = ob_get_clean(); ?>
<?php include 'layout.php'; ?>