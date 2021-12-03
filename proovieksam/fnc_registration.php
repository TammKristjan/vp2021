<?php 
    $database = "if21_kristjan_tamm";
    
	function store_form($firstname_input, $lastname_input, $studentcode_input, $payment, $cancelled){
		$notice = null;
        $conn = new mysqli($GLOBALS["server_host"], $GLOBALS["server_user_name"], $GLOBALS["server_password"], $GLOBALS["database"]);
        $conn->set_charset("utf8");
		$stmt = $conn->prepare("SELECT id FROM vp_party WHERE studentcode = ?");
		$stmt->bind_param("i", $studentcode_input);
		$stmt->bind_result($id_from_db);
		$stmt->execute();
		if($stmt->fetch()){
			//kasutaja juba olemas
			$notice = "Sellise üliõpilaskoodiga (" .$studentcode_input .") registreering <strong>on juba tehtud</strong>!";
		} else {
			//sulgen eelmise käsu
			$stmt->close();
			$stmt = $conn->prepare("INSERT INTO vp_party (firstname, lastname, studentcode, payment, cancelled) VALUES(?,?,?,?,?)");
			echo $conn->error;
			
			//krüpteerime üliõpilaskoodi
			//$option = ["cost" => 12];
			//$pwd_hash = password_hash($studentcode, PASSWORD_BCRYPT, $option);
			
			$stmt->bind_param("ssiis", $firstname_input, $lastname_input, $studentcode_input, $payment, $cancelled);
			
			if($stmt->execute()){
				$notice = "Salvestamine õnnestus!";
			} else {
				$notice = "Salvestamisel tekkis viga: " .$stmt->error;
			}
        }
        $stmt->close();
        $conn->close();
        return $notice;
    }
	
	//EI TÖÖTA
	function cancel_registration($studentcode_input){
		$notice = null;
        $conn = new mysqli($GLOBALS["server_host"], $GLOBALS["server_user_name"], $GLOBALS["server_password"], $GLOBALS["database"]);
        $conn->set_charset("utf8");
		$stmt = $conn->prepare("SELECT id FROM vp_party WHERE studentcode = ?");
		$stmt->bind_param("i", $studentcode_input);
		$stmt->bind_result($id_from_db);
		$stmt->execute();
		if($stmt->fetch()){
			//sulgen eelmise käsu
			$stmt->close();
			$stmt = $conn->prepare("INSERT INTO vp_party (cancelled) VALUES(?)");
			echo $conn->error;
			$stmt->bind_param("d", $cancelled);
			
			if($stmt->execute()){
				$notice = "Salvestamine õnnestus!";
			} else {
				$notice = "Salvestamisel tekkis viga: " .$stmt->error;
			}
			
		} else {
			//kasutaja olemas
			$notice = "Sellise üliõpilaskoodiga (" .$studentcode_input .") registreeringut <strong>ei leitud</strong>!";
        }
        $stmt->close();
        $conn->close();
        return $notice;
    }
	
	function list_registrations(){
		$html = null;
        $conn = new mysqli($GLOBALS["server_host"], $GLOBALS["server_user_name"], $GLOBALS["server_password"], $GLOBALS["database"]);
        $conn->set_charset("utf8");
		$stmt = $conn->prepare("SELECT firstname, lastname, payment, cancelled FROM vp_party");
		echo $conn->error;
		$stmt->bind_result($firstname_from_db, $lastname_from_db, $payment_from_db, $cancelled_from_db);
		$stmt->execute();
		while($stmt->fetch()){
			if(empty($cancelled_from_db)){
				if($payment_from_db == 0) {
					$payment_info = "<strong> Maksmata </strong>";
				} else {
					$payment_info = "<strong> Makstud </strong>";
				}
				$html .= "<li>" .$firstname_from_db ." " .$lastname_from_db ." " .$payment_info ." " .$cancelled_from_db;
			} else {
				$html .= "<li>" .$firstname_from_db ." " .$lastname_from_db ." " .$payment_info ." " ."<strong>TÜHISTATUD</strong>";
			}
			$html .= "</li> \n";
		}
		if(empty($html)){
			$html = "<p>Info puudub.</p> \n";
		} else {
            $html = "<ul> \n" .$html ."</ul> \n";
        }
		$stmt->close();
        $conn->close();
        return $html;
	}