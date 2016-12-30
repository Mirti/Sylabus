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
          <title>Sylabus URz</title>
      <meta name="description" content="Sylabus Uniwersytetu Rzeszowskiego">
        <meta name="author" content="Artur Nykiel, Marcin Mytych">
		<link rel="Shortcut icon" href="http://wiki.psrp.org.pl/images/7/77/Logo_urz_rzeszow.png">

          <link rel="stylesheet" href="css/styles.css?v=1.0">
            <link rel="stylesheet" href="css/sylabuscss.css">

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
         <a href="index.php"><img src="images/logo-500x500.jpg" alt="Logo Uniwersytetu" height="92" width="92"></a>



          <?php
	$id=$_POST['prz_id'];
	$sql= 'SELECT * FROM przedmiot p, efekt e, przedmiot_efekt pe, rocznik r WHERE p.przedmiot_id=pe.przedmiot_id AND p.rocznik_id=r.rocznik_id AND e.efekt_id=pe.efekt_id AND p.przedmiot_id='.$id;
	$rezultat= $polaczenie->query($sql);
	$wynik=mysqli_fetch_assoc($rezultat);
  ?>
          <form action="save_to_db.php" method="post">

            <table>
              <tr>
                <td>Nazwa przedmiotu:</td>
                <td colspan="2">
                  <?php echo	'<input type="text"  class="form-control" value="'.$wynik['nazwa'].'"  readonly/> <br /> <br />'; ?>
                </td>
                <td>Kierunek: </td>
                <td colspan="2">
                  <?php echo	'<input type="text"  class="form-control" value="'.$wynik['kierunek'].'" readonly/> <br /> <br />';?>
                </td>
                <td>&nbsp;Typ zajęć: &nbsp;</td>
                <td colspan="2">
                 <?php echo	'<input type="text"  class="form-control" value="'.$wynik['typ_zajec'].'" readonly/> <br /> <br />';?>
                </td>
              </tr>
              <tr>
                <td>&nbsp;&nbsp;&nbsp;Sposób zaliczenia: &nbsp;&nbsp;</td>
                <td colspan="2">
                 <?php echo	'<input type="text" class="form-control" value="'.$wynik['sposob_zaliczenia'].'" readonly/> <br /> <br />';?>
                </td>
                <td>&nbsp;&nbsp;Liczba godzin: &nbsp;&nbsp;</td>
                <td colspan="2">
                  <?php echo	'<input type="text" class="form-control"  value="'.$wynik['liczba_godzin'].'" readonly/> <br /> <br />';?>
                </td>
                <td>Rok: </td>
                <td colspan="2">
                  <?php echo	'<input type="text" class="form-control"  value="'.$wynik['rok'].'" readonly/> <br /> <br />'; ?>
                </td>
              </tr>
              <tr>
                <td>ECTS: </td>
                <td colspan="2">
                <?php echo	'<input type="text" class="form-control"  value="'.$wynik['ECTS'].'" readonly/> <br /> <br />'; ?></td>
                <td></td>
                <td colspan="2">
                  <input type="button" style="width:100%;" class="btn btn-primary" onclick="location.href='index.php';" value="Powrót" />
                </td>
				<td colspan="2">
					<input type="button" class="btn btn-primary" onclick="location.href='matryca.xls';" value="Matryca" />
				</td>
              </tr>

			          <!-- pierwsza tabela-->


        <table class="table table-hover table-bordered" >
          <th class="info">
            EK<br />(Efekt Kształcenia)
          </th>
          <th class="info">Treść efektu kształcenia zdefiniowanego dla przedmiotu (modułu)</th>
          <th class="info">
            Odniesienie do efektów  kierunkowych <br />(KEK)
          </th>
          <?php
    $result = $polaczenie->query("SELECT e.efekt_id, e.kod, e.opis, e.KEK FROM efekt e, przedmiot p, przedmiot_efekt pe WHERE p.przedmiot_id=pe.przedmiot_id AND e.efekt_id=pe.efekt_id AND p.przedmiot_id=".$id);
	while ($row=mysqli_fetch_assoc($result)): 
		
       echo '<form action="effect_delete.php" method="post"><input type="hidden" name="przedmiot_id" value='.$id.'><input type="hidden" name="efekt_id" value='.$row['efekt_id'].'><tr><td>'.$row['kod'].'<td>'.$row['opis'].'</td><td>'.$row['KEK'].'</td></tr></form>';
    endwhile;
	?>
        

        </table>

        <!-- druga tabela-->
        <br />
        <br />
        <br />
        <br />



        <table class="table table-hover table-bordered" >
          <th class="info" style="font-size:120%;">Nazwa</th>
          <th class="info" style="font-size:120%;">Sposób sprawdzenia</th>
          <?php
    $result = $polaczenie->query("SELECT w.wymaganie_id,w.nazwa, w.sposob_sprawdzenia, w.przedmiot_id FROM wymaganie w, przedmiot p WHERE p.przedmiot_id=w.przedmiot_id AND w.przedmiot_id=".$id);
	while ($row=mysqli_fetch_assoc($result)): 
       echo '<form action="requirement_delete.php" method="post"><input type="hidden" name="przedmiot_id" value='.$id.'><input type="hidden" name="wymaganie_id" value='.$row['wymaganie_id'].'><tr><td>'.$row['nazwa'].'<td>'.$row['sposob_sprawdzenia'].'</td></tr></form>';
    endwhile;
	?>
 

        </table>

        <br />
        <br />
        <br />

        <!-- trzecia tabela-->

        <table class="table table-hover table-bordered" >
          <th class="info" style="font-size:120%;">Treść programowa</th>
          <?php
    $result = $polaczenie->query("SELECT t.tresc_id,t.opis FROM tresc t, przedmiot p WHERE p.przedmiot_id=t.przedmiot_id AND t.przedmiot_id=".$id);
	while ($row=mysqli_fetch_assoc($result)): 
       echo '<form action="content_delete.php" method="post"><input type="hidden" name="przedmiot_id" value='.$id.'><input type="hidden" name="tresc_id" value='.$row['tresc_id'].'><tr><td>'.$row['opis'].'</td></tr></form>';
    endwhile;
	?>

        </table>
          <?php
  $polaczenie->close();
  ?>


        </div>
      


    </div>

  </body>
  <footer class="footer" style="bottom:0px;width: 100%;background-color:#071778;text-align: center;font-size: 1.4em;line-height: 1.5em;color: #c8c8c8;">
    Aleja Tadeusza Rejtana 16C, 35-001 Rzeszów
  </footer>
</html>