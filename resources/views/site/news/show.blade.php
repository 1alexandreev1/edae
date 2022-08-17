@extends($extendsTemplate)

@section('content')
    <div class="card ">
        <div class="card-header">
            <div class="row justify-content-between">
                <div class="col">
                    <h2>{{ $model->name }}</h1>
                </div>
                <div class="col-auto">
                    @include('edae.actions')
                </div>
            </div>
        </div>
        <div class="card-body">
            {!! $model->getReplaceField('text') !!}
        </div>
        <div class="card-footer">
            @include($statistics ?? 'edae.statistics')
        </div>
    </div>

    @include('edae.commentTemplate', ['comments' => $model->comments, 'url' => route($route . 'storeComment', $model)])
@endsection
