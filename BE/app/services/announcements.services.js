const path = require("path");
const fs = require("fs");
const Announcement = require("../models/announcement.model.js");
const { Op } = require("sequelize");

class announcementService {
  // [GET] /announcements?search=&page=&limit=
  async index(req, res) {
    const { search = "", page = 1, limit = 10 } = req.query;

    try {
      const { count, rows } = await Announcement.findAndCountAll({
        where: search
          ? { title: { [Op.like]: `%${search}%` } }
          : undefined,
        order: [["posted_at", "DESC"]],
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

  // [GET] /announcements/:id
  async show(req, res) {
    const item = await Announcement.findByPk(req.params.id);
    if (!item) return res.status(404).json({ message: "Không tìm thấy" });
    res.json(item);
  }

  // [POST] /announcements
  async store(req, res) {
    try {
      const { title, content, posted_at } = req.body;
      const file = req.file;

      if (!title || !content) {
        return res.status(400).json({ message: "Thiếu tiêu đề hoặc nội dung" });
      }

      let cover_image = null;
      if (file) {
        cover_image = `/uploads/${file.filename}`;
      }

      const newItem = await Announcement.create({
        title,
        content,
        posted_at,
        cover_image,
      });

      res.status(201).json(newItem);
    } catch (err) {
      res.status(500).json({ message: "Lỗi tạo mới", error: err.message });
    }
  }

  // [PUT] /announcements/:id
  async update(req, res) {
    try {
      const { title, content, posted_at } = req.body;

      const file = req.file;

      const item = await Announcement.findByPk(req.params.id);
      if (!item) return res.status(404).json({ message: "Không tìm thấy" });

      if (file) {
        if (item.cover_image) {
          const oldPath = path.join("public", item.cover_image);
          if (fs.existsSync(oldPath)) fs.unlinkSync(oldPath);
        }
        item.cover_image = `/uploads/${file.filename}`;
      }

      item.title = title;
      item.content = content;
      item.posted_at = posted_at;

      await item.save();
      res.json(item);
    } catch (err) {
      res.status(500).json({ message: "Lỗi cập nhật", error: err.message });
    }
  }

  // [DELETE] /announcements/:id
  async destroy(req, res) {
    const item = await Announcement.findByPk(req.params.id);
    if (!item) return res.status(404).json({ message: "Không tìm thấy" });

    if (item.cover_image) {
      const filePath = path.join("public", item.cover_image);
      if (fs.existsSync(filePath)) fs.unlinkSync(filePath);
    }

    await item.destroy();
    res.json({ message: "Xoá thành công" });
  }
}

module.exports = new announcementService();
