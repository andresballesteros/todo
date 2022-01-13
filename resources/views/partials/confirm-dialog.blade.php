{{--   plantilla para dialogos de confirmación --}}
  <div class="modal fade" id="confirmDialog" tabindex="-1" role="dialog" aria-labelledby="confirmDialogTitle"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Confirmación</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  {{ $mensaje }}
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary btn-crear" data-dismiss="modal">Cancelar<i
                          class="fa fa-times"></i></button>
                  <a href="#" class="btn btn-primary btn-crear" onclick="this.onclick=null;event.preventDefault();
          document.getElementById('{{ $formId }}').submit();">Aceptar<i class="fa fa-check"></i></a>
              </div>
          </div>
      </div>
  </div>
