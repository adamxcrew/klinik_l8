<div class="form-group">
  <label for="kode_dokter">Nomor Dokter</label>
  <input type="text" readonly id="kode_dokter" name="kode_dokter" value="{{ old('kode_dokter')?? $dokter->kode_dokter}}" class="form-control">
  @error("kode_dokter")
  <div class="text-danger d-block mt-2">{{$message}}</div>
  @enderror
</div>
<div class="form-group">
  <label for="name">Nama Dokter</label>
  <input type="text" id="name" name="name" value="{{ old('name') ??  $dokter->user->name ??''}}" class="form-control">
  @error("name")
  <div class="text-danger d-block mt-2">{{$message}}</div>
  @enderror
</div>
<div x-data="{spesialis: false }">
  <div class="form-group">
    <label for="ss">Jenis Dokter</label>
    <select id="ss" name="sp" class="form-control" x-on:change="spesialis =$event.target.value==='1' ? true : false">
      <option selected disabled>Pilih Jenis Dokter</option>
      <option value="">Dokter Umum</option>
      <option value="1">Dokter Spesialis</option>
    </select>
    @error("sp")
    <div class="text-danger d-block mt-2">{{$message}}</div>
    @enderror
  </div>
  <div class="form-group" x-show="spesialis">
    <label for="spesialis">Nama Spesiali</label>
    <input id="spesialis" name="spesialis" value="{{ old('spesialis')?? $dokter->spesialis}}" class="form-control">
    @error("spesialis")
    <div class="text-danger d-block mt-2">{{$message}}</div>
    @enderror
  </div>
</div>
<div class="form-group">
  <label for="poliklinik_id">Penempatan</label>
  <select id="poliklinik_id" name="poliklinik_id[]" class="form-control" multiple>
    @foreach($polikliniks as $poliklinik)
    <option {{ $dokter->polikliniks()->find($poliklinik->id)? "selected" :''}} value="{{$poliklinik->id}}">{{$poliklinik->nama}}</option>
    @endforeach
  </select>
  @error("poliklinik_id")
  <div class="text-danger d-block mt-2">{{$message}}</div>
  @enderror
</div>
<div class="form-group"><input type="submit" value="{{$submit ?? 'Tambah'}}" class="btn btn-primary"></div>
@push("styles")
<link rel="stylesheet" href="\sb-admin2\vendor\select2\css\select2.min.css">
@endpush
@push("scripts")
<script src="\sb-admin2\vendor\select2\js\select2.min.js"></script>
<script>
  $(document).ready(function() {
    $("#poliklinik_id").select2({
      placeholder: "Select Poliklinik"
    })
  })
</script>
@endpush