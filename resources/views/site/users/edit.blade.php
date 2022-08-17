<div class="row">
    <div class="col-md-6 col-12">
        <div class="form-group">
            <label for="">{{ __($translation . 'login') }}*</label>
            <input class="form-control" name="login" id="login" type="text" placeholder="" value="{{ $model->login ?? old('login') ?? '' }}">
        </div>
        <div class="form-group">
            <label for="">{{ __($translation . 'name') }}*</label>
            <input class="form-control" name="name" id="name" type="text" placeholder="" value="{{ $model->name ?? old('name') ?? '' }}">
        </div>
        <div class="form-group">
            <label for="">{{ __($translation . 'surname') }}</label>
            <input class="form-control" name="surname" id="surname" type="text" placeholder="" value="{{ $model->surname ?? old('surname') ?? '' }}">
        </div>
        <div class="form-group">
            <label for="">{{ __($translation . 'patronymic') }}</label>
            <input class="form-control" name="patronymic" id="patronymic" type="text" placeholder="" value="{{ $model->patronymic ?? old('patronymic') ?? '' }}">
        </div>
        <div class="form-group">
            <label for="">{{ __($translation . 'email') }}*</label>
            <input class="form-control" name="email" id="email" type="email" placeholder="" value="{{ $model->email ?? old('email') ?? '' }}">
        </div>
        <div class="form-group">
            <label for="">{{ __($translation . 'password') }}</label>
            <input class="form-control" name="password" id="password" type="password" placeholder="" value="">
        </div>
        <div class="form-group">
            <label for="">{{ __($translation . 'password_confirmation') }}</label>
            <input class="form-control" name="password_confirmation" id="password_confirmation" type="password" placeholder="" value="">
        </div>
    </div>
    <div class="col-md-6 col-12">
        <label for="">{{ __($translation . 'avatar') }}</label>
        <input class="form-control" name="avatar" id="avatar" type="file" placeholder="" value="">
    </div>
</div>

@section('js')
@endsection
