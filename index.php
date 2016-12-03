<?php
require_once "connect.php";
	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	if ($polaczenie->connect_errno!=0)
	{
		echo "Błąd połączenia numer: ".$polaczenie->connect_errno.' <br/> W celu otrzymania pomocy skontaktuj się z administratorem: <a href="mailto:m.mytych@o2.pl">m.mytych@o2.pl</a>';
		exit();
	}
?>


<!doctype html>

<html lang="pl">
<head>
  <meta charset="utf-8">
  <title>The HTML5 Herald</title>
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

<h3>Wybierz kierunek: </h3>

<select name="kierunek">
<option value="">---</option>
<?php
    $result = $polaczenie->query("SELECT rok,kierunek FROM rocznik");
    while ($row=mysqli_fetch_assoc($result)):    
       echo "<option value=".$row['kierunek'].">".$row['rok']." ".$row['kierunek']."</option>";
    endwhile;
?>

</select> <br /> <br />

<h3>Wybierz prowadzącego:</h3>
<select name="prowadzacy">
<option value="">---</option>
<?php
    $result = $polaczenie->query("SELECT stopien,imie,nazwisko FROM prowadzacy");
    while ($row=mysqli_fetch_assoc($result)):    
       echo "<option value=".$row['nazwisko'].">".$row['stopien']." ".$row['imie']." ".$row['nazwisko']."</option>";
    endwhile;
?>

</select> <br /> <br />
<input type="submit" value="Szukaj"/>
</form>

	<table>
		<th>Nazwa przedmiotu</th>
		<th>Prowadzący</th>
		<th>Kierunek</th>
		<th>Semestr</th>

  <?php

			$sql='SELECT * FROM przedmiot';
			$rezultat=$polaczenie->query($sql);
			while ($row=mysqli_fetch_assoc($rezultat)):
				echo "<tr> <td> ".$row['nazwa']." </td></tr>";	
			endwhile;
		echo "</table>";
		$polaczenie->close();
?>

  
  
</body>
</html>