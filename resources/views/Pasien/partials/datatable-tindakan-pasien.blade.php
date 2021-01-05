<h5 class="card-title d-flex justify-content-between align-items-center">
  <span>Daftar Tindakan</span>
  <button class="btn btn-primary mr-2 my-1" data-toggle="modal" data-target="#tambahTindakanModal" type="button">Tambah</button>
</h5>
<p class="card-text">
  <div id="table-tindakan-pasien" endpoint="{{route('pasien.tindakan.datatable',[$pendaftar,'view'])}}">
    <div class="table-responsive">
      <table class="table table-bordered" width="100%" id="tindakan-pasien-table" cellspacing="0">
        <thead>
          <tr>
            <th>#ID</th>
            <th>Kode Tindakan</th>
            <th>Nama Tindakan</th>
            <th>Action</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</p>


<!-- Modal -->
<div class="modal fade" id="tambahTindakanModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahTindakanModalLabel">Daftar Tindakan Pasien</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
        <div id="table-tindakan" endpoint="{{route('pasien.tindakan.datatable',$pendaftar)}}">
          <div class="table-responsive">
            <table class="table table-bordered" width="100%" id="tindakan-table" cellspacing="0">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Kode</th>
                  <th>Nama Tindakan</th>
                  <th>Action</th>
                </tr>
              </thead>
            </table>
            <div id="tambahTindakan" endpoint="{{route('api.pasien.tambahtindakan',$pendaftar)}}"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@push("scripts")
<script>
  $(function() {
    let MyModal = $("#tambahTindakanModal");
    const dataTableTindakanPasien = $('#tindakan-pasien-table').DataTable({
      processing: true,
      "searching": false,
      serverSide: true,
      ajax: {
        url: $('#table-tindakan-pasien').attr('endpoint'),
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
          "defaultContent": "<button class='delete btn btn-danger btn-sm'>Delete</button>",
          orderable: false,
          searchable: false
        }
      ]
    });
    $('#tindakan-pasien-table').on('click', function(e) {
      let Me = e.target;
      if (Me.classList.contains("delete")) {
        let elTR = Me.closest("tr");
        let dt = dataTableTindakanPasien.row(elTR).data();
        (async () => {
          let data = {
            tindakan_id: dt.tindakan_id
          };
          let res = await axios.delete(dt.delete, {
            data: data
          });
          dataTableTindakanPasien.ajax.reload();
          dataTableTindakans.ajax.reload()
        })();
      }
    });
    let tindakanSelected = null;
    const dataTableTindakans = $("#tindakan-table").DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: $('#table-tindakan').attr('endpoint'),
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
        let endpoint = MyModal.find("#tambahTindakan").attr("endpoint");
        let elTR = Me.closest("tr");
        let tindakan = dataTableTindakans.row(elTR).data();
        try {
          (async () => {
            let data = {
              tindakan_id: tindakan.id
            }
            let res = await axios.post(endpoint, data);
            await dataTableTindakans.ajax.reload();
            dataTableTindakanPasien.ajax.reload();
          })();
        } catch (error) {
          console.log(error);
        }
        MyModal.modal('toggle');
      }
    });
    MyModal.on('hidden.bs.modal', function(e) {
      dataTableTindakans.search('').draw();
      dataTableTindakans.ajax.reload();
    })

  });
</script>
@endpush