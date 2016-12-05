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
	
	$login=$_POST['login'];
	$haslo=$_POST['haslo'];
	
	$login = htmlentities($login, ENT_QUOTES, "UTF-8");
	$haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");
	
	if ($rezultat = @$polaczenie->query(
		sprintf("SELECT * FROM prowadzacy WHERE login='%s' AND password='%s'",
		mysqli_real_escape_string($polaczenie,$login),
		mysqli_real_escape_string($polaczenie,$haslo))))
		{
			$user_num = $rezultat->num_rows;
			if($user_num>0)
			{
				$_SESSION['zalogowany'] = true;
				
				$wiersz = $rezultat->fetch_assoc();
				$_SESSION['prowadzacy_id'] = $wiersz['prowadzacy_id'];
				$_SESSION['imie']=$wiersz['imie'];
				$_SESSION['nazwisko']=$wiersz['nazwisko'];
				
				unset($_SESSION['blad']);
				$rezultat->free_result();
				header('Location: user_panel.php');
				
			} else {
				
				$_SESSION['blad'] = 'Nieprawidłowy login lub hasło!';
				header('Location: login.php');
				
			}
			
		}
		
		$polaczenie->close();
?>
