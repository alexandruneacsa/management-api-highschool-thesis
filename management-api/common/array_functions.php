<?php
	
function array_to_table($arrays, $fields = array()){
	//Genereaza tabel html pe baza unei multimi de arrays php
	if(!is_array($arrays) || empty($arrays)) return '<p class="error">Date eronate!</p>';

    //Cheile primului array (titlu, autor, etc.), vor fi elementele antetului
	if($fields == NULL) $fields = array_keys($arrays[0]);
	
	//start tabel
	$html = '<table class="table">';

	//Antet tabel
	$html .= '<tr>';
	foreach($fields as $v){
		$html .= '<th>'. strtoupper($v).'</th>';	
		}
	$html .= '</tr>';

	//Date tabel
	foreach($arrays as $array){
		//Start tr
		$html .= "\t".'<tr>';
		//Generez td-uri
		foreach($array as $field=>$v){
			if(in_array($field, $fields)){
				$html .= '<td>'.$v.'</td>';		
				}
		}	
		//End tr
		$html .= '</tr>'."\n";
		} 
	
	//End tabel
	$html .= '</table>';
	//Returnez rezultat
	return $html;
	}
	
function sort_array($arrays, $field){
	usort($arrays,
		function($a,$b) use ($field){
			if(strnatcasecmp($a[$field],$b[$field])>0) return 1;
			else return -1;
			}	
	);
	return $arrays;
	}
?>