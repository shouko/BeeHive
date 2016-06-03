var Sequelize = require('sequelize');
var sqlite3 = require('sqlite3');
var sequelize = new Sequelize('mysql://beehive:@127.0.0.1:3307/beehive', {
  logging: false
});
var db = new sqlite3.Database(process.argv[2]);
var Promise = require('bluebird');

var User = sequelize.define('user', {
  userid: {
    type: Sequelize.INTEGER,
    primaryKey: true
  },
  aliasInfo_id: Sequelize.BIGINT,
  signature: Sequelize.STRING,
  birthday: Sequelize.INTEGER,
  name: Sequelize.STRING,
  customized_id: Sequelize.STRING,
  avatar: Sequelize.BIGINT,
  cover: Sequelize.BIGINT,
  like: Sequelize.INTEGER,
  gender: Sequelize.INTEGER,
  relationship: Sequelize.INTEGER,
  type: Sequelize.INTEGER,
  updateTime: Sequelize.INTEGER,
  version: {
    type: Sequelize.INTEGER,
    primaryKey: true
  }
}, {
  timestamps: false,
  freezeTableName: true,
  tableName: 'bb_user_info'
});

var Geo = sequelize.define('geo', {
  latitude: Sequelize.DOUBLE,
  longitude: Sequelize.DOUBLE,
  timestamp: {
    type: Sequelize.INTEGER,
    primaryKey: true
  },
  uid: {
    type: Sequelize.INTEGER,
    primaryKey: true
  }
}, {
  timestamps: false,
  freezeTableName: true,
  tableName: 'bb_user_geo_info'
});

console.log('processing', process.argv[2]);

db.all("SELECT * FROM bb_user_info", function(err, rows) {
  console.log('Selected', rows.length, ' users');
  sequelize.transaction(function (t) {
    return new Promise.map(rows, function(row) {
      return User.create(row, {
        ignoreDuplicates: true,
        transaction: t
      });
    });
  }).catch(function(err) {
    console.log('Error ' + err);
  }).finally(function(err) {
    console.log('Inserted', rows.length, ' users');
  });
});

db.all("SELECT * FROM bb_user_geo_info", function(err, rows) {
  console.log('Selected', rows.length, 'geo');
  new Promise.map(rows, function(row) {
    return Geo.create(row, {
      ignoreDuplicates: true
    });
  }).catch(function(err) {
    console.log('Error ' + err);
  }).finally(function(err) {
    console.log('Inserted', rows.length, ' geos');
  });
});
