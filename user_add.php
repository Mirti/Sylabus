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




          <form action="user_add_script.php" method="post">

            <table>
              <tr>
                <td>Imię:</td>
                <td colspan="2">
                  <?php echo	'<input type="text" name="imie" class="form-control" /> <br /> <br />'; ?>
                </td>
               
                <td>&nbsp;Nazwisko: &nbsp;</td>
                <td colspan="2">
				<?php echo	'<input type="text" name="nazwisko" class="form-control" /> <br /> <br />'; ?>
                </td>
				 <td>&nbsp;Stopień: </td>
                <td colspan="2">
				<?php echo	'<input type="text" name="stopien" class="form-control" /> <br /> <br />'; ?>
				</td>
              </tr>
              <tr>
                <td>E-mail: &nbsp;&nbsp;</td>
                <td colspan="2">
                 <?php echo '<input type="text" name="email" class="form-control" /> <br /> <br />'; ?>
                </td>
                <td>&nbsp;Telefon: &nbsp;&nbsp;</td>
                <td colspan="2">
                  <?php echo	'<input type="text" class="form-control" name=telefon /> <br /> <br />';?>
                </td>
				 <td>&nbsp;WWW: </td>
                <td colspan="2">
                  <?php echo	'<input type="text" class="form-control" name=www /> <br /> <br />'; ?>
                </td>
           
              </tr>
              <tr>
                <td>Login: </td>
                <td colspan="2">
                <?php echo	'<input type="text" class="form-control" name=login /> <br /> <br />'; ?></td>
				<td>&nbsp;Hasło: </td>
                <td colspan="2">
                <?php echo	'<input type="text" class="form-control" name=haslo /> <br /> <br />'; ?></td>
 
                <td colspan="2">
                  
                </td>
                <td>
                  <input type="button" style="width:40%;float:left;" class="btn btn-primary" onclick="location.href='admin_panel.php';" value="Powrót" />
                  <input type="submit" style="width:40%;float:right;" class="btn btn-primary" value="Dodaj" />
                </td>

                <td colspan="2">
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