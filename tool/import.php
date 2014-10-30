<?php
require('../db.config.php');

if(!isset($argv[1])){
	echo "Missing argument, please specify what BeeTalk source DB file to process\n";
	exit();
}

try{

	// set up destination

	$dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";port=".DB_PORT.";charset=utf8";
	$dbh = new PDO($dsn, DB_USER, DB_PASS);

	$dsi = 'sqlite:'.$argv[1];
	$dbi = new PDO($dsi);

	$sti = $dbi->query('SELECT * FROM `bb_user_info`');

	$sql = 'REPLACE INTO `bb_user_info` VALUES(:userid, :birthday, :signature, :customized_id, :name, :gender, :avatar, :cover, :extras, :relationship, :type, :updateTime, :like, :version)';
	$stmt = $dbh->prepare($sql);

	while($row = $sti->fetch(PDO::FETCH_ASSOC)){
		print_r($row);
		unset($row['aliasInfo_id']);
		$stmt->execute($row);
		echo "\n";
	}

} catch(PDOException $e) {
	echo $e->getMessage();
	echo "\n";
}

// $sth = $dbh -> prepare($sql);

?>
