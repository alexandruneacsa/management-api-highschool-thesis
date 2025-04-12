<?php #Administrare utilizatori
global $dbc;
$page_title = 'Administrare';
$file_name = basename($_SERVER['PHP_SELF']);
include ('lib/header.php');
?>

<h1>Administrare utilizatori</h1>

<?php #Conectarea la baza de date; prelucrarea datelor
require_once ('common/array_functions.php'); //Pentru functiile de generare a tabelului
require ('lib/connect.php');

//SELECT
$query = "SELECT id_user, CONCAT( nume, ' ', prenume ) AS `nume` , email, user, DATE_FORMAT( data_adaugarii, '%D %M %Y' ) AS `data`
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
			$new_cols = array(
		 							'Edit'=>'<a href="edit_user.php?id='.$row['id_user'].'">Edit</a>',
									'Delete'=>'<a href="delete_user.php?id='.$row['id_user'].'">Delete</a>',		 	
		 						);
			$array_rows[] = $row + $new_cols; //Adaug prin reuniune coloanele Edit si Delete
			}
				 
		 //Transmit datele catre browser organizate sub forma de tabel
		 echo array_to_table($array_rows);
		} else { //SELECT ok, dar nu am inregistrari
			echo '<p class="error">Nu exista utilizatori inregistrati!</p>';
			}		
	
	}else{ //Interogarea nu a rulat cu succes
		
		echo '<p class="error">'. mysqli_error($dbc).'</p>';
		}
	
mysqli_close($dbc);//Inchid conexiunea cu baza de date
?>
	
<?php
include ('lib/footer.php');
?>