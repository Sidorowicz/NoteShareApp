<?php
session_start();
	//Niezalogowanego przerzuć do indexu
if (!isset($_SESSION['zalogowany']))
{
	header('Location: index.php');
	exit();
}
	
	//zmienne wlasciwosci notatki
$deletenoteid = $_POST["delete_note_id"];


if ($deletenoteid==""){
	header('Location: index.php');
	exit();
}		
$conn = mysqli_connect('localhost','root','','NoteShare');

$ide = mysqli_query($conn,"
				select id 
				from users
				where login='".$_SESSION["login"]."' 
				");	
$user_id=mysqli_fetch_row($ide);
$user_id = $user_id[0];
$delete_note = 	"
DELETE 
FROM note_access
WHERE id_note='".$deletenoteid."'
AND id_user='".$user_id."'
";
$execute_insert_note = mysqli_query($conn, $delete_note);


header('Location: noteshare.php');
exit();
?>
