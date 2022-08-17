@extends($extendsTemplate)

@section('content')
    <div class="card">
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
            <div class="row mb-1">
                <div class="col"></div>
                <div class="col-9">
                    @foreach ($model->ingredients as $name => $val)
                        <div class="row border-bottom ">
                            <div class="col text-left">
                                {{ $name }}
                            </div>
                            <div class="col text-right">
                                {{ $val }}
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col"></div>
            </div>
            {!! $model->getReplaceField('description') !!}
        </div>
        <div class="card-footer">
            @include($statistics ?? 'edae.statistics')
        </div>
    </div>

    @include('edae.commentTemplate', ['comments' => $model->comments, 'url' => route($route . 'storeComment', $model)])

@endsection
