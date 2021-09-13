<?php
	$author_name = "Kristjan Tamm";
	$weekday_names_et = ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];
	$full_time_now = date("d.m.Y H:i:s");
	$hour_now = date("H");
	//echo $hour_now;
	$weekday_now = date("N");
	$schedule_now = "ebamäärane";
	//echo $weekday_now;
	$day_category = "ebamäärane";
	if ($weekday_now <= 5) {
		$day_category = "koolipäev";
		if ($hour_now >= 8 AND $hour_now <= 18) {
			$schedule_now = "tundide aeg";
		} elseif ($hour_now > 18 AND $hour_now < 23) {
			$schedule_now = "vaba aeg";
			}
		 else
			if ($hour_now >= 23 AND $hour_now < 8) {
				$schedule_now = "une aeg";
				}
			
		//echo "koolipäev";
	} else {
			if ($hour_now >= 23 AND $hour_now < 8) {
				$schedule_now = "une aeg";
				}
			else {
			$schedule_now = "vaba aeg";
			$day_category = "puhkepäev";
			}
		}
	//loome fotode kataloogi sisu
	$photo_dir = "photos/";
	$allowed_photo_types = ["image/jpeg", "image/png"];
	$all_files = array_slice(scandir($photo_dir), 2);
	//echo $all_files;
	#var_dump ($all_files);
	//$only_files = array_slice($all_files,  2);
	//var_dump($all_files);
	
	//sõelun välja ainult pildid
	$photo_files = [];
	foreach($all_files  as $file); {
		$file_info = getimagesize($photo_dir .$file);
		if (isset($file_info["mime"])) {
			if (in_array($file_info["mime"], $allowed_photo_types)) {
				array_push($photo_files, $file);
			}
		}
	}
	var_dump($photo_files);
	$limit = count($photo_files);
	$pic_num = mt_rand(0, $limit - 1);
	$pic_file = $photo_files[$pic_num - 1];
	//<img src="pilt.jpg" alt="Tallinna Ülikool">
	$pic_html = '<img src="' .$photo_dir .$pic_file .'" .alt="Tallinna Ülikool">';
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
	<img src="tlu.jpg" alt="Tallinna Ülikooli Terra õppehoone" width="600">
	<p>Lehe avamise hetk: <span><?php echo  $weekday_names_et[$weekday_now -1] .", " .$full_time_now .", on " .$day_category .", on " .$schedule_now; ?> </span>.</p>
	<h2>Kursusel õpime</h2>
	<ul>
		<li>HTML keelt</li>
		<li>PHP programmeerimiskeelt</li>
		<li>SQL päringukeelt</li>
		<li>jne</li>
	</ul>
	<?php echo $pic_html; ?>;
	<img src="pilt2.jpg" alt="Mõtlik mees, kes vaatab arvutiekraani" width="600">
	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla viverra pellentesque rhoncus. Aenean aliquet dignissim venenatis. Donec euismod dui sapien. Fusce placerat dapibus posuere.</p>
</body>


</html>