<div class="form-group">
    <label for="name">Название</label>
    <input class="form-control" name="name" id="name" type="text" placeholder="" value="{{ $model->name ?? old('name') ?? '' }}">
</div>

<select class="form-control select2" name="category_id" id="category">
    @foreach ($categories as $item)
        <option @if (isset($model) && $model->id == $item->id) selected @endif
                value="{{ $item->id }}">{{ $item->name }}</option>
    @endforeach
</select>

@section('js')
    <script src="{{ asset('js/recipes/edit.js') }}"></script>
@endsection
