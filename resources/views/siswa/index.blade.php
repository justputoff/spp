@extends('layouts.main')

@section('content')

<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
  <div class="card">
    <h5 class="card-header">Table Parent <a href="{{ route('student.create') }}" class="btn btn-sm btn-success">Tambah student</a></h5>
    <div class="table-responsive text-nowrap p-3">
      <table class="table" id="example">
        <thead>
          <tr class="text-nowrap table-dark">
            <th class="text-white">No</th>
            <th class="text-white">Nama</th>
            <th class="text-white">NIK</th>
            <th class="text-white">NIS</th>
            <th class="text-white">NISN</th>
            <th class="text-white">Rombel</th>
            <th class="text-white">Parent</th>
            <th class="text-white">TA</th>
            <th class="text-white">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $item)
          <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $item->name }}</td>
            <td>{{ $item->nik }}</td>
            <td>{{ $item->nis }}</td>
            <td>{{ $item->nisn }}</td>
            <td>{{ $item->grade->name }}</td>
            <td>{{ $item->studentParent->name }}</td>
            <td>{{ $item->taStudent->name }}</td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{ route('student.edit', $item->id) }}"><i class="bx bx-edit-alt me-1"></i>Edit</a>
                  <a class="dropdown-item" href="{{ route('student.destroy', $item->id) }}"><i class="bx bx-trash me-1"></i>Delete</a>
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