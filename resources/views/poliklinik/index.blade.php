<x-backend-layout>
  <x-slot name="header">
    <div class="page-header-icon">
      <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
      </svg>
    </div>
    Poliklinik - List

  </x-slot>
  <div class="card mb-2">
    <div class="card-header">{{ $page_title ?? "Tambah Poliklinik baru"}}</div>
    <div class="card-body">
      <form action="{{ route('poliklinik.tambah')}}" method="post">
        @csrf
        @include("poliklinik.Partials.form-groupt",['submit'=> "Create"])
      </form>
    </div>
  </div>

  <x-data-table-client-side>
    <x-slot name="title">
      {{ $page_title ?? 'Daftar Poliklinik'}}
    </x-slot>
    <thead>
      <tr>
        <th>#</th>
        <th>Nomor Poliklinik</th>
        <th>Nama</th>
        <th>Jam Layanan</th>
        <th>Keterangan</th>
        <th>status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($polikliniks as $i => $poliklinik)
      <tr>
        <td>{{$i+1}}</td>
        <td>{{$poliklinik->no_poli}}</td>
        <td>{{$poliklinik->nama}}</td>
        <td>{{$poliklinik->jam_layanan}}</td>
        <td>
          <div class="d-flex justify-content-center align-items-center status" endpoint="{{route('poliklinik.gantistatus',$poliklinik)}}" data="{{$poliklinik->status}}">

          </div>
        </td>
        <td>{{$poliklinik->keterangan}}</td>
        <td>
          <a href="{{ route('poliklinik.edit',$poliklinik)}}" class="btn btn-success">Edit</a>
          <span class="delete" endpoint="{{route('poliklinik.delete',$poliklinik)}}"></span>
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
        placeholder: "Select Roles"
      })
    })
  </script>
  @endpush

</x-backend-layout>