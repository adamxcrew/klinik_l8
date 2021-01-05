<div class="form-group">
  <label for="no_poli">Nomor Poliklinik</label>
  <input type="text" readonly id="no_poli" name="no_poli" value="{{ old('no_poli')?? $poliklinik->no_poli}}" class="form-control">
  @error("no_poli")
  <div class="text-danger d-block mt-2">{{$message}}</div>
  @enderror
</div>
<div class="form-group">
  <label for="nama">Nama Poliklinik</label>
  <input type="text" id="nama" name="nama" value="{{ old('nama')?? $poliklinik->nama}}" class="form-control">
  @error("nama")
  <div class="text-danger d-block mt-2">{{$message}}</div>
  @enderror
</div>
<div class="form-group">
  <label for="keterangan">Keterangan</label>
  <textarea id="keterangan" name="keterangan" class="form-control">{{ old('keterangan')?? $poliklinik->keterangan}}</textarea>
  @error("keterangan")
  <div class="text-danger d-block mt-2">{{$message}}</div>
  @enderror
</div>
<div class="form-group">
  <label for="jam_layanan">Jam Layanan</label>
  <input type="time" id="jam_layanan" name="jam_layanan" value="{{ old('jam_layanan')?? $poliklinik->jam_layanan}}" class="form-control">
  @error("jam_layanan")
  <div class="text-danger d-block mt-2">{{$message}}</div>
  @enderror
</div>
<div class="form-group"><input type="submit" value="{{$submit ?? 'Tambah'}}" class="btn btn-primary"></div>