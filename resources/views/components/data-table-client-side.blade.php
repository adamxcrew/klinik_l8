<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">{{ $title ?? "DataTable"}}</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        {{$slot}}
      </table>
    </div>
  </div>
</div>


@push('scripts')
<!-- Page level plugins -->
<script src="/sb-admin2/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="/sb-admin2/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script>
  // Call the dataTables jQuery plugin
  $(document).ready(function() {
    $('#dataTable').DataTable();
  });
</script>
@endpush
@push("styles")
<!-- Custom styles for this page -->
<link href="/sb-admin2/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush