<?php

function query($sqlFilePath,$database,$QueryParams){
	
	$sql = file_get_contents($sqlFilePath);
	$statement = $database->prepare($sql);
    $statement->execute($QueryParams);
	
	$results = $statement->fetchAll(PDO::FETCH_ASSOC);
	
	return $results;
}

function searchServices($term, $database) {
	//if (is_null($term) || strcmp($term,'') == 0){
	//	return array();
	//}
	
	$params = array(
		'term' => '%' . $term . '%'
	);
	
	return query('sql/getServices.sql',$database,$params);
}

function getUser($userid,$database){
	$params = array(
		'userid' => $userid
	);
	return query('sql/getUser.sql',$database,$params);
}

function get($key) {
	if(isset($_GET[$key])) {
		return $_GET[$key];
	}
	
	else {
		return '';
	}
}

function formatDollars($dollars)
{
    $formatted = "$" . number_format(sprintf('%0.2f', preg_replace("/[^0-9.]/", "", $dollars)), 2);
    return $dollars < 0 ? "({$formatted})" : "{$formatted}";
}