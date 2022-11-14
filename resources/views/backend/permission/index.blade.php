@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <strong>{{ $title }}</strong>
    </div>
    <div class="card-body">
        <a href="{{ route('permission.create') }}" class="btn btn-sm btn-info">Tambah</a>
        {!! $dataTable->table(['class'=>'table table-striped table-bordered']) !!}
    </div>
    <div class="card-footer">
    </div>
</div>

@push('scripts')
{!! $dataTable->scripts() !!}
@endpush
@endsection

