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
		  $id=$_POST['rocznik_id'];
		  $sql='SELECT * FROM rocznik WHERE rocznik_id='.$id;
		  $result=$polaczenie->query($sql);
		  $row=mysqli_fetch_assoc($result);
  ?>

			<form action="year_edit_script.php" method="post">
			<input type="hidden" value=<?php echo $id ?> name="rocznik_id" />
            <table>
              <tr>
                <td>Kierunek:</td>
                <td colspan="2" >
                  <?php echo	'<input type="text" name="kierunek" class="form-control" style="margin-top:5%;margin-bottom:-10%;" value='.$row['kierunek'].' /> <br /> <br />'; ?>
                </td>
               
                <td>&nbsp;Rok: &nbsp;</td>
                <td colspan="2">
					<select name="rok" class="form-control">
				<?php echo '<option value='.$row['rok'].'>'.$row['rok'].'</option>'; ?>
						<option value="I">I</option>
						<option value="II">II</option>
						<option value="III">III</option>
						<option value="IV">IV</option>
						<option value="V">V</option>
					</select>
                </td>
				 <td>&nbsp;Tryb: </td>
                <td colspan="2">
				<select name="tryb" class="form-control">
					<?php echo	'<option value='.$row['tryb'].'>'.$row['tryb'].'</option>'; ?>
					<option value="stacjonarne">stacjonarne</option>
					<option value="niestacjonarne">niestacjonarne</option>
				</select>			
				</td>
              </tr>
              <tr>
                <td>Wydział: &nbsp;&nbsp;</td>
                <td colspan="2">
                 <select name="wydzial_id" class="form-control" >
						<?php
						$result2 = $polaczenie->query('SELECT * FROM wydzial w,rocznik r WHERE w.wydzial_id=r.wydzial_id AND w.wydzial_id='.$row['wydzial_id']);
						$row2=mysqli_fetch_assoc($result2);
						echo "<option value=".$row2['wydzial_id'].">".$row2['nazwa']."</option>";
						$result2 = $polaczenie->query('SELECT * FROM wydzial');
						while ($row2=mysqli_fetch_assoc($result2)):    
						echo "<option value=".$row2['wydzial_id'].">".$row2['nazwa']."</option>";
						endwhile;
						?>
				 </select>
                </td>
                <td>&nbsp;Opiekun: &nbsp;&nbsp;</td>
                <td colspan="2">
                  <?php echo	'<input type="text" class="form-control" name=opiekun value='.$row['opiekun'].' /> <br /> <br />';?>
                </td>
           
              </tr>
              <tr><td>&nbsp;</td></tr>
              <tr>
 
                <td colspan="2">
                  
                </td>
                <td>
                  <input type="button" style="width:80%;float:right;"  class="btn btn-primary" onclick="location.href='admin_panel.php';" value="Powrót" />
                </td>

                <td colspan="2">
                  
                </td>
				</form>
        <td>
          <input type="submit" style="width:100%;" class="btn btn-primary" value="Zapisz zmiany" />
        </td>
				<td colspan="2">
                  <form action="year_delete.php" method="post">
				  <input type="hidden" value=<?php  echo $id ?> name="rocznik_id" />
				  <input type="submit" style="width:80%;float:right;" class="btn btn-primary" value="Usuń rocznik" /> 
				  </form>
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