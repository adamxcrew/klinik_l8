<x-backend-layout>
  <div class="card mb-2">
    <div class="card-header">{{ $page_title ??  "Edit Dokter"}}</div>
    <div class="card-body">
      <form action="{{ route('dokter.edit',$dokter->id)}}" method="post">
        @csrf
        @method('PUT')
        @include("dokter.Partials.form-groupt",['submit'=> "Update"])
      </form>
    </div>
  </div>
</x-backend-layout>