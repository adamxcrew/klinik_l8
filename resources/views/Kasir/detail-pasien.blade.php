<x-backend-layout>

  <x-slot name="header">
    <div class="page-header-icon">
      <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
      </svg>
    </div>
    Pasien - Diagnosa
  </x-slot>
  <div>
    <div class="row mb-2 pb-2">
      <div class="col-md-6">
        <div class="card mb-4  border-top-primary h-100">
          <div class="card-header text-center bg-gray-100">Informasi Pasien</div>
          <div class="card-body p-0">
            <!-- Billing history table-->
            <div class="table-responsive table-billing-history">
              <table class="table mb-0">
                <tbody>
                  <tr>
                    <td class="bg-dark-900">Nomor Pendaftaran</td>
                    <td>{{ $pendaftar->nomor_pendaftaran}}</td>
                  </tr>
                  <tr>
                    <td class="">Nama</td>
                    <td>{{ $pendaftar->pasien->nama}}</td>
                  </tr>
                  <tr>
                    <td class="">Tempat Tgl Lahir</td>
                    <td>{{ $pendaftar->pasien->tempat_lahir .", ".$pendaftar->pasien->tanggal_lahir->format('d F Y')}}</td>
                  </tr>
                  <tr>
                    <td class="">Umur</td>
                    <td>{{ $pendaftar->pasien->tanggal_lahir->diffInYears()}} Years</td>
                  </tr>
                  <tr>
                    <td colspan="2" class="bg-gray-400 text-center text-dark">Informasi Terkait</td>
                  </tr>
                  <tr>
                    <td class="bg-dark-900">Tujuan Poliklinik</td>
                    <td>{{ $pendaftar->poliklinik->nama}}</td>
                  </tr>
                  <tr>
                    <td class="">Tanggal Sekarang</td>
                    <td>{{ "Bantaeng, ". date("d F Y")}}</td>
                  </tr>
                  <tr>
                    <td class="">Jenis Layanan</td>
                    <td>{{ $pendaftar->layanan}}</td>
                  </tr>
                </tbody>
              </table>

            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card mb-4  border-top-primary h-100">
          <div class="card-header text-center bg-gray-100 text-gray-900">DAFTAR BIAYA</div>
          <div class="card-body p-0">
            <!-- Billing history table-->
            <div class="table-responsive table-billing-history">
              <table class="table mb-0">
                <tbody>
                  <?php $subtotal = 0; ?>
                  <tr>
                    <td colspan="3">Biaya Tindakan</td>
                  </tr>
                  @foreach($pendaftar->tindakans as $tindakan)
                  <?php $subtotal += $tindakan->harga; ?>
                  <tr>
                    <td></td>
                    <td>
                      {{$tindakan->nama}}
                    </td>
                    <td>
                      {{rupiah($tindakan->harga)}}
                    </td>
                  </tr>
                  @endforeach
                  <tr>
                    <td colspan="3">Biaya Obat-obatan</td>
                  </tr>
                  @foreach($pendaftar->obats as $obat)
                  <?php $subtotal += ($obat->harga * $obat->pivot->quantity); ?>
                  <tr>
                    <td></td>
                    <td>
                      {{$obat->nama}}<br>
                      {{ $obat->pivot->quantity }} x @ {{$obat->harga}}
                    </td>
                    <td>
                      {{rupiah($obat->harga * $obat->pivot->quantity)}}
                    </td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="2">TOTAl</td>
                    <td>{{rupiah($subtotal)}}</td>
                  </tr>
                </tfoot>
              </table>
              <div class="text-center p-3">
                <button class="btn btn-info w-100" data-toggle="modal" data-target="#bayarModal">Bayar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="bayarModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content ">
          <div class="modal-header">
            <h5 class="modal-title" id="bayarModalLabel">Pembayaran Biaya</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">
            <form action="{{route('kasir.detail-pasien',$pendaftar)}}" method="post">
              @csrf
              <input type="number" name="total_bayar" id="jumlahbayar" value="{{$subtotal}}" hidden>
              <div class="input-group input-group-joined mb-4">
                <label for="uangbayar" class="d-block w-100">Uang Bayar</label>

                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                  </span>
                </div>
                <input class="form-control" id="uangbayar" name="uang_bayar" type="number" placeholder="Ex : 500000" aria-label="Bayar">
              </div>
              <div class="input-group input-group-joined mb-4">
                <label for="uangbayar" class="d-block w-100">Kembalian</label>
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.121 15.536c-1.171 1.952-3.07 1.952-4.242 0-1.172-1.953-1.172-5.119 0-7.072 1.171-1.952 3.07-1.952 4.242 0M8 10.5h4m-4 3h4m9-1.5a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                  </span>
                </div>
                <input class="form-control" type="number" name="kembalian" id="kembalian" readonly aria-label="Bayar">
              </div>
              <button class="btn btn-primary" disabled id="buttonBayar">Bayar Sekarang</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    @push("styles")
    <link href="/vendor/sweetalert2/sweetalert2.min.css" rel="stylesheet">

    @endpush
    @push("scripts")
    <!-- Page level plugins -->
    <script src="/vendor/sweetalert2/sweetalert2.min.js"></script>


    <script>
      (() => {
        const elBayarModal = document.querySelector("#bayarModal");
        const formBayar = elBayarModal.querySelector("form");
        const inBayar = elBayarModal.querySelector("#uangbayar");
        const kembalian = elBayarModal.querySelector("#kembalian");
        const jumlahBayar = parseInt(elBayarModal.querySelector("#jumlahbayar").value);
        const buttonProses = elBayarModal.querySelector("#buttonBayar");


        inBayar.oninput = function() {

          uangBayar = parseInt(inBayar.value);
          if (uangBayar > jumlahBayar) {
            buttonProses.disabled = false;
          } else {
            buttonProses.disabled = true
          }
          kembalian.value = uangBayar - jumlahBayar;
        };
        formBayar.onsubmit = function(e) {
          if (buttonProses.disabled === false) {

          } else {
            e.preventDefault();
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Masukkan Sejumlah uang yang cukup!',
            })
          }
        }
      })();
    </script>
    @endpush

</x-backend-layout>