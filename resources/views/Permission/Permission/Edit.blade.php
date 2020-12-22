<x-backend-layout>
  <div class="card mb-2">
    <div class="card-header">{{ $page_title ?? "Edit Permission"}}</div>
    <div class="card-body">
      <form action="{{ route('permission.edit',$permission)}}" method="post">
        @csrf
        @method('PUT')
        @include("Permission.Permission.Partials.form-groupt",['submit'=> "Create"])
      </form>
    </div>
  </div>
</x-backend-layout>