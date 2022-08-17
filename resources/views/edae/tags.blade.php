<div class="form-group ">
    <label for="">Теги</label>
    <div class="row">
        <div class="col">
            <select class="form-control select2" multiple name="tags[]" id="tags">
                @foreach ($tags as $item)
                    <option @if (isset($model) && $model->tags->firstWhere('id', $item->id)) selected @endif
                            value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-auto">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add_tag_modal">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>
</div>

