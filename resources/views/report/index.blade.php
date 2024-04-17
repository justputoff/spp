@extends('layouts.main')

@section('content')

<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
  <div class="card mt-3">
    <h5 class="card-header">Table SPP</h5>
    <div class="table-responsive text-nowrap p-3">
      <table class="table" id="example">
        <thead>
          <tr class="text-nowrap table-dark">
            <th class="text-white">No</th>
            <th class="text-white">Nama Siswa</th>
            <th class="text-white">NIS</th>
            <th class="text-white">Rombel</th>
            <th class="text-white">Nama Wali</th>
            <th class="text-white">Bulan Tagihan</th>
            <th class="text-white">Tanggal Bayar</th>
            <th class="text-white">Via Bayar</th>
            <th class="text-white">Status</th>
            <th class="text-white">Tahun</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $item)
          <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $item->student->name }}</td>
            <td>{{ $item->student->nis }}</td>
            <td>{{ $item->student->grade->name }}</td>
            <td>{{ $item->student->studentParent->name }}</td>
            <td>{{ $item->bulan }}</td>
            <td>{{ $item->tanggal ?? 'BELUM BAYAR' }}</td>
            <td>{{ $item->via ?? 'BELUM BAYAR' }}</td>
            <td>{{ $item->status }}</td>
            <td>{{ $item->tahun }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- / Content -->
@endsection