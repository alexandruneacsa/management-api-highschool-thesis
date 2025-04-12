<?php #Listare utilizatori
global $dbc;
$page_title = 'Listare';
$file_name = basename($_SERVER['PHP_SELF']);
include ('lib/header.php');
?>

<h1>Lista sportivi</h1>

<?php #Conectarea la baza de date; prelucrarea datelor
require_once ('common/array_functions.php');
require ('lib/connect.php');


//SELECT
$query = "SELECT CONCAT( nume, ' ', prenume ) AS `nume` , DATE_FORMAT( data_adaugarii, '%D %M %Y' ) AS `data`, centura
			FROM users
			ORDER BY data_adaugarii";

$result = @ mysqli_query($dbc,$query); //Rulez interogarea

//Verific SELECT
if($result){ //Daca interogarea a rulat cu succes, afisez rezultatul
	
	//Determin numarul de inregistrari rezultate
	$num=mysqli_num_rows($result);
	
	if($num>0){ //Am inregistrari, le afises sub forma de tabel
		//Afisez numarul de utilizatori
		echo "<h4>Exista $num utilizatori inregistrati.</h4>\n";
	 	
	 	//Afisez datele sub forma de tabel
		
		//Construiesc un array cu inregistrarile rezultate din SELECT;
		$array_rows = array();
		//Pentru fiecare inregistrare rezultata, transform in array asociativ si adaug la $array_rows
		while($row=mysqli_fetch_assoc($result)) {
			$array_rows[] = $row;
			}
			
		//Transmit datele catre browser organizate sub forma de tabel
		echo array_to_table($array_rows);
		} else { // SELECT ok, dar nu am inregistrari
			echo '<p class="error">Nu exista utilizatori inregistrati!</p>';
			}		
	
	}else{ //Interogarea nu a rulat cu succes
		
		echo '<p class="error">'. mysqli_error($dbc).'</p>';
		}
	
mysqli_close($dbc); //Inchid conexiunea cu baza de date
?>
	
<?php
include ('lib/footer.php');
?>