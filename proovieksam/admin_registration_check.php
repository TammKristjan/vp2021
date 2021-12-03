<?php
    require_once("../../../config.php");
	require_once("fnc_registration.php");
    require_once("fnc_general.php");
	require("page_header.php");
	$database = "if21_kristjan_tamm";
	
	//EI TÖÖTA
	function list_studentcode(){
		$html = null;
        $conn = new mysqli($GLOBALS["server_host"], $GLOBALS["server_user_name"], $GLOBALS["server_password"], $GLOBALS["database"]);
        $conn->set_charset("utf8");
		$stmt = $conn->prepare("SELECT studentcode FROM vp_party");
		echo $conn->error;
		$stmt->bind_result($studencode_from_db);
		$stmt->execute();
		while($stmt->fetch()){
			$html .= "<li>" .$studencode_from_db ."</li> \n";
		}
		$stmt->close();
        $conn->close();
        return $html;
	}

    if(isset($_POST["payment_submit"])){
        if(isset($_POST["person_input"]) and !empty($_POST["person_input"])){
            $selected_person = filter_var($_POST["person_input"], FILTER_VALIDATE_INT);
        } else {
            $choose_payment_error .= "Isik on valimata! "; 
        }
        
		if(isset($_POST["payment_input"]) and !empty($_POST["payment_input"])){
			$payment = test_input(filter_var($_POST["payment_input"], FILTER_SANITIZE_STRING));
			if(empty($payment)){
				$choose_payment_error .= "Palun sisesta korrektne makse staatus!";
			}
		} else {
			$choose_payment_error .= "Makse staatus on sisestamata!";
		}
        
        if(empty($choose_payment_error)){
            $store_payment_error = payment_submit($selected_person, $payment);
        }   
    }
?>
	<h1>Peo list</h1>
	<?php echo list_registrations(); ?>
    <h1>Makse staatuse muutmine</h1>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="person_input">Isik: </label>
        <select name="person_input" id="person_input">
            <option value="" selected disabled>Vali isik</option>
            <?php echo list_studentcode(); ?>
        </select>
		<select name="payment_input" id="payment_input">
            <option value="" selected disabled>Makse staatus</option>
            <?php echo list_registrations($selected_person); ?>
        </select>
        
        <input type="submit" name="payment_submit" value="Salvesta">
    </form>
    <span><?php echo $store_payment_error; ?></span>
</body>
</html>