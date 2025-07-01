const { DataTypes } = require("sequelize");
const sequelize = require("../config/db.config.js");

const Course = sequelize.define("course", {
  id: {
    type: DataTypes.INTEGER,
    primaryKey: true,
    autoIncrement: true
  },
  course_code: {
    type: DataTypes.STRING
  },
  name: {
    type: DataTypes.STRING,
    allowNull: false
  },
  description: {
    type: DataTypes.TEXT
  },
  credits: {
    type: DataTypes.INTEGER
  }
}, {
  tableName: "courses",
  timestamps: true
});

module.exports = Course;
