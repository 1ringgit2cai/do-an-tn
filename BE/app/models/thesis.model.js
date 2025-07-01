const { DataTypes } = require("sequelize");
const sequelize = require("../config/db.config.js");

const Thesis = sequelize.define("thesis", {
  id: {
    type: DataTypes.INTEGER,
    primaryKey: true,
    autoIncrement: true
  },
  title: {
    type: DataTypes.STRING,
    allowNull: false
  },
  abstract: {
    type: DataTypes.TEXT
  },
  author_name: {
    type: DataTypes.STRING
  },
  lecturer_id: {
    type: DataTypes.INTEGER
  },
  year: {
    type: DataTypes.INTEGER
  },
  file_path: {
    type: DataTypes.STRING
  }
}, {
  tableName: "theses",
  timestamps: true
});

module.exports = Thesis;
