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
	
	$literatura=$_POST['literatura'];
	$przedmiot_id=$_POST['id'];
	
	$sql='SELECT * from literatura WHERE przedmiot_id='.$przedmiot_id;
	$result=$polaczenie->query($sql);
	if (is_null(mysqli_fetch_assoc($result))) $sql='INSERT INTO literatura(przedmiot_id,tresc) VALUES ('.$przedmiot_id.',"'.$literatura.'")';
	else  $sql='UPDATE literatura SET tresc="'.$literatura.'" WHERE przedmiot_id='.$przedmiot_id;
	echo $sql;
	$polaczenie->query($sql);

	$_SESSION['p_id']=$przedmiot_id;
	
	$polaczenie->close();
	header ('Location: sylabus_edit.php');
	
?>

