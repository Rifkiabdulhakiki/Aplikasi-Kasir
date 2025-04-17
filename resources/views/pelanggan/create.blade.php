@extends('layouts.app')

@section('title', 'Tambah Pelanggan')

@section('content')
<div class="container">
    <h1>Tambah Pelanggan</h1>

    <form action="{{ route('pelanggan.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="Nama_pelanggan" class="form-label">Nama Pelanggan</label>
            <input type="text" class="form-control" id="Nama_pelanggan" name="Nama_pelanggan" required>
        </div>

        <div class="mb-3">
            <label for="Alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="Alamat" name="Alamat" required>
        </div>

        <div class="mb-3">
            <label for="Nomor_telepon" class="form-label">Nomor Telepon</label>
            <input type="text" class="form-control" id="Nomor_telepon" name="Nomor_telepon" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
