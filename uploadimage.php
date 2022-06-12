
<?php



session_start();
	//Niezalogowanego przerzuć do indexu
if (!isset($_SESSION['zalogowany']))
{
	header('Location: index.php');
	exit();
}
$today = date("YmdHis");
$conn = mysqli_connect('localhost','root','','NoteShare');


if(isset($_POST['uploadfilesub'])) {
$filename = $_FILES['uploadfile']['name'];
$filetmpname = $_FILES['uploadfile']['tmp_name'];
$folder = 'uploadedfiles/';
$name = $today.$_POST['current_note_id_image'].'.png';
move_uploaded_file($filetmpname, $folder.$name);
$ide = mysqli_query($conn,"
				select id 
				from users
				where login='".$_SESSION["login"]."' 
				");	
			$user_id=mysqli_fetch_row($ide);
			$user_id = $user_id[0];
			$update_note2 = '
				insert into uploadedimage 
				values ("" ,"'.$name.'" )
			';
			$execute_update_note2 = mysqli_query($conn, $update_note2);
			$update_note = "
				UPDATE notes n
				INNER JOIN note_access ac  
				INNER JOIN users u 
				ON n.id=ac.id_note AND u.id=ac.id_user
				SET n.image='".$name."'
				WHERE n.id='".$_POST["current_note_id_image"]."' and u.id='".$user_id."'
			";
			$execute_update_note = mysqli_query($conn, $update_note);
	
			
	
header('Location: noteshare.php');
	exit();
}
?>