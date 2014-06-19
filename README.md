How to generate data.csv

SELECT * FROM bb_user_info, bb_user_geo_info WHERE bb_user_geo_info.uid = bb_user_info.userid ORDER by updateTime DESC
