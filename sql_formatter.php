<?php
session_start();

	echo $_POST['wydzial'];
	echo $_POST['kierunek'];
	echo $_POST['prowadzacy'];
	echo "<br />";
	$sql_query="SELECT p.nazwa, p.typ_zajec, n.imie,n.nazwisko FROM przedmiot p, prowadzacy n, przedmiot_prowadzacy pp WHERE";
	
	if (strcmp($_POST['wydzial'],"")!== 0)  $sql_query=$sql_query." wydzial.nazwa=".$_POST['wydzial'];
	
	if (strcmp($_POST['kierunek'],"")!== 0)  $sql_query=$sql_query." rocznik.nazwa=".$_POST['kierunek'];
	
	if (strcmp($_POST['prowadzacy'],"")!== 0)  $sql_query=$sql_query." prowadzacy.imie=".$_POST['prowadzacy'];
	echo $sql_query;
	$_SESSION['sql']=$sql_query;
	header('Location: index.php');

?>