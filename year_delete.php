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
	
	$rocznik_id=$_POST['rocznik_id'];
	$sql='DELETE FROM rocznik WHERE rocznik_id="'.$rocznik_id.'"';
	$polaczenie->query($sql);

	
		$polaczenie->close();
	header ('Location: admin_panel.php');
	
	

	
?>

