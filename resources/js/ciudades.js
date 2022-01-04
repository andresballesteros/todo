$(window).on(function() {
    $(".loader").fadeOut("slow");
});
var jq = $.noConflict(true);
jq(function() {
    jq(".select2bs4").select2({
        theme: "bootstrap4"
    });
});

