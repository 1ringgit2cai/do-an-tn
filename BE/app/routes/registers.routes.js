const express = require('express');
const router = express.Router();
const services = require('../services/registers.services.js');
const upload = require("../middlewares/upload.js");
const auth = require("../middlewares/auth.js");

router.get("/", auth, services.index);
router.get("/:id", auth, services.show);
router.post("/", upload.none(), services.store);
router.put("/:id", auth, upload.none(), services.update);
router.delete("/:id", auth, services.destroy);


module.exports = router;