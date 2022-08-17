@extends('adminlte::page')

@section('title', $title ?? 'Панель администратора')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    @yield('css')
@stop

@section('content_lte')
    <h1>{{ $title ?? 'Панель администратора' }}</h1>
    <div class="card">
        @if (isset($permission))
            <div class="card-header">
                @include('edae.add_button')
            </div>
        @endif
        <div class="card-body">
            @yield('content')
        </div>
    </div>
@stop

@section('adminlte_js')
    <script src="{{ asset('js/main.js') }}"></script>
    @yield('js')
@stop
