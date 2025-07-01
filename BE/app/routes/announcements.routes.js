const express = require('express');
const router = express.Router();
const services = require('../services/announcements.services.js');
const upload = require("../middlewares/upload.js");
const auth = require("../middlewares/auth.js");

router.get("/", services.index);
router.get("/:id", services.show);
router.post("/", auth, upload.single("cover_image"), services.store);
router.put("/:id", auth, upload.single("cover_image"), services.update);
router.delete("/:id", auth, services.destroy);


module.exports = router;