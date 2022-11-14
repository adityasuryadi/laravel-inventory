@if(session('danger'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('message') }}
    <button class="close" type="button" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
@elseif(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('message') }}
    <button class="close" type="button" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
@endif