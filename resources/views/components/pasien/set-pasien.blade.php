@if(!$pasien)
<div class="card mb-4">
  <div class="card-header">Identitas Pasien</div>
  <div class="card-body">
    <form action="{{route('pasien.tambah')}}" method="post">
      @csrf
      <!-- Form Row-->
      <div class="form-row">
        <div class="form-group col-md-6">
          <label class="small mb-1" for="namaPasien">Nama Pasien**</label>
          <input class="form-control @error('nama') is-invalid @enderror" id="namaPasien" name="nama" type="text" placeholder="insert name" value="{{ old('nama')}}">
          @error('nama')
          <div class="text-danger mt-2 d-block">{{ $message }}</div>
          @enderror
        </div>
        <div class="form-group col-md-6">
          <label class="small mb-1" for="noKtp">Nomor KTP**</label>
          <input class="form-control @error('no_ktp') is-invalid @enderror" id="noKtp" name="no_ktp" type="text" placeholder="Masukkan Nomor Kartu Tanda Penduduk" value="{{ old('no_ktp')}}">
          @error('no_ktp')
          <div class="text-danger mt-2 d-block">{{ $message }}</div>
          @enderror
        </div>
      </div>


      <!-- Form Row-->
      <div class="form-row">
        <!-- Form Group (first name)-->
        <div class="form-group col-md-6">
          <label class="small mb-1" for="tempat_lahir">Tempat Lahir</label>
          <input class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" name="tempat_lahir" type="text" value="{{old('tempat_lahir')}}">
          @error('tempat_lahir')
          <div class="text-danger mt-2 d-block">{{ $message }}</div>
          @enderror
        </div>
        <!-- Form Group (last name)-->
        <div class="form-group col-md-6">
          <label class="small mb-1" for="tanggal_lahir">Tempat Lahir</label>
          <input class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" type="date" value="{{old('tanggal_lahir' ?? '1996-10-10')}}">
          @error('tanggal_lahir')
          <div class="text-danger mt-2 d-block">{{ $message }}</div>
          @enderror
        </div>
      </div>
      <!-- Form Row-->
      <div class="form-row">
        <!-- Form Group (first name)-->
        <div class="form-group col-md-6">
          <label class="small mb-1" for="rt_rw">RT/RW</label>
          <input class="form-control @error('rt_rw') is-invalid @enderror" placeholder="ex : 001/002" id="rt_rw" name="rt_rw" type="text" value="{{old('rt_rw')}}">
          @error('rt_rw')
          <div class="text-danger mt-2 d-block">{{ $message }}</div>
          @enderror
        </div>
        <!-- Form Group (last name)-->
        <div class="form-group col-md-6">
          <label class="small mb-1" for="alamat">Alamat</label>
          <input class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" type="text" value="{{old('alamat')}}">
          @error('alamat')
          <div class="text-danger mt-2 d-block">{{ $message }}</div>
          @enderror
        </div>
      </div>
      <div class="form-row">
        <!-- Form Group (first name)-->
        <div class="form-group col-md-6 col-lg-4">
          <label class="small mb-1" for="no_hp">Nomor HP</label>
          <input class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" type="tel" value="{{old('no_hp')}}">
          @error('no_hp')
          <div class="text-danger mt-2 d-block">{{ $message }}</div>
          @enderror
        </div>
        <!-- Form Group (last name)-->
        <div class="form-group col-md-6 col-lg-4">
          <label class="small mb-1" for="pekerjaan">Pekerjaan</label>
          <input class="form-control @error('pekerjaan') is-invalid @enderror" id="pekerjaan" name="pekerjaan" type="text" value="{{old('pekerjaan')}}">
          @error('pekerjaan')
          <div class="text-danger mt-2 d-block">{{ $message }}</div>
          @enderror
        </div>
        <div class="form-group col-lg-4 col-md-12">
          <label class="small mb-1" for="email">Email</label>
          <input class="form-control @error('email') is-invalid @enderror" id="email" name="email" type="email" placeholder="Masukkan Email" value="{{ old('email')}}">
          @error('email')
          <div class="text-danger mt-2 d-block">{{ $message }}</div>
          @enderror
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 mt-2">
          <h2> Tujuan</h2>
          <hr>
        </div>
        <div class="form-group col-md-6">
          <label class="small mb-1" for="poliklinik_id">Poliklinik </label>
          <select name="poliklinik_id" id="" endpoint="{{ route('poliklinik.dokter','valuenya')}}" class="form-control select2Poliklinik @error('poliklinik_id') is-invalid @enderror">
            <option disabled selected>Select Poliklinik</option>
            @foreach($polikliniks as $poliklinik)
            <option {{ old('poliklinik_id') == $poliklinik->id ? 'selected' : ($poliklinik->id== $pendaftar->poliklinik_id ? 'selected' :'')}} value="{{$poliklinik->id}}">{{$poliklinik->nama}}</option>
            @endforeach
          </select>
          @error('poliklinik_id')
          <div class="text-danger mt-2 d-block">{{ $message }}</div>
          @enderror
        </div>
        <div class="form-group col-md-6">
          <label class="small mb-1" for="dokter_id">Dokters </label>
          <select name="dokter_id" id="" endpoint="{{ route('poliklinik.dokter','valuenya')}}" class="form-control select2Dokter @error('dokter_id') is-invalid @enderror">
            <option disabled selected>Select Dokter</option>
          </select>
          @error('dokter_id')
          <div class="text-danger mt-2 d-block">{{ $message }}</div>
          @enderror
        </div>
        <div class="col-md-12">
          <hr>
          <div class="row">
            <div class="col-md-7 m-auto d-flex justify-content-center">
              <label class="mr-4">Jenis Layanan :</label>
              <div class="form-check">
                <label class="form-check-label">
                  <input type="radio" class="form-check-input" name="layanan" id="" value="bpjs">
                  BPJS
                </label>
              </div>

              <div class="form-check ml-3">
                <label class="form-check-label">
                  <input type="radio" class="form-check-input" name="layanan" value="umum" checked>
                  UMUM
                </label>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Save changes button-->
      <button class="btn btn-primary" type="submit">Save changes</button>
    </form>
  </div>
</div>
@else
<div class="row">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">Identitas User</div>
      <div class="card-body">
        <div class="row">
          <span class="col-md-5">Nama</span>
          <span class="text-secondary col-md-7">{{$pasien->nama}}</span>
        </div>
        <div class="row">
          <span class="col-md-5">No. KTP</span>
          <span class="text-secondary col-md-7">{{$pasien->no_ktp}}</span>
        </div>
        <div class="row">
          <span class="col-md-5">Tempat/Tgl Lahir</span>
          <span class="text-secondary col-md-7 ">{{$pasien->tempat_lahir}}/{{ date('d-m-Y', strtotime($pasien->tanggal_lahir))
 }}</span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6"></div>
</div>

@endif
@push("styles")
<link rel="stylesheet" href="\sb-admin2\vendor\select2\css\select2.min.css">
@endpush
@push("scripts")
<script src="\sb-admin2\vendor\select2\js\select2.min.js"></script>
<script>
  $(document).ready(function() {
    let $poliklinik = $(".select2Poliklinik").select2({
      placeholder: "Select Poliklinik"
    });
    let $dokter = $(".select2Dokter").select2({
      placeholder: "Select Dokter"
    });
    $poliklinik.on("change", async (e) => {
      setDokters()
    })
    setDokters();

    async function setDokters() {
      if ($poliklinik.val() !== null) {
        let endpoint = $poliklinik.attr('endpoint').replace("valuenya", $poliklinik.val());
        try {
          let res = await axios.get(endpoint);
          $dokter.html('');
          var newOption = new Option("Pilih Dokter", '', true, true);
          $dokter.append(newOption).trigger('change');
          res.data.dokters.map(dokter => {
            var newOption = new Option(dokter.user.name, dokter.id, false, false);
            $dokter.append(newOption).trigger('change');
          })

        } catch (error) {

        }
      }
    }
  })
</script>
@endpush