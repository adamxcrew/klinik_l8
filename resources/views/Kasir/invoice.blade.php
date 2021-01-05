<x-backend-layout>
  <x-slot name="header_right">
    <button class="btn btn-info rounded-lg" id="btnPrint">Print</button>
  </x-slot>
  <x-slot name="header">
    <div class="page-header-icon">
      <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
      </svg>
      Kasir - Invoice
    </div>
  </x-slot>

  <div id="printThis">
    <div class="row mb-2 pb-2">
      <div class="col-md-12">
        <div class="card mb-4 mx-auto w-75  border-top-primary h-100">
          <div class="card-body ">
            <div class="d-flex justify-content-between align-items-end">
              <div class="klinik">
                <h1 class="card-title">{{config('app.name')}}</h1>
                <span>Jalan Manual</span> <br>
                <span>Telp . 00099</span>
              </div>
              <div class="w-50">
                <ul class="mb-0">
                  <li class="d-flex justify-content-between">
                    <span> No. Invoice</span>
                    <span class="ml-2">{{$pendaftar->pembayaran->no_invoice ?? "INV_0393837"}}</span>
                  </li>
                  <li class="d-flex justify-content-between">
                    <span> No. Pendaftaran</span>
                    <span class="ml-2">{{$pendaftar->nomor_pendaftaran}}</span>
                  </li>
                  <li class="d-flex justify-content-between">
                    <span> Tanggal Pembayaran</span>
                    <span class="ml-2">{{$pendaftar->pembayaran->created_at->format("d F Y")}}</span>
                  </li>
                </ul>
              </div>
            </div>

            <hr />
            <div class="row my-2">
              <div class="col-md-6">
                <div class="table-responsive table-billing-history">
                  <table class="mb-0 table-sm">
                    <tbody>
                      <tr>
                        <td class="mr-2">Nama</td>
                        <td>{{ $pendaftar->pasien->nama}}</td>
                      </tr>
                      <tr>
                        <td class="mr-2">Alamat</td>
                        <td>{{ $pendaftar->pasien->alamat}}</td>
                      </tr>
                      <tr>
                        <td class="mr-2">Tempat Tgl Lahir</td>
                        <td>{{ $pendaftar->pasien->tempat_lahir .", ".$pendaftar->pasien->tanggal_lahir->format('d F Y')}}</td>
                      </tr>
                      <tr>
                        <td class="mr-2">Umur</td>
                        <td>{{ $pendaftar->pasien->tanggal_lahir->diffInYears()}} Years</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="col-md-6">
                <div class="table-responsive table-billing-history">
                  <table class="mb-0 table-sm">
                    <tbody>
                      <tr>
                        <td class="mr-2">Poli</td>
                        <td>{{ $pendaftar->poliklinik->nama}}</td>
                      </tr>
                      <tr>
                        <td class="mr-2">Dokter</td>
                        <td>{{ $pendaftar->dokter->user->name}}</td>
                      </tr>
                      <tr>
                        <td class="mr-2">Jenis Layanan</td>
                        <td>{{ $pendaftar->layanan}}</td>
                      </tr>
                      <tr>
                        <td class="mr-2">Tanggal Daftar</td>
                        <td>{{ $pendaftar->created_at->format("d F Y")}}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <hr />
            <h2 class="text-center">DAFTAR BIAYA</h2>
            <div class="table-responsive border p-3">
              <table class="w-100 mx-auto">
                <tbody>
                  <tr class="my-1">
                    <td colspan="3">Biaya Tindakan</td>
                  </tr>
                  @foreach($pendaftar->tindakans as $tindakan)
                  <tr class="my-1">
                    <td></td>
                    <td> {{$tindakan->nama}} </td>
                    <td class="text-right">{{rupiah($tindakan->harga)}}</td>
                  </tr>
                  @endforeach
                  <tr class="my-1">
                    <td colspan="3">Biaya Obat-obatan</td>
                  </tr>
                  @foreach($pendaftar->obats as $obat)
                  <tr class="my-1">
                    <td></td>
                    <td>
                      {{$obat->nama}}<br>
                      {{ $obat->pivot->quantity }} x @ {{$obat->pivot->harga}}
                    </td>
                    <td class="text-right">
                      {{rupiah($obat->pivot->harga * $obat->pivot->quantity)}}
                    </td>
                  </tr>
                  @endforeach
                  <tr>
                    <td colspan="3">
                      <hr>
                    </td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr class="my-1">
                    <td colspan="2" class="text-center my-2">
                      TOTAL BAYAR
                    </td>
                    <td class="text-right">
                      {{rupiah($pendaftar->pembayaran->total_bayar)}}
                    </td>
                  </tr>

                  <tr class="my-1">
                    <td colspan="2" class="text-center my-2">
                      JUMLAH BAYAR
                    </td>
                    <td class="text-right">
                      {{rupiah($pendaftar->pembayaran->uang_bayar)}}
                    </td>
                  </tr>
                  <tr class="my-1">
                    <td colspan="2" class="text-center my-2">
                      KEMBALIAN
                    </td>
                    <td class="text-right">
                      {{rupiah($pendaftar->pembayaran->kembalian)}}
                    </td>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
          <!-- Billing history table-->
        </div>
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
        width: 900px;
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