const { Op } = require("sequelize");
const path = require("path");
const fs = require("fs");
const Document = require("../models/document.model.js");
const Course = require("../models/course.model.js");
Document.belongsTo(Course, {
    foreignKey: "course_id",
    as: "course",
});
Course.hasMany(Document, {
    foreignKey: "course_id",
    as: "documents",
});

class documentsService {
    // [GET] /documents?search=&page=&limit=
    async index(req, res) {
        try {
            const { search = "", page = 1, limit = 10 } = req.query;

            const { count, rows } = await Document.findAndCountAll({
                where: search
                    ? {
                        title: { [Op.like]: `%${search}%` },
                    }
                    : undefined,
                include: [
                    {
                        model: Course,
                        as: "course"
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
            res.status(500).json({ message: "Lỗi truy xuất danh sách tài liệu", error: err.message });
        }
    }

    // [GET] /documents/:id
    async show(req, res) {
        try {
            const document = await Document.findByPk(req.params.id, {
                include: [
                    {
                        model: Course,
                        as: "course"
                    },
                ],
            });
            if (!document) {
                return res.status(404).json({ message: "Không tìm thấy tài liệu" });
            }
            res.json(document);
        } catch (err) {
            res.status(500).json({ message: "Lỗi truy xuất tài liệu", error: err.message });
        }
    }

    // [POST] /documents
    async store(req, res) {
        const { title, description, course_id } = req.body;
            const file = req.file;

            // Validate dữ liệu
            if (!title || title.trim().length < 3) {
                return res.status(400).json({ message: "Tiêu đề phải có ít nhất 3 ký tự" });
            }

            if (!file) {
                return res.status(400).json({ message: "Vui lòng chọn tệp tài liệu" });
            }

            let file_path = `/uploads/${file.filename}`;

            const newDoc = await Document.create({
                title,
                description,
                course_id,
                file_path,
                uploaded_at: new Date(),
            });

            return res.status(201).json(newDoc);
        try {
            
        } catch (err) {
            res.status(500).json({ message: "Lỗi tạo tài liệu", error: err.message });
        }
    }

    // [PUT] /documents/:id
    async update(req, res) {
        try {
            const { title, description, course_id } = req.body;
            const file = req.file;

            const document = await Document.findByPk(req.params.id);
            if (!document) {
                return res.status(404).json({ message: "Không tìm thấy tài liệu" });
            }

            // Validate dữ liệu
            if (!title || title.trim().length < 3) {
                return res.status(400).json({ message: "Tiêu đề phải có ít nhất 3 ký tự" });
            }

            // Nếu có file mới, xoá file cũ
            if (file) {
                if (document.file_path) {
                    const oldPath = path.join("public", document.file_path);
                    if (fs.existsSync(oldPath)) fs.unlinkSync(oldPath);
                }
                document.file_path = `/uploads/${file.filename}`;
            }

            document.title = title;
            document.description = description;
            document.course_id = course_id;

            await document.save();
            res.json(document);
        } catch (err) {
            res.status(500).json({ message: "Lỗi cập nhật tài liệu", error: err.message });
        }
    }

    // [DELETE] /documents/:id
    async destroy(req, res) {
        try {
            const document = await Document.findByPk(req.params.id);
            if (!document) {
                return res.status(404).json({ message: "Không tìm thấy tài liệu" });
            }

            // Xoá file khỏi ổ cứng nếu có
            if (document.file_path) {
                const filePath = path.join("public", document.file_path);
                if (fs.existsSync(filePath)) fs.unlinkSync(filePath);
            }

            await document.destroy();
            res.json({ message: "Xoá tài liệu thành công" });
        } catch (err) {
            res.status(500).json({ message: "Lỗi xoá tài liệu", error: err.message });
        }
    }
}

module.exports = new documentsService();
