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
	
	$kod=$_POST['kod'];
	$tresc=$_POST['tresc'];
	$przedmiot_id=$_POST['id'];
	
	$sql='INSERT INTO cel (kod,tresc) VALUES ("'.$kod.'","'.$tresc.'")';
	$polaczenie->query($sql);
	$sql='SELECT cel_id FROM cel ORDER BY cel_id desc limit 1';
	$result=	$polaczenie->query($sql);
	$row=mysqli_fetch_assoc($result);
	$sql='INSERT INTO przedmiot_cel VALUES ('.$przedmiot_id.','.$row['cel_id'].')';

	$polaczenie->query($sql);
	$_SESSION['p_id']=$przedmiot_id;
	
		$polaczenie->close();
	header ('Location: sylabus_edit.php');
	
?>

