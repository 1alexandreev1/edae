<button  type="button" class="btn btn-primary mb-2" onclick="field.clone('cloneFiles', 'group_files');">
    <i class="fas fa-plus"></i>
    {{ $btnName }}
</button>
<input class="d-none" name="last_code" type="number" value="{{ old('last_code') ?? $model->last_code ?? 1 }}">
<div class="row">
    <div class="col">{{ $label }}</div>
</div>
<div class="form-group" id="group_files">
    @foreach ($medias as $media)
        <div class="form-group">
            <div class="row">
                <div class="col-auto col-7">
                    <input class="form-control file" type="text" readonly id="file-{{ $loop->index }}" name="fileOld[{{ $media->uuid }}]" value="{{ $media->file_name }}">
                </div>
                <div class="col-auto col-3">
                    <input class="form-control file-code" type="text" readonly id="fileCode-{{ $loop->index }}" onclick="copyVal(this)"
                        value="{{ $media->getCustomProperty('code') }}" name="fileCode[{{ $media->uuid }}]" placeholder="$CODE$">
                </div>
                <button type="button" class="btn btn-danger" onclick="field.remove(this)">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
    @endforeach
</div>
<div class="form-group d-none" id="cloneFiles">
    <div class="row">
        <div class="col-auto col-7">
            <input class="form-control file" onchange="field.showCode(this)" type="file" id="file">
        </div>
        <div class="col-auto col-3">
            <input class="form-control file-code" type="text" readonly id="codeFile" value="" onchange="" placeholder="$code$" onclick="copyVal(this)">
        </div>
        <button type="button" class="btn btn-danger" onclick="field.remove(this)">
            <i class="fas fa-minus"></i>
        </button>
    </div>
</div>
