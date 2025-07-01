const { Op } = require("sequelize");
const Course = require("../models/course.model.js");
const Lecturer = require("../models/lecturer.model.js");
const CourseLecturer = require("../models/course_lecturer.model.js");
Course.belongsToMany(Lecturer, {
  through: CourseLecturer,
  foreignKey: "course_id",
  otherKey: "lecturer_id",
  as: "lecturers"
});

Lecturer.belongsToMany(Course, {
  through: CourseLecturer,
  foreignKey: "lecturer_id",
  otherKey: "course_id",
  as: "courses"
});
class coursesService {
    // [GET] /courses?search=&page=&limit=
    async index(req, res) {
        try {
            const { search = "", page = 1, limit = 10 } = req.query;

            const { count, rows } = await Course.findAndCountAll({
                where: search
                    ? {
                        [Op.or]: [
                            { name: { [Op.like]: `%${search}%` } },
                            { course_code: { [Op.like]: `%${search}%` } }
                        ]
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
            res.status(500).json({ message: "Lỗi truy xuất danh sách khoá học", error: err.message });
        }
    }

    // [GET] /courses/:id
    async show(req, res) {
        try {
            const course = await Course.findByPk(req.params.id);
            if (!course) {
                return res.status(404).json({ message: "Không tìm thấy khoá học" });
            }
            res.json(course);
        } catch (err) {
            res.status(500).json({ message: "Lỗi truy xuất khoá học", error: err.message });
        }
    }

    // [POST] /courses
    async store(req, res) {
        try {
            const { course_code, name, description, credits } = req.body;

            // Validate thủ công
            if (!course_code) {
                return res.status(400).json({ message: "Vui lòng nhập mã khóa học" });
            }
            if (!name || name.length < 5) {
                return res.status(400).json({ message: "Tên khoá học phải có ít nhất 5 ký tự" });
            }
            if (description && description.length > 500) {
                return res.status(400).json({ message: "Mô tả tối đa 500 ký tự" });
            }
            if (!credits || isNaN(credits) || credits < 1 || credits > 10) {
                return res.status(400).json({ message: "Số tín chỉ phải từ 1 đến 10" });
            }

            const newCourse = await Course.create({
                course_code,
                name,
                description,
                credits,
            });

            res.status(201).json(newCourse);
        } catch (err) {
            res.status(500).json({ message: "Lỗi tạo mới khoá học", error: err.message });
        }
    }

    // [PUT] /courses/:id
    async update(req, res) {
        try {
            const { course_code, name, description, credits } = req.body;
            const course = await Course.findByPk(req.params.id);

            if (!course) {
                return res.status(404).json({ message: "Không tìm thấy khoá học" });
            }

            // Validate thủ công
            if (!course_code) {
                return res.status(400).json({ message: "Vui lòng nhập mã khóa học" });
            }
            if (!name || name.length < 5) {
                return res.status(400).json({ message: "Tên khoá học phải có ít nhất 5 ký tự" });
            }
            if (description && description.length > 500) {
                return res.status(400).json({ message: "Mô tả tối đa 500 ký tự" });
            }
            if (!credits || isNaN(credits) || credits < 1 || credits > 10) {
                return res.status(400).json({ message: "Số tín chỉ phải từ 1 đến 10" });
            }

            course.course_code = course_code;
            course.name = name;
            course.description = description;
            course.credits = credits;

            await course.save();
            res.json(course);
        } catch (err) {
            res.status(500).json({ message: "Lỗi cập nhật khoá học", error: err.message });
        }
    }

    // [DELETE] /courses/:id
    async destroy(req, res) {
        try {
            const course = await Course.findByPk(req.params.id);
            if (!course) {
                return res.status(404).json({ message: "Không tìm thấy khoá học" });
            }

            await course.destroy();
            res.json({ message: "Xoá khoá học thành công" });
        } catch (err) {
            res.status(500).json({ message: "Lỗi xoá khoá học", error: err.message });
        }
    }

    // [GET] /courses/lecturer/:id
    async listLecturer(req, res) {
        
        try {
            const course = await Course.findByPk(req.params.id, {
                include: {
                    model: Lecturer,
                    as: "lecturers",
                    through: { attributes: [] } // bỏ bảng trung gian
                }
            });

            if (!course) {
                return res.status(404).json({ message: "Không tìm thấy khóa học" });
            }

            res.json({data: course.lecturers});
        } catch (err) {
            res.status(500).json({ message: "Lỗi truy xuất giảng viên", error: err.message });
        }
    }

    // [POST] /courses/lecturer/:id
    async addLecturer(req, res) {
        try {
            const course_id = req.params.id;
            const { lecturer_id } = req.body;

            if (!lecturer_id) {
                return res.status(400).json({ message: "Vui lòng nhập lecturer_id" });
            }

            const course = await Course.findByPk(course_id);
            const lecturer = await Lecturer.findByPk(lecturer_id);

            if (!course || !lecturer) {
                return res.status(404).json({ message: "Khóa học hoặc giảng viên không tồn tại" });
            }

            await CourseLecturer.create({ course_id, lecturer_id });
            res.status(201).json({ message: "Gán giảng viên thành công" });
        } catch (err) {
            if (err.name === "SequelizeUniqueConstraintError") {
                return res.status(409).json({ message: "Giảng viên đã được gán vào khóa học này" });
            }
            res.status(500).json({ message: "Lỗi gán giảng viên", error: err.message });
        }
    }

    // [DELETE] /courses/lecturer/:id
    async removeLecturer(req, res) {
        try {
            const course_id = req.params.id;
            const { lecturer_id } = req.query;

            if (!lecturer_id) {
                return res.status(400).json({ message: "Vui lòng cung cấp lecturer_id để xoá" });
            }

            const deleted = await CourseLecturer.destroy({
                where: { course_id, lecturer_id }
            });

            if (deleted === 0) {
                return res.status(404).json({ message: "Không tìm thấy liên kết để xoá" });
            }

            res.json({ message: "Xoá giảng viên khỏi khoá học thành công" });
        } catch (err) {
            res.status(500).json({ message: "Lỗi xoá giảng viên", error: err.message });
        }
    }
}

module.exports = new coursesService();
