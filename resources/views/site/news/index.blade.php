@extends($extendsTemplate)

@section('content')
    @forelse ($models as $model)
        <div class="card  mb-3">
            <div class="card-header">
                <h3 class="cart-title h4">
                    <a href="{{ route($route.'show', $model) }}">
                        {{ $model->name }}
                    </a>
                </h3>
            </div>
            <div class="card-body">
                {{-- убрать из новостей обязательный блок картинки --}}
                <div class="row">
                    <div class="col-auto">
                        <img class="adaptive-500-400" src="{{ empty($model->getFirstMediaUrl('')) ? asset('img/not-logo-news.jpg') : $model->getFirstMediaUrl('') }}" alt="food">
                    </div>
                    <div class="col-auto">
                        {!! Str::words($model->getReplaceField('text', true), 50) !!} <a href="{{ route($route.'show', $model) }}"><span class="h6">Читать дальше...<span></a>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                @include($statistics ?? 'edae.statistics')
            </div>
        </div>
        {{ $models->onEachSide(5)->links() }}
    @empty
        <div class="card">
            <div class="card-body">
                Новостей пока нет.
            </div>
        </div>
    @endforelse
@endsection

@section('js')
@endsection
