<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Inventory') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    @stack('styles')

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    <div id="app">
        @include('layouts.header')
        <div class="app-body">
            @include('layouts.sidebar')
            <main class="main">
            <ol class="breadcrumb"></ol>
                <div class="container-fluid">
                    <div class="animated fadeIn">
                        <div class="container-fluid">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
<style>
.modal-backdrop {
    visibility: hidden !important;
}
.modal-in {
    background-color: rgba(0, 0, 0, 5);
}
</style>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="/vendor/datatables/buttons.server-side.js"></script>
<link rel="stylesheet" href="{{ asset('bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<script src="{{ asset('bootstrap-datepicker/dist/js/bootstrap-datepicker.js') }}"></script>

<script>
$(document).on('hidden.bs.modal',function(event)=>{
    if($('.modal:visible').length){
        $('body').addClass('modal-open');
    }
});
<script>
    $(document.body).on('click', '.js-submit-confirm', function(event) {
        event.preventDefault();
        var $form = $(this).closest('form');
        swal({
        title: "Anda Yakin?",
        text: "Anda yakin akan menghapus data ini",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            $form.submit();
        }
        });
  });
</script>
@stack('scripts')
</html>