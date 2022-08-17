@extends($extendsTemplate)

@section('content')
    {{-- @forelse ($models as $item)
        <div class="card  mb-3">
            <div class="card-header">
                <h3 class="cart-title h4">
                    <a href="{{ route($route.'show', $item) }}">
                        {{ $item->name }}
                    </a>
                </h3>
            </div>
            <div class="card-body">
                {{-- убрать из новостей обязательный блок картинки -}}
                <div class="row">
                    <div class="col-auto">
                        <img class="" src="{{asset('img/not-logo-food.png')}}" alt="food"
                                style="swidth: 100%; height: 100%; ;max-width: 500px; max-height: 400px;">
                    </div>
                    <div class="col-auto">
                        {{ Str::words($item->text, 50) }}
                        <a href="{{ route($route.'show', $item) }}"><h6>Смотреть дальше...</h6></a>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                статистика рецептов
            </div>
        </div>
    @empty
        <div class="card">
            <div class="card-body">
                Рецептов пока нет.
            </div>
        </div>
    @endforelse --}}
@endsection

@section('js')
@endsection
