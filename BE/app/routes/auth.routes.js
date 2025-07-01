const express = require("express");
const router = express.Router();
const upload = require("../middlewares/upload.js");
const authService = require("../services/auth.services");

router.post("/login", upload.none(), authService.login);

module.exports = router;
