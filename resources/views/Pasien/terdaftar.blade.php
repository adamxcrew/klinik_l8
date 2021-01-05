<x-backend-layout>
  <x-slot name="header">
    <div class="page-header-icon">
      <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
      </svg>
    </div>
    Pasien - Tambah
  </x-slot>
  <div>
    @if($pasiens->count()>0)
    <div class="card">
      <div class="card-body">
        <div class="row mt-2">
          <div class="col-md-6">
            <div class="mb-3">
              <h2 class="card-title">Tujuan</h2>
              <hr>
            </div>

            <form class="row" method="post" action="{{ route('pasien.terdaftar')}}">
              @csrf
              <div class="form-group col-md-12">
                <label for="selectPasien">Pasien</label>
                <select class="form-control" name="pasien_id" id="selectPasien">
                  <option value="" selected disabled>Select Pasien</option>
                  @foreach($pasiens as $pasien)
                  <option value="{{$pasien->id}}">{{$pasien->nama}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-md-6">
                <label class="small mb-1" for="poliklinik_id">Poliklinik </label>
                <select name="poliklinik_id" id="" endpoint="{{ route('poliklinik.dokter','valuenya')}}" class="form-control select2Poliklinik @error('poliklinik_id') is-invalid @enderror">
                  <option disabled selected>Select Poliklinik</option>
                  @foreach($polikliniks as $poliklinik)
                  <option {{ old('poliklinik_id') == $poliklinik->id ? 'selected' : ''}} value="{{$poliklinik->id}}">{{$poliklinik->nama}}</option>
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
              <div class="input-group mt-3">
                <button class="form-control btn btn-primary btn-md waves-effect m-0" id="btnPrint" type="submit">Tambah Pasien</button>
              </div>
            </form>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <h2 class="card-title">Details Pasien</h2>
              <hr>
            </div>
            <div class="text-center" id="loadingPasien">
              <p class="mt-2 pt-4">Haraf Pilih Pasien</p>
              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: none; display: block; shape-rendering: auto;" width="297px" height="297px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                <rect x="17.5" y="30" width="15" height="40" fill="#1d2830">
                  <animate attributeName="y" repeatCount="indefinite" dur="1.639344262295082s" calcMode="spline" keyTimes="0;0.5;1" values="18;30;30" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.3278688524590164s"></animate>
                  <animate attributeName="height" repeatCount="indefinite" dur="1.639344262295082s" calcMode="spline" keyTimes="0;0.5;1" values="64;40;40" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.3278688524590164s"></animate>
                </rect>
                <rect x="42.5" y="30" width="15" height="40" fill="#064d69">
                  <animate attributeName="y" repeatCount="indefinite" dur="1.639344262295082s" calcMode="spline" keyTimes="0;0.5;1" values="20.999999999999996;30;30" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.1639344262295082s"></animate>
                  <animate attributeName="height" repeatCount="indefinite" dur="1.639344262295082s" calcMode="spline" keyTimes="0;0.5;1" values="58.00000000000001;40;40" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.1639344262295082s"></animate>
                </rect>
                <rect x="67.5" y="30" width="15" height="40" fill="#7ba6b7">
                  <animate attributeName="y" repeatCount="indefinite" dur="1.639344262295082s" calcMode="spline" keyTimes="0;0.5;1" values="20.999999999999996;30;30" keySplines="0 0.5 0.5 1;0 0.5 0.5 1"></animate>
                  <animate attributeName="height" repeatCount="indefinite" dur="1.639344262295082s" calcMode="spline" keyTimes="0;0.5;1" values="58.00000000000001;40;40" keySplines="0 0.5 0.5 1;0 0.5 0.5 1"></animate>
                </rect>
              </svg>

            </div>
            <ul class="list-group mb-3 z-depth-1" id="detailPasien">
              <li class="list-group-item d-flex justify-content-between lh-condensed">
                <div>
                  <h6 class="my-0">Nama Pasien</h6>
                  <small class="text-muted">Pasien detail</small>
                </div>
                <span class="text-muted" id="namaPasien"></span>
              </li>
              <li class="list-group-item d-flex justify-content-between lh-condensed">
                <div>
                  <h6 class="my-0">No KTP</h6>
                  <small class="text-muted">Kartu Tanda Penduduk</small>
                </div>
                <span class="text-muted" id="ktp"></span>
              </li>
              <li class="list-group-item d-flex justify-content-between bg-light">
                <div class="text-success">
                  <h6 class="my-0">Email</h6>
                  <small>User . email</small>
                </div>
                <span class="text-success" id="email"></span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                  <h6 class="my-0">Tempat Lahir</h6>
                  <small class="text-muted">Lahir di : </small>
                </div>
                <span class="badge badge-success py-2 px-2" id="tempatLahir">ddd</span>
              </li>
              <li class="list-group-item d-flex justify-content-between">
                <span>Tanggal Lahir</span>
                <strong id="tglLahir"></strong>
              </li>
            </ul>
          </div>
        </div>

      </div>
    </div>
    @else
    <div class="alert alert-danger text-center" role="alert">
      <strong>Tidak Ada Pasien terdaftar</strong>
      <a href="{{route('pasien.tambah')}}" class="ml-2 btn btn-sm btn-primary">Tambah Pasien Baru</a>
    </div>
    @endif
  </div>
  @push("styles")
  <link rel="stylesheet" href="\sb-admin2\vendor\select2\css\select2.min.css">
  @endpush
  @push("scripts")
  <script src="\sb-admin2\vendor\select2\js\select2.min.js"></script>
  <script>
    $(document).ready(function() {
      const pasiens = <?= json_encode($pasiens) ?>;
      const elLoading = document.querySelector("#loadingPasien");
      const elDetailsPasien = document.querySelector("#detailPasien");

      let $pasien = $("#selectPasien").select2({
        placeholder: "Select Pasiens"
      });
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
      $pasien.on("change", function() {
        setPasiens();
      })

      setPasiens();

      function setPasiens() {
        if ($pasien.val() !== null) {
          const pasien = pasiens.filter(item => item.id == $pasien.val())[0];
          console.log(pasien);
          elDetailsPasien.querySelector("#tglLahir").innerHTML = pasien.tanggal_lahir;
          elDetailsPasien.querySelector("#tempatLahir").innerHTML = pasien.tempat_lahir;
          elDetailsPasien.querySelector("#email").innerHTML = pasien.email;
          elDetailsPasien.querySelector("#ktp").innerHTML = pasien.no_ktp;
          elDetailsPasien.querySelector("#namaPasien").innerHTML = pasien.nama;
          elLoading.classList.add("d-none")
          elDetailsPasien.classList.remove("d-none")
        } else {
          elLoading.classList.remove("d-none")
          elDetailsPasien.classList.add("d-none")
        }
      }
    });
  </script>
  @endpush

</x-backend-layout>