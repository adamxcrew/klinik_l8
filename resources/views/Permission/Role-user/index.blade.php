<x-backend-layout>
  <x-slot name="header">
    <div class="page-header-icon">
      <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
      </svg>
    </div>
    Permission - User Roles

  </x-slot>
  <div class="card mb-2">
    <div class="card-header">{{ $page_title ?? "Create New User Roles"}}</div>
    <div class="card-body">
      <form action="{{ route('RoleUser.create')}}" method="post">
        @csrf
        @include("Permission.Role-user.Partials.form-groupt",['submit'=> "Create"])
      </form>
    </div>
  </div>

  <x-data-table-client-side>
    <x-slot name="title">
      {{ $page_title ?? 'List Navigations'}}
    </x-slot>
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>email</th>
        <th>Roles</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $i => $us)
      <tr>
        <td>{{$i+1}}</td>
        <td>{{$us->name}}</td>
        <td>{{$us->email}}</td>
        <td>{{implode(", ",$us->getRoleNames()->toArray())}}</td>
        <td>
          <a href="{{ route('RoleUser.edit',$us)  }}" class="btn btn-success">Sync</a>
          <span class="delete" endpoint="{{route('RoleUser.delete',$us)}}"></span>
        </td>
      </tr>
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