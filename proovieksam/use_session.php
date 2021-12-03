<?php
	//alustame sessiooni
    //session_start();
	require_once("classes/SessionManager.class.php");
	SessionManager::sessionStart("vp", 0, "/~kritam/vp2021/", "greeny.cs.tlu.ee");