<x-backend-layout>
  @push("styles")
  <!-- Custom styles for this page -->
  <link href="/sb-admin2/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  @endpush
  @push("scripts")
  <!-- Page level plugins -->
  <script src="/sb-admin2/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="/sb-admin2/vendor/datatables/dataTables.bootstrap4.min.js"></script>
  @endpush
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

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card mb-4  border-top-primary h-100">
          <div class="card-header text-center bg-gray-100 text-gray-900">Informasi Terkait</div>
          <div class="card-body p-0">
            <!-- Billing history table-->
            <div class="table-responsive table-billing-history">
              <table class="table mb-0">
                <tbody>
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
    </div>
    <div class="card">
      <div class="card-header border-bottom d-flex justify-content-between">
        <ul class="nav nav-tabs card-header-tabs" id="cardTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="diagnosa-tab" href="#diagnosa" data-toggle="tab" role="tab" aria-controls="diagnosa" aria-selected="true">Diagnosa</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="resep-tab" href="#resep" data-toggle="tab" role="tab" aria-controls="resep" aria-selected="false">Resep</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="tindakan-tab" href="#tindakan" data-toggle="tab" role="tab" aria-controls="tindakan" aria-selected="false">Tindakan</a>
          </li>

        </ul>

        <a href="{{route('pasien.diagnosa-selesai',$pendaftar)}}" class="btn btn-info btn-sm">Billing Poli Selesai</a>
      </div>
      <div class="card-body">
        <div class="tab-content" id="cardTabContent">
          <div class="tab-pane fade show active" id="diagnosa" role="tabpanel" aria-labelledby="diagnosa-tab">
            <!-- Angles Styled Card -->
            <div class="card card-waves">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h2 class="card-title">
                  Daftar Diagnosa Pasien
                </h2>
                <button class="btn btn-primary mr-2 my-1" data-toggle="modal" data-target="#tambahDiagnosaModal" type="button">Tambah</button>
              </div>
              <div class="card-body">
                <div>
                  @include("Pasien.partials.datatable-diagnosa-pasien")
                </div>

              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="resep" role="tabpanel" aria-labelledby="resep-tab">
            @include("Pasien.partials.datatable-resep-pasien")
          </div>
          <div class="tab-pane fade" id="tindakan" role="tabpanel" aria-labelledby="tindakan-tab">
            @include("Pasien.partials.datatable-tindakan-pasien")
          </div>
        </div>
      </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="tambahDiagnosaModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content ">
          <div class="modal-header">
            <h5 class="modal-title" id="tambahDiagnosaModalLabel">Daftar Diagnosa Pasien</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">
            @include("Pasien.partials.datatable-diagnosas")
          </div>

        </div>
      </div>
    </div>
</x-backend-layout>