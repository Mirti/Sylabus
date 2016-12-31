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



         <table border=1>
			<th>Imię</th>
			<th>Nazwisko</th>
			<th>Stopień</th>
			<th>Login</th>
			<th>Edytuj/Dodaj</th>
			
			 <?php
    $result = $polaczenie->query("SELECT * FROM prowadzacy");
	while ($row=mysqli_fetch_assoc($result)): 
       echo '<form action="user_edit.php" method="post"><input type="hidden" name="prowadzacy_id" value='.$row['prowadzacy_id'].'><tr><td>'.$row['imie'].'</td><td>'.$row['nazwisko'].'</td><td>'.$row['stopien'].'</td><td>'.$row['login'].'</td><td><input type="submit" value="Edytuj"</td></tr></form>';
    endwhile;
	?>		
		 </table>
		 <form action="user_add.php">
			<input type="submit" class="btn btn-primary" value="Dodaj" />
		 </form>
		 
		 
		 <!-- tabela 2 -->
		 
		          <table border=1>
			<th>Kierunek</th>
			<th>Rok</th>
			<th>Tryb</th>
			<th>Wydział</th>
			<th>Opiekun</th>
			<th>Edytuj/Dodaj</th>
			
			 <?php
    $result = $polaczenie->query("SELECT * FROM rocznik r,wydzial w WHERE r.wydzial_id=w.wydzial_id");
	while ($row=mysqli_fetch_assoc($result)): 
       echo '<form action="year_edit.php" method="post"><input type="hidden" name="rocznik_id" value='.$row['rocznik_id'].'><tr><td>'.$row['kierunek'].'</td><td>'.$row['rok'].'</td><td>'.$row['tryb'].'</td><td>'.$row['nazwa'].'</td><td>'.$row['opiekun'].'</td><td><input type="submit" value="Edytuj"</td></tr></form>';
    endwhile;
	?>		
	<form action="year_add.php" method="post">
            <tr>
              <td>
                <input type="text" name="kierunek" />
              </td>
			   <td>
                <select name="rok">
					<option value="I">I</option>
					<option value="II">II</option>
					<option value="III">III</option>
					<option value="IV">IV</option>
					<option value="V">V</option>
				</select>
              </td>
			  <td>
                <select name="tryb">
					<option value="stacjonarne">stacjonarne</option>
					<option value="niestacjonarne">niestacjonarne</option>
				</select>
              </td>
			  <td>
                <select name="wydzial">
					 <?php
							$result = $polaczenie->query("SELECT * FROM wydzial");
							while ($row=mysqli_fetch_assoc($result)):    
							echo "<option value=".$row['wydzial_id'].">".$row['nazwa']."</option>";
							endwhile;
					?>
				</select>
              </td>
			  <td>
                <input type="text" name="opiekun" />
              </td>
               
              <td>
                <input type="submit" value="Dodaj" />
              </td>
            </tr>
          </form>
		 </table>
		 
		 
		 
		 
      


    </div>
	<footer class="footer">Uniwersytet Rzeszowski <br />Aleja Tadeusza Rejtana 16C,<br /> 35-001 Rzeszów
<p style="font-size:0.7em">
tel. + 48 17 872 10 00 (centrala telefoniczna)<br />
tel/fax: + 48 17 872 12 <a href="https://www.youtube.com/watch?v=OSCiMbMVDLI" style="text-decoration:none; color:white">65</a><br />
e-mail:<a href="mailto:infor@ur.edu.pl">info@ur.edu.pl</a></p></footer>

  </body>
</html>