<?php
    require_once("../../../config.php");
	require_once("fnc_general.php");
    require("page_header.php");
	require("fnc_registration.php");
	
	//kas püütakse salvestada
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if(isset($_POST["form_submit"])){
			//kontrollin, et andmeid ikka sisestati

			if(!empty($_POST["studentcode_input"])){
				$studentcode_input = filter_var($_POST["studentcode_input"], FILTER_VALIDATE_INT);
				//cancel registration funktsiooniga panna "cancelled" väljale väärtus
			} else {
				$studentcode_input_error = "Palun sisesta üliõpilaskood!";
			}
		}
	}
	
?>
    <h1>Registreeringu tühistamine</h1>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<label for="studentcode_input">Üliõpilaskood</label>
        <input type="number" name="studentcode_input" id="studentcode_input" min="100000" max="999999" placeholder="Üliõpilaskood" value="<?php echo $studentcode_input; ?>">
		<span><?php echo $studentcode_input_error; ?></span>
		<br>
		<br>
		<input type="submit" name="form_submit" value="Tühista registreering">
    </form>
</body>
</html>