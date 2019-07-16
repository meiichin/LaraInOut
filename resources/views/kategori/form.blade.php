<form action="{{$model->exists ? route('kategori.update', $model->id) : route('kategori.store')}}"
    method="{{$model->exists ? 'PUT' : 'POST'}}">


    @if($model->exists)
    @csrf
    <input type="hidden" name="_method" value="PUT">
    @else
    @csrf
    @endif

    <div class="form-group">
        <label for="" class="control-label">Tipe</label>
        <select class="form-control" name="tipe" id="tipe">
            @if($model->exists)
            <option value="0" {{($model->tipe === '0') ? 'selected' : ''}}>Pengeluaran</option>
            <option value="1" {{($model->tipe === '1') ? 'selected' : ''}}>Pemasukan</option>
            @else
            <option value="0">Pengeluaran</option>
            <option value="1">Pemasukan</option>
            @endif
        </select>
    </div>

    <div class="form-group">
        <label for="" class="control-label">Nama</label>
        <input class="form-control" type="text" name="nama" id="nama" placeholder="Masukan Nama . ." value="{{$model->exists ? $model->nama : ''}}">
    </div>

    <div class="form-group">
        <label for="" class="control-label">Deskripsi</label>
        <textarea class="form-control"  name="deskripsi" id="deskripsi" cols="30" rows="5" placeholder="Masukan Deskripsi . .">{{$model->exists ? $model->deskripsi : ''}}</textarea>
    </div>
</form>
