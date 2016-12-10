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
            <link rel="stylesheet" href="css/kurwa.css">
              <link rel="stylesheet" href="css/tabela.css">

                <!-- butstrap-->
                <!-- Latest compiled and minified CSS -->
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

                  <!-- jQuery library -->
                  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

                  <!-- Latest compiled JavaScript -->
                  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
                  <!-- tabela-->
                  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
                  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
        
</head>



  <body>
  Zalogowany user: 
  <?php
  echo $_SESSION['imie']." ".$_SESSION['nazwisko'];
  ?>
  <br />
  <a href="logout_script.php">Wyloguj</a>
  <br /> <br />
  Twoje przedmioty:
   <table id="myTable" class="table table-hover" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th id="wierszI">Nazwa przedmiotu</th>
              <th id="wierszI">Typ zajęć</th>
              <th id="wierszI">Rok</th>
              <th id="wierszI">Kierunek</th>
              <th id="wierszI">Tryb studiów</th>
			  <th id="wierszI">Edycja</th>
            </tr>
          </thead>

          <tbody>
            <?php

			$sql="SELECT p.przedmiot_id, p.nazwa, p.typ_zajec, n.imie,n.nazwisko, r.rok, r.kierunek, r.tryb FROM przedmiot p, prowadzacy n, rocznik r, wydzial w, przedmiot_prowadzacy pp WHERE r.wydzial_id=w.wydzial_id AND p.rocznik_id=r.rocznik_id and p.przedmiot_id=pp.przedmiot_id AND n.prowadzacy_id=pp.prowadzacy_id AND n.prowadzacy_id=".$_SESSION['prowadzacy_id'];
			$rezultat=@$polaczenie->query($sql);
			while ($row=@mysqli_fetch_assoc($rezultat)):
				echo '<tr> <td> <a href="https://youtu.be/dw3fHh6oZqA?t=51s"> '.$row['nazwa']." </a></td> <td>".$row['typ_zajec']."</td><td>".$row['rok']."</td><td>".$row['kierunek']."</td><td>".$row['tryb'].'</td><td><form action="sylabus.php" method="post"><input type="hidden" name="p_id" value='.$row['przedmiot_id'].'><input type="image" src="images/edit_icon.png" alt="Submit"/></form></td></tr>';	
			endwhile;
		echo "</tbody>"; 
		$polaczenie->close();
?>
          </table>
  
   
   
  </body>
</html>