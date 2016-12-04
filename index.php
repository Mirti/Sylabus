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
	
?>


<!doctype html>

<html lang="pl">
<head>
  <meta charset="utf-8">
  <title>Super sylabus kurwo</title>
  <meta name="description" content="The HTML5 Herald">
  <meta name="author" content="SitePoint">

  <link rel="stylesheet" href="css/styles.css?v=1.0">
</head>

<body>

<form action="sql_formatter.php" method="post">

<h3>Wybierz wydział: </h3>
<select name="wydzial">
<option value="">---</option>
<?php
    $result = $polaczenie->query("SELECT * FROM wydzial");
    while ($row=mysqli_fetch_assoc($result)):    
       echo "<option value=".$row['nazwa'].">".$row['nazwa']."</option>";
    endwhile;
?>
</select> <br /> <br />

<h3>Wybierz rocznik: </h3>

<select name="rok">
<option value="">---</option>
<?php
    $result = $polaczenie->query("SELECT rok FROM rocznik");
    while ($row=mysqli_fetch_assoc($result)):    
       echo "<option value=".$row['rok'].">".$row['rok']."</option>";
    endwhile;
?>

</select> <br /> <br />

<h3>Wybierz kierunek: </h3>

<select name="kierunek">
<option value="">---</option>
<?php
    $result = $polaczenie->query("SELECT rok,kierunek FROM rocznik");
    while ($row=mysqli_fetch_assoc($result)):    
       echo "<option value=".$row['kierunek'].">".$row['kierunek']."</option>";
    endwhile;
?>

</select> <br /> <br />

<h3>Wybierz prowadzącego:</h3>
<select name="prowadzacy">
<option value="">---</option>
<?php
    $result = $polaczenie->query("SELECT stopien,imie,nazwisko FROM prowadzacy");
    while ($row=mysqli_fetch_assoc($result)):    
       echo "<option value=".$row['imie'].">".$row['stopien']." ".$row['imie']." ".$row['nazwisko']."</option>";
    endwhile;
?>

</select> <br /> <br />
<input type="submit" value="Szukaj"/>
</form>

	<table border=1>
		<th>Nazwa przedmiotu</th>
		<th>Prowadzący</th>
		<th>Typ zajęć</th>
		<th>Rok</th>
		<th>Kierunek</th>
		<th>Tryb studiów</th>

  <?php

			$sql='SELECT * FROM przedmiot';
			$rezultat=$polaczenie->query($_SESSION['sql']);
			while ($row=mysqli_fetch_assoc($rezultat)):
				echo '<tr> <td> <a href="http://onet.pl"> '.$row['nazwa']." </a></td> <td>".$row['imie']." ".$row['nazwisko']."</tr>";	
			endwhile;
		echo "</table>";
		$polaczenie->close();
?>

  
  
</body>
</html>