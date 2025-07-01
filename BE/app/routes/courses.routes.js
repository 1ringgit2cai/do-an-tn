const express = require("express");
const router = express.Router();
const services = require("../services/courses.services.js");
const upload = require("../middlewares/upload.js");
const auth = require("../middlewares/auth.js");

router.get("/:id/lecturer", services.listLecturer);
router.post("/:id/lecturer", auth, upload.none(), services.addLecturer);
router.delete("/:id/lecturer", auth, services.removeLecturer);

router.get("/:id", services.show);
router.post("/", auth, upload.none(), services.store);
router.put("/:id", auth, upload.none(), services.update);
router.delete("/:id", auth, services.destroy);
router.get("/", services.index);

module.exports = router;
