@extends('layouts.main')

@section('content')

<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
  <div class="card">
    <h5 class="card-header">Tambah SPP</h5>
    <form action="{{ route('spp.store') }}" method="POST" class="p-3" enctype="multipart/form-data">
      @csrf
      <div class="row mb-3">
        <label for="exampleFormControlSelect1" class="form-label col-sm-2">Bulan</label>
        <div class="col-sm-10">
          <select class="form-select" name="bulan" id="exampleFormControlSelect1" aria-label="Default select example">
            @foreach ($bulans as $bulan)
                <option value="{{ $bulan }}">{{ $bulan }}</option>
            @endforeach    
          </select>
        </div>
      </div>
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="basic-default-name">Tahun</label>
        <div class="col-sm-10">
          <input type="number" name="tahun" value="{{ date('Y') }}" class="form-control" id="basic-default-name" placeholder="" />
        </div>
      </div>
      <div class="row justify-content-end">
        <div class="col-sm-10">
          <button type="submit" onclick="return confirm('Apakah Anda yakin ingin mengirim data ini?')" class="btn btn-sm btn-dark mt-3">Kirim</button>
        </div>
      </div>
    </form>
  </div>

  <div class="card mt-3">
    <h5 class="card-header">Table SPP</h5>
    <div class="table-responsive text-nowrap p-3">
      <table class="table" id="example">
        <thead>
          <tr class="text-nowrap table-dark">
            <th class="text-white">No</th>
            <th class="text-white">Nama Siswa</th>
            <th class="text-white">Tagihan</th>
            <th class="text-white">NIS</th>
            <th class="text-white">Nama Wali</th>
            <th class="text-white">Bulan Tagihan</th>
            <th class="text-white">Tanggal Bayar</th>
            <th class="text-white">Via Bayar</th>
            <th class="text-white">Status</th>
            <th class="text-white">Tahun</th>
            <th class="text-white">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $item)
          <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $item->student->name }}</td>
            <td>{{ $item->price }}</td>
            <td>{{ $item->student->nis }}</td>
            <td>{{ $item->student->studentParent->name }}</td>
            <td>{{ $item->bulan }}</td>
            <td>{{ $item->tanggal ?? 'BELUM BAYAR' }}</td>
            <td>{{ $item->via ?? 'BELUM BAYAR' }}</td>
            <td>{{ $item->status }}</td>
            <td>{{ $item->tahun }}</td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{ route('spp.edit', $item->id) }}"><i class="bx bx-edit-alt me-1"></i>Edit</a>
                  <a class="dropdown-item" href="{{ route('spp.destroy', $item->id) }}"><i class="bx bx-trash me-1"></i>Delete</a>
                </div>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- / Content -->
@endsection