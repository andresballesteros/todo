$(document).ready(function() {
    $("a[data-confirm]").click(function(ev) {
        var href = $(this).attr("href");
        if (!$("#dataConfirmModal").length) {
            $("body").append(
                '<div class="modal fade" id="dataConfirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmDialogTitle" aria-hidden="true"><div class="modal-dialog modal-dialog-centered" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="exampleModalLongTitle">Confirmación</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body">Hola</div><div class="modal-footer"><button type="button" class="btn btn-secondary btn-crear" data-dismiss="modal">Cancelar<i class="fa fa-times"></i></button><a class="btn btn-primary btn-crear" id="dataConfirmOK">Aceptar<i class="fa fa-check"></i></a></div></div></div></div>'
            );
        }
        $("#dataConfirmModal")
            .find(".modal-body")
            .text($(this).attr("data-confirm"));
        $("#dataConfirmOK").attr("href", href);
        $("#dataConfirmModal").modal({ show: true });
        return false;
    });
});
