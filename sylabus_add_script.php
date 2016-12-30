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
	
	$nazwa=$_POST['nazwa'];
	$typ_zajec=$_POST['typ_zajec'];
	$sposob_zaliczenia=$_POST['sposob_zaliczenia'];
	$liczba_godzin=$_POST['liczba_godzin'];
	$rocznik_id=$_POST['rocznik_id'];
	$semestr=$_POST['semestr'];
	$ECTS=$_POST['ECTS'];
	
	$sql='INSERT INTO przedmiot (nazwa,rocznik_id,semestr,ECTS,liczba_godzin,sposob_zaliczenia,typ_zajec) VALUES ("'.$nazwa.'",'.$rocznik_id.','.$semestr.','.$ECTS.','.$liczba_godzin.',"'.$sposob_zaliczenia.'","'.$typ_zajec.'")';

	$polaczenie->query($sql);
	$sql='SELECT przedmiot_id FROM przedmiot ORDER BY przedmiot_id desc limit 1';

	$result=	$polaczenie->query($sql);
	$row=mysqli_fetch_assoc($result);
	
	
	$sql='INSERT INTO przedmiot_prowadzacy VALUES('.$row['przedmiot_id'].','.$_SESSION['prowadzacy_id'].')';
	$polaczenie->query($sql);
	$_SESSION['p_id']=$row['przedmiot_id'];

	
		$polaczenie->close();
	header ('Location: sylabus_edit.php');
	
?>

