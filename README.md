BeeHive
================
BeeHive is an experiment for visualizing user location data provided by the mobile instant messaging app BeeTalk.

BeeHive reads data asynchronously, and place a marker on specific location on the map for each single row of data, which basically consists of name, gender, birthday, ID, status, and last updated time.

## Usage
Data file of users is named **data.csv** and located at the root directory of BeeHive, you may use the SQL query string suggested below to generate the **data.csv** file with the user database of BeeTalk located in your mobile phone.

	SELECT * FROM bb_user_info, bb_user_geo_info WHERE bb_user_geo_info.uid = bb_user_info.userid ORDER by updateTime DESC

Notice: The generated **data.csv** file might be large, to lower the impact on performance, you may adjust the **preview** parameter near the bottom of **index.html** to a smaller number, while the default value is 350, then the browser would only read that amount of data.

## Known Issues
 - User avatar not showing
 - Data is not realtime updated

## Credits
 - Inspired by Denny Huang
 - [Leaflet JavaScript Map Library](http://leafletjs.com/)
 - [Awesome Markers Plugin for Leaflet](https://github.com/lvoogdt/Leaflet.awesome-markers)
 - [jQuery JavaScript Library](http://jquery.com/)
 - [Papa Parse CSV Parser](http://papaparse.com/)
