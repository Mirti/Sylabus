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

            <link rel="stylesheet" href="css/glowny.css">

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
        <img src="images/logo-500x500.jpg" alt="Logo Uniwersytetu" height="92" width="92">
          
        <form action="sql_formatter.php" method="post">
          </br>
          </br>
          <table id="formularz">
            <thead>
              <tr>
                <td>Wybierz wydział:</td>
                <td colspan="5">
                  <select name="wydzial" class="form-control" id="lista">
                    <option value="">---</option>
                    <?php
    $result = $polaczenie->query("SELECT * FROM wydzial");
    while ($row=mysqli_fetch_assoc($result)):    
       echo "<option value=".$row['nazwa'].">".$row['nazwa']."</option>";
    endwhile;
?>
                  </select>
                </td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  Wybierz rocznik:
                </td>
                <td colspan="2">
                  <select name="rok" class="form-control" id="lista">
                    <option value="">---</option>
                    <?php
    $result = $polaczenie->query("SELECT rok FROM rocznik");
    while ($row=mysqli_fetch_assoc($result)):    
       echo "<option value=".$row['rok'].">".$row['rok']."</option>";
    endwhile;
?>
                  </select>
                </td>
                <td>Wybierz kierunek:</td>
                <td colspan="2">
                  <select name="kierunek" class="form-control" id="lista">
                    <option value="">---</option>
                    <?php
    $result = $polaczenie->query("SELECT rok,kierunek FROM rocznik");
    while ($row=mysqli_fetch_assoc($result)):    
       echo "<option value=".$row['kierunek'].">".$row['kierunek']."</option>";
    endwhile;
?>

                  </select>
                </td>

              </tr>
              <tr>
                <td>Wybierz prowadzącego:</td>
                <td colspan="2">
                  <select class="form-control" id="lista" name="prowadzacy" >
                    <option value="">---</option>
                    <?php
    $result = $polaczenie->query("SELECT stopien,imie,nazwisko FROM prowadzacy");
    while ($row=mysqli_fetch_assoc($result)):    
       echo "<option value=".$row['imie'].">".$row['stopien']." ".$row['imie']." ".$row['nazwisko']."</option>";
    endwhile;
?>

                  </select>
                </td>
                <td></td>
                <td colspan="2"></td>
              </tr>
              <tr>
                <td colspan="4"></td>
                <td colspan="2">
                  <input type="submit" style="width:100%;" class="btn btn-primary" value="Szukaj"/>
                </td>
              </tr>
            </tbody>
          </table>

        </form>


        </br>
        </br>
        <table id="myTable" class="table table-hover" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th id="wierszI">Nazwa przedmiotu</th>
              <th id="wierszI">Prowadzący</th>
              <th id="wierszI">Typ zajęć</th>
              <th id="wierszI">Rok</th>
              <th id="wierszI">Kierunek</th>
              <th id="wierszI">Tryb studiów</th>
            </tr>
          </thead>

          <tbody>
            <?php

			$rezultat=@$polaczenie->query($_SESSION['sql']);
			while ($row=@mysqli_fetch_assoc($rezultat)):
				echo '<tr> <td> <a href="https://youtu.be/dw3fHh6oZqA?t=51s"> '.$row['nazwa']." </a></td> <td>".$row['imie']." ".$row['nazwisko']."<td>".$row['typ_zajec']."</td><td>".$row['rok']."</td><td>".$row['kierunek']."</td><td>".$row['tryb']."</td></tr>";	
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
  <footer class="footer" style="bottom:0;width: 100%;background-color:#071778;text-align: center;font-size: 1.4em;line-height: 1.5em;color: #f1f1f1;">
    Aleja Tadeusza Rejtana 16C, 35-001 Rzeszów
  </footer>
</html>