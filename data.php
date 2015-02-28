<?php
require('db.config.php');

$sql = "SELECT * FROM `bb_user_info`, `bb_user_geo_info` WHERE `bb_user_geo_info`.`uid` = `bb_user_info`.`userid`";
$params = array();

if( isset($_GET['uid']) && $_GET['uid'] != '' ){
	$sql .= " AND `bb_user_info`.`userid` = ?";
	$params[] = $_GET['uid'];
}

if( isset($_GET['gender']) && $_GET['gender'] != '-1' ){
	// -1: all, 0: male, 1: female
	$sql .= " AND `bb_user_info`.`gender` LIKE ?";
	$params[] = $_GET['gender'];
}

// read 100 rows of data for default
$limit = 100;
if ( isset($_GET['limit']) ){
	$limit = abs($_GET['limit']);
	$sql .= ' ORDER by `timestamp` DESC LIMIT 0, ?';
}

$dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8";
$dbh = new PDO($dsn, DB_USER, DB_PASS);

$sth = $dbh -> prepare($sql);

$size = count($params);

for($i = 0; $i < $size; $i++){
	$sth->bindValue($i+1, $params[$i]);
}

$sth->bindValue($size + 1, $limit, PDO::PARAM_INT);

$sth -> execute();
$sth -> setFetchMode(PDO::FETCH_ASSOC);
$result = $sth->fetchAll();

header('Content-Type: application/json; charset=utf-8');
echo json_encode($result, JSON_PRETTY_PRINT);

$dbh = NULL;

?>
