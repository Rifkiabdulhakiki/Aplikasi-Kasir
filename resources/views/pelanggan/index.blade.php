@extends('layouts.app')

@section('title', 'Daftar Pelanggan')

@section('content')
<div class="container">
    <h1>Daftar Pelanggan</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(auth()->user()->role == 'Admin')
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addPelangganModal">Tambah Pelanggan</button>
    @endif

    <form method="GET" action="{{ route('pelanggan.index') }}">
        <input type="text" name="search" placeholder="Cari pelanggan..." value="{{ request('search') }}">
        <button type="submit">Cari</button>
    </form>

    <table class="table">
        <thead>
           <tr class="text-center">
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>Alamat</th>
                <th>Nomor Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead> 
        <tbody>
            @foreach($pelanggans as $pelanggan)
           <tr class="text-center">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $pelanggan->Nama_pelanggan }}</td>
                <td>{{ $pelanggan->Alamat }}</td>
                <td>{{ $pelanggan->Nomor_telepon }}</td>
                <td>
                @if(auth()->user()->role == 'Admin')
                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editPelangganModal" data-id="{{ $pelanggan->PelangganID }}" data-nama="{{ $pelanggan->Nama_pelanggan }}" data-alamat="{{ $pelanggan->Alamat }}" data-telepon="{{ $pelanggan->Nomor_telepon }}">Edit</button>
                    <form action="{{ route('pelanggan.destroy', $pelanggan->PelangganID) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pelanggan ini?')">Hapus</button>
                    </form>
                @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $pelanggans->links() }}
</div>

<!-- Modal Tambah Pelanggan -->
<div class="modal fade" id="addPelangganModal" tabindex="-1" aria-labelledby="addPelangganModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('pelanggan.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addPelangganModalLabel">Tambah Pelanggan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Pelanggan -->
<div class="modal fade" id="editPelangganModal" tabindex="-1" aria-labelledby="editPelangganModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editForm" action="" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editPelangganModalLabel">Edit Pelanggan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editNama_pelanggan" class="form-label">Nama Pelanggan</label>
                        <input type="text" class="form-control" id="editNama_pelanggan" name="Nama_pelanggan" required>
                    </div>

                    <div class="mb-3">
                        <label for="editAlamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="editAlamat" name="Alamat" required>
                    </div>

                    <div class="mb-3">
                        <label for="editNomor_telepon" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" id="editNomor_telepon" name="Nomor_telepon" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    const editPelangganModal = document.getElementById('editPelangganModal');
    editPelangganModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const pelangganId = button.getAttribute('data-id');
        const nama = button.getAttribute('data-nama');
        const alamat = button.getAttribute('data-alamat');
        const telepon = button.getAttribute('data-telepon');

        const form = document.getElementById('editForm');
        form.action = '/pelanggan/' + pelangganId;

        document.getElementById('editNama_pelanggan').value = nama;
        document.getElementById('editAlamat').value = alamat;
        document.getElementById('editNomor_telepon').value = telepon;
    });
</script>
@endsection
