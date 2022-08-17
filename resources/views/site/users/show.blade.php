@extends($extendsTemplate)

@section('content')
    <div class="card ">
        <div class="card-header">
            <div class="row justify-content-between">
                <div class="col">
                    <h2>{{$model->login}}</h1>
                </div>
                <div class="col-auto">
                    @include('edae.actions')
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-auto">
                    @if (is_null($model->avatar))
                        <img class="rounded adaptive-250" src="{{ asset('img/noavatar.png') }}" alt="avatar">
                    @else
                        <img class="rounded adaptive-250" src="{{ $model->avatar }}" alt="avatar">
                    @endif
                </div>
                <div class="col-auto">
                    <div class="row">
                        <div class="col">
                            {{ __($translation . 'name') }}:
                        </div>
                        <div class="col">
                            {{ $model->name }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            {{ __($translation . 'surname') }}:
                        </div>
                        <div class="col">
                            {{ $model->surname ?? '-'}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            {{ __($translation . 'patronymic') }}:
                        </div>
                        <div class="col">
                            {{ $model->patronymic ?? '-' }}
                        </div>
                    </div>
                    @if (Auth::id() == $model->id)
                        <div class="row">
                            <div class="col">
                                {{ __($translation . 'email') }}:
                            </div>
                            <div class="col">
                                    {{ $model->email }}
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col">
                            {{ __($translation . 'created_at') }}:
                        </div>
                        <div class="col">
                            {{ $model->created_at }}
                        </div>
                    </div>
                </div>
                <div class="col-2 col-sm-2">

                </div>
            </div>
        </div>
    </div>

@endsection
