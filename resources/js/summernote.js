window.$ = window.jQuery = require('jquery');

window.jQuery(document).ready(function() {
    console.log("Hello");
    window.jQuery('#summernote').summernote();
});
