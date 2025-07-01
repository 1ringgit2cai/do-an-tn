const { DataTypes } = require("sequelize");
const sequelize = require("../config/db.config.js");

const Announcement = sequelize.define("announcement", {
  id: {
    type: DataTypes.INTEGER,
    primaryKey: true,
    autoIncrement: true
  },
  title: {
    type: DataTypes.STRING,
    allowNull: false
  },
  content: {
    type: DataTypes.TEXT
  },
  cover_image: {
    type: DataTypes.STRING
  },
  posted_at: {
    type: DataTypes.DATE,
    defaultValue: DataTypes.NOW
  }
}, {
  tableName: "announcements",
  timestamps: true
});

module.exports = Announcement;
