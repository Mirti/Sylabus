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

            <link rel="stylesheet" href="css/logincss.css">

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
      <div id="naglowek">Sylabus Uniwersytetu Rzeszowskiego - Logowanie</div>

      <div id="srodek">
        <form action="login_script.php" method="post">
          <table id="logtab" class="table table-hover" cellspacing="0" width="30%">

            <tr>
              <th colspan="2" style="font-size: 1.4em;line-height: 1.5em" >Logowanie</th>
            </tr>
            <tr>
              <td>Login: </td>
              <td>
                <input id="logtext" type="text" class="form-control" name="login" />
              </td>
            </tr>
            <tr>
              <td>Hasło: </td>
              <td>
                <input id="logtext" type="password" class="form-control" name="haslo" />
              </td>
            </tr>
            <tr>
              <td></td>
              <td>
                <input id="logtext" type="submit" class="btn btn-primary" value="Zaloguj" />
              </td>
            </tr>


          </table>

        </form>



        <?php
	if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
?>

      </div>
    </div>
  </body>
  <footer class="footer" style="bottom:0px;width: 100%;background-color:#071778;text-align: center;font-size: 1.4em;line-height: 1.5em;color: #f1f1f1;">
    Aleja Tadeusza Rejtana 16C, 35-001 Rzeszów
  </footer>
</html>