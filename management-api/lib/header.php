<?php
global $page_title;
function menu(array $options){
	//Generez meniu html pe baza unui array setand si clasa current pe optiunea selectata
  	//Global $file_name;
	$file_name = basename($_SERVER['PHP_SELF']); //Numele scriptului curent
  	$html = '';
  	foreach($options as $option=>$href){
  		$current = NULL;
  		if(strcasecmp($href, $file_name)==0){
  			$current = ' class="current"';
  		}
  		$html .= "\n";
  		$html .= '<li'.$current.'><a href="'.$href.'">'. ucfirst($option).'</a></li>';
  		$html .= "\n";
  	} //End foreach
return $html;
} //End function
?>
<!DOCTYPE HTML>
<html>
<head>
	<title><?php echo $page_title; ?></title>	
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine&amp;v1" />
  	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz" />
	<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
</head>
<body>
	<div id="main">
	    <div id="header">
	      <div id="logo">
	        <h1><a href="index.php">Rio Grappling Club</a></h1>
	      </div>
	      <div id="menubar">
	      	<ul id="menu">
	      		<!--
	         	<li><a href="index.php">Acasa</a></li>
	          	<li><a href="inregistrare.php">Inregistrare</a></li>
					<li><a href="listare.php">Sportivi</a></li>
					<li><a href="parola.php">Schimba Parola</a></li>
					<li><a href="admin.php">Admin</a></li>
					-->
					<?php
	        			// generez meniu cu php
	        			//require_once ('./lib/header_functions.php');
	        			$options = array('Acasa'=>'index.php', 'Adaugare Sportivi'=>'inregistrare.php','Sportivi'=>'listare.php','administrare'=>'admin.php');
	        			echo menu($options);
	        		?>
	        </ul>
	      </div>
	    </div>
	    
	    <div id="site_content">
      	<div id="sidebar_container">
	        	<img class="paperclip" src="img/paperclip.png" alt="paperclip" />
		      <div class="sidebar">
	          
	          <p><br />Program:<a href="#"></a></p>
			  <p>Luni 20:00-21:30 (Antrenament de tehnica)</p>
			  <p>Miercuri 20:00-21:30 (Antrenament de tehnica)</p>
			  <p>Vineri 20:00-21:30 (Antrenament de tehnica)</p>
			  <p>Duminica 18:00-19:30 (Sparring)</p>
	        </div>
	      </div>
      	
      	<div id="content"><!-- Aici incepe continutul specific paginii. -->
	