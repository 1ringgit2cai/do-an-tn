const { DataTypes } = require("sequelize");
const sequelize = require("../config/db.config.js");

const CourseLecturer = sequelize.define("course_lecturer", {
  course_id: {
    type: DataTypes.INTEGER,
    primaryKey: true,
    allowNull: false,
  },
  lecturer_id: {
    type: DataTypes.INTEGER,
    primaryKey: true,
    allowNull: false,
  }
}, {
  tableName: "courses_lecturers",
  timestamps: true,
});

module.exports = CourseLecturer;
