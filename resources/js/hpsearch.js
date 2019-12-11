const $ = require("jquery");

$(document).ready(function () {
    $("#province").change(function() {
        console.log($(this).val());
        let u = $("meta[name=hp_search_province_url]").attr("content").replace("X", $(this).val());
        console.log("URL", u);
        window.location = u;
    });
});
