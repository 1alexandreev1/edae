<div class="form-group">
    <label for="name">Название</label>
    <input class="form-control" name="name" id="name" type="text" placeholder="" value="{{ $model->name ?? old('name') ?? '' }}">
</div>

<div class="row justify-content-between">
    <div class="col-md-6 col-sm-12">
        <div class="form-group" id="group_ingredient" data-elements_count="1">
            <button  type="button" class="btn btn-primary  mb-2" onclick="ingredients.addFields('cloneElement', 'group_ingredient')">
                <i class="fas fa-plus"></i>
                Добавить ингридиент
            </button>
            <div class="row">
                <div class="col">Ингридиенты</div>
            </div>
            @foreach ($model->ingredients ?? [] as $key => $value)
                <div class="form-group">
                    <div class="row">
                        <div class="col-auto col-sm-7">
                            <input class="form-control" name="ingredient[old{{ $loop->index }}]"
                                    id="ingredient-{{ $loop->index }}" type="text" placeholder="Помидор" value="{{ $key }}">
                        </div>
                        <div class="col-auto">
                            <input class="form-control" type="text" name="ingredientCount[old{{ $loop->index }}]"
                                    id="ingredientCount-{{ $loop->index }}" placeholder="100 гр. или 3 шт." value="{{ $value }}">
                        </div>
                        <button type="button" class="btn btn-danger" onclick="ingredient.remove(this)">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="form-group d-none" id="cloneElement">
            <div class="row">
                <div class="col-auto col-sm-7">
                    <input class="form-control" id="ingredient" type="text" placeholder="Помидор">
                </div>
                <div class="col-auto">
                    <input class="form-control" type="text" id="ingredientCount" placeholder="100 гр. или 3 шт.">
                </div>
                <button type="button" class="btn btn-danger" onclick="ingredients.remove(this)">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        @include('edae.files',['btnName' => 'Добавить фото', 'label' => 'Фотографии (первое фото идет на обложку)'])
    </div>
</div>

<div class="form-group">
    <label for="text">Процесс готовки</label>
    <textarea class="form-control summernote" name="description" id="description" style="width: 100%; max-width: 1200px" rows="5">{{ $model->description ?? old('description') ?? '' }}</textarea>
</div>

<div class="form-group">
    <label for="">@lang('news.publish')</label>
    <input class="form-control selectDateTime" type="text" name="publish" value="{{  $model->publish ?? old('publish') ?? date('d.m.Y H:i') }}">
</div>

@include('edae.tags')

@section('js')
    <script src="{{ asset('js/recipes/edit.js') }}"></script>
@endsection
