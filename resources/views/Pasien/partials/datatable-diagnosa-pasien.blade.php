<div id="table-diagnosa-pasien" endpoint="{{route('diagnosa.datatable',[$pendaftar,'view'])}}">
  <div class="table-responsive">
    <table class="table table-bordered" width="100%" id="diagnosa-pasien-table" cellspacing="0">
      <thead>
        <tr>
          <th>#ID</th>
          <th>Kode</th>
          <th>Nama Diagnosa</th>
          <th>Keterangan</th>
          <th>Action</th>
        </tr>
      </thead>
    </table>
  </div>
</div>
@push("scripts")
<script>
  const dataTableDiagnosaPasien = $('#diagnosa-pasien-table').DataTable({
    processing: true,
    serverSide: true,
    "searching": false,
    ajax: {
      url: $('#table-diagnosa-pasien').attr('endpoint'),
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
        data: 'keterangan',
        name: 'keterangan'
      },
      {
        data: null,
        "defaultContent": "<button class='delete btn btn-danger btn-sm'>Delete</button>",
        orderable: false,
        searchable: false
      }
    ]
  });

  $(function() {
    $('#diagnosa-pasien-table').on('click', function(e) {
      let Me = e.target;
      if (Me.classList.contains("delete")) {
        let elTR = Me.closest("tr");
        let dt = dataTableDiagnosaPasien.row(elTR).data();
        (async () => {
          let data = {
            diagnosa_id: dt.diagnosa_id
          };
          let res = await axios.delete(dt.delete, {
            data: data
          });
          dataTableDiagnosaPasien.ajax.reload();
          $('#diagnosa-table').DataTable().ajax.reload()
        })();
      }
    });
  });
</script>
@endpush