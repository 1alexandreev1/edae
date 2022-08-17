<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('plugins/datepicker/css/gijgo.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('plugins/fancybox/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    @yield('css')
    @if (Route::is('home'))
        <title>{{ 'Главная страница сайта Edaee.ru' }}</title>
    @else
        <title>{{ $title ?? 'Страница сайта Edaee.ru' }}</title>
    @endif
</head>
<body class="bg-light">
    @include('edae.menu')

    <div class="row justify-content-center w-100 my-2">
        <div class="col-sm-4 col-md-6">
            @yield('content')
        </div>
        @if (isset($block_availability) && $block_availability)
            <div class="col-sm-3 col-md-3">
                @include('edae.blocks')
            </div>
        @endif

    </div>

    {{-- <div class="container ">
        <div class="row no-gutters">
            <div class="col-sm-6 col-md-8 {{-- jumbotron w-100 -}}">
                @yield('content')
            </div>
            <div class="col-5 col-md-3 mt-3 ml-2">
                @include('edae.blocks')
            </div>
        </div>
    </div> --}}

    <footer class="footer mt-auto py-2 bg-dark">
        <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
        <script src="{{ asset('vendor/select2/js/select2.full.min.js') }}"></script>
        <script src="{{ asset('vendor/select2/js/i18n/ru.js') }}"></script>
        <script src="{{ asset('vendor/summernote/summernote-bs4.min.js') }}"></script>
        <script src="{{ asset('vendor/summernote/lang/summernote-ru-RU.min.js') }}"></script>
        <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
        {{-- <script src="{{ asset('plugins/datepicker/js/gijgo.min.js') }}"></script>
        <script src="{{ asset('plugins/datepicker/js/messages/messages.ru-ru.js') }}"></script> --}}
        <script src="{{ asset('vendor/daterangepicker/daterangepicker.js') }}"></script>
        <script src="{{ asset('plugins/fancybox/jquery.fancybox.min.js') }}"></script>
        <script src="{{ asset('vendor/inputmask/jquery.inputmask.min.js') }}"></script>
        <script src="{{ asset('vendor/moment/moment-with-locales.min.js') }}"></script>
        {{-- <script src="{{ asset('vendor/moment/moment.min.js.map') }}"></script> --}}
        <script src="{{ asset('vendor/moment/locale/ru.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script>
        @yield('js')
        <div class="container">
          <span class="text-muted">edaee.ru (c)</span>
        </div>
    </footer>
</body>
</html>
