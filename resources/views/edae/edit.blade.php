@extends($extendsTemplate)

@section('content')
    @can("$permission-edit")
        <form id="general_form" action="{{ empty($model) ? route("admin.{$route}store") : route("admin.{$route}update", $model)}}" method="POST"
                enctype="multipart/form-data">
    @elsecan("$permission-additional")
        <form id="general-form" action="{{ empty($model) ? route("{$route}store") : route("{$route}update", $model)}}" method="POST">
    @endcan
        @csrf
        @method(empty($model) ? 'POST' : 'PATCH')
        <div class="mt-1 mb-2">
            @include("{$template}edit")
        </div>
        <div class="card-footer">
            <div class="row justify-content-between">
                <button type="button" onclick="sendForm(general_form)" class="btn btn-outline-primary col-auto">
                    Сохранить
                </button>
                <a class="btn btn-outline-danger col-auto" href="@can("$permission-edit"){{ route("admin.{$route}index") }}@elsecan("$permission-update"){{ route("{$route}index") }}@endcan">
                    Отмена
                </a>
            </div>
        </div>
    </form>
    @isset($url_store_tag)
        @include('edae.modals.tag_modal')
    @endisset
@endsection
