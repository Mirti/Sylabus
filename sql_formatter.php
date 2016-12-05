<?php
session_start();

	$sql_query="SELECT p.nazwa, p.typ_zajec, n.imie,n.nazwisko, r.rok, r.kierunek, r.tryb FROM przedmiot p, prowadzacy n, rocznik r, wydzial w, przedmiot_prowadzacy pp WHERE r.wydzial_id=w.wydzial_id AND p.rocznik_id=r.rocznik_id and p.przedmiot_id=pp.przedmiot_id AND n.prowadzacy_id=pp.prowadzacy_id ";
	
	if (strcmp($_POST['wydzial'],"")!== 0)  $sql_query=$sql_query."AND w.nazwa=".'"'.$_POST['wydzial'].'" ';
	
	if (strcmp($_POST['kierunek'],"")!== 0)  $sql_query=$sql_query."AND r.kierunek=".'"'.$_POST['kierunek'].'" ';
	
	if (strcmp($_POST['rok'],"")!== 0)  $sql_query=$sql_query."AND r.rok=".'"'.$_POST['rok'].'" ';
	
	if (strcmp($_POST['prowadzacy'],"")!== 0)  $sql_query=$sql_query."AND n.imie=".'"'.$_POST['prowadzacy'].'" ';
	
	echo $sql_query;
	$_SESSION['sql']=$sql_query;
	header('Location: index.php');

?>