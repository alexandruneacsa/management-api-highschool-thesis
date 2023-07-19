<?php # listare utilizatori
$page_title = 'Listare';
$file_name = basename($_SERVER['PHP_SELF']);
include ('lib/header.php');
?>

<h1>Lista sportivi</h1>

<?php # conectarea la baza de date; prelucrarea datelor
require_once ('common/array_functions.php');
require ('lib/connect.php');


//SELECT
$query = "SELECT CONCAT( nume, ' ', prenume ) AS `nume` , DATE_FORMAT( data_adaugarii, '%D %M %Y' ) AS `data`, centura
			FROM users
			ORDER BY data_adaugarii";
//echo $query; // pt debug
$result = @ mysqli_query($dbc,$query); // rulez interogarea

// verific SELECT		
if($result){ // daca interogarea a rulat cu succes, afisez rezultatul
	
	// determin numarul de inregistrari rezultate
	$num=mysqli_num_rows($result);
	
	if($num>0){ // am inregistrari, le afises sub forma de tabel
		// Afisez numarul de utilizatori
		echo "<h4>Exista $num utilizatori inregistrati.</h4>\n";
	 	
	 	// Afisez datele sub forma de tabel
		
		// Construiesc un array cu inregistrarile rezultate din SELECT;
		$array_rows = array();
		// pentru fiecare inregistrare rezultata, transform in array asociativ si adaug la $array_rows			
		while($row=mysqli_fetch_assoc($result)) {
			$array_rows[] = $row;
			}
			
		// Transmit datele catre browser organizate sub forma de tabel 
		echo array_to_table($array_rows);
		} else { // SELECT ok, dar nu am inregistrari
			echo '<p class="error">Nu exista utilizatori inregistrati!</p>';
			}		
	
	}else{ // interogarea nu a rulat cu succes
		
		echo '<p class="error">'. mysqli_error($dbc).'</p>';
		}
	
mysqli_close($dbc);//inchid conexiunea cu baza de date

?>
	
<?php
include ('lib/footer.php');
?>