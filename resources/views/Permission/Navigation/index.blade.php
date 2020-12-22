<x-backend-layout>
  <x-slot name="header">
    <div class="page-header-icon">
      <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
      </svg>
    </div>
    Permission - User Roles

  </x-slot>
  <div class="card mb-2">
    <div class="card-header">Pembuatan Navigation Dinamic</div>
    <div class="card-body">
      <form action="{{ route('navigation.create')}}" method="post">
        @csrf
        @include("Permission.Navigation.Partials.form-groupt",['submit'=> "Create"])
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
        <th>URL</th>
        <th>Permission Name</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($navigations as $i => $nv)
      <tr>
        <td>{{$i+1}}</td>
        <td>{{$nv->name}}</td>
        <td>{{$nv->url}}</td>
        <td>{{ $nv->permission_name}}</td>
        <td>
          <a href="{{ route('navigation.edit',$nv->id)  }}" class="btn btn-success">Edit</a>
          <span class="delete" endpoint="{{route('navigation.delete',$nv)}}"></span>

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
        placeholder: "Select Permission"
      })
    })
  </script>
  @endpush

</x-backend-layout>