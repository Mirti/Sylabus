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

          <link rel="stylesheet" href="css/styles.css?v=1.0">
            <link rel="stylesheet" href="css/sylabuscss_add.css">
              

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
  ?>
          <form action="sylabus_add_script.php" method="post">

            <table>
              <tr>
                <td>Nazwa przedmiotu:</td>
                <td colspan="2">
                  <?php echo	'<input type="text" name="nazwa" class="form-control"/> <br /> <br />'; ?>
                </td>
               
                <td>&nbsp;Typ zajęć: &nbsp;</td>
                <td colspan="2">
                  <?php echo	'<select name="typ_zajec" class="form-control" name="typ_zajec" style="height:50%;width:100%;margin-top:5%;margin-bottom:-10%;"><option value="wykład">wykład</option><option value="ćwiczenia">ćwiczenia</option><option value="labolatorium">labolatorium</option><option value="seminarium">seminarium</option></select> <br /> <br />'; ?>
                </td>
				 <td>&nbsp;&nbsp;Rocznik: </td>
                <td colspan="2">
				<select name="rocznik_id" class="form-control"
                   <?php
				$result = $polaczenie->query("SELECT * FROM rocznik");
				while ($row=mysqli_fetch_assoc($result)):    
				echo "<option value=".$row['rocznik_id'].">".$row['rok'].' '.$row['kierunek'].' '.$row['tryb']."</option>";
				endwhile;
?>
                </td>
              </tr>
              <tr>
                <td>Sposób zaliczenia: &nbsp;&nbsp;</td>
                <td colspan="2">
                  <?php echo	'<select name="sposob_zaliczenia" class="form-control" style="height:50%;width:100%;margin-top:5%;margin-bottom:-10%;"><option value="egzamin">egzamin</option><option value="ocena">ocena</option><option value="zaliczenie">zaliczenie</option></select> <br /> <br />'; ?>
                </td>
                <td>&nbsp;&nbsp;Liczba godzin: &nbsp;&nbsp;</td>
                <td colspan="2">
                  <?php echo	'<input type="text" class="form-control" name=liczba_godzin /> <br /> <br />';?>
                </td>
				 <td>&nbsp;&nbsp;Semestr: </td>
                <td colspan="2">
                  <?php echo	'<input type="text" class="form-control" name=semestr /> <br /> <br />'; ?>
                </td>
           
              </tr>
              <tr>
                <td>ECTS: </td>
                <td colspan="2">
                <?php echo	'<input type="text" class="form-control" name=ECTS /> <br /> <br />'; ?></td>

                <td></td>
                <td colspan="2">
                  <input type="button" style="width:100%;float:right;" class="btn btn-primary" onclick="location.href='user_panel.php';" value="Powrót" />
                </td>

                <td colspan="2">
                  <input type="submit" style="width:65%;float:right;" class="btn btn-primary" value="Dodaj przedmiot" />
                </td>
              </tr>
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