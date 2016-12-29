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
	
	$przedmiot_id=$_POST['przedmiot_id'];
	$efekt_id=$_POST['efekt_id'];
	$sql='DELETE FROM przedmiot_efekt WHERE przedmiot_id='.$przedmiot_id.' AND efekt_id='.$efekt_id;
	$polaczenie->query($sql);
	$_SESSION['p_id']=$przedmiot_id;
	
		$polaczenie->close();
	header ('Location: sylabus_edit.php');
	
	

	
?>

