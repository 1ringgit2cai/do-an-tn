const jwt = require("jsonwebtoken");
const bcrypt = require("bcryptjs");
const Admin = require("../models/admin.model");

const JWT_SECRET = process.env.JWT_SECRET || "your_jwt_secret"; // đặt .env nếu có

class AuthService {
  // [POST] /auth/login
  async login(req, res) {
    try {
      const { email, password } = req.body;

      // Kiểm tra đầu vào
      if (!email || !password) {
        return res.status(400).json({ message: "Vui lòng nhập email và mật khẩu" });
      }

      // Tìm admin theo email
      const admin = await Admin.findOne({ where: { email } });
      if (!admin) {
        return res.status(401).json({ message: "Email hoặc mật khẩu không đúng" });
      }

      // So sánh mật khẩu
      const isMatch = await bcrypt.compare(password, admin.password);
      if (!isMatch) {
        return res.status(401).json({ message: "Email hoặc mật khẩu không đúng" });
      }

      // Tạo JWT token
      const token = jwt.sign(
        {
          id: admin.id,
          email: admin.email,
          full_name: admin.full_name,
        },
        JWT_SECRET,
        { expiresIn: "30d" } // thời gian token sống
      );

      res.json({
        message: "Đăng nhập thành công",
        token,
        admin: {
          id: admin.id,
          email: admin.email,
          full_name: admin.full_name,
        },
      });
    } catch (err) {
      res.status(500).json({ message: "Lỗi đăng nhập", error: err.message });
    }
  }
}

module.exports = new AuthService();
