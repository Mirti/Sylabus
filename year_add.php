﻿<?php
session_start();
require_once "connect.php";
	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if ($polaczenie->connect_errno!=0)
	{
		echo "Błąd połączenia numer: ".$polaczenie->connect_errno.' <br/> W celu otrzymania pomocy skontaktuj się z administratorem: <a href="mailto:m.mytych@o2.pl">m.mytych@o2.pl</a>';
		exit();
	}
	$polaczenie -> query("SET NAMES 'utf8'");
		if(!isset($_SESSION['zalogowany'])) header('Location:index.php');
	
	$kierunek=$_POST['kierunek'];
	$rok=$_POST['rok'];
	$tryb=$_POST['tryb'];
	$wydzial_id=$_POST['wydzial'];
	$opiekun=$_POST['opiekun'];

	
	$sql='INSERT INTO rocznik (kierunek,rok,tryb,wydzial_id,opiekun) VALUES ("'.$kierunek.'","'.$rok.'","'.$tryb.'",'.$wydzial_id.',"'.$opiekun.'")';
	$polaczenie->query($sql);
	$polaczenie->close();
	header ('Location: admin_panel.php');
	
?>

