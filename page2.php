﻿<?php
	$author_name = "Kristjan Tamm";
	$todays_evaluation = null; //$todays_evaluation = "";
	$inserted_adjective = null;
	$adjective_error = null;
	
	//kontrollin kas on klikitud submit nuppu
	if (isset($_POST["todays_adjective_input"])) {
		//echo "Klikiti nuppu";
		//kas midagi kirjutati ka
		if (!empty($_POST["adjective_input"])){
			$todays_evaluation = "<p>tänane päev on <strong>" .$_POST["adjective_input"] ."</strong>.</p>";
			$inserted_adjective = $_POST["adjective_input"];
		} else {
			$adjective_error = "Palun kirjuta tänase päeva kohta sobiv omadussõna!";
		}
	}
	
	//loome fotode kataloogi sisu
	$photo_dir = "photos/";
	$allowed_photo_types = ["image/jpeg", "image/png"];
	$all_files = array_slice(scandir($photo_dir), 2);
	$photo_files = [];
		foreach($all_files as $file){
			$file_info = getimagesize($photo_dir .$file);
			if(isset($file_info["mime"])){
				if(in_array($file_info["mime"], $allowed_photo_types)){
					array_push($photo_files, $file);
				}
			}
		}
	$limit = count($photo_files);
	$pic_num = mt_rand(0, $limit - 1);
	$pic_file = $photo_files[$pic_num];
	//<img src="pilt.jpg" alt="Tallinna Ülikool">
	$pic_html = '<img src="' .$photo_dir .$pic_file .'" .alt="Tallinna Ülikool">';
	
	//fotode nimekiri
	//<p>Valida on järgmised fotod: <strong>foto1.jpg</strong>, <strong>foto2.jpg</strong></p>
	//<ul>Valida on järgmised fotod: <li>foto1.jpg</li>, <li>foto2.jpg</li></ul>
	$list_html = "<ul> \n";
	for($i = 0; $i < $limit; $i++) {
		$list_html .= "<li>" .$photo_files[$i] ."</li> \n";
	}
	$list_html .= "</ul>";
	
	$photo_select_html .= '<select name="photo_select"> ."\n"';
	for($i = 0; $i < $limit; $i++) {
		//option value="0">fail.jpg</option>
		$photo_select_html .= '<option value="' .$i .'">' .$photo_files[$i] ."</option> \n";
	}
	$photo_select_html .= "</select>";
	
	
?>
<!DOCTYPE html>
<html lang="et">
<head>
	<meta charset="utf-8">
	<title><?php echo $author_name; ?>, veebiprogrammeerimine</title>
</head>
<body>
	<h1><?php echo $author_name; ?>, veebiprogrammeerimine</h1>
	<p>See leht on valminud õppetöö raames ja ei sisalda mingisugust tõsiseltvõetavat sisu!</p>
	<p>Õppetöö toimus <a href="https://www.tlu.ee/dt">Tallinna Ülikooli Digitehnoloogiate instituudis</a>.</p>
	<hr>
	<form method="POST">
		<input type="text" name="adjective_input" placeholder="omadussõna tänase kohta" value="<?php echo $inserted_adjective; ?>">
		<input type="submit" name="todays_adjective_input" value="Saada ära!">
		<span><?php echo $adjective_error; ?></span>
	<form>
	<hr>
	<?php
		echo $todays_evaluation;
		
	?>
	<form method="POST">
		<?php echo $photo_select_html; ?>
	</form>
	<?php
		echo $pic_html;
		echo $list_html;
	?>
	
	<!--
	<img src="tlu.jpg" alt="Tallinna Ülikooli Terra õppehoone" width="600">
	<?php echo $pic_html; ?>;
	<img src="pilt2.jpg" alt="Mõtlik mees, kes vaatab arvutiekraani" width="600">
	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla viverra pellentesque rhoncus. Aenean aliquet dignissim venenatis. Donec euismod dui sapien. Fusce placerat dapibus posuere.</p>
	-->
</body>


</html>