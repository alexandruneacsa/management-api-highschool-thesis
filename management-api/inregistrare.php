<?php #Inregistrare utilizator
global $dbc;
$page_title = 'Inregistrare';
$file_name = basename($_SERVER['PHP_SELF']);
include ('lib/header.php');
?>
<h1>Inregistraza utilizator</h1>

<?php #Conectarea la baza de date; prelucrarea datelor
require ('lib/connect.php');


/* -- Campurile formularului si atributele acestora --*/
$form_fields=  array( // fields
    'nume'        => array('obligatoriu'=>true, 'regex'=>'/^[a-zA-Z\-\s\']{2,20}$/'),
    'prenume'     => array('obligatoriu'=>true, 'regex'=>'/^[a-zA-Z\-\s\']{2,20}$/'),
    'email'     	=> array('obligatoriu'=>true, 'regex'=>'/^[a-zA-Z0-9\.\-_\+]+@[a-zA-Z0-9\-]+\.([a-zA-Z0-9\-]+\.)*[a-zA-Z]{2,3}$/'),
    'user'    		=> array('obligatoriu'=>true, 'regex'=>'/^[a-zA-Z\-0-9]{4,15}$/'),
    'parola'      => array('obligatoriu'=>true, 'regex'=>'/^[A-Za-z]+\d+.*$/'),
	'parola'      => array('obligatoriu'=>true, 'regex'=>'/^[A-Za-z]{2,20}$/'),
	'centura'        => array('obligatoriu'=>true, 'regex'=>'/^[a-zA-Z\-\s\']{2,20}$/'),
    );

/*--Pentru pastrarea datelor in formular, initializez $form_data pentru cazul in care formularul a fost afisat prima data-- */
foreach($form_fields as $field=>$atribute) {
	$form_data[$field]='';
}

if(isset($_POST['submit'])){
		
	/*--Pastrarea datelor in formular; actualizare $form_data dupa apasarea butonului-- */
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
		$user=trim($form_data['user']);
		$parola=trim($form_data['parola']);
		$parola_criptata = md5($parola); //In db voi memora parola criptata; pentru securitate, se mai poate atasa parolei un string si apoi se aplica alg de criptare
		$email=trim($form_data['email']);
		$centura=trim($form_data['centura']);
		//INSERT
		$query="INSERT INTO users(nume, prenume, email, user, parola, data_adaugarii , centura)
					VALUES('$nume','$prenume','$email','$user','$parola_criptata', NOW(),'$centura');";

		$result= @ mysqli_query($dbc,$query); //Rulez interogarea
		
		//verific INSERT		
		if($result && mysqli_affected_rows($dbc)==1){ //INSERT ok; s-a adaugat o inregistrare
				echo '<h2>Multumim!</h2>
					<p>Inregistrarea a fost realizata cu succes!</p>';
				include ('lib/footer.php'); //Includ footer pt ca intrerup scriptul fortat; formularul si footerul care sunt dupa exit nu vor mai aparea in pagina
				exit();
				}else{ //Insert gresit sintactic sau neefectuat, de exemplu din motive de integritate
				echo '<p class="error">Insert nereusit!</p>';
				echo '<p class="error"> Eroare de sistem: '. mysqli_error($dbc).'</p>';
				}
			//End INSERT
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
			<label for="user">User:</label>
			<input type="text" name="user" id="user" maxlength="30" value="<?php echo htmlentities($form_data['user']); ?>" />
			</p>				
			<p>
			<label for="parola">Parola:</label>
			<input type="password" name="parola" id="parola" maxlength="40" value="<?php echo htmlentities($form_data['parola']); ?>" />
			</p>
			
			<label for="centura">Centura:</label>
			<input type="text" name="centura" id="centura" maxlength="30" value="<?php echo htmlentities($form_data['centura']); ?>" />
			</p>
			<p>
			<input type="submit" name="submit" value="Inregistreaza" class="submit" />
			</p>			
	<p>
	</form>

<?php
include ('lib/footer.php');
?>