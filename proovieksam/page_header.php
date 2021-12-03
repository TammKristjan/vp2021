<?php
    $css_color = null;
    //<style>
    //  body {
    //     background-color: #FFFFFF;
    //     color: #000000;
    //  }
    //</style>
    $css_color .= "<style> \n";
    $css_color .= "body { \n";
    $css_color .= "\t background-color: " .'background-color: #FFFFFF;' ."; \n";
    $css_color .= "\t color: " .'color: #000000;' ."; \n";
    $css_color .= "} \n";
    $css_color .= "</style> \n";
?>
<!DOCTYPE html>
<html lang="et">
<head>
	<meta charset="utf-8">
    <?php
        echo $css_color;
        if(isset($to_head) and !empty($to_head)){
            echo $to_head;
        }
    ?>
</head>
<body>
    <img src="./pics/vp_banner.png" alt="veebiprogrammeerimise lehe bänner">