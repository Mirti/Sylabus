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
require('mysql_table.php');
$id=$_SESSION['edit_id'];
$result=$polaczenie->query('SELECT * from przedmiot p,rocznik r WHERE r.rocznik_id=p.rocznik_id AND p.przedmiot_id='.$id);
$row=mysqli_fetch_assoc($result);
class PDF extends PDF_MySQL_Table
{
function Header()
{
    //Title
    $this->SetFont('Arial','',18);
    $this->Cell(0,6,'Sylabus',0,1,'C');
    $this->Ln(10);
    //Ensure table header is output
    parent::Header();
}
}

//Connect to database
mysql_connect('localhost','root','');
mysql_select_db('sylabusy');
ob_clean();  
$pdf=new PDF();
$pdf->AddPage();
$prop=array('HeaderColor'=>array(102,178,255),
            'color1'=>array(210,245,255),
            'color2'=>array(204,229,255),
            'padding'=>2);
$pdf->SetFontSize(11);
$pdf->Cell(15,0,'');
$pdf->Cell(35,0,'Nazwa przedmiotu:');
$pdf->Cell(40,0,$row['nazwa']);
$pdf->Cell(20,0,'Kierunek:');
$pdf->Cell(35,0,$row['kierunek']);
$pdf->Cell(10,0,'Rok:');
$pdf->Cell(60,0,$row['rok']);
$pdf->SetFontSize(10);
$pdf->Ln(10);
$pdf->Cell(15,0,'');
$pdf->Cell(25,0,'Typ zajęć:');
$pdf->Cell(50,0,$row['typ_zajec']);
$pdf->Cell(35,0,'Sposób zaliczenia:');
$pdf->Cell(35,0,$row['sposob_zaliczenia']);
$pdf->Ln(10);
$pdf->Cell(15,0,'');
$pdf->Cell(25,0,'Liczba godzin:');
$pdf->Cell(50,0,$row['liczba_godzin']);
$pdf->Cell(15,0,'ECTS:');
$pdf->Cell(35,0,$row['ECTS']);
$pdf->Ln(20);
$pdf->SetFontSize(15);
$pdf->Cell(0,6,'Wymagania wstepne',0,1,'C');
$pdf->Table('SELECT tresc FROM wymagania_wstepne WHERE przedmiot_id='.$id,$prop);
$pdf->Ln(20);
$pdf->SetFontSize(15);
$pdf->Cell(0,6,'Cele przedmiotu',0,1,'C');
$pdf->Table('SELECT c.kod, c.tresc FROM cel c, przedmiot p, przedmiot_cel pc WHERE c.cel_id=pc.cel_id AND p.przedmiot_id=pc.przedmiot_id AND p.przedmiot_id='.$id,$prop);
$pdf->Ln(20);
$pdf->SetFontSize(15);
$pdf->Cell(0,6,'Efekty kształcenia',0,1,'C');
$pdf->Table('SELECT e.kod, e.opis, e.KEK FROM efekt e, przedmiot p, przedmiot_efekt pe WHERE e.efekt_id=pe.efekt_id AND p.przedmiot_id=pe.przedmiot_id AND p.przedmiot_id='.$id,$prop);
$pdf->Ln(20);
$pdf->SetFontSize(15);
$pdf->Cell(0,6,'Wymagania',0,1,'C');
$pdf->Table('SELECT nazwa, sposob_sprawdzenia FROM wymaganie WHERE przedmiot_id='.$id,$prop);
$pdf->Ln(20);
$pdf->SetFontSize(15);
$pdf->Cell(0,6,'Treści programowe',0,1,'C');
$pdf->Table('SELECT opis FROM tresc WHERE przedmiot_id='.$id,$prop);
$pdf->Ln(20);
$pdf->SetFontSize(15);
$pdf->Cell(0,6,'Literatura',0,1,'C');
$pdf->Table('SELECT tresc FROM literatura WHERE przedmiot_id='.$id,$prop);
$pdf->Ln(20);
$pdf->Output();
?>