<!DOCTYPE html>
<html lang="pl">
<head >
<meta charset="utf-8">
<title>Page Title</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Roughly 155 characters">
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
<?php
//START SESJI
	session_start();
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
//POLACZENIE Z BAZA DANYCH
$conn = mysqli_connect('localhost','root','','NoteShare');
?>
<script>
//Załaduj wstępnie pola
function loadstart(){
	set_fields();
	startTime();
}
//Start zegara i update'owanie ukrytych pól
function startTime() {
  var today = new Date();
  var h = today.getHours();
  var m = today.getMinutes();
  var s = today.getSeconds();
  m = checkTime(m);
  s = checkTime(s);
  document.getElementById('clock').innerHTML =
  h + ":" + m + ":" + s;
  var t = setTimeout(startTime, 500);
  var u = setTimeout(update_area, 500);
  var p = setTimeout(update_area2, 500);
}
//Sprawdzanie czasu dla formatu 00:00:00
function checkTime(i) {
  if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
  return i;
}
//Opcje formatowania
function chooseColor(){
      var mycolor = document.getElementById("myColor").value;
      document.execCommand('foreColor', false, mycolor);
    }
function changeFont(){
      var myFont = document.getElementById("input-font").value;
      document.execCommand('fontName', false, myFont);
    }

function changeSize(){
      var mysize = document.getElementById("fontSize").value;
      document.execCommand('fontSize', false, mysize);
    }

function checkDiv(){
      var editorText = document.getElementById("editor1").innerHTML;
      if(editorText === ''){
        document.getElementById("editor1").style.border = '5px solid red';
      }
    }
//Funkcje wywoływane przy wcisnięciu klawisza podczas wpisywania notatki lub tytułu
	function update_area(){
		document.getElementById("current_note_note").value = document.getElementById("editor1").innerHTML;
		update_current_button_description();	
	}
	function update_area2(){
		
		document.getElementById("current_note_title").value = document.getElementById("note_title").innerHTML;
		update_current_button_description();
		
	}
	function set_fields(){
		document.getElementById("zeszyt").value = "3";
	}
	function update_current_button_description(){
		var current_id = document.getElementById("current_note_id").value;
		document.getElementById(current_id).value = document.getElementById("editor1").innerHTML ;
		document.getElementById(current_id).innerHTML = document.getElementById("note_title").innerHTML ;
	}

</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){

	
	$(".notes_menu").click(function(){
		var nazwa = $( this ).html();
		var wartosc = $( this ).attr( "value" );
		var id = $( this ).attr( "id" );
		$('#editor1').html(wartosc);
		$('#note_title').html(nazwa);
		$('#current_note_id').val(id);
		$('#current_note_note').val(wartosc);
		$('#current_note_title').val(nazwa);
		$('#delete_note_id').val(id);
		$('#reminder_note_id').val(id);
		$('#note_idid').val(id);
		$('#note_id_remind').val(id);
		$('#note_id_remove').val(id);
		$('#share_note_id').val(id);
		$('#current_note_id_image').val(id);
		
		var ele = document.getElementsByClassName("image_names");

			if (ele.length > 0) {
				for (i = 0; i < ele.length; i++) {
					if (ele[i].name != $('#current_note_id').val()){
						ele[i].style.display = "none";
						
					}else{
						ele[i].style.display = "block";
					}      
				}
			}  

	});
	
	
	
	$(".categories_sub_menu").click(function(){
		var wartosc = $( this ).attr( "value" );
		var idd = $( this ).attr( "value" );
		$('#zeszyt').val(wartosc);
		$('#delete_zeszyt_id').val(wartosc);

		var ele = document.getElementsByClassName("notes_menu");
			if (ele.length > 0) {
				for (i = 0; i < ele.length; i++) {
					if (ele[i].name != $('#zeszyt').val()){
						
						ele[i].style.display = "none";
					}else{
						ele[i].style.display = "block";
					}      
				}
			}
	});
	
	
	
	$("#all_notes").click(function(){
		$('#zeszyt').val("1");
		var ele = document.getElementsByClassName("notes_menu");
			if (ele.length > 0) {
				for (i = 0; i < ele.length; i++) {
					
						ele[i].style.display = "block";
						  
				}
			}
	});
	$("#recieved_notes").click(function(){
		var ele = document.getElementsByClassName("notes_menu");
			if (ele.length > 0) {
				for (i = 0; i < ele.length; i++) {
					if (ele[i].name != "recieved"){
						ele[i].style.display = "none";
					}else{
						ele[i].style.display = "block";
					}      
				}
			}
			

	});
	$("#categories_menu_search_s").click(function(){
		var ele = document.getElementsByClassName("notes_menu");
		
			if (ele.length > 0) {
				for (i = 0; i < ele.length; i++) {
					if( (ele[i].innerHTML).indexOf(($("#categories_menu_search").val()))>-1){
						ele[i].style.display = "block";
					}else{
						ele[i].style.display = "none";
					}      
				}
			}
	});
});
</script>
</head>
<body onload="loadstart()">
<div id="categories_menu">
		<div id="user_data">
			<p style="font-size:20px;">NoteShare</p><br>
			<?php
			echo "<p>".$_SESSION['login'].' 
			<br>
			 <a href="logout.php"style="color:white;text-decoration:none;">Wyloguj się!</a> </p>';
			?>
			<!--<br>Czas:<div id="clock" style="display:inline;"></div>-->
		</div>
		<div id="categories_top">
		<input type="text" id="categories_menu_search" placeholder="Szukaj..."></input> 
		<div id="categories_menu_search_s">
		<a><i class="fa fa-search" aria-hidden="true"></i></a>
		</div> 

			<form method="post" action="addempty.php">
			<input type="hidden" id="user_id" name="user_id" value=''></input>
			<input type="hidden" id="zeszyt" name="zeszyt" value=''></input>
			<button type="submit" id="add_note_button" > 
				
				Dodaj notatkę 
			</button>
			</form>
		</div>
		<button class="categories_menu" id="all_notes"><i class="fa fa-star"></i>   Wszystkie notatki</button>
		<div class="categories_menu"><i class="fa fa-book"></i>  Zeszyty :</div>
		<div id="notebooks">
			<?php
			$ress = mysqli_query($conn,"
			select zeszyty.nazwa,zeszyty.id 
			from `zeszyty` 
			inner join `zeszyty_access` 
			inner join`users` 
			on `zeszyty`.`id`=`zeszyty_access`.`id_zeszytu` 
			and `users`.`id`=`zeszyty_access`.`id_usera` 
			where `users`.`login`='".$_SESSION['login']."'");
            while ($rs =mysqli_fetch_assoc($ress)) {
            echo '<button class="categories_sub_menu" value="'.$rs['id'].'"> <i class="fa fa-book"></i>  '. $rs['nazwa'] .'  </button>';}
			function set_current_notee($name) {$_SESSION['note_name'] = $name;}
			?>
			</div>
		<form method="post" action="addzeszyt.php">	
		<input class="categories_sub_menu2" type="text" id="zeszyt_name" name="zeszyt_name" placeholder="Nowy zeszyt" ></input>
		<button class="categories_sub_menu">Dodaj zeszyt</button>
		</form>
		<button class="categories_menu" id="recieved_notes"><i class="fa fa-chevron-down"></i> Otrzymane notatki</button>
<div id="note_menu_bottom" style="color:red; overflow:hidden;">
<br><br><br>
<form method="post" action="deletenote.php">	
		<input type="hidden" id="delete_note_id" name="delete_note_id"></input>
		<button class="categories_menu"><i class="fa fa-minus"></i>   Usuń notatkę</button>
		</form>
		
<form method="post" action="deletenotebook.php">
		<input type="hidden" id="delete_zeszyt_id" name="delete_zeszyt_id"></input>
		<button class="categories_menu"><i class="fa fa-minus"></i>   Usuń zeszyt</button>
		</form>
		
		
		
		
		
		
</div>
</div>
<div style="float:left;">
<div id="notes_menu">
<?php
$res = mysqli_query($conn,
		"select notes.textarea_content,notes.id,notes.name,notes.zeszyt_id,notes.przypomnienie
		from `notes` 
		inner join `note_access` 
		inner join`users` 
		on `notes`.`id`=`note_access`.`id_note` 
		and `users`.`id`=`note_access`.`id_user` 
		where `users`.`login`='".$_SESSION['login']."'
		and `note_access`.`id_user` = `notes`.`original_user_id`
		"
);
while ($row =mysqli_fetch_assoc($res)) {
	$b = date('Y-m-d');
	$a= $row['przypomnienie'];
	if($a>$b){
		echo '<button class="notes_menu" value="'.htmlentities(base64_decode($row['textarea_content'])).'"id="'.$row['id'].'"name="'.$row['zeszyt_id'].'" >'.$row['name']."</button>";
	}else{

		echo '<button class="notes_menu" value="'.htmlentities(base64_decode($row['textarea_content'])).'"id="'.$row['id'].'"name="'.$row['zeszyt_id'].'" 
		style="
		animation-name: animatedcolor;
	animation-duration: 20s;
	animation-iteration-count: infinite;
	animation-direction: alternate;
	animation-timing-function: linear;
		"
		>'.$row['name']."</button>";
	}

}
$res = mysqli_query($conn,
		"select notes.textarea_content,notes.id,notes.name,notes.zeszyt_id,notes.przypomnienie
		from `notes` 
		inner join `note_access` 
		inner join`users` 
		on `notes`.`id`=`note_access`.`id_note` 
		and `users`.`id`=`note_access`.`id_user` 
		where `note_access`.`id_user` != `notes`.`original_user_id` 
		and `users`.`login`='".$_SESSION['login']."'
		and `note_access`.`id_user` = '".$_SESSION['id']."'"
);


while ($row =mysqli_fetch_assoc($res)) {
	$b = date('Y-m-d');
	$a= $row['przypomnienie'];
	if($a<=$b){
		echo '<button class="notes_menu" value="'.htmlentities(base64_decode($row['textarea_content'])).'"id="'.$row['id'].'" name="recieved" 
		style="
		animation-name: animatedcolor;
		animation-duration: 20s;
		animation-iteration-count: infinite;
		animation-direction: alternate;
		animation-timing-function: linear;
		"
		>'.$row['name'] ."</button>";
	}else{
		echo '<button class="notes_menu" value="'.htmlentities(base64_decode($row['textarea_content'])).'"id="'.$row['id'].'" name="recieved">'.$row['name'] ."</button>";
	}
}
?>
</div>




	   
	   
	   

</div>
<div id="content">
<div id="top_content">
<div id="top_top_content">
	<div class="edit_menu_item2" style="float:left;">

		<?php
			$res = mysqli_query($conn,
				"select notes.image,notes.id
				from `notes` 
				inner join `note_access` 
				inner join`users` 
				on `notes`.`id`=`note_access`.`id_note` 
				and `users`.`id`=`note_access`.`id_user` 
				where `users`.`login`='".$_SESSION['login']."'			
				"
			);
			
			
			
			
			while ($row =mysqli_fetch_assoc($res)) {
				if($row['image']!=NULL){
					echo '<a href="uploadedfiles/'.$row['image'].'" class="image_names" name="'.$row['id'].'"  style="width:150px;float:left;font-size:15px;overflow:hidden;display:none;margin:10px;" download>Załącznik</a> ';
					
				}else{
					echo '<a class="image_names" name="'.$row['id'].'"  style="width:150px;float:left;font-size:15px;overflow:hidden;display:none;margin:10px;">Brak Załącznika</a> ';
					
				}
						

				
			}
			
			
			
			
		?>
	</div>

	
	<div class="edit_menu_item2" style="padding:3px;">
		<form action="generate.php" method="post" target="share_code" style="display:inline;">
			<input type="hidden" name="note_idid" id="note_idid"></input>
			<button id="myBtn" ><i class="fa fa-ellipsis-h"></i></button>
		</form>
	</div>
					
	<div class="edit_menu_item2"  style="padding:3px;			">
		<form method="post" action="updatenote.php">
			<input type="hidden" id="current_note_id" name="current_note_id" ></input>
			<input type="hidden" id="current_note_title" name="current_note_title" ></input>
			<input type="hidden" id="current_note_note" name="current_note_note" ></input>
			<button>Zapisz</button>
		</form>
	</div>	
</div>










<div id="bot_top_content">
<div id="bot_top_content2">
				<div class="edit_menu_item"><button class="fontStyle italic" onclick="document.execCommand('italic',false,null);" title="Italicize Highlighted Text"><i class="fa fa-italic"></i></button></div>
				<div class="edit_menu_item"><button class="fontStyle bold" onclick="document.execCommand( 'bold',false,null);" title="Bold Highlighted Text"><i class="fa fa-bold"></i></button></div>
				<div class="edit_menu_item"><button class="fontStyle underline" onclick="document.execCommand( 'underline',false,null);"><i class="fa fa-underline"></i></button></div>
				<div class="edit_menu_item"><button class="fontStyle strikethrough" onclick="document.execCommand( 'strikethrough',false,null);"><strikethrough><i class="fa fa-strikethrough"></i></strikethrough></button></div>
				<div class="edit_menu_item">|</div>

				<div class="edit_menu_item"><button class="fontStyle align-left" onclick="document.execCommand( 'justifyLeft',false,null);"><justifyLeft><i class="fa fa-outdent"></i></justifyLeft></button></div>
				<div class="edit_menu_item"><button class="fontStyle align-center" onclick="document.execCommand( 'justifyCenter',false,null);"><justifyCenter><i class="fa fa-align-justify"></i></justifyCenter></button></div>
				<div class="edit_menu_item"><button class="fontStyle align-right" onclick="document.execCommand( 'justifyRight',false,null);"><justifyRight><i class="fa fa-indent"></i></justifyRight></button></div>
				<div class="edit_menu_item">|</div>


				<div class="edit_menu_item"><button class="fontStyle orderedlist" onclick="document.execCommand('insertOrderedList', false, null);"><insertOrderedList><i class="fa fa-list-ol"></i></insertOrderedList></button></div>
				<div class="edit_menu_item"><button class="fontStyle unorderedlist" onclick="document.execCommand('insertUnorderedList',false, null)"><insertUnorderedList><i class="fa fa-list"></i></insertUnorderedList></button> </div>   
				<div class="edit_menu_item">|</div>

			<div class="menu_select" >
				<select id="input-font" class="input"  onchange="changeFont (this);" style="width:100px; margin-top:1px;margin-right:10px; border-radius:6px;">
						<option value="Arial">Arial</option>
						<option value="Helvetica">Helvetica</option>
						<option value="Times New Roman">Times New Roman</option>
						<option value="Sans serif">Sans serif</option>
						<option value="Courier New">Courier New</option>
						<option value="Verdana">Verdana</option>
						<option value="Georgia">Georgia</option>
						<option value="Palatino">Palatino</option>
						<option value="Garamond">Garamond</option>
						<option value="Comic Sans MS">Comic Sans MS</option>
						<option value="Arial Black">Arial Black</option>
						<option value="Tahoma">Tahoma</option>
						<option value="Comic Sans MS">Comic Sans MS</option>
				</select>
			</div>

			<div class="menu_select" >

				<select id="fontSize" onclick="changeSize()" style="width:30px; margin-top:1px;margin-right:10px; border-radius:6px;">
						<option value="1">1</option>      
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
				</select>
			</div>
				
				<div class="edit_menu_item">
				<input class="color-apply" type="color" onchange="chooseColor()" id="myColor" style="width:19px;height:20px;border-radius:30px;"> 
			</div>
				

				

</div>

</div>
</div>
<div id="editor_case" >
<div contenteditable="true" id="note_title" name="note_title" onkeyup="update_area2()" ><div></div></div>
<div id="editor1" contenteditable="true" name="editor1" onkeyup="update_area()" >
 
</div>
</div>







</div>




<div id="myModal" class="modal">
  <div class="modal-content" style="text-align:left; overflow:scroll;">
    <span class="close">&times;</span>
	

<form method="post" action="share.php">	
		<p style="width:100%;text-align:center;">Podaj adress email użytkownika któremu chcesz udostępnić aktualną notatkę:</p>
		<input type="text" id="share_user_email" name="share_user_email" placeholder="osoba@adres.pl" style="test-align:center;"></input><br>
		<input type="hidden" id="share_note_id" name="share_note_id"></input><br>
		<button style="">Udostępnij </button><br><br>
		</form>
		

<form method="post" action="shared.php">	
		<p style="width:100%;text-align:center;">Podaj kod notatki którą chcesz dodać:<p>
		<input type="text" id="share_code" name="share_code"></input><br><br>
		<button class="">Dodaj notatkę</button><br><br>
		</form>
		
					<p style="width:100%;text-align:center;">Kod udostępnienia notatki:
					<br>
					<iframe name="share_code" style="width:100px;margin-left:auto;margin-right:auto;height:35px;margin-top:14px;border:none;margin-top:7px;"
></iframe>
					</p>

		
		
<p style="width:100%;text-align:center;">Załącznik:</p>

	<form action="uploadimage.php" method="post" enctype="multipart/form-data">
		<input type="file" name="uploadfile" id="uploadfile" name="Wybierz plik" style="width:90%;float:left;"/>
		<input type="hidden" id="current_note_id_image" name="current_note_id_image" />
		<input type="submit" name="uploadfilesub" value="Dołącz" style="width:10%;float:left;" />
	</form>











	<p style="width:100%;text-align:center;">Przypomnienia:</p>
<div style="width:90%;margin-left:auto;margin-right:auto;">
	<form method="post" action="setreminder.php" >	
		<input type="hidden" id="note_id_remind" name="reminder_note_id"></input>
		<input type="date" id="start" name="data" value="2021-01-01" min="2021-01-01" max="2040-12-31" style="display:block;width:100%;height:30px;font-size:20px;"><br>
		<button style="width:49%">Ustaw</button>
	</form>
	<form method="post" action="removereminder.php">	
		<input type="hidden" id="note_id_remove" name="reminder_note_id"/>
		<button style="width:49%">Usuń</button>
	</form>
</div>









	





</div>



</div>





</div>








<script>
var modal = document.getElementById("myModal");
var btn = document.getElementById("myBtn");
var span = document.getElementsByClassName("close")[0];
btn.onclick = function() {
  modal.style.display = "block";
}
span.onclick = function() {
  modal.style.display = "none";
}
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
</body>
</html>
