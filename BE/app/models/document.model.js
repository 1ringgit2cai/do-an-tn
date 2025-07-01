const { DataTypes } = require("sequelize");
const sequelize = require("../config/db.config.js");

const Document = sequelize.define("document", {
  id: {
    type: DataTypes.INTEGER,
    primaryKey: true,
    autoIncrement: true
  },
  title: {
    type: DataTypes.STRING,
    allowNull: false
  },
  description: {
    type: DataTypes.TEXT
  },
  file_path: {
    type: DataTypes.STRING
  },
  course_id: {
    type: DataTypes.INTEGER
  },
  uploaded_at: {
    type: DataTypes.DATE,
    defaultValue: DataTypes.NOW
  }
}, {
  tableName: "documents",
  timestamps: true
});

module.exports = Document;
