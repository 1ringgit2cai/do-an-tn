const { Op } = require("sequelize");
const Lecturer = require("../models/lecturer.model.js");
const CourseLecturer = require("../models/course_lecturer.model.js");
const Course = require("../models/course.model.js");
const path = require("path");
const fs = require("fs");

class lecturersService {
    // [GET] /lecturers?search=&page=&limit=
    async index(req, res) {
        try {
            const { search = "", page = 1, limit = 10 } = req.query;

            const { count, rows } = await Lecturer.findAndCountAll({
                where: search
                    ? {
                        [Op.or]: [
                            { full_name: { [Op.like]: `%${search}%` } },
                            { academic_title: { [Op.like]: `%${search}%` } },
                            { department: { [Op.like]: `%${search}%` } },
                        ]
                    }
                    : undefined,
                order: [["createdAt", "DESC"]],
                limit: parseInt(limit),
                offset: (parseInt(page) - 1) * parseInt(limit),
            });

            const lecturerIds = rows.map(l => l.id);

            const courseLecturers = await CourseLecturer.findAll({
                where: { lecturer_id: lecturerIds }
            });

            const courseIds = [...new Set(courseLecturers.map(cl => cl.course_id))];

            const courses = await Course.findAll({
                where: { id: courseIds }
            });

            const coursesMap = {};
            courses.forEach(c => { coursesMap[c.id] = c });

            const lecturerCoursesMap = {};
            courseLecturers.forEach(cl => {
                if (!lecturerCoursesMap[cl.lecturer_id]) {
                    lecturerCoursesMap[cl.lecturer_id] = [];
                }
                lecturerCoursesMap[cl.lecturer_id].push(coursesMap[cl.course_id]);
            });

            const data = rows.map(l => {
                const lecturer = l.toJSON();
                lecturer.courses = lecturerCoursesMap[l.id] || [];
                return lecturer;
            });

            res.status(200).json({
                data,
                total: count,
                page: parseInt(page),
                totalPages: Math.ceil(count / limit),
            });
        } catch (err) {
            res.status(500).json({ message: "Lỗi truy xuất danh sách giảng viên", error: err.message });
        }
    }

    // [GET] /lecturers/:id
    async show(req, res) {
        try {
            const lecturer = await Lecturer.findByPk(req.params.id);
            if (!lecturer) {
                return res.status(404).json({ message: "Không tìm thấy giảng viên" });
            }
            res.json(lecturer);
        } catch (err) {
            res.status(500).json({ message: "Lỗi truy xuất giảng viên", error: err.message });
        }
    }

    // [POST] /lecturers
    async store(req, res) {
        try {
            const { full_name, academic_title, department, bio } = req.body;
            const file = req.file;

            // Validate thủ công
            if (!full_name || full_name.trim().length < 3) {
                return res.status(400).json({ message: "Họ tên phải có ít nhất 3 ký tự" });
            }

            if (!department || department.trim().length === 0) {
                return res.status(400).json({ message: "Vui lòng nhập khoa/bộ môn" });
            }

            if (academic_title && academic_title.length > 100) {
                return res.status(400).json({ message: "Học hàm tối đa 100 ký tự" });
            }

            if (bio && bio.length > 1000) {
                return res.status(400).json({ message: "Tiểu sử tối đa 1000 ký tự" });
            }

            let image = null;
            if (file) {
                image = `/uploads/${file.filename}`;
            } else {
                return res.status(400).json({ message: "Vui lòng chọn ảnh giảng viên" });
            }

            const newLecturer = await Lecturer.create({
                full_name,
                academic_title,
                department,
                bio,
                image,
            });

            res.status(201).json(newLecturer);
        } catch (err) {
            res.status(500).json({ message: "Lỗi tạo mới giảng viên", error: err.message });
        }
    }

    // [PUT] /lecturers/:id
    async update(req, res) {
        try {
            const { full_name, academic_title, department, bio } = req.body;
            const lecturer = await Lecturer.findByPk(req.params.id);
            const file = req.file;

            if (!lecturer) {
                return res.status(404).json({ message: "Không tìm thấy giảng viên" });
            }

            // Validate thủ công
            if (!full_name || full_name.trim().length < 3) {
                return res.status(400).json({ message: "Họ tên phải có ít nhất 3 ký tự" });
            }

            if (!department || department.trim().length === 0) {
                return res.status(400).json({ message: "Vui lòng nhập khoa/bộ môn" });
            }

            if (academic_title && academic_title.length > 100) {
                return res.status(400).json({ message: "Học hàm tối đa 100 ký tự" });
            }

            if (bio && bio.length > 1000) {
                return res.status(400).json({ message: "Tiểu sử tối đa 1000 ký tự" });
            }

            // Nếu có ảnh mới => xoá ảnh cũ (nếu có)
            if (file) {
                if (lecturer.image) {
                    const oldPath = path.join("public", lecturer.image);
                    if (fs.existsSync(oldPath)) fs.unlinkSync(oldPath);
                }
                lecturer.image = `/uploads/${file.filename}`;
            }

            lecturer.full_name = full_name;
            lecturer.academic_title = academic_title;
            lecturer.department = department;
            lecturer.bio = bio;

            await lecturer.save();
            res.json(lecturer);
        } catch (err) {
            res.status(500).json({ message: "Lỗi cập nhật giảng viên", error: err.message });
        }
    }

    // [DELETE] /lecturers/:id
    async destroy(req, res) {
        try {
            const lecturer = await Lecturer.findByPk(req.params.id);
            if (!lecturer) {
                return res.status(404).json({ message: "Không tìm thấy giảng viên" });
            }

            await lecturer.destroy();
            res.json({ message: "Xoá giảng viên thành công" });
        } catch (err) {
            res.status(500).json({ message: "Lỗi xoá giảng viên", error: err.message });
        }
    }
}

module.exports = new lecturersService();
