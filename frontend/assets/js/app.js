$(document).ready(function () {
    var app = $.spapp({
        defaultView: "home", // which view loads first
        templateDir: "views/" // where view files are stored
    });

    // define routes for each view
    app.route({
        view: "home",
        load: "home.html"
    });

    app.route({
        view: "portfolio",
        load: "portfolio.html"
    });

    app.route({
        view: "about",
        load: "about.html"
    });

    app.route({
        view: "contact",
        load: "contact.html"
    });

    app.run();
});
