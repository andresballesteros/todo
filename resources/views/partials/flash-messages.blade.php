{{-- Mensajes de confirmación --}}
@if (session()->has('flash'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('flash') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
