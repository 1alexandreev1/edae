<div class="form-group">
    <label for="">@lang('news.name')</label>
    <input class="form-control" name="name" id="name" type="text" placeholder="" value="{{ $model->name ?? old('name') ?? '' }}">
</div>

<div class="form-group">
    @include('edae.files',['btnName' => 'Добавить файл/изображение', 'label' => 'Фотографии (первое фото идет на обложку)'])
</div>

<div class="form-group">
    <label for="">@lang('news.text')</label>
    <textarea class="form-control summernote" name="text" id="text" style="width: 1000px" rows="5">{{ $model->text ?? old('text') ?? '' }}</textarea>
</div>

<div class="form-group">
    <label for="">@lang('news.publish')</label>
    <input class="form-control selectDateTime" type="text" name="publish" value="{{  $model->publish ?? old('publish') }}">
</div>

@include('edae.tags')
