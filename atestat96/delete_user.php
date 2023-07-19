<?php # stergere utilizator
$page_title = 'Sterge utilizator';
$file_name = basename($_SERVER['PHP_SELF']);
include ('lib/header.php');
?>

<h1>Administrare utilizatori</h1>

<?php # conectarea la baza de date; prelucrarea datelor
require ('lib/connect.php');

if(isset($_GET['id']) && is_numeric($_GET['id'])){ // daca s-a transmis id prin GET
	$id=$_GET['id'];
	}else { // Nu am id valid, intrerup scriptul.
	echo '<p class="error">Aceasta pagina a fost accesata din greseala.</p>';
	include ('lib/footer.php'); 
	exit();
	}

// am id, rulez interogarea de stergere	
$query="DELETE FROM users WHERE id_user = $id LIMIT 1";
$result = @ mysqli_query($dbc,$query);

if (mysqli_affected_rows($dbc) == 1) {// am sters exact o inregistrare
	Header("Location:admin.php"); //  redirectionez catre admin.php pentru a vedea instant efectul stergerii
	exit();
		} else {
			// Stergere nereusita
			echo '<p class="error">Utilizatorul nu a putut fi sters.</p>';
			echo '<p class="error">' . mysqli_error($dbc) . '</p>';
		}
mysqli_close($dbc);//inchid conexiunea cu baza de date	
?>