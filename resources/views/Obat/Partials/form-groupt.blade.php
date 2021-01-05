<div class="form-group">
  <label for="kode">Kode Obat</label>
  <input type="text" readonly id="kode" name="kode" value="{{ old('kode')?? $obat->kode}}" class="form-control @error('kode') is-invalid @enderror">
  @error("kode")
  <div class="text-danger d-block mt-2">{{$message}}</div>
  @enderror
</div>
<div class="form-group">
  <label for="nama">Nama Obat</label>
  <input type="text" id="nama" name="nama" value="{{ old('nama')?? $obat->nama}}" class="form-control @error('stock') is-invalid @enderror">
  @error("nama")
  <div class="text-danger d-block mt-2">{{$message}}</div>
  @enderror
</div>
<div class="form-group">
  <label for="satuan">Satuan</label>
  <textarea id="satuan" name="satuan" class="form-control @error('satuan') is-invalid @enderror">{{ old('satuan')?? $obat->satuan}}</textarea>
  @error("satuan")
  <div class="text-danger d-block mt-2">{{$message}}</div>
  @enderror
</div>
<div class="form-group">
  <label for="harga">Harga OBAT</label>
  <input type="number" id="harga" name="harga" value="{{ old('harga')?? $obat->harga}}" class="form-control @error('harga') is-invalid @enderror">
  @error("harga")
  <div class="text-danger d-block mt-2">{{$message}}</div>
  @enderror
</div>
<div class="form-group">
  <label for="stock">Stock</label>
  <input type="number" id="stock" name="stock" value="{{ old('stock')?? $obat->stock}}" class="form-control @error('stock') is-invalid @enderror">
  @error("stock")
  <div class="text-danger d-block mt-2">{{$message}}</div>
  @enderror
</div>
<div class="form-group"><input type="submit" value="{{$submit ?? 'Tambah'}}" class="btn btn-primary"></div>