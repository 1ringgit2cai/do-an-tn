const jwt = require("jsonwebtoken");
const JWT_SECRET = process.env.JWT_SECRET || "your_jwt_secret";

function verifyToken(req, res, next) {
  const authHeader = req.headers.authorization;
  const token = authHeader && authHeader.split(" ")[1]; // "Bearer TOKEN"

  if (!token) {
    return res.status(401).json({ message: "Không có token truy cập" });
  }

  try {
    const decoded = jwt.verify(token, JWT_SECRET);
    req.user = decoded; // thông tin người dùng gán vào request
    next();
  } catch (err) {
    res.status(403).json({ message: "Token không hợp lệ hoặc đã hết hạn" });
  }
}

module.exports = verifyToken;
