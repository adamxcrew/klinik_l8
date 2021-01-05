<x-backend-layout>
  <x-slot name="header">
    <div class="page-header-icon">
      <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
      </svg>
    </div>
    Master - Obat

  </x-slot>
  <div class="card mb-2">
    <div class="card-header bg-info text-white" href="#tambahObat" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="tambahObat">{{ $page_title ?? "Tambah Obat baru"}}</div>
    <div class="collapse {{$errors->any() ? 'show' :''}}" id="tambahObat">
      <div class="card-body">
        <form action="{{ route('obat.tambah')}}" method="post">
          @csrf
          @include("obat.Partials.form-groupt",['submit'=> "Create"])
        </form>
      </div>
    </div>
  </div>

  <x-data-table-client-side>
    <x-slot name="title">
      {{ $page_title ?? 'Daftar Obats'}}
    </x-slot>
    <thead>
      <tr>
        <th>#</th>
        <th>Kode Obat</th>
        <th>Nama</th>
        <th>Satuan</th>
        <th>Harga</th>
        <th>status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($obats as $i => $obat)
      <tr>
        <td>{{$i+1}}</td>
        <td>{{$obat->kode}}</td>
        <td>{{$obat->nama}}</td>
        <td>{{$obat->satuan}}</td>
        <td>{{rupiah($obat->harga)}}</td>
        <td>
          <div class="d-flex justify-content-center align-items-center status" endpoint="{{route('obat.gantistatus',$obat)}}" data="{{$obat->status}}">
          </div>
        </td>
        <td>
          <a href="{{ route('obat.edit',$obat)}}" class="btn btn-success">Edit</a>
          <span class="delete" endpoint="{{route('obat.delete',$obat)}}"></span>
        </td>
      </tr>
      @endforeach
    </tbody>
  </x-data-table-client-side>

</x-backend-layout>