<?php
session_start();
require_once "connect.php";
	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if ($polaczenie->connect_errno!=0)
	{
		echo "Błąd połączenia numer: ".$polaczenie->connect_errno.' <br/> W celu otrzymania pomocy skontaktuj się z administratorem: <a href="mailto:m.mytych@o2.pl">m.mytych@o2.pl</a>';
		exit();
	}
	$polaczenie -> query("SET NAMES 'utf8'");
	
	$imie=$_POST['imie'];
	$nazwisko=$_POST['nazwisko'];
	$stopien=$_POST['stopien'];
	$www=$_POST['www'];
	$email=$_POST['email'];
	$login=$_POST['login'];
	$haslo=$_POST['haslo'];
	$telefon=$_POST['telefon'];
	$prowadzacy_id=$_POST['prowadzacy_id'];

	
	$sql='UPDATE prowadzacy SET imie="'.$imie.'", nazwisko="'.$nazwisko.'", stopien="'.$stopien.'", www="'.$www.'", email="'.$email.'",telefon="'.$telefon.'",login="'.$login.'",password="'.$haslo.'" WHERE prowadzacy_id='.$prowadzacy_id;
	$polaczenie->query($sql);

	$polaczenie->close();
	header ('Location: admin_panel.php');
	
?>

