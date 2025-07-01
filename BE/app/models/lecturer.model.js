const { DataTypes } = require("sequelize");
const sequelize = require("../config/db.config.js");

const Lecturer = sequelize.define("lecturer", {
  id: {
    type: DataTypes.INTEGER,
    primaryKey: true,
    autoIncrement: true
  },
  full_name: {
    type: DataTypes.STRING,
    allowNull: false
  },
  academic_title: {
    type: DataTypes.STRING
  },
  department: {
    type: DataTypes.STRING
  },
  bio: {
    type: DataTypes.TEXT
  },
  image: {
    type: DataTypes.STRING
  }
}, {
  tableName: "lecturers",
  timestamps: true
});

module.exports = Lecturer;
