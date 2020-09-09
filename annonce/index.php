<?php
	// charge et initialise les bibliothèques globales
	require_once 'model.php';
	require_once 'controllers.php';
	// démarrage de la session
	session_start();
	
	// récupération du nom de la page demandée
	$uri = parse_url($_SERVER['REQUEST_URI'],
	PHP_URL_PATH);
	// vérification utilisateur authentifié
	if( !isset($_SESSION['login']) ) {
		if( !isset($_POST['login']) || !isset($_POST['password']) ) {
			$error='not connected';
			$uri='/annonce/index.php' ;
	}
	elseif( !is_user($_POST['login'],$_POST['password']) ){
		$error='bad login/pwd';
		$uri='/annonce/index.php' ;
	}
	else {
		$_SESSION['login'] = $_POST['login'] ;
		$login = $_SESSION['login'];
	}
	}
	else
		$login = $_SESSION['login'] ;

	if(!isset($login)){
		$login = " ";
		}
	if(!isset($error)){
		$error = " ";
		}
	
	// route la requête en interne
	if ('/annonce/index.php' == $uri ) {
		login_action($login,$error);
	}
	
	elseif ('/annonce/index.php/register' == $uri) {
		register_action($login, $error);
	}
	elseif ( '/annonce/index.php/annonces' == $uri ){
		annonces_action($login,$error);
	}
	elseif ('/annonce/index.php/post' == $uri && isset($_GET['id'])) {
		post_action($_GET['id'],$login,$error);
	}
	
	
	elseif ('/annonce/index.php/new' == $uri){
		new_action($login,$error);
	}
	
	
	
	elseif('/annonce/index.php/logout' == $uri ) {
		header( "refresh:0;url=../index.php " );
		exit;
			
		// fermeture de la session
		session_destroy();
		// affichage de la page de connexion
		login_action('','');
		
	}
	else {
		header('Status: 404 Not Found');
		echo '<html><body><h1>My Page Not Found</h1></body></html>';
	}
?>



