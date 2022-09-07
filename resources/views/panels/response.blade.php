@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show alert-validation-msg" role="alert">
    <div class="alert-body">
        @foreach ($errors->all() as $error)
        <i data-feather="info" class="mr-50 align-middle"></i>
        <span>{{ $error }}</span>
        <br>
        @endforeach
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif

@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <div class="alert-body">
        <i data-feather="check" class="mr-50 align-middle"></i>
        <span>{{ session('success') }}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif

@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <div class="alert-body">
        <i data-feather="x-circle" class="mr-50 align-middle"></i>
        <span>{{ session('error') }}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif 