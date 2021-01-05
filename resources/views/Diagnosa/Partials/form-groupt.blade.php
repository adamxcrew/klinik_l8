<div class="form-group">
  <label for="no_poli">Kode Diagnosa</label>
  <input type="text" readonly id="kode" name="kode" value="{{ old('kode')?? $diagnosa->kode}}" class="form-control">
  @error("kode")
  <div class="text-danger d-block mt-2">{{$message}}</div>
  @enderror
</div>
<div class="form-group">
  <label for="nama">Nama Diagnosa</label>
  <input type="text" id="nama" name="nama" value="{{ old('nama')?? $diagnosa->nama}}" class="form-control">
  @error("nama")
  <div class="text-danger d-block mt-2">{{$message}}</div>
  @enderror
</div>
<div class="form-group"><input type="submit" value="{{$submit ?? 'Tambah'}}" class="btn btn-primary"></div>