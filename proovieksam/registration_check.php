<?php
    require_once("../../../config.php");
	require_once("fnc_general.php");
    require("page_header.php");
	require("fnc_registration.php");
?>
    <h1>Peo list</h1>
	<?php echo list_registrations(); ?>
</body>
</html>