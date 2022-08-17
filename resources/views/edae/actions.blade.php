<div class="row">
    @can("$permission-edit")
        <a class="btn btn-outline-primary m-1 col-auto" href="{{ route("admin.{$route}edit", $model) }}">
            <i class="fas fa-edit"></i>
        </a>
    @endcan
    @can("$permission-delete")
        <form action="{{ route("admin.{$route}destroy", $model) }}" method="POST">
            @csrf
            @method('delete')
            <button class="btn btn-outline-danger m-1 col-auto" type="submit">
                <i class="far fa-trash-alt"></i>
            </button>
        </form>
    @endcan
</div>
