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
	
	$nazwa=$_POST['nazwa'];
	$kierunek=$_POST['kierunek'];
	$typ_zajec=$_POST['typ_zajec'];
	$sposob_zaliczenia=$_POST['sposob_zaliczenia'];
	$liczba_godzin=$_POST['liczba_godzin'];
	$rok=$_POST['rok'];
	$ECTS=$_POST['ECTS'];
	
	$sql='UPDATE przedmiot SET nazwa="'.$nazwa.'", typ_zajec="'.$typ_zajec.'", sposob_zaliczenia="'.$sposob_zaliczenia.'",liczba_godzin='.$liczba_godzin.',ECTS='.$ECTS.' WHERE przedmiot_id='.$_SESSION['edit_id'];
	$polaczenie->query($sql);
		$polaczenie->close();
	header ('Location: user_panel.php');
	
	

	
?>

