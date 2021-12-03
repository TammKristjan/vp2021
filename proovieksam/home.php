<?php
	require_once("../../../config.php");
    require_once("fnc_registration.php");
	require_once("fnc_general.php");
	require("page_header.php");
	
	
	$form_store_notice = null;
	
	$firstname_input = null;
	$lastname_input = null;
	$studentcode_input = null;
	
	$firstname_input_error = null;
	$lastname_input_error = null;
	$studentcode_input_error = null;
	
	$payment = 0;
	$cancelled = null;
	
	
    //kas püütakse salvestada
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if(isset($_POST["form_submit"])){
			//kontrollin, et andmeid ikka sisestati
			if(!empty($_POST["firstname_input"])){
				$firstname_input = test_input(filter_var($_POST["firstname_input"], FILTER_SANITIZE_STRING));
			} else {
				$firstname_input_error = "Palun sisesta eesnimi!";
			}
			if(!empty($_POST["lastname_input"])){
				$lastname_input = test_input(filter_var($_POST["lastname_input"], FILTER_SANITIZE_STRING));
			} else {
				$lastname_input_error = "Palun sisesta perekonnanimi!";
			}
			if(!empty($_POST["studentcode_input"])){
				$studentcode_input = filter_var($_POST["studentcode_input"], FILTER_VALIDATE_INT);
			} else {
				$studentcode_input_error = "Palun sisesta üliõpilaskood!";
			}
			if(empty($firstname_input_error) and empty($lastname_input_error) and empty($studentcode_input_error)){
				
				$form_store_notice = store_form($firstname_input, $lastname_input, $studentcode_input, $payment, $cancelled);
			} else {
				$form_store_notice = "Osa andmeid on puudu!";
			}
		}
	}
    
?>
	<hr>
	<h1 id="heading">TLÜ 2021 digitehnoloogiate instituudi jõulupidu</h1>
	<p>See leht on valminud õppetöö raames ja ei sisalda mingisugust tõsiseltvõetavat sisu!</p>
	<p>Õppetöö lehekülg: <a href="https://www.tlu.ee/dt">Tallinna Ülikooli Digitehnoloogiate instituut</a>.</p>
    <h2>Registreerimine</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="firstname_input">Eesnimi</label>
        <input type="text" name="firstname_input" id="firstname_input" placeholder="Eesnimi" value="<?php echo $firstname_input; ?>">
		<span><?php echo $firstname_input_error; ?></span>
		<label for="lastname_input">Perekonnanimi</label>
        <input type="text" name="lastname_input" id="lastname_input" placeholder="Perekonnanimi" value="<?php echo $lastname_input; ?>">
		<span><?php echo $lastname_input_error; ?></span>
		<label for="studentcode_input">Üliõpilaskood</label>
        <input type="number" name="studentcode_input" id="studentcode_input" min="100000" max="999999" placeholder="Üliõpilaskood" value="<?php echo $studentcode_input; ?>">
		<span><?php echo $studentcode_input_error; ?></span>
		<br>
		<br>
		<input type="submit" name="form_submit" value="Registreeru">
    </form>
    <span><?php echo $form_store_notice; ?></span>
	<hr>
    <ul>
		<li><a href="registration_check.php">Registreerumisleht</a></li>
		<li><a href="registration_cancel.php">Registreerumise tühistamine</a></li>
		<li><a href="admin_registration_check.php">Administraatori vaade</></li>
    </ul>
</body>
</html>