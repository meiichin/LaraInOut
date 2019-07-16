<form action="{{$model->exists ? route('transaksi.update', $model->id) : route('transaksi.store')}}"
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
                <option value="">-- Pilih Tipe --</option>
                <option value="0" {{($kate->tipe === '0') ? 'selected' : ''}}>Pengeluaran</option>
                <option value="1" {{($kate->tipe === '1') ? 'selected' : ''}}>Pemasukan</option>
                @else
                <option value="">-- Pilih Tipe --</option>
                <option value="0">Pengeluaran</option>
                <option value="1">Pemasukan</option>
                @endif
            </select>
        </div>

        <div class="form-group">
            <label for="" class="control-label">Kategori</label>
            <select class="form-control" name="kategori_id" id="kategori_id">
                @if($model->exists)
                <option value="">-- Pilih Kategori --</option>
                @foreach ($kateall as $item)
                    <option value="{{$item->id}}" {{($item->id === $kate->id) ? 'selected' : ''}}>{{$item->nama}}</option>
                @endforeach
                @else
                <option value="">-- Pilih Kategori --</option>
                @endif
            </select>
        </div>

        <div class="form-group">
            <label for="" class="control-label">Nominal</label>
            <input class="form-control" type="text" name="nominal" id="nominal" placeholder="Masukan Nominal . ." value="{{$model->exists ? $model->nominal : ''}}">
        </div>

        <div class="form-group">
            <label for="" class="control-label">Deskripsi</label>
            <textarea class="form-control"  name="deskripsi" id="deskripsi" cols="30" rows="5" placeholder="Masukan Deskripsi . .">{{$model->exists ? $model->deskripsi : ''}}</textarea>
        </div>
    </form>

    <script>
    $('#tipe').change(function (event) {
        function removeOptions(selectbox)
        {
            var i;
            for(i = selectbox.options.length - 1 ; i >= 0 ; i--)
            {
                selectbox.remove(i);
            }
        }
        var id = document.getElementById('tipe');
        var url = "{{url('valkategori')}}/"+id.value;
        $.ajax({
            url: url,
            method: "GET",
            success: function (response) {
                console.log(response);
                removeOptions(document.getElementById("kategori_id"));
                $('#kategori_id').append(response);
            },
            error: function (xhr) {
                console.log("error");
            }
        })
    });
    </script>
