<x-backend-layout>
  <x-slot name="header">
    <div class="page-header-icon">
      <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
      </svg>
    </div>
    Tindakan - List
  </x-slot>
  <div class="card mb-2">
    <div class="card-header">{{ $page_title ?? "Tambah Tindakan baru"}}</div>
    <div class="card-body">
      <form action="{{ route('tindakan.tambah')}}" method="post">
        @csrf
        @include("Tindakan.Partials.form-groupt",['submit'=> "Create"])
      </form>
    </div>
  </div>

  <x-data-table-client-side>
    <x-slot name="title">
      {{ $page_title ?? 'Daftar Tindakans'}}
    </x-slot>
    <thead>
      <tr>
        <th>#</th>
        <th>Kode Tindakan</th>
        <th>Nama</th>
        <th>Harga</th>
        <th>Tgl Input</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($tindakans as $i => $tindakan)
      <tr>
        <td>{{$i+1}}</td>
        <td>{{$tindakan->kode}}</td>
        <td>{{$tindakan->nama}}</td>
        <td>{{ rupiah($tindakan->harga)}}</td>
        <td>{{ $tindakan->created_at->format('d F Y')}}</td>
        <td>
          <div class="d-flex justify-content-center align-items-center status" endpoint="{{route('tindakan.gantistatus',$tindakan)}}" data="{{$tindakan->status}}">
          </div>
        </td>
        <td>
          <a href="{{ route('tindakan.edit',$tindakan)}}" class="btn btn-success">Edit</a>
          <span class="delete" endpoint="{{route('tindakan.delete',$tindakan)}}"></span>
        </td>
      </tr>
      @endforeach
    </tbody>
  </x-data-table-client-side>

</x-backend-layout>