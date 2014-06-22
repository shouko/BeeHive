SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

CREATE TABLE `bb_user_geo_info` (
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `timestamp` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  PRIMARY KEY (`timestamp`,`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `bb_user_info` (
  `aliasInfo_id` bigint(20) NOT NULL,
  `userid` int(11) NOT NULL,
  `birthday` int(11) NOT NULL,
  `signature` varchar(255) NOT NULL,
  `customized_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` int(11) NOT NULL,
  `avatar` bigint(20) NOT NULL,
  `cover` bigint(20) NOT NULL,
  `extras` int(11) NOT NULL,
  `relationship` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `updateTime` int(11) NOT NULL,
  `like` int(11) NOT NULL,
  `version` int(11) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
