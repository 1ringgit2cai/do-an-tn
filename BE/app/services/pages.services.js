const Page = require("../models/page.model.js");
const { Op } = require("sequelize");

class PageService {
    // [GET] /pages?search=&page=&limit=
    async index(req, res) {
        const { search = "", page = 1, limit = 10 } = req.query;

        try {
            const { count, rows } = await Page.findAndCountAll({
                where: search
                    ? {
                        [Op.or]: [
                            { title: { [Op.like]: `%${search}%` } },
                            { slug: { [Op.like]: `%${search}%` } }
                        ]
                    }
                    : undefined,
                order: [["createdAt", "DESC"]],
                limit: parseInt(limit),
                offset: (parseInt(page) - 1) * parseInt(limit)
            });

            res.status(200).json({
                data: rows,
                total: count,
                page: parseInt(page),
                totalPages: Math.ceil(count / limit)
            });
        } catch (err) {
            res.status(500).json({ message: "Lỗi truy xuất", error: err.message });
        }
    }

    // [GET] /pages/:id
    async show(req, res) {
        const page = await Page.findByPk(req.params.id);
        if (!page) return res.status(404).json({ message: "Không tìm thấy" });
        res.json(page);
    }

    // [GET] /:slug/detail
    async showBySlug(req, res) {
        const page = await Page.findOne({ where: { slug: req.params.slug } });
        if (!page) return res.status(404).json({ message: "Không tìm thấy" });
        res.json(page);
    }

    // [POST] /pages
    async store(req, res) {
        try {
            const { slug, title, content, type = "admission" } = req.body;

            if (!title || !slug) {
                return res.status(400).json({ message: "Thiếu slug hoặc tiêu đề" });
            }

            const newPage = await Page.create({ slug, title, content, type });

            res.status(201).json(newPage);
        } catch (err) {
            res.status(500).json({ message: "Lỗi tạo mới", error: err.message });
        }
    }

    // [PUT] /pages/:id
    async update(req, res) {
        try {
            const { slug, title, content, type } = req.body;

            const page = await Page.findByPk(req.params.id);
            if (!page) return res.status(404).json({ message: "Không tìm thấy" });

            page.slug = slug;
            page.title = title;
            page.content = content;
            page.type = type;

            await page.save();
            res.json(page);
        } catch (err) {
            res.status(500).json({ message: "Lỗi cập nhật", error: err.message });
        }
    }

    // [DELETE] /pages/:id
    async destroy(req, res) {
        const page = await Page.findByPk(req.params.id);
        if (!page) return res.status(404).json({ message: "Không tìm thấy" });

        await page.destroy();
        res.json({ message: "Xoá thành công" });
    }
}

module.exports = new PageService();
