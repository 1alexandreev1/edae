<div class="modal fade" id="{{ $modal_id ?? 'modal_id' }}" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            @if (isset($modal_content))
                {!! $modal_content !!}
            @else
                <div class="modal-header">
                    <h4 class="modal-title">{{ $modal_title ?? '' }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @isset($modal_body)
                        {!! $modal_body !!}
                    @endisset
                    @isset($modal_includes)
                        @foreach ($modal_includes as $include_path)
                            @include($include_path)
                        @endforeach
                    @endisset
                </div>
                <div class="modal-footer justify-content-between">
                    @isset($modal_onclick)
                        <button type="button" onclick="{{ $modal_onclick ?? '' }}" class="btn btn-primary">@lang('general.save')</button>
                    @else
                        <button type="submit" class="btn btn-primary">@lang('general.save')</button>
                    @endisset
                    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('general.cancel')</button>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- Launch btn --}}
{{--
    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#{{ $modal_id ?? 'modal_id' }}">
        BTN NAME
    </button>
--}}
