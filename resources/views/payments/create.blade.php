@extends('layouts.main')

@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="card">
    <h5 class="card-header">Tambah Pembayaran</h5>
    <form action="{{ route('payments.store') }}" method="POST" class="p-3" enctype="multipart/form-data">
      @csrf
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="student_name">Nama Siswa</label>
        <div class="col-sm-10">
          <input type="text" name="student_name" class="form-control" id="student_name" placeholder="Masukkan nama siswa" />
        </div>
      </div>
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="student_nik">NIK Siswa</label>
        <div class="col-sm-10">
          <input type="text" name="student_nik" class="form-control" id="student_nik" placeholder="Masukkan NIK siswa" />
        </div>
      </div>
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="fee_id">Jenis Biaya</label>
        <div class="col-sm-10">
          <select name="fee_id" class="form-select" id="fee_id">
            @foreach ($fees as $fee)
            <option value="{{ $fee->id }}">{{ $fee->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
      @if (Auth::user()->role == 'ADMIN')
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="status">Status</label>
        <div class="col-sm-10">
          <select name="status" class="form-select" id="status">
            <option value="Pending">Pending</option>
            <option value="Completed">Completed</option>
          </select>
        </div>
      </div>
      @endif
      <div class="row justify-content-end">
        <div class="col-sm-10">
          <button type="submit" onclick="return confirm('Apakah Anda yakin ingin mengirim data ini?')" class="btn btn-sm btn-dark mt-3">Kirim</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- / Content -->
@endsection