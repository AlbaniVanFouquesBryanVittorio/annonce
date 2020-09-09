<?php $title= 'Exemple Annonces Basic PHP: Connexion'; ?>
<?php ob_start(); ?>
<form action="/annonce/index.php/annonces" method="POST" >
    <label for="idnom"> Nom </label> :
    <input type="text" name="nom" id="idnom" />
    <br/>
    <label for="idprenom "> Prenom </label> :
    <input type="text" name="prenom" id="idprenom" />
    <br/>
    <label for="idmail"> Mail</label> :
    <input type="text" name="mail" id="idmail" />
    <br/>
    <label for="idpays"> Pays</label> :
    <select name="pays">
		<?php
	function countries($name){

    $url = 'https://data.gouv.nc/api/records/1.0/search/';
    $request_url= $url .'?dataset=liste-des-pays-et-territoires-etrangers&q='. urlencode($name).'&rows=199';

    // initialisation d'une session
    $curl= curl_init($request_url);

    // spécification des paramètres de connexion
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);

    // envoie de la requête et récupération du résultat sous forme d'objet JSON
    $response= json_decode(curl_exec($curl));

    // fermeture de la session
    curl_close($curl);

    // stockage des villes et des codes postaux dans un tableau associatif
    foreach( $response->records as $infoPays){
        $pays[$infoPays->fields->libcog]=$infoPays->fields->libenr;
    }
    return $pays;
};

$country = countries('');

// retourne la liste des pays
foreach($country as $nom => $libe){
    echo '<option>'.$nom.'</option>';
}
?>
	</select>
    <br/>
    <label for="idville"> Ville </label> :
    <select name="ville">
		<?php
	function cityNC($name){

		$url = 'https://data.gouv.nc/api/records/1.0/search/';
		$request_url= $url .'?dataset=communes-nc&q='. urlencode($name).'&rows=50';

		// initialisation d'une session
		$curl= curl_init($request_url);

		// spécification des paramètres de connexion
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);

		// envoie de la requête et récupération du résultat sous forme d'objet JSON
		$response= json_decode(curl_exec($curl));

		// fermeture de la session
		curl_close($curl);

		// stockage des villes et des codes postaux dans un tableau associatif
		foreach( $response->records as $infoville){
			$villes[$infoville->fields->nom_minus]=$infoville->fields->code_post;
			}
		return $villes;
    };

	$villesNC = cityNC('');

	// retourne la liste des villes de NC avec leur code postal
	foreach($villesNC as $nom => $cp){
		echo '<option>'.$nom.'</option>';
	}
	?>
	</select>
    <br/>
    <br/>
    <br/>
    <br/>
    <label for="idlogin"> Login </label> :
    <input type="text" name="login" id="idlogin" placeholder="defaut" />
    <br />
	<label for="idpassword"> Password </label> :
    <input type="password" name="password" id="idpassword" />
    <br/>
    <input type="submit" value="Valider"></form>
	
    <form action="/annonce/index.php" ><input type="submit" value="Annuler"></form></body>

<?php $content = ob_get_clean(); ?>
<?php include 'layout.php'; ?>
