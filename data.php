<?php
require('db.config.php');

// read 100 rows of data for default
$limit = 100;
if ( isset($_GET['limit']) ){
	$limit = abs($_GET['limit']);
}

$gender = '%';
if( isset($_GET['gender']) && $_GET['gender'] != '-1' ){
		// -1: all, 0: male, 1: female
		$gender = abs($_GET['gender']);
}

$dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8";
$dbh = new PDO($dsn, DB_USER, DB_PASS);

$sql = "SELECT * FROM `bb_user_info`, `bb_user_geo_info` WHERE `bb_user_geo_info`.`uid` = `bb_user_info`.`userid` AND `bb_user_info`.`gender` LIKE ? ORDER by `timestamp` DESC LIMIT 0, ?";
$sth = $dbh -> prepare($sql);

$sth -> bindValue(1, $gender);
$sth -> bindValue(2, $limit, PDO::PARAM_INT);
$sth -> execute();
$sth -> setFetchMode(PDO::FETCH_ASSOC);
$result = $sth->fetchAll();

header('Content-Type: application/json; charset=utf-8');
echo json_encode($result, JSON_PRETTY_PRINT);

$dbh = NULL;

?>
