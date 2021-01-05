<div class="form-group">
  <label for="kode">Kode Tindakan</label>
  <input type="text" readonly id="kode" name="kode" value="{{ old('kode')?? $tindakan->kode}}" class="form-control">
  @error("kode")
  <div class="text-danger d-block mt-2">{{$message}}</div>
  @enderror
</div>
<div class="form-group">
  <label for="nama">Nama Tindakan</label>
  <input type="text" id="nama" name="nama" value="{{ old('nama') ??  $tindakan->nama ??''}}" class="form-control">
  @error("nama")
  <div class="text-danger d-block mt-2">{{$message}}</div>
  @enderror
</div>
<div class="form-group">
  <label for="harga">Harga Tindakan</label>
  <input type="number" id="harga" name="harga" value="{{ old('harga') ??  $tindakan->harga ??''}}" class="form-control">
  @error("harga")
  <div class="text-danger d-block mt-2">{{$message}}</div>
  @enderror
</div>

<div class="form-group"><input type="submit" value="{{$submit ?? 'Tambah'}}" class="btn btn-primary"></div>