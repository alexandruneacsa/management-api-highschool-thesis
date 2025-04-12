<?php # mysqli_connect.php

//Acest fisier contine datele care permit accesul la baza de date,
//Stabileste conexiunea cu MySQL,
//Selecteaza baza de date

//Setarea datelor de acces
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWORD', '');
DEFINE ('DB_NAME', 'myusers');

//Stabilirea conexiunii
$dbc = @ mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Nu se poate stabili conexiunea cu MySQL: ' . mysqli_connect_error() );

