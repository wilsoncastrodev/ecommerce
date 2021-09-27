@if ($errors->any())
    @if (count($errors) > 1)
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        <strong>Oops!</strong> Ocorreu alguns erros ao realizar o cadastro.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @else
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        <strong>Oops!</strong> Ocorreu um erro ao realizar o cadastro.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
@endif
