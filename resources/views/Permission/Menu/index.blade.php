<x-backend-layout>
  <x-slot name="header">
    <div class="page-header-icon">
      <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
        <path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" />
      </svg>
    </div>
    Permissions - Menu
  </x-slot>


  <div class="card mb-2">
    <div class="card-header">Pembuatan Menu Dinamic</div>
    <div class="card-body">
      <form action="{{route('menu.create')}}" method="POST">
        @csrf
        <div class="form-group">
          <label for="nameMenu">Email address</label>
          <input class="form-control @error('name') is-invalid @enderror" id="nameMenu" name="name" placeholder="ex: Menu">
          @error('name')
          <div class="text-danger mt-2 d-block">{{ $message }}</div>
          @enderror
        </div>
        <div class="form-group">
          <input type="submit" class="btn btn-primary" value="Tambah">
        </div>
      </form>
    </div>
  </div>

  <x-data-table-client-side>
    <thead>
      <tr>
        <th>Name</th>
        <th>Created At</th>
        <th class="text-center">Action</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <th>Name</th>
        <th>Created At</th>
        <th class="text-center">Action</th>
      </tr>
    </tfoot>
    <tbody>
      @foreach($menus as $mn)
      <tr>
        <td>{{$mn->name}}</td>
        <td>{{$mn->created_at->format('d F Y')}}</td>
        <td>
          <a href="{{route('menu.edit',$mn->id)}}" class="btn btn-success mr-2">Edit</a>
          <span class="delete" endpoint="{{route('menu.delete',$mn->id)}}"></span>
        </td>
      </tr>
      @endforeach
    </tbody>
  </x-data-table-client-side>



</x-backend-layout>