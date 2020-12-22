<x-backend-layout>
  <x-slot name="header">
    <div class="page-header-icon">
      <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z" />
      </svg>
    </div>
    Permissions
  </x-slot>
  <div class="card mb-2">
    <div class="card-header">{{ $page_title ?? "Create New Role Permission"}}</div>
    <div class="card-body">
      <form action="{{ route('RolePermission.create')}}" method="post">
        @csrf
        @include("Permission.Role-permission.Partials.form-groupt",['submit'=> "Create"])
      </form>
    </div>
  </div>

  <x-data-table-client-side>
    <x-slot name="title">
      {{ $page_title ??  'List Permission'}}
    </x-slot>
    <thead>
      <tr>
        <th>#</th>
        <th>Role Name</th>
        <th>Have Permission</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($roles as $i => $rl)
      @if($rl->hasAnyPermission($permissions))
      <tr>
        <td>{{$i+1}}</td>
        <td>{{$rl->name}}</td>
        <td>{{implode(", ",$rl->getPermissionNames()->toArray())}}</td>
        <td>
          <a href="{{ route('RolePermission.edit',$rl->id)  }}" class="btn btn-success">Sync</a>
          <span class="delete" endpoint="{{route('RolePermission.delete',$rl)}}"></span>

        </td>
      </tr>
      @endif
      @endforeach
    </tbody>
  </x-data-table-client-side>
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