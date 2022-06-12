<?php
session_start();
	//Niezalogowanego przerzuć do indexu
if (!isset($_SESSION['zalogowany']))
{
	header('Location: index.php');
	exit();
}

			$conn = mysqli_connect('localhost','root','','NoteShare');
			$sql2 = " insert into zeszyty values (NULL,'".$_POST["zeszyt_name"]."')";
			$rs2 = mysqli_query($conn, $sql2);
			$last_id = $conn->insert_id;
			$ide = mysqli_query($conn,	"
													select id 
													from users
													where login='".$_SESSION["login"]."' 
													");
			$user_id=mysqli_fetch_row($ide);
			$user_id = $user_id[0];
			$sql2 = " insert into zeszyty_access values ('".$last_id."','".$user_id."')";
			$rs2 = mysqli_query($conn, $sql2);
			
header('Location: index.php');
exit();
?>