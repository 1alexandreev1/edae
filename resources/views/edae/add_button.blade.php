@can("$permission-create")
    <a href="{{ route('admin.' . $route . 'create') }}" class="btn btn-success m-1 ml-1 mr-1">
        <i class="fas fa-plus"></i> {{ __('general.create') }}
    </a>
@endcan
