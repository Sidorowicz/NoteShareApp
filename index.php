<?php

	session_start();
	
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		header('Location: noteshare.php');
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

		<p><h2>NoteShare</h2></p><br><br>
		Noteshare jest darmową aplikacją <br>do tworzenia, udostępniania oraz <br>przechowywania notatek.<br><br><br><br>
	<form action="login.php" method="post">
	<label>Posiadasz konto?</label><br>
	<button class="index_button">Zaloguj się!</button>
	</form><br>
	
	
	<form action="register.php" method="post">
	<label>Nie masz konta?</label><br>
	<button class="index_button">Zarejestruj się!</button>
	</form>
	
<?php
	if(isset($_SESSION['blad']))	echo $_SESSION['blad'];  $_SESSION['blad']="";
?>
</div>
</div>
</body>
</html>