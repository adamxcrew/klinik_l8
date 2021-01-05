<x-backend-layout>
  <div class="card mb-2">
    <div class="card-header">{{ $page_title ??  "Edit Tindakan"}}</div>
    <div class="card-body">
      <form action="{{ route('tindakan.edit',$tindakan->id)}}" method="post">
        @csrf
        @method('PUT')
        @include("tindakan.Partials.form-groupt",['submit'=> "Update"])
      </form>
    </div>
  </div>  
</x-backend-layout>