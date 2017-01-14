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
		if(!isset($_SESSION['zalogowany'])) header('Location:index.php');
	
	$kierunek=$_POST['kierunek'];
	$rok=$_POST['rok'];
	$rocznik_id=$_POST['rocznik_id'];
	$wydzial_id=$_POST['wydzial_id'];
	$tryb=$_POST['tryb'];
	$opiekun=$_POST['opiekun'];

	
	$sql='UPDATE rocznik SET kierunek="'.$kierunek.'", rok="'.$rok.'", tryb="'.$tryb.'", wydzial_id='.$wydzial_id.', opiekun="'.$opiekun.'" WHERE rocznik_id='.$rocznik_id;
	$polaczenie->query($sql);
	$polaczenie->close();
	header ('Location: admin_panel.php');
	
?>

