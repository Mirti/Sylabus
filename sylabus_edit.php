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
        <a href="index.php">
          <img src="images/logo-500x500.jpg" alt="Logo Uniwersytetu" height="92" width="92">
        </a>



        <?php
		  if(isset($_POST['p_id']))
		$id=$_POST['p_id'];
		  else $id=$_SESSION['p_id'];
	
	$_SESSION['edit_id']=$id;
	$sql= 'SELECT * FROM przedmiot p, efekt e, przedmiot_efekt pe, rocznik r WHERE p.przedmiot_id=pe.przedmiot_id AND p.rocznik_id=r.rocznik_id AND e.efekt_id=pe.efekt_id AND p.przedmiot_id='.$id;
	$rezultat= $polaczenie->query($sql);
	$wynik=mysqli_fetch_assoc($rezultat);
  ?>
        <form action="save_to_db.php" method="post">

          <table>
            <tr>
              <td>Nazwa przedmiotu:</td>
              <td colspan="2">
                <?php echo	'<input type="text" name="nazwa" class="form-control" value="'.$wynik['nazwa'].'"/> <br /> <br />'; ?>
              </td>
              <td>&nbsp;&nbsp;Kierunek: </td>
              <td colspan="2">
                <?php echo	'<input type="text" name="kierunek" class="form-control" value="'.$wynik['kierunek'].'"/> <br /> <br />';?>
              </td>
              <td>&nbsp;Typ zajęć: &nbsp;</td>
              <td colspan="2">
                <?php echo	'<select name="typ_zajec" class="form-control" name="typ_zajec" style="height:50%;width:100%;margin-top:5%;margin-bottom:-10%;"><option value='.$wynik['typ_zajec'].'>'.$wynik['typ_zajec'].'</option><option value="wykład">wykład</option><option value="ćwiczenia">ćwiczenia</option><option value="labolatorium">labolatorium</option><option value="seminarium">seminarium</option></select> <br /> <br />'; ?>
              </td>
            </tr>
            <tr>
              <td>Sposób zaliczenia: &nbsp;&nbsp;</td>
              <td colspan="2">
                <?php echo	'<select name="sposob_zaliczenia" class="form-control" style="height:50%;width:100%;margin-top:5%;margin-bottom:-10%;"><option value='.$wynik['sposob_zaliczenia'].'>'.$wynik['sposob_zaliczenia'].'</option><option value="egzamin">egzamin</option><option value="ocena">ocena</option><option value="zaliczenie">zaliczenie</option></select> <br /> <br />'; ?>
              </td>
              <td>&nbsp;&nbsp;Liczba godzin: &nbsp;&nbsp;</td>
              <td colspan="2">
                <?php echo	'<input type="text" class="form-control" name=liczba_godzin value="'.$wynik['liczba_godzin'].'"/> <br /> <br />';?>
              </td>
              <td>&nbsp;&nbsp;Rok: </td>
              <td colspan="2">
                <?php echo	'<input type="text" class="form-control" name=rok value="'.$wynik['rok'].'"/> <br /> <br />'; ?>
              </td>
            </tr>
            <tr>
              <td>ECTS: </td>
              <td colspan="2">
                <?php echo	'<input type="text" class="form-control" name=ECTS value="'.$wynik['ECTS'].'"/> <br /> <br />'; ?>
              </td>
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

		
					 <!-- Wymagania wstępne -->
			 <h3>Wymagania wstępne</h3>
			 <form action="edit_pre_requirements.php" method="post">
			 <input type="hidden" name="id" value=<?php echo $id ?>>
			 <textarea name="wymagania">
			 <?php
			 $sql='SELECT * from wymagania_wstepne w,przedmiot p WHERE w.przedmiot_id=p.przedmiot_id AND w.przedmiot_id='.$id;
			 $result = $polaczenie->query($sql);
			 $row=mysqli_fetch_assoc($result);
			 echo $row['tresc'];
				?>
			 </textarea>
			 <input type="submit" class="btn btn-primary" value="Zapisz">
			 </form>

			 <!-- cele -->
			 <h3>Cele przedmiotu </h3>
			 <table class="table table-hover table-bordered" >
          <th class="info">Kod </th>
          <th class="info">Treść</th>
          <th class="info">Dodaj/Usuń</th>
          <?php
    $result = $polaczenie->query("SELECT c.cel_id, c.kod, c.tresc FROM cel c, przedmiot p, przedmiot_cel pc WHERE p.przedmiot_id=pc.przedmiot_id AND c.cel_id=pc.cel_id AND p.przedmiot_id=".$id);
	while ($row=mysqli_fetch_assoc($result)): 
		
       echo '<form action="target_delete.php" method="post"><input type="hidden" name="przedmiot_id" value='.$id.'><input type="hidden" name="cel_id" value='.$row['cel_id'].'><tr><td>'.$row['kod'].'<td>'.$row['tresc'].'</td><td><input type="submit" class="btn btn-danger" value="Usuń"</td></tr></form>';
    endwhile;
	?>
          <form action="target_add.php" method="post">
            <tr>
              <input type="hidden" name="id" value="<?php echo $id; ?>">
              <td>
                <input style="all:inherit" type="text" name="kod" />
              </td>
              <td>
                <input style="height:50%;width:100%;margin-top:0.5%;margin-bottom:-10%;" class="form-control" type="text" name="tresc" />
              </td>
              <td>
                <input type="submit" class="btn btn-primary" value="Dodaj" />
              </td>
            </tr>
          </form>

        </table>
			 
        <!-- pierwsza tabela-->

		<h3>Efekty kształcenia</h3>
        <table class="table table-hover table-bordered" >
          <th class="info">
            EK<br />(Efekt Kształcenia)
          </th>
          <th class="info">Treść efektu kształcenia zdefiniowanego dla przedmiotu (modułu)</th>
          <th class="info">
            Odniesienie do efektów  kierunkowych <br />(KEK)
          </th>
          <th class="info">Dodaj/Usuń</th>
          <?php
    $result = $polaczenie->query("SELECT e.efekt_id, e.kod, e.opis, e.KEK FROM efekt e, przedmiot p, przedmiot_efekt pe WHERE p.przedmiot_id=pe.przedmiot_id AND e.efekt_id=pe.efekt_id AND p.przedmiot_id=".$id);
	while ($row=mysqli_fetch_assoc($result)): 
		
       echo '<form action="effect_delete.php" method="post"><input type="hidden" name="przedmiot_id" value='.$id.'><input type="hidden" name="efekt_id" value='.$row['efekt_id'].'><tr><td>'.$row['kod'].'<td>'.$row['opis'].'</td><td>'.$row['KEK'].'</td><td><input type="submit" class="btn btn-danger" value="Usuń"</td></tr></form>';
    endwhile;
	?>
          <form action="effect_add.php" method="post">
            <tr>
              <input type="hidden" name="id" value="<?php echo $id; ?>">
              <td>
                <input style="all:inherit" type="text" name="EK" />
              </td>
              <td>
                <input style="height:50%;width:100%;margin-top:0.5%;margin-bottom:-10%;" class="form-control" type="text" name="tresc" />
              </td>
              <td>
                <input style="height:50%;width:100%;margin-top:0.5%;margin-bottom:-10%;" class="form-control" type="text" name="KEK" />
              </td>
              <td>
                <input type="submit" class="btn btn-primary" value="Dodaj" />
              </td>
            </tr>
          </form>

        </table>

        <!-- druga tabela-->
        <br />
        <br />
        <br />
        <br />


		<h3>Wymagania</h3>
        <table class="table table-hover table-bordered" >
          <th class="info" style="font-size:120%;">Nazwa</th>
          <th class="info" style="font-size:120%;">Sposób sprawdzenia</th>
          <th class="info" style="font-size:120%;">Dodaj/Usuń</th>
          <?php
    $result = $polaczenie->query("SELECT w.wymaganie_id,w.nazwa, w.sposob_sprawdzenia, w.przedmiot_id FROM wymaganie w, przedmiot p WHERE p.przedmiot_id=w.przedmiot_id AND w.przedmiot_id=".$id);
	while ($row=mysqli_fetch_assoc($result)): 
       echo '<form action="requirement_delete.php" method="post"><input type="hidden" name="przedmiot_id" value='.$id.'><input type="hidden" name="wymaganie_id" value='.$row['wymaganie_id'].'><tr><td>'.$row['nazwa'].'<td>'.$row['sposob_sprawdzenia'].'</td><td><input type="submit" class="btn btn-danger" value="Usuń"</td></tr></form>';
    endwhile;
	?>
          <form action="requirement_add.php" method="post">
            <tr>
              <input type="hidden" name="id" value="<?php echo $id; ?>">
              <td>
                <input style="height:50%;width:100%;margin-top:0.5%;margin-bottom:-10%;" class="form-control" type="text" name="nazwa" />
              </td>
              <td>
                <select class="form-control" style="width:100%;" name="sposob_sprawdzenia">
                  <option value="kolokwium">kolokwium</option>
                  <option value="odpowiedz_ustna">odpowiedź ustna</option>
                  <option value="projekt">projekt</option>
                  <option value="referat">referat</option>
                  <option value="inne">inne</option>
                </select>
              </td>
              <td>
                <input type="submit" class="btn btn-primary" value="Dodaj" />
              </td>
            </tr>
          </form>

        </table>

        <br />
        <br />
        <br />

        <!-- trzecia tabela-->
		<h3>Treści programowe</h3>
        <table class="table table-hover table-bordered" >
          <th class="info" style="font-size:120%;">Treść programowa</th>
          <th class="info" style="font-size:120%;">Dodaj/Usuń</th>
          <?php
    $result = $polaczenie->query("SELECT t.tresc_id,t.opis FROM tresc t, przedmiot p WHERE p.przedmiot_id=t.przedmiot_id AND t.przedmiot_id=".$id);
	while ($row=mysqli_fetch_assoc($result)): 
       echo '<form action="content_delete.php" method="post"><input type="hidden" name="przedmiot_id" value='.$id.'><input type="hidden" name="tresc_id" value='.$row['tresc_id'].'><tr><td>'.$row['opis'].'</td><td><input type="submit" class="btn btn-danger" value="Usuń"</td></tr></form>';
    endwhile;
	?>
          <form action="content_add.php" method="post">
            <tr>
              <input type="hidden" name="id" value="<?php echo $id; ?>">
              <td>
                <input style="height:50%;width:100%;margin-top:0.5%;margin-bottom:-10%;" class="form-control" type="text" name="nazwa" />
              </td>
               
              <td>
                <input type="submit" class="btn btn-primary" value="Dodaj" />
              </td>
            </tr>
          </form>

        </table>
		
		<!-- Literatura-->
		<h3>Literatura</h3>
			 <form action="edit_literature.php" method="post">
			<input type="hidden" name="id" value=<?php echo $id ?>>
			 <textarea name="literatura">
			 <?php
			 $sql='SELECT * from literatura l,przedmiot p WHERE l.przedmiot_id=p.przedmiot_id AND l.przedmiot_id='.$id;
			 $result = $polaczenie->query($sql);
			 $row=mysqli_fetch_assoc($result);
			 echo $row['tresc'];
				?>
			 </textarea>
			 <input type="submit" class="btn btn-primary" value="Zapisz">
			 </form>

        <?php
  $polaczenie->close();
  ?>


      </div>



    </div>
    <footer class="footer">
      Uniwersytet Rzeszowski <br />Aleja Tadeusza Rejtana 16C,<br /> 35-001 Rzeszów
      <p style="font-size:0.7em">
        tel. + 48 17 872 10 00 (centrala telefoniczna)<br />
        tel/fax: + 48 17 872 12 <a href="https://www.youtube.com/watch?v=OSCiMbMVDLI" style="text-decoration:none; color:white">65</a><br />
        e-mail:<a href="mailto:infor@ur.edu.pl">info@ur.edu.pl</a>
      </p>
    </footer>
  </body>
</html>