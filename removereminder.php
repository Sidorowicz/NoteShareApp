<?php
session_start();
	//Niezalogowanego przerzuć do indexu
if (!isset($_SESSION['zalogowany']))
{
	header('Location: index.php');
	exit();
}

$conn = mysqli_connect('localhost','root','','NoteShare');

			$update_note = "
				UPDATE notes n
				SET przypomnienie='2100-01-01'
				WHERE id='".$_POST["reminder_note_id"]."'
			";
			$execute_update_note = mysqli_query($conn, $update_note);

header('Location: noteshare.php');
exit();
?>