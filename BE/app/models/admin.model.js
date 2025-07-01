const { DataTypes } = require("sequelize");
const sequelize = require("../config/db.config.js");

const Admin = sequelize.define("admin", {
  id: {
    type: DataTypes.INTEGER,
    primaryKey: true,
    autoIncrement: true
  },
  email: {
    type: DataTypes.STRING,
    allowNull: false,
    unique: true
  },
  password: {
    type: DataTypes.STRING,
    allowNull: false
  },
  full_name: {
    type: DataTypes.STRING
  }
}, {
  tableName: "admins",
  timestamps: true
});

module.exports = Admin;
