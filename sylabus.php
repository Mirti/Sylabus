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
  <?php
	echo $_SESSION['test'];
  $polaczenie->close();
  ?>
   
  </body>
</html>