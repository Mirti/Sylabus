﻿<?php
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
	
?>


<!doctype html>

<html lang="pl">
  <head>
    <meta charset="utf-8">
            <title>Sylabus URz</title>
      <meta name="description" content="Sylabus Uniwersytetu Rzeszowskiego">
        <meta name="author" content="Artur Nykiel, Marcin Mytych">
		<link rel="Shortcut icon" href="http://wiki.psrp.org.pl/images/7/77/Logo_urz_rzeszow.png">

            <link rel="stylesheet" href="css/userpanelcss.css">

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

    <div id="caly_blok">
      <div id="naglowek">Sylabus Uniwersytetu Rzeszowskiego</div>



      <div id="srodek">
	<a href="index.php"><img id="logoimg" src="images/logo-500x500.jpg" alt="Logo Uniwersytetu" height="92" width="92"></a>
          <p id="dane">
            Zalogowany użytkownik:&nbsp;
            <?php
  echo $_SESSION['imie']." ".$_SESSION['nazwisko'];
  ?>
            <br /> <br />
            <a href="logout_script.php">
              <input id="logoffbutton"  class="btn btn-primary" value="Wyloguj" />
            </a>
          </p>

		  
          </br>
          <p id="przedm">
            <b>Twoje przedmioty:</b> <input type="button" style="float:right" class="btn btn-primary" onclick="location.href='sylabus_add.php';" value="Dodaj przedmiot" />
          </p>
          <hr style="border-width: 3px;border-color:black;border-style: inset;"></hr>
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
				echo '<tr> <td><form id="wybor_przedmiotu" action="sylabus_view.php" method="post"><input type="hidden" name="prz_id" value='.$row['przedmiot_id'].'><button class="btn btn-link" type="Submit">'.$row['nazwa'].'</form></td> <td>'.$row['typ_zajec']."</td><td>".$row['rok']."</td><td>".$row['kierunek']."</td><td>".$row['tryb'].'</td><td><form action="sylabus_edit.php" method="post"><input type="hidden" name="p_id" value='.$row['przedmiot_id'].'><input type="image" src="images/edit_icon.png" alt="Submit"/></form></td></tr>';	
			endwhile;
		echo "</tbody>"; 
		$polaczenie->close();
?>
            </table>	




          <script>
            $(document).ready(function(){
            $('#myTable').DataTable({
            "language": {
            "lengthMenu": "Wyświetl _MENU_ wyników",
            "zeroRecords": "Nic nie znaleziono",
            "info": "Strona  _PAGE_ z _PAGES_",
            "infoEmpty": "Brak wyników",
            "search":         "Szukaj:",
            "infoFiltered": "(Wyszukano z _MAX_ rekordów)",
            "paginate": {
            "first":      "Pierwsza",
            "last":       "Ostatnia",
            "next":       "Następna",
            "previous":   "Poprzednia"
            },
            }
            });
            });
          </script>








        </div>




    </div>

  </body>
  <footer class="footer">
    Uniwersytet Rzeszowski <br />Aleja Tadeusza Rejtana 16C,<br /> 35-001 Rzeszów
    <p style="font-size:0.7em">
      tel. + 48 17 872 10 00 (centrala telefoniczna)<br />
      tel/fax: + 48 17 872 12 <a href="https://www.youtube.com/watch?v=OSCiMbMVDLI" style="text-decoration:none; color:white">65</a><br />
      e-mail:<a href="mailto:infor@ur.edu.pl">info@ur.edu.pl</a>
    </p>
  </footer>
</html>