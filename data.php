<?php
require('db.config.php');

$dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8";
$dbh = new PDO($dsn, DB_USER, DB_PASS);

$sql = "SELECT * FROM `bb_user_info`, `bb_user_geo_info` WHERE `bb_user_geo_info`.`uid` = `bb_user_info`.`userid` ORDER by `timestamp` DESC LIMIT 0,3000";
$sth = $dbh -> prepare($sql);

// options for requested data might be available in the future, prepared for $sth -> (array('option1','option2'));
$sth -> execute();
$sth -> setFetchMode(PDO::FETCH_ASSOC);
$result = $sth->fetchAll();

header('Content-Type: application/json; charset=utf-8');
echo json_encode($result, JSON_PRETTY_PRINT);

$dbh = NULL;

?>
