@extends('site.admin')

@section('title', 'Панель администратора')

@section('content')
    Добро пожаловать, {{ Auth::user()->login ?? 'пользователь' }}!
@stop
