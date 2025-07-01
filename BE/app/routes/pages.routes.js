const express = require('express');
const router = express.Router();
const services = require('../services/pages.services.js');
const upload = require("../middlewares/upload.js");
const auth = require("../middlewares/auth.js");

router.get("/", services.index);
router.get("/:id", services.show);
router.get("/:slug/detail", services.showBySlug);
router.post("/", auth, upload.none(), services.store);
router.put("/:id", auth, upload.none(), services.update);
router.delete("/:id", auth, services.destroy);

module.exports = router;