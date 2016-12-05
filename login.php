<?php
session_start();
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
  
  

   <form action="login_script.php" method="post">
   Login: <input type="text" name="login"/>  <br /> <br />
   Hasło: <input type="password" name="haslo" /> <br /> <br />
   <input type="submit" value="Zaloguj" />
   </form>
<?php
	if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
?>
   
   
  </body>
</html>