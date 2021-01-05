<div id="table-diagnosa" endpoint="{{route('diagnosa.datatable',$pendaftar)}}">
  <div class="table-responsive">

    <table class="table table-bordered" width="100%" id="diagnosa-table" cellspacing="0">
      <thead>
        <tr>
          <th>#</th>
          <th>Kode</th>
          <th>Nama Diagnosa</th>
          <th>Action</th>
        </tr>
      </thead>
    </table>

  </div>
  <div class="card keterangan d-none">
    <div class="card-header">
      <h2 class=" card-title">
        <svg width="36" style="cursor: pointer;" class="mr-2 back" height="35" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
        </svg>
        <span>
          Back
        </span>
      </h2>
    </div>
    <div class="card-body">
      <div class="form-group">
        <label for="keterangan">Keterangan</label>
        <textarea class="form-control" name="keterangan" rows="3"></textarea>
      </div>
    </div>
    <div class="modal-footer">
      <!-- <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button> -->
      <button class="btn btn-primary" endpoint="{{route('api.pasien.tambahdiagnosa',$pendaftar)}}" id="tambah-diagnosa" type="submit">Tambahkan</button>
    </div>
  </div>
</div>
@push("scripts")
<script>
  let diagnosa = {};
  let selectedDiagnosa = [];
  const dataTableDiagnosa = $('#diagnosa-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: {

      url: $("#table-diagnosa").attr('endpoint'),

      "dataSrc": function(json) {
        return json.data;
      },
      "data": function(d) {
        if (selectedDiagnosa.length > 0) {
          d.idSelected = selectedDiagnosa.map(diagnosa => diagnosa.id).join(",")
        }
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
        data: 'null',
        defaultContent: `<a href="javascript:void(0)" class="edit btn btn-info btn-sm mr-1 tambahkan" >Tambahkan</a>`,
        orderable: false,
        searchable: false
      }
    ]
  });
  $(function() {

    $('#diagnosa-table').on('click', '.tambahkan', function() {
      let elTR = this.closest("tr");
      let dt = dataTableDiagnosa.row(elTR).data();
      diagnosa = dt
      showKeterangan(true)
    })

    function showKeterangan(status) {
      if (status === true) {
        $("#table-diagnosa").find(".keterangan").removeClass("d-none");
        $("#table-diagnosa").find(".keterangan.card-title span").html(diagnosa.nama)
        $("#table-diagnosa").find(".table-responsive").addClass("d-none");
      } else {
        $("#table-diagnosa").find(".keterangan").addClass("d-none");
        $("#table-diagnosa").find(".keterangan.card-title span").html("Back")
        $("#table-diagnosa").find(".table-responsive").removeClass("d-none");
        $("#table-diagnosa").find("[name='keterangan']").val('');
        $("#tambahDiagnosaModal").on('hidden.bs.modal', function(e) {
          dataTableDiagnosa.search('').draw();
          dataTableDiagnosa.ajax.reload();
        })
      }
    }
    $("#table-diagnosa").find(".keterangan").on('click', function(e) {
      let Me = e.target;
      if (e.target.classList.contains("back")) {
        showKeterangan(false)
      }
      if (e.target.id === "tambah-diagnosa") {
        diagnosa.keterangan = $("#table-diagnosa").find("[name='keterangan']").val();

        try {
          (async () => {
            let data = {
              diagnosa_id: diagnosa.id,
              keterangan: diagnosa.keterangan
            }
            let res = await axios.post(Me.getAttribute("endpoint"), data);
            dataTableDiagnosa.ajax.reload();
            $('#diagnosa-pasien-table').DataTable().ajax.reload();

            showKeterangan(false)
          })();
        } catch (error) {
          console.log(error);
        }
        $('#tambahDiagnosaModal').modal('toggle');
      }
    })
  });
</script>
@endpush