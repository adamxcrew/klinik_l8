<h5 class="card-title d-flex justify-content-between align-items-center">
  <span>Daftar Resep</span>
  <button class="btn btn-primary mr-2 my-1" data-toggle="modal" data-target="#tambahResepModal" type="button">Tambah</button>
</h5>
<p class="card-text">
<div id="table-resep-pasien" endpoint="{{route('resep.datatable',[$pendaftar,'view'])}}">
  <div class="table-responsive">
    <table class="table table-bordered" width="100%" id="resep-pasien-table" cellspacing="0">
      <thead>
        <tr>
          <th>#ID</th>
          <th>Kode Obat</th>
          <th>Nama Obat</th>
          <th>Satuan</th>
          <th>Jumlah Obat</th>
          <th>Aturan Pakai</th>
          <th>Action</th>
        </tr>
      </thead>
    </table>
  </div>
</div>
</p>


<!-- Modal -->
<div class="modal fade" id="tambahResepModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahResepModalLabel">Daftar Resep Pasien</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
        <div id="table-resep" endpoint="{{route('resep.datatable',$pendaftar)}}">
          <div class="table-responsive">
            <table class="table table-bordered" width="100%" id="resep-table" cellspacing="0">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Kode</th>
                  <th>Nama Obat</th>
                  <th>Action</th>
                </tr>
              </thead>
            </table>
          </div>
          <div class="card lanjutan d-none">
            <div class="card-header">
              <h2 class="card-title">
                <svg width="36" style="cursor: pointer;" class="mr-1 pl-2 back" height="35" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                <span>
                  Back
                </span>
              </h2>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="jumlahObat">Jumlah Obat</label>
                <input type="number" id="jumlahObat" class="form-control">
              </div>
              <div class="form-group">
                <label for="aturanPakai">Aturan Pakai</label>
                <input type="text" id="aturanPakai" class="form-control" placeholder="EX : 2x1">
              </div>
            </div>
            <div class="modal-footer">
              <!-- <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button> -->
              <button class="btn btn-primary submitObat" endpoint="{{route('api.pasien.tambahresep',$pendaftar)}}" type="submit">Tambahkan</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@push("styles")
<link href="/vendor/sweetalert2/sweetalert2.min.css" rel="stylesheet">
@endpush
@push("scripts")
<script src="/vendor/sweetalert2/sweetalert2.min.js"></script>
<script>
  $(function() {
    let MyModal = $("#tambahResepModal");
    const dataTableObatPasien = $('#resep-pasien-table').DataTable({
      processing: true,
      "searching": false,
      serverSide: true,
      ajax: {
        url: $('#table-resep-pasien').attr('endpoint'),
        "dataSrc": function(json) {
          return json.data;
        }
      },
      columns: [{
          data: 'id',
          name: 'id'
        },
        {
          data: 'kode',
          name: 'kode'
        },

        {
          data: 'nama',
          name: 'nama'
        },
        {
          data: 'satuan',
          name: 'satuan'
        },
        {
          data: 'quantity',
          name: 'quantity'
        },
        {
          data: 'aturan',
          name: 'aturan'
        },
        {
          data: null,
          "defaultContent": "<button class='delete btn btn-danger btn-sm'>Delete</button>",
          orderable: false,
          searchable: false
        }
      ]
    });
    $('#resep-pasien-table').on('click', function(e) {
      let Me = e.target;
      if (Me.classList.contains("delete")) {
        let elTR = Me.closest("tr");
        let dt = dataTableObatPasien.row(elTR).data();
        (async () => {
          let data = {
            obat_id: dt.obat_id
          };
          let res = await axios.delete(dt.delete, {
            data: data
          });
          dataTableObatPasien.ajax.reload();
          // $('#resep-table').DataTable().ajax.reload()
        })();
      }
    });
    let obatSelected = null;
    let showTindakLanjut = (obat = null) => {
      obatSelected = obat;
      if (obat) {
        MyModal.find(".lanjutan").removeClass("d-none");
        MyModal.find(".lanjutan .card-title span").html(obat.nama)
        MyModal.find(".table-responsive").addClass("d-none");
        MyModal.find("#jumlahObat").attr("max", obat.stock);
      } else {
        MyModal.find(".lanjutan").addClass("d-none");
        MyModal.find(".lanjutan .card-title span").html("Back")
        MyModal.find(".table-responsive").removeClass("d-none");
        MyModal.find("#aturanPakai").val("");
        MyModal.find("#jumlahObat").val("0");
      }
    }
    const dataTableObats = $("#resep-table").DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: $('#table-resep').attr('endpoint'),
        "dataSrc": function(json) {
          return json.data;
        }
      },
      columns: [{
          data: 'id',
          name: 'id'
        },
        {
          data: 'kode',
          name: 'kode'
        },

        {
          data: 'nama',
          name: 'nama'
        },

        {
          data: null,
          "defaultContent": "<button class='lanjut btn btn-danger btn-sm'>Pilih</button>",
          orderable: false,
          searchable: false
        }
      ]
    })
    MyModal.on('click', function(e) {
      let Me = e.target;
      if (Me.classList.contains("lanjut")) {
        let elTR = Me.closest("tr");
        let obat = dataTableObats.row(elTR).data();
        showTindakLanjut(obat);
      } else if (Me.classList.contains("back")) {
        showTindakLanjut(null);

      } else if (Me.classList.contains("submitObat")) {
        obatSelected.quantity = MyModal.find("#jumlahObat").val();
        obatSelected.aturan = MyModal.find("#aturanPakai").val();

        try {
          (async () => {
            let data = {
              obat_id: obatSelected.id,
              quantity: obatSelected.quantity,
              aturan: obatSelected.aturan,
              harga: obatSelected.harga

            }
            let res = await axios.post(Me.getAttribute("endpoint"), data);
            await dataTableObats.ajax.reload();
            dataTableObatPasien.ajax.reload();
            showTindakLanjut(null)
          })();
        } catch (error) {
          console.log(error);
        }
        MyModal.modal('toggle');
      }
    });
    MyModal.on('hidden.bs.modal', function(e) {
      dataTableObats.search('').draw();
      dataTableObats.ajax.reload();
    })
    let modalInput = MyModal.find("#jumlahObat");
    modalInput.on('input', function() {
      let inp = parseInt(modalInput.val());
      if (inp > obatSelected.stock) {
        modalInput.val(obatSelected.stock);
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Melebihi stok Obat yang ada!',
        })
      }
    })
  });
</script>
@endpush