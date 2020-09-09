<?php
	function open_database_connection()
	{
		$link = mysqli_connect('localhost', 'root', '', 'jobstage_db');
		return $link;
	}
	function close_database_connection($link)
	{
		mysqli_close($link);
	}
	function is_user( $login, $password )
	{
		$isuser = False ;
		$link = open_database_connection();
		$query= 'SELECT login FROM Users WHERE
		login="'.$login.'" and password="'.$password.'"';
		$result = mysqli_query($link, $query );
		if( mysqli_num_rows( $result) )
		$isuser = True;
		mysqli_free_result( $result );
		close_database_connection($link);
		return $isuser;
	}

	function get_all_posts()
		{
		$link = open_database_connection();
		$resultall = mysqli_query($link,'SELECT id, title FROM Post');
		$posts = array();
		while ($row = mysqli_fetch_assoc($resultall)) {
		$posts[] = $row;
		}
		mysqli_free_result( $resultall);
		close_database_connection($link);
		return $posts;
		}
	function get_post( $id )
		{
		$link = open_database_connection();
		$id = intval($id);
		$result = mysqli_query($link, 'SELECT * FROM Post WHERE
		id='.$id );
		$post = mysqli_fetch_assoc($result);
		mysqli_free_result( $result);
		close_database_connection($link);
		return $post;
		}
		
	function sign_in($login, $password)
	{
		$link = mysqli_connect('localhost', 'root', '', 'jobstage_db');
	
		$query= 'INSERT INTO Users(nom,prenom,mail,pays,ville,login,password)VALUE ("'.$_POST['nom'].'","'.$_POST['prenom'].'","'.$_POST['mail'].'","'.$_POST['pays'].'","'.$_POST['ville'].'","'.$_POST['login'].'","'.$_POST['password'].'")';
		mysqli_query($link,$query);
		close_database_connection($link);
	}
	
	function new_post()
	{
		$link = mysqli_connect('localhost', 'root', '', 'jobstage_db');
		$result = mysqli_query($link, 'SELECT count(*) FROM Post');
		$row = mysqli_fetch_row($result);
		$id=$row[0]+1;
		$query= 'INSERT INTO Post(titre,contenu)VALUE ("'.$id.'","'.$_POST['titre'].'","'.$_POST['contenu'].'")';
		mysqli_query($link,$query);
		close_database_connection($link);
	}
?>

