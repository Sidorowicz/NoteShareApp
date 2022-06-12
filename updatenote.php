<?php
session_start();
	//Niezalogowanego przerzuć do indexu
if (!isset($_SESSION['zalogowany']))
{
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



			$cont=base64_encode($_POST["current_note_note"]);
			
			$update_note = "
				UPDATE notes n
				INNER JOIN note_access ac  
				INNER JOIN users u 
				ON n.id=ac.id_note AND u.id=ac.id_user
				SET n.textarea_content='".$cont."' , n.name='".$_POST["current_note_title"]."'
				WHERE n.id='".$_POST["current_note_id"]."' and u.id='".$user_id."'
			";
			$execute_update_note = mysqli_query($conn, $update_note);

header('Location: noteshare.php');
exit();
?>