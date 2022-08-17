@extends('site.general')

@section('content')
    <div class="card mb-3">
        <div class="card-header">
            <h3 class="cart-title h4">
                О нас
            </h3>
        </div>
        <div class="card-body">
            {!! $text ?? 'Тут пока ничего нет.' !!}
        </div>
    </div>
@endsection

@section('js')
@endsection
