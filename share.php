<?php
session_start();
	//Niezalogowanego przerzuć do indexu
if (!isset($_SESSION['zalogowany']))
{
	header('Location: index.php');
	exit();
}
$conn = mysqli_connect('localhost','root','','NoteShare');
$email = $_POST['share_user_email'];
$noteid = $_POST['share_note_id'];
$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email)){
header('Location: index.php');
exit();
}
$ide = mysqli_query($conn,"select id from users where email='".$email."'");	
$user_id=mysqli_fetch_row($ide);
$user_id = $user_id[0]; 
$wemail = mysqli_query($conn,"SELECT email FROM users WHERE email='".$email."'");
if(mysqli_num_rows($wemail)==0) {
echo "mail nie znaleziony";
}
else {
$ex_acc = mysqli_query($conn,"
SELECT * 
FROM note_access 
WHERE id_user='".$user_id."' 
AND id_note='".$noteid."'");
if(mysqli_num_rows($ex_acc)==0){
	
	
$sql2 = "insert into note_access values ('".$noteid."','". $user_id."')";
$rs2 = mysqli_query($conn, $sql2);	
	
header('Location: index.php');
	exit();
}
}

?>