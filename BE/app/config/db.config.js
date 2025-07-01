const Sequelize = require('sequelize');
const sequelize = new Sequelize('msc_info_portal', 'root', '', {
  dialect: 'mysql',
  host: 'localhost',
  logging: false, // tắt log
});

module.exports = sequelize;