<?php #Editare utilizator
global $dbc;
$page_title = 'Inregistrare';
$file_name = basename($_SERVER['PHP_SELF']);
include ('lib/header.php');
?>
<h1>Editare utilizator</h1>

<?php #Conectarea la baza de date
require ('lib/connect.php');

//Preiau id-ul transmis prin GET
if(isset($_GET['id']) && is_numeric($_GET['id'])){ //Daca s-a transmis id prin GET
	$id=$_GET['id'];
	}else { // Nu am id valid, intrerup scriptul.
	echo '<p class="error">Aceasta pagina a fost accesata din greseala.</p>';
	include ('lib/footer.php'); 
	exit();
	}

//Am id => preiau datele utilizatorului selectat, afisez formularul cu datele utilizatorului selectat, modific date, fac UPDATE
$query = "SELECT id_user, nume, prenume, email
				FROM users
				WHERE id_user = $id
				LIMIT 1 ";
$result = @ mysqli_query($dbc, $query);

if($result && mysqli_num_rows($result) == 1) { //Am gasit utilizatorul
	$row = mysqli_fetch_assoc($result);
}else{ //Nu am gasit utilizatorul, intrerup scriptul.
	echo '<p class="error">Nu exista utilizatorul.</p>';
	echo '<p class="error">'. mysqli_error($dbc).'</p>';
	include ('lib/footer.php'); 
	exit();
	}
	
/* -- Campurile formularului si atributele acestora --*/
$form_fields=  array( // fields
    'nume'        => array('obligatoriu'=>true, 'regex'=>'/^[a-zA-Z\-\s\']{2,20}$/'),
    'prenume'     => array('obligatoriu'=>true, 'regex'=>'/^[a-zA-Z\-\s\']{2,20}$/'),
    'email'     	=> array('obligatoriu'=>true, 'regex'=>'/^[a-zA-Z0-9\.\-_\+]+@[a-zA-Z0-9\-]+\.([a-zA-Z0-9\-]+\.)*[a-zA-Z]{2,3}$/'),
    );

/*-- Pentru pastrarea datelor in formular, initializez $form_data pentru cazul in care formularul a fost afisat prima data-- */
foreach($form_fields as $field=>$atribute) {
	$form_data[$field]=$row[$field];
}

if(isset($_POST['submit'])){
		
	/*-- Pastrarea datelor in formular; actualizare $form_data dupa apasarea butonului-- */
	$form_data=$_POST;
			
	/*--Validare formular--*/
	
	//Init errors; pentru un camp va fi semnalata o singura eroare
	$errors = array();
		
	//Verific campurile obligatorii si campuri cu format
	foreach($form_fields as $field=>$atribute) {
		
		if(isset($atribute['obligatoriu']) && $atribute['obligatoriu'] === true) {//campul este obligatoriu
			if (!isset($form_data[$field]) || empty($form_data[$field])) {
				$errors[] ="Campul $field trebuie completat";
			}
		}
		
		if(isset($atribute['regex']) && !empty($atribute['regex']) && is_string($atribute['regex'])) {//campul are un format impus
			if($form_data[$field] && !preg_match($atribute['regex'],$form_data[$field])) {
					$errors[] = "Campul $field nu este valid";
					}
			}
		}//End foreach

	/*--Procesarea datelor sau afisare erorilor--*/
	if(!empty($errors)){ //Daca am erori, le afisez
		echo '<div class="error">';
		echo implode("<br />", $errors);
		echo '</div>';
	}else{ //Daca nu am erori, procesez datele
		$nume=trim($form_data['nume']);
		$prenume=trim($form_data['prenume']);
		$email=trim($form_data['email']);
		
		//UPDATE
		$query="UPDATE users 
				SET nume = '$nume', prenume = '$prenume', email = '$email'
				WHERE id_user = $id";
		echo $query;//Debug
		
		$result= @ mysqli_query($dbc,$query); //Rulez interogarea
		
		//Verific UPDATE
		if($result && mysqli_affected_rows($dbc)==1){ //UPDATE ok; s-a modificat o inregistrare
				echo '<h2>Multumim!</h2>
					<p>Inregistrarea a fost modificata cu succes!</p>';
				include ('lib/footer.php'); //Includ footer pt ca intrerup scriptul fortat; formularul si footerul care sunt dupa exit nu vor mai aparea in pagina
				exit();
				}else{ //Insert gresit sintactic sau neefectuat, de exemplu din motive de integritate
				echo '<p class="error">Update nereusit!</p>';
				echo '<p class="error">'. mysqli_error($dbc).'</p>';
				}
			//end UPDATE
		mysqli_close($dbc); //Inchid conexiunea cu baza de date
		} //End "nu am erori"
}

?>
	<form action="" method="post" class="form_settings">
			<p>
			<label for="nume">Nume:</label>
			<input type="text" name="nume" id="nume" maxlength="30" value="<?php echo htmlentities($form_data['nume']); ?>" />
			</p>
			<p>
			<label for="prenume">Prenume:</label>
			<input type="text" name="prenume" id="prenume" maxlength="30" value="<?php echo htmlentities($form_data['prenume']); ?>" />
			</p>
			<p>
			<label for="email">Email:</label>
			<input type="text" name="email" id="email" maxlength="60" value="<?php echo htmlentities($form_data['email']); ?>" />
			</p>
			<p>
			<input type="submit" name="submit" value="Modifica" class="submit" />
			</p>			
	</form>

<?php
include ('lib/footer.php');
?>