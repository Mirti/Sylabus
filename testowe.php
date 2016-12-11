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
        <img id="logoimg" src="images/logo-500x500.jpg" alt="Logo Uniwersytetu" height="92" width="92">



          <?php
	$id=$_POST['p_id'];
	$sql= 'SELECT * FROM przedmiot p, efekt e, przedmiot_efekt pe, rocznik r WHERE p.przedmiot_id=pe.przedmiot_id AND p.rocznik_id=r.rocznik_id AND e.efekt_id=pe.efekt_id AND p.przedmiot_id='.$id;
	$rezultat= $polaczenie->query($sql);
	$wynik=mysqli_fetch_assoc($rezultat);
  ?>
          <form action="save_to_db.php" method="post">
            <?php
echo	'Nazwa przedmiotu: <input type="text" value="'.$wynik['nazwa'].'"/> <br /> <br />';
echo	'Typ zajęć: <select><option value="'.$wynik['typ_zajec'].'"/></select> <br /> <br />';
echo	'Kierunek: <input type="text" value="'.$wynik['kierunek'].'"/> <br /> <br />';
echo	'Rok: <input type="text" value="'.$wynik['rok'].'"/> <br /> <br />';
echo	'Liczba godzin: <input type="text" value="'.$wynik['liczba_godzin'].'"/> <br /> <br />';
echo	'Sposób zaliczenia: <input type="text" value="'.$wynik['sposob_zaliczenia'].'"/> <br /> <br />';
echo	'ECTS: <input type="text" value="'.$wynik['ECTS'].'"/> <br /> <br />';
	?>
            <input type="button" onclick="location.href='user_panel.php';" value="Powrót" />
            <input type="submit" value="Zapisz zmiany" />

          </form>
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