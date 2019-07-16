@extends('layouts.app')

@section('title')
Kategori
@endsection

@section('content')
<div class="panel panel-primary">
            <a href="{{ route('kategori.create') }}" class="btn btn-success pull-right modal-show mb-2"
                title="Buat Kategori"><i class="icon-plus"></i> Create</a>

    <div class="panel-body">
        <table id="datatable" class="table table-hover" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tipe</th>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>
<script>
        $('#datatable').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('table.kategori') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'id'},
                {data: 'tipe', name: 'tipe'},
                {data: 'nama', name: 'nama'},
                {data: 'deskripsi', name: 'deskripsi'},
                {data: 'action', name: 'action'}
            ]
        });
    </script>

@endsection
@push('scripts')
    <script>
        $('#datatable').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('table.kategori') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'id'},
                {data: 'tipe', name: 'tipe'},
                {data: 'nama', name: 'nama'},
                {data: 'deskripsi', name: 'deskripsi'},
                {data: 'action', name: 'action'}
            ]
        });
    </script>
@endpush