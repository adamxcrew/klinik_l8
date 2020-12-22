<x-backend-layout>
  <x-slot name="header">
    <div class="page-header-icon">
      <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
      </svg>
    </div>
    Permission - Role
  </x-slot>


  <div class="card mb-2">
    <div class="card-header">Create Role</div>
    <div class="card-body">
      <form action="{{route('role.create')}}" method="POST">
        @csrf
        @include("Permission.Role.Partials.form-groupt",['submit'=> "Create"])
      </form>
    </div>
  </div>

  <x-data-table-client-side>
    <x-slot name="title">
      DataTable Roles
    </x-slot>
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>GuardName</th>
        <th>Created At</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($roles as $i => $role)
      <tr>
        <td>{{$i+1}}</td>
        <td>{{$role->name}}</td>
        <td>{{$role->guard_name}}</td>
        <td>{{$role->created_at->format('d F Y')}}</td>
        <td>
          <a href="{{route('role.edit',$role->id)}}" class="btn btn-success mr-2">Edit</a>
          <span class="delete" endpoint="{{route('role.delete',$role->id)}}"></span>
        </td>
      </tr>
      @endforeach
    </tbody>
  </x-data-table-client-side>
</x-backend-layout>