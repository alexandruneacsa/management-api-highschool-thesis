<?php
	
function array_to_table($arrays, $fields = array()){
	// genereaza tabel html pe baza unei multimi de arrays php
	if(!is_array($arrays) || empty($arrays)) return '<p class="error">Date eronate!</p>';
	
	if($fields == NULL) $fields = array_keys($arrays[0]); // cheile primului array (titlu, autor, etc.), vor fi elementele antetului
	//print_r($keys); // pt debug
	
	//start tabel
	$html = '<table class="table">';

	//antet tabel
	$html .= '<tr>';
	foreach($fields as $v){
		$html .= '<th>'. strtoupper($v).'</th>';	
		}
	$html .= '</tr>';

	//date tabel
	foreach($arrays as $array){
		//start tr
		$html .= "\t".'<tr>';
		// generez td-uri
		foreach($array as $field=>$v){
			if(in_array($field, $fields)){
				$html .= '<td>'.$v.'</td>';		
				}
		}	
		//end tr
		$html .= '</tr>'."\n";
		} 
	
	//end tabel
	$html .= '</table>';
	// returnez rezultat
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