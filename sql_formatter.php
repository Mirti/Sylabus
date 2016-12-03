<?php

	echo $_POST['wydzial'];
	echo $_POST['kierunek'];
	echo $_POST['prowadzacy'];
	echo "<br />";
	$sql_query="SELECT p.nazwa, p.typ_zajec, n.imie,n.nazwisko FROM przedmiot p, prowadzacy n, przedmiot_prowadzacy pp WHERE";
	
	if (strcmp($_POST['wydzial'],"")!== 0)  $sql_query=$sql_query." wydzial.nazwa=".$_POST['wydzial'];
	echo $sql_query;

?>