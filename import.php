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

/*
	$sti = $dbi->query('SELECT * FROM `bb_user_info`');


	$sql = "INSERT INTO `bb_user_info` (`userid`, `aliasInfo_id`, `birthday`, `signature`, `customized_id`, `name`, `gender`, `avatar`, `cover`, `extras`, `relationship`, `type`, `updateTime`, `like`, `version`) VALUES(:userid, :aliasInfo_id, :birthday, :signature, :customized_id, :name, :gender, :avatar, :cover, :extras, :relationship, :type, :updateTime, :like, :version)";
	$stmt = $dbh->prepare($sql);

	while($row = $sti->fetch(PDO::FETCH_ASSOC)){
		print_r($row);
		$stmt->execute($row);
	}
*/

	$sti = $dbi->query('SELECT * FROM `bb_user_geo_info`');

	$sql = "INSERT INTO `bb_user_geo_info` (`latitude`,`longitude`,`timestamp`,`uid`) VALUES(:latitude, :longitude, :timestamp, :uid)";
	$stmt = $dbh->prepare($sql);

	while($row = $sti->fetch(PDO::FETCH_ASSOC)){
			$stmt->execute($row);
	}

} catch(PDOException $e) {
	echo $e->getMessage();
	echo "\n";
}

// $sth = $dbh -> prepare($sql);

?>
