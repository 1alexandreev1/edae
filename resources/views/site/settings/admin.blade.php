@extends($extendsTemplate)

@section('content')
    <form action="{{ route("admin.{$route}save") }}" method="post">
        @method('post')
        @csrf
        <div class="card card-primary card-outline card-tabs">
            <div class="card-header p-0 pt-1 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                    @foreach ($models as $model)
                        <li class="nav-item">
                            <a class="nav-link @if ($loop->first) active @endif" id="tab_{{ $model->slug }}" data-toggle="pill" href="#{{ $model->slug }}" role="tab" aria-controls="{{ $model->slug }}" aria-selected="true">
                                @lang("{$translation}{$model->slug}.title")
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="tabContent">
                    @foreach ($models as $model)
                        <div class="tab-pane fade @if ($loop->first) active show @endif" id="{{ $model->slug }}" role="tabpanel" aria-labelledby="tab_{{ $model->slug }}">
                            @foreach ($model->settings as $key => $item)
                            {{-- @dd($item) --}}
                                <label for="">@lang("{$translation}{$model->slug}.{$key}")</label>
                                @if ($item->type == 'text')
                                    <textarea class="summernote" name="settings[{{ $model->slug }}][{{ $key }}][value]" id="{{ $key }}">
                                        {!! $item->value !!}
                                    </textarea>
                                    <input type="text" hidden name="settings[{{ $model->slug }}][{{ $key }}][type]" value="{{ $item->type }}">
                                @endif
                                @if ($item->type == 'string')
                                    <input class="form-control" type="text" name="settings[{{ $model->slug }}][{{ $key }}][value]" id="{{ $key }}" value="{{ $item->value }}">
                                    <input type="text" hidden name="settings[{{ $model->slug }}][{{ $key }}][type]" value="{{ $item->type }}">
                                @endif
                                @if ($item->type == 'number')
                                    <input class="form-control" type="number" name="settings[{{ $model->slug }}][{{ $key }}][value]" id="{{ $key }}" value="{{ $item->value }}">
                                    <input type="text" hidden name="settings[{{ $model->slug }}][{{ $key }}][type]" value="{{ $item->type }}">
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <button class="btn btn-primary" type="submit">
            @lang('general.save')
        </button>
    </form>
@endsection

@section('js')
@endsection
