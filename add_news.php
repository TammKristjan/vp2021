<?php
    require_once("use_session.php");
	
    require_once("../../config.php");
	require_once("fnc_photoupload.php");
    require_once("fnc_general.php");
    //fotode üleslaadimise klass
    require_once("classes/Photoupload.class.php");
	
	$news_notice = null;
	
	//uudise aegumine
	$expire = new DateTime("now");
	$expire->add(new DateInterval("P7D"));
	$expire_date = date_format($expire, "Y-m-d");
	
    $normal_photo_max_width = 600;
    $normal_photo_max_height = 400;
	$thumbnail_width = $thumbnail_height = 100;
    
    $photo_filename_prefix = "vpnews_";
    $photo_upload_size_limit = 1024 * 1024;
	$allowed_photo_types = ["image/jpeg", "image/png"];
    
    if(isset($_POST["news_submit"])){
		
		//vaadata user_profile.php faili, hea võtta alus sealt
		$news_text = test_input($_POST["news_input"]);
		$news_notice = store_news($news_text, $_POST["bg_color_input"],$_POST["text_color_input"]);
		//uudise tekst sisaldab nüüd html märgendeid (näiteks <b> ...).
		//Kindlasti tuleks kastuada meie funtksiooni test_input()
		//selleks on ka htmlsepcialchars(uudis) funktsioon, mis kodeerib html erimärgid ringi, ohutuks ("<" -> &lt;)
		//pärast, uudise näitamisel, et html taastuks, on vaja: htmlspecialchars_decode(uudis_andmebaasist)
		//kui on ka foto valitud, salvestage see esimesena, ka andmetabelisse. Siis saate kohe ka tema id kätte: $photo_id = $conn->insert_id;
		//uudise näitamisel tuleb arvestada ka aegumist
		//$today = date("Y-m-d");
		//SQL lauses WHERE added >= ?
    }
    
    $to_head = '<script src="javascript/checkFileSize.js" defer></script>' ."\n";
	$to_head .= '<script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>';
    
    require("page_header.php");
?>

	<h1><?php echo $_SESSION["first_name"] ." " .$_SESSION["last_name"]; ?>, veebiprogrammeerimine</h1>
	<p>See leht on valminud õppetöö raames ja ei sisalda mingisugust tõsiseltvõetavat sisu!</p>
	<p>Õppetöö toimus <a href="https://www.tlu.ee/dt">Tallinna Ülikooli Digitehnoloogiate instituudis</a>.</p>
	<hr>
    <ul>
        <li><a href="?logout=1">Logi välja</a></li>
		<li><a href="home.php">Avaleht</a></li>
    </ul>
	<hr>
    <h2>Uudise lisamine</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
		<label for="title_input">Uudise pealkiri</label>
        <input type="text" name="title_input" id="title_input">
		<br>
		<label for="news_input">Uudis</label>
        <textarea id="news_input" name="news_input"></textarea>
		<script>CKEDITOR.replace( 'news_input' )</script>
		<br>
		<label for="expire_input">Viimane kuvamise kuupäev</label>
		<input id="expire_input" name="expire_input" type="date" value="<?php echo $expire_date; ?>">
		<br>
        <label for="photo_input"> Vali pildifail! </label>
        <input type="file" name="photo_input" id="photo_input">
        
        <br>
        <input type="submit" name="news_submit" id="news_submit" value="Salvesta uudis"><span id="notice"></span>
    </form>
    <span><?php echo $news_notice; ?></span>
</body>
</html>