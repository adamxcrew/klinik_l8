<x-backend-layout>
  <x-slot name="header">
    <div class="page-header-icon">
      <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
      </svg>
    </div>
    Pasien - Details
  </x-slot>
  <div>
    <div class="row justify-content-center">
      <div class="col-md-8 mb-4 ">
        <div class="mw-100" id="printThis">
          <!-- Heading -->
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Nomor Antrian</span>
            <span class="badge badge-secondary badge-pill">3</span>
          </h4>

          <!-- Cart -->
          <ul class="list-group mb-3 z-depth-1">
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Nama Pasien</h6>
                <small class="text-muted">Pasien detail</small>
              </div>
              <span class="text-muted">{{$pendaftaran->pasien->nama}}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Nomor Pendaftaran</h6>
                <small class="text-muted">Pendaftaran</small>
              </div>
              <span class="text-muted">{{$pendaftaran->nomor_pendaftaran}}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Poliklinik</h6>
                <small class="text-muted">Bagian</small>
              </div>
              <span class="text-muted">{{$pendaftaran->poliklinik->nama}}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between bg-light">
              <div class="text-success">
                <h6 class="my-0">Nama Dokter</h6>
                <small>Dokter</small>
              </div>
              <span class="text-success">{{ $pendaftaran->dokter->user->name}}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <div>
                <h6 class="my-0">Status Antrian</h6>
                <small class="text-muted">Status</small>
              </div>
              <span class="badge badge-success py-2 px-2">{{ $pendaftaran->status_poli ==0 ?'Mengantri Untuk Diagnosa' : ''}}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span>Tanggal Pendaftaran</span>
              <strong>{{$pendaftaran->created_at->format('d/m/Y')}}</strong>
            </li>
          </ul>
          <!-- Cart -->

        </div>

        <!-- Promo code -->
        <div class="card p-2">
          <div class="input-group">
            <button class="form-control btn btn-primary btn-md waves-effect m-0" id="btnPrint" type="button">Cetak Struck</button>
          </div>
        </div>
        <!-- Promo code -->

      </div>
    </div>
  </div>
  <center>
    <div id="printSection" class="row">
    </div>

  </center>



  @push("styles")
  <style>
    @media screen {
      #printSection {
        display: none;
      }
    }

    @media print {
      body * {
        visibility: hidden;
      }

      #printSection,
      #printSection * {
        visibility: visible;
      }

      #printSection {
        display: block;
        width: 400px;
        height: 559px;
        padding-left: 20px;
      }
    }
  </style>
  @endpush
  @push("scripts")
  <script>
    document.getElementById("btnPrint").onclick = function() {
      printElement(document.getElementById("printThis"));
    }

    function printElement(elem) {
      var domClone = elem.cloneNode(true);

      var $printSection = document.getElementById("printSection");

      if (!$printSection) {
        var $printSection = document.createElement("div");
        $printSection.id = "printSection";
        document.body.appendChild($printSection);
      }
      $printSection.innerHTML = "";
      $printSection.appendChild(domClone);
      window.print();
    }

    function PrintElem(elem) {
      var mywindow = window.open('', 'PRINT', 'height=600,width=800');

      var domClone = elem.cloneNode(true);

      mywindow.document.body.appendChild(domClone); // necessary for IE >= 10
      mywindow.document.close(); // necessary for IE >= 10
      mywindow.focus(); // necessary for IE >= 10*/

      mywindow.print();
      // mywindow.close();

      return true;
    }
  </script>

  @endpush
</x-backend-layout>