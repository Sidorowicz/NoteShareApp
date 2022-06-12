<?php
session_start();
	//Niezalogowanego przerzuć do indexu
if (!isset($_SESSION['zalogowany']))
{
	header('Location: index.php');
	exit();
}
$conn = mysqli_connect('localhost','root','','NoteShare');
$code = $_POST['share_code'];


$ide = mysqli_query($conn,"select id from users where login='".$_SESSION['login']."'");	
$user_id=mysqli_fetch_row($ide);
$user_id = $user_id[0]; 

$code_id = mysqli_query($conn,"SELECT id FROM notes WHERE code='".$code."'");
$c=mysqli_fetch_row($code_id);
$c = $c[0]; 


$sql2 = "insert into note_access values ('".$c."','". $user_id."')";
$rs2 = mysqli_query($conn, $sql2);	
	
header('Location: index.php');
exit();



?>