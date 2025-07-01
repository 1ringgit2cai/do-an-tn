const express = require('express');
const router = express.Router();
const services = require('../services/lecturers.services.js');
const upload = require("../middlewares/upload.js");
const auth = require("../middlewares/auth.js");

router.get("/", services.index);
router.get("/:id", services.show);
router.post("/", auth, upload.single("image"), services.store);
router.put("/:id", auth, upload.single("image"), services.update);
router.delete("/:id", auth, services.destroy);


module.exports = router;