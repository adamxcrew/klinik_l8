<x-backend-layout>
  <x-slot name="header">
    <div class="page-header-icon">
      <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
        <path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" />
      </svg>
    </div>
    Permissions - Menu Edit
  </x-slot>
  <div class="card mb-2">
    <div class="card-header">Update Menu Dinamic</div>
    <div class="card-body">
      <form action="{{route('menu.edit',$menu)}}" method="POST">
        @csrf
        @method("PUT")
        @include("Permission.Menu.Partials.form-groupt")
      </form>
    </div>
  </div>


</x-backend-layout>