<?php
session_start();
if (!isset($_SESSION['zalogowany']))
{
	header('Location: index.php');
	exit();
}
function generate_string($input, $strength = 16) {
    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }
    return $random_string;
}

			$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$share_code = generate_string($permitted_chars, 8);
			$conn = mysqli_connect('localhost','root','','NoteShare');
			$ide = mysqli_query($conn,	"
													select id 
													from users
													where login='".$_SESSION["login"]."' 
													");
			$user_id=mysqli_fetch_row($ide);
			$user_id = $user_id[0];
			
			$insert_note = 							"
													insert into notes 
													values (NULL,'','Nowa Notatka','".$_POST['zeszyt'].
													"','".$share_code."','".$user_id."','','2100-01-01')";
			$execute_insert_note = mysqli_query($conn, $insert_note);
			$last_id = $conn->insert_id;
			
			$sql2 = 								"
													insert into 
													note_access 
													values ('".$last_id."','".$user_id."')";
			$rs2 = mysqli_query($conn, $sql2);

header('Location: noteshare.php');
exit();
?>