<?php 
	require_once "./config/configGeneral.php";
	require_once "./controllers/viewsController.php";

	$ViewTemplate=new viewsController();
	$ViewTemplate->get_template();