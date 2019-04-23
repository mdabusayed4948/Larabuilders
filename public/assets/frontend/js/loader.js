

//========================
// Loader
//========================
jQuery(window).on('load', function () {
    if (jQuery(".container-loader").length > 0)
    {
        jQuery(".container-loader").delay(800).fadeOut("slow");
    }
});