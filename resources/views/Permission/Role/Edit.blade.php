<x-backend-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>


  <div class="card mb-2">
    <div class="card-header">{{ $page_title ?? "Edit  Roles"}}</div>
    <div class="card-body">
      <form action="{{ route('role.edit',$role)}}" method="post">
        @csrf
        @method('PUT')
        @include("Permission.Role.Partials.form-groupt",['submit'=> "Edit"])
      </form>
    </div>
  </div>
</x-backend-layout>