<x-backend-layout>
  <x-slot name="header">
    <div class="page-header-icon">
      <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
      </svg>
    </div>
    Permissions
  </x-slot>
  <div class="card mb-2">
    <div class="card-header">{{ $page_title ?? 'List Permission'}}</div>
    <div class="card-body">
      <form action="{{route('permission.create')}}" method="POST">
        @csrf
        @include("Permission.Permission.Partials.form-groupt",['submit'=> "Create"])
      </form>
    </div>
  </div>

  <x-data-table-client-side>
    <x-slot name="title">
      DataTable Permission
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
      @foreach($permissions as $i => $permission)
      <tr>
        <td>{{$i+1}}</td>
        <td>{{$permission->name}}</td>
        <td>{{$permission->guard_name}}</td>
        <td>{{$permission->created_at->format('d F Y')}}</td>
        <td>
          <a href="{{route('permission.edit',$permission->id)}}" class="btn btn-success mr-2">Edit</a>
          <span class="delete" endpoint="{{route('permission.delete',$permission->id)}}"></span>
        </td>
      </tr>
      @endforeach
    </tbody>
  </x-data-table-client-side>
</x-backend-layout>