<?php
require(__DIR__.'/web/db.config.php');

if(!isset($argv[1])){
	echo "Missing argument, please specify what BeeTalk source DB file to process\n";
	exit();
}

/*
if(abs($argv[0]) > 1464891871) {
	exit();
}
*/

try{

	// set up destination

	$dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";port=".DB_PORT.";charset=utf8";
	$dbh = new PDO($dsn, DB_USER, DB_PASS);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$dsi = 'sqlite:'.$argv[1];
	$dbi = new PDO($dsi);

	$sti = $dbi->query('SELECT * FROM `bb_user_info`');

	$sql = "INSERT IGNORE INTO `bb_user_info` (`userid`, `aliasInfo_id`, `birthday`, `signature`, `customized_id`, `name`, `gender`, `avatar`, `cover`, `extras`, `relationship`, `type`, `updateTime`, `like`, `version`) VALUES(:userid, IFNULL(:aliasInfo_id, 0), :birthday, IFNULL(:signature, ''), :customized_id, :name, :gender, :avatar, :cover, :extras, :relationship, :type, :updateTime, :like, :version)";
	$stmt = $dbh->prepare($sql);

	$dbh->beginTransaction();
	echo time()." inserting users\n";
	while($row = $sti->fetch(PDO::FETCH_ASSOC)){
		$stmt->execute($row);
	}
	$dbh->commit();
	echo time()." inserted users\n";

/*
	$sti = $dbi->query('SELECT * FROM `bb_user_geo_info`');

	$sql = "INSERT INTO `bb_user_geo_info` (`latitude`,`longitude`,`timestamp`,`uid`) VALUES(:latitude, :longitude, :timestamp, :uid)";
	$stmt = $dbh->prepare($sql);

	$dbh->beginTransaction();
	echo time()." inserting geos\n";

	while($row = $sti->fetch(PDO::FETCH_ASSOC)){
			$stmt->execute($row);
	}
	$dbh->commit();
	echo time()." inserted geos\n";
*/

} catch(PDOException $e) {
	echo $e->getMessage();
	echo "\n";
	echo $argv[1];
	echo "\n";
}

// $sth = $dbh -> prepare($sql);

?>
