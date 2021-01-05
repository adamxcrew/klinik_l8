<x-backend-layout>
  <div class="card mb-2">
    <div class="card-header">{{ $page_title ??  "Edit Poliklinik"}}</div>
    <div class="card-body">
      <form action="{{ route('poliklinik.edit',$poliklinik->id)}}" method="post">
        @csrf
        @method('PUT')
        @include("poliklinik.Partials.form-groupt",['submit'=> "Update"])
      </form>
    </div>
  </div>
</x-backend-layout>