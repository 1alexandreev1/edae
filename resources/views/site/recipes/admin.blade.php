@extends($extendsTemplate)

@section('content')
    {{ $dataTable->table(['width' => '100%']) }}
@endsection

@section('js')
    {{ $dataTable->scripts() }}
@endsection
