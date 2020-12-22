<x-backend-layout>
  <div class="card mb-2">
    <div class="card-header">{{ $page_title ??  "Sync User"}}</div>
    <div class="card-body">
      <form action="{{ route('RoleUser.edit',$user->id)}}" method="post">
        @csrf
        @method('PUT')
        @include("Permission.Role-user.Partials.form-groupt",['submit'=> "Create"])
      </form>
    </div>
  </div>
  @push("styles")
  <link rel="stylesheet" href="\sb-admin2\vendor\select2\css\select2.min.css">
  @endpush
  @push("scripts")
  <script src="\sb-admin2\vendor\select2\js\select2.min.js"></script>
  <script>
    $(document).ready(function() {
      $(".select2").select2({
        placeholder: "Select Roles"
      })
    })
  </script>
  @endpush

</x-backend-layout>