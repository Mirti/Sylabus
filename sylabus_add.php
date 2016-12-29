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
	$id=@$_POST['p_id']; //USUNĄĆ!!!
	$_SESSION['edit_id']=$id;
	$sql= 'SELECT * FROM przedmiot p, efekt e, przedmiot_efekt pe, rocznik r WHERE p.przedmiot_id=pe.przedmiot_id AND p.rocznik_id=r.rocznik_id AND e.efekt_id=pe.efekt_id AND p.przedmiot_id='.$id;
	$rezultat= $polaczenie->query($sql);
	$wynik=@mysqli_fetch_assoc($rezultat); //USUNĄĆ
  ?>
          <form action="save_to_db.php" method="post">

            <table>
              <tr>
                <td>Nazwa przedmiotu:</td>
                <td colspan="2">
                  <?php echo	'<input type="text" name="nazwa" class="form-control" value="'.$wynik['nazwa'].'"/> <br /> <br />'; ?>
                </td>
                <td>Kierunek: </td>
                <td colspan="2">
                  <?php echo	'<input type="text" name="kierunek" class="form-control" value="'.$wynik['kierunek'].'"/> <br /> <br />';?>
                </td>
                <td>&nbsp;Typ zajęć: &nbsp;</td>
                <td colspan="2">
                  <?php echo	'<select name="typ_zajec" class="selectpicker" name="typ_zajec" style="height:50%;width:100%;margin-top:5%;margin-bottom:-10%;"><option value='.$wynik['typ_zajec'].'>'.$wynik['typ_zajec'].'</option><option value="wykład">wykład</option><option value="ćwiczenia">ćwiczenia</option><option value="labolatorium">labolatorium</option><option value="seminarium">seminarium</option></select> <br /> <br />'; ?>
                </td>
              </tr>
              <tr>
                <td>&nbsp;&nbsp;&nbsp;Sposób zaliczenia: &nbsp;&nbsp;</td>
                <td colspan="2">
                  <?php echo	'<select name="sposob_zaliczenia" class="selectpicker" style="height:50%;width:100%;margin-top:5%;margin-bottom:-10%;"><option value='.$wynik['sposob_zaliczenia'].'>'.$wynik['sposob_zaliczenia'].'</option><option value="egzamin">egzamin</option><option value="ocena">ocena</option><option value="zaliczenie">zaliczenie</option></select> <br /> <br />'; ?>
                </td>
                <td>&nbsp;&nbsp;Liczba godzin: &nbsp;&nbsp;</td>
                <td colspan="2">
                  <?php echo	'<input type="text" class="form-control" name=liczba_godzin value="'.$wynik['liczba_godzin'].'"/> <br /> <br />';?>
                </td>
                <td>Rok: </td>
                <td colspan="2">
                  <?php echo	'<input type="text" class="form-control" name=rok value="'.$wynik['rok'].'"/> <br /> <br />'; ?>
                </td>
              </tr>
              <tr>
                <td>ECTS: </td>
                <td colspan="2">
                <?php echo	'<input type="text" class="form-control" name=ECTS value="'.$wynik['ECTS'].'"/> <br /> <br />'; ?></td>
                <td></td>
                <td colspan="2">
                  <input type="button" style="width:100%;" class="btn btn-primary" onclick="location.href='user_panel.php';" value="Powrót" />
                </td>
                <td></td>

                <td colspan="2">
                  <input type="submit" style="width:100%;" class="btn btn-primary" value="Zapisz zmiany" />
                </td>
              </tr>
            </table>
			 </form>
        <table class="table table-hover table-bordered" >
          <th class="info">
            EK<br />(Efekt Kształcenia)
          </th>
          <th class="info">Treść efektu kształcenia zdefiniowanego dla przedmiotu (modułu)</th>
          <th class="info">
            Odniesienie do efektów  kierunkowych <br />(KEK)
          </th>
          <th class="info">&nbsp;&nbsp;Dodaj</th>


          <form action="add_effect.php" method="post">
	<tr>
		<td><input style="height:50%;width:100%;margin-top:0.5%;margin-bottom:-10%;" class="form-control" type="text" name="nazwa" /></td>
    <td><input style="height:50%;width:100%;margin-top:0.5%;margin-bottom:-10%;" class="form-control" type="text" name="nazwa" /></td>
    <td><input style="height:50%;width:100%;margin-top:0.5%;margin-bottom:-10%;" class="form-control" type="text" name="nazwa" /></td>
    <td><input type="submit" class="btn btn-primary" value="Dodaj" /></td>
	</tr>
	</form>
						
	</table>
          <?php
  $polaczenie->close();
  ?>


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