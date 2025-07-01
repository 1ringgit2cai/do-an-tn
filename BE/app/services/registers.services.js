const Register = require("../models/register.model.js");
const { Op } = require("sequelize");

class RegisterService {
    // [GET] /registers?search=&page=&limit=
    async index(req, res) {
        const { search = "", page = 1, limit = 10 } = req.query;

        try {
            const { count, rows } = await Register.findAndCountAll({
                where: search
                    ? {
                        full_name: { [Op.like]: `%${search}%` },
                    }
                    : undefined,
                order: [["createdAt", "DESC"]],
                limit: parseInt(limit),
                offset: (parseInt(page) - 1) * parseInt(limit),
            });

            res.status(200).json({
                data: rows,
                total: count,
                page: parseInt(page),
                totalPages: Math.ceil(count / limit),
            });
        } catch (err) {
            res.status(500).json({ message: "Lỗi truy xuất", error: err.message });
        }
    }

    // [GET] /registers/:id
    async show(req, res) {
        const item = await Register.findByPk(req.params.id);
        if (!item) return res.status(404).json({ message: "Không tìm thấy" });
        res.json(item);
    }

    // [POST] /registers
    async store(req, res) {
        try {
            const { full_name, phone, email, address, education, major } = req.body;

            if (!full_name || !phone || !email || !address || !education || !major) {
                return res.status(400).json({ message: "Vui lòng điền đầy đủ thông tin." });
            }

            const newItem = await Register.create({
                full_name,
                phone,
                email,
                address,
                education,
                major,
                status: "pending",
            });

            res.status(201).json(newItem);
        } catch (err) {
            res.status(500).json({ message: "Lỗi khi tạo đăng ký", error: err.message });
        }
    }

    // [PUT] /registers/:id
    async update(req, res) {
        try {
            const { status } = req.body;

            if (!["pending", "processed"].includes(status)) {
                return res.status(400).json({ message: "Trạng thái không hợp lệ." });
            }

            const item = await Register.findByPk(req.params.id);
            if (!item) return res.status(404).json({ message: "Không tìm thấy" });

            item.status = status;
            await item.save();

            res.json(item);
        } catch (err) {
            res.status(500).json({ message: "Lỗi cập nhật trạng thái", error: err.message });
        }
    }

    // [DELETE] /registers/:id
    async destroy(req, res) {
        const item = await Register.findByPk(req.params.id);
        if (!item) return res.status(404).json({ message: "Không tìm thấy" });

        await item.destroy();
        res.json({ message: "Xoá đăng ký thành công" });
    }
}

module.exports = new RegisterService();
