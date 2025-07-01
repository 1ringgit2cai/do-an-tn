const { DataTypes } = require("sequelize");
const sequelize = require("../config/db.config.js");

const Register = sequelize.define("register", {
    id: {
        type: DataTypes.INTEGER,
        primaryKey: true,
        autoIncrement: true
    },
    full_name: {
        type: DataTypes.STRING(100),
        allowNull: false
    },
    phone: {
        type: DataTypes.STRING(20),
        allowNull: false
    },
    email: {
        type: DataTypes.STRING(100),
        allowNull: false
    },
    address: {
        type: DataTypes.STRING(255),
        allowNull: false
    },
    education: {
        type: DataTypes.STRING(100),
        allowNull: false
    },
    major: {
        type: DataTypes.STRING(100),
        allowNull: false
    },
    status: {
        type: DataTypes.ENUM("pending", "processed"),
        allowNull: false,
        defaultValue: "pending"
    }
}, {
    tableName: "registers",
    timestamps: true
});

module.exports = Register;
