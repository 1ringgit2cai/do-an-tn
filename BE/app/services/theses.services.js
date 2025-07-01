const { Op } = require("sequelize");
const path = require("path");
const fs = require("fs");
const Thesis = require("../models/thesis.model.js");
const Lecturer = require("../models/lecturer.model.js");

Thesis.belongsTo(Lecturer, {
    foreignKey: "lecturer_id",
    as: "lecturer",
});
Lecturer.hasMany(Thesis, {
    foreignKey: "lecturer_id",
    as: "theses",
});

class thesesService {
    // [GET] /theses?search=&page=&limit=
    async index(req, res) {
        try {
            const { search = "", page = 1, limit = 10 } = req.query;

            const { count, rows } = await Thesis.findAndCountAll({
                where: search
                    ? {
                        title: { [Op.like]: `%${search}%` },
                    }
                    : undefined,
                include: [
                    {
                        model: Lecturer,
                        as: "lecturer",
                    },
                ],
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
            res.status(500).json({ message: "Lỗi truy xuất danh sách luận văn", error: err.message });
        }
    }

    // [GET] /theses/:id
    async show(req, res) {
        try {
            const thesis = await Thesis.findByPk(req.params.id, {
                include: [
                    {
                        model: Lecturer,
                        as: "lecturer",
                    },
                ],
            });
            if (!thesis) {
                return res.status(404).json({ message: "Không tìm thấy luận văn" });
            }
            res.json(thesis);
        } catch (err) {
            res.status(500).json({ message: "Lỗi truy xuất luận văn", error: err.message });
        }
    }

    // [POST] /theses
    async store(req, res) {
        try {
            const { title, abstract, author_name, lecturer_id, year } = req.body;
            const file = req.file;

            if (!title || title.trim().length < 3) {
                return res.status(400).json({ message: "Tiêu đề phải có ít nhất 3 ký tự" });
            }
            if (!author_name || author_name.trim().length < 3) {
                return res.status(400).json({ message: "Tên tác giả phải có ít nhất 3 ký tự" });
            }
            if (!file) {
                return res.status(400).json({ message: "Vui lòng chọn file luận văn" });
            }

            let file_path = `/uploads/${file.filename}`;

            const newThesis = await Thesis.create({
                title,
                abstract,
                author_name,
                lecturer_id,
                year,
                file_path,
            });

            res.status(201).json(newThesis);
        } catch (err) {
            res.status(500).json({ message: "Lỗi tạo luận văn", error: err.message });
        }
    }

    // [PUT] /theses/:id
    async update(req, res) {
        try {
            const { title, abstract, author_name, lecturer_id, year } = req.body;
            const file = req.file;

            const thesis = await Thesis.findByPk(req.params.id);
            if (!thesis) {
                return res.status(404).json({ message: "Không tìm thấy luận văn" });
            }

            if (!title || title.trim().length < 3) {
                return res.status(400).json({ message: "Tiêu đề phải có ít nhất 3 ký tự" });
            }
            if (!author_name || author_name.trim().length < 3) {
                return res.status(400).json({ message: "Tên tác giả phải có ít nhất 3 ký tự" });
            }

            if (file) {
                if (thesis.file_path) {
                    const oldPath = path.join("public", thesis.file_path);
                    if (fs.existsSync(oldPath)) fs.unlinkSync(oldPath);
                }
                thesis.file_path = `/uploads/${file.filename}`;
            }

            thesis.title = title;
            thesis.abstract = abstract;
            thesis.author_name = author_name;
            thesis.lecturer_id = lecturer_id;
            thesis.year = year;

            await thesis.save();
            res.json(thesis);
        } catch (err) {
            res.status(500).json({ message: "Lỗi cập nhật luận văn", error: err.message });
        }
    }

    // [DELETE] /theses/:id
    async destroy(req, res) {
        try {
            const thesis = await Thesis.findByPk(req.params.id);
            if (!thesis) {
                return res.status(404).json({ message: "Không tìm thấy luận văn" });
            }

            if (thesis.file_path) {
                const filePath = path.join("public", thesis.file_path);
                if (fs.existsSync(filePath)) fs.unlinkSync(filePath);
            }

            await thesis.destroy();
            res.json({ message: "Xoá luận văn thành công" });
        } catch (err) {
            res.status(500).json({ message: "Lỗi xoá luận văn", error: err.message });
        }
    }
}

module.exports = new thesesService();
