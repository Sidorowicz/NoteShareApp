<?php
session_start();
	//Niezalogowanego przerzuć do indexu
if (!isset($_SESSION['zalogowany']))
{
	header('Location: index.php');
	exit();
}

$conn = mysqli_connect('localhost','root','','NoteShare');

			$ide = mysqli_query($conn,"SELECT code from notes where id='".$_POST['note_idid']."'");	
			$kod=mysqli_fetch_row($ide);
			$kod = $kod[0];
echo $kod;
exit();
?>