<x-backend-layout>
  <x-slot name="header">
    <div class="page-header-icon">
      <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
      </svg>
    </div>
    Poli - Pasien Antri
  </x-slot>
  <x-data-table-client-side>
    <x-slot name="title">
      {{ $page_title ?? 'Daftar Pasien Antri'}}
    </x-slot>
    <thead>
      <tr>
        <th>#</th>
        <th>Tanggal Daftar</th>
        <th>Nomor Pendaftaran Pasien</th>
        <th>Nama</th>
        <th>Jenis Layanan</th>
        <th>Poli</th>
        <th>Dokter</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($pendaftars as $i => $pasien)
      <tr>
        <td>{{$i+1}}</td>
        <td>{{$pasien->created_at->diffForHumans()}}</td>
        <td>{{$pasien->nomor_pendaftaran}}</td>
        <td>{{$pasien->nama}}</td>
        <td>{{ $pasien->layanan}}</td>
        <td>{{ $pasien->poliklinik->nama}}</td>
        <td>{{ $pasien->dokter->user->name}}</td>
        <td>
          <a href="{{ route('pasien.diagnosa',$pasien)}}" class="btn btn-success">Diagnosa</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </x-data-table-client-side>

</x-backend-layout>