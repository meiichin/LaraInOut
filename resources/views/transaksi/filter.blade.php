@extends('layouts.app')

@section('title')
Transaksi
@endsection

@section('content')
<div class="panel panel-primary">
        <div class="panel-heading mb-5">
            <div class="row">
                    <h3 class="panel-title mr-5">Saldo : Rp. {{$saldo}}</h3>
                    <a href="{{ route('transaksi.create') }}" class="btn btn-success pull-right modal-show mb-2 "
                        title="Buat Transaksi"><i class="fa fa-plus"></i> Tambah</a>
                </div>
                    <br>
                    <h5>Filter Transaksi</h5>
                    <form action="{{route('filter.transaksi')}}" method="GET">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-5">
                                <input class="form-control" type="date" name="start" value="{{$start}}" required>
                            </div>
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-9">
                                        <input class="form-control" type="date" name="end" value="{{$end}}" required>
                                    </div>
                                    <div class="col-md-3">
                                        <input class="form-control" type="submit" value="Search">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
        </div>
    <div class="panel-body">
        <table id="datatable" class="table table-hover" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tipe</th>
                    <th>Kategori</th>
                    <th>Nominal</th>
                    <th>Deskripsi</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>

@endsection
@push('scripts')
    <script>
        var url = "{{ url('table/filter') }}/{{$start}}/{{$end}}";
        console.log(url);
        $('#datatable').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: url,
            columns: [
                {data: 'DT_RowIndex', name: 'id'},
                {data: 'kategori_id', name: 'kategori_id'},
                {data: 'kategori_id', name: 'kategori_id'},
                {data: 'nominal', name: 'nominal'},
                {data: 'deskripsi', name: 'deskripsi'},
                {data: 'action', name: 'action'}
            ]
        });
    </script>
@endpush
