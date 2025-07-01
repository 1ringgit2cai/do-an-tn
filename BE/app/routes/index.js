const announcementRoute = require("./announcements.routes.js");
const courseRoute = require("./courses.routes.js");
const lecturerRoute = require("./lecturers.routes.js");
const documentRoute = require("./documents.routes.js");
const thesisRoute = require("./theses.routes.js");
const authRoute = require("./auth.routes.js");
const registerRoute = require("./registers.routes.js");
const pageRoute = require("./pages.routes.js");

function route(app){
    app.use("/announcements", announcementRoute);
    app.use("/courses", courseRoute);
    app.use("/lecturers", lecturerRoute);
    app.use("/documents", documentRoute);
    app.use("/theses", thesisRoute);
    app.use("/registers", registerRoute);
    app.use("/pages", pageRoute);
    app.use("/auth", authRoute);
}

module.exports = route