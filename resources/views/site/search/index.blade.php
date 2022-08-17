@extends('site.general')

@section('content')
    <form class="form-inline my-2 row" method="post" action="{{ route('search') }}">
        @csrf
        <div class="col">
            <input class="form-control mr-sm-2 w-100" type="text" name="q" value="{{ $q }}" placeholder="{{ __('search.placeholder') }}"
                    aria-label="{{ __('search.title') }}">
        </div>
        <div class="col-auto">
            <button class="btn btn-outline-success my-sm-0" type="submit"><i
                    class="fas fa-search"></i></button>
        </div>
    </form>
    @forelse ($searchData as $item)
        @foreach ($item->data as $model)
            <a href="{{ route($item->modul . 'show', $model->id) }}">
                @php($nameForUrl = $item->name)
                <h3>{{ $model->$nameForUrl }}</h3>
            </a>
            <div>
                Модуль: <a href="{{ route($item->modul . 'index') }}">@lang($item->modul . 'title')</a>
            </div>
            <hr>
        @endforeach
    @empty
        <div class="card">
            <div class="card-body">
                <div class="text-center">
                    Поиск не дал результатов
                </div>
            </div>
        </div>
    @endforelse
@endsection

@section('js')
@endsection
