<?php
	require_once 'model.php';
	if (isset($_Post['pays'])){
		sign_in($_POST['login'], $_POST['password']);
	}
	if( is_user( $_POST['login'], $_POST['password'] ) ) {
		$login = $_POST['login'];
		$posts = get_all_posts();
	}
	// inclut le code de la présentation HTML
	require 'view/annonces.php';
?>