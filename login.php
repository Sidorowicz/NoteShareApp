<?php
	session_start();
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		header('Location: logged.php');
		exit();
	}
?>





<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>NoteShare</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>




<div id="quick_note">






<div id= "site_container">
		<h3>Zaloguj się:</h3><br><br><br>
		<form action="zaloguj.php" method="post">
		Login: <br /> <br><input type="text" name="login" class="type-2"/> <br /><br>
		Hasło: <br /> <br><input type="password" name="haslo" class="type-2"/> <br /><br />
		<button class="index_button">Zaloguj</button><br /><br /><br /><br />
</form>
<form action="index.php" method="post">
	<button class="index_button">Powrót</button>
</form>	

	
</div>
</div>











</body>
</html>