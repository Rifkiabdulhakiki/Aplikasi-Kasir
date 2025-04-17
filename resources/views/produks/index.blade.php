@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
<div class="container">
    <h1>Daftar Produk</h1>

    <!-- Button trigger modal untuk Admin -->
    @if(auth()->user()->role == 'Admin')
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createModal">
        Tambah Produk
    </button>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" action="{{ route('produks.index') }}">
        <input type="text" name="search" placeholder="Cari produk..." value="{{ request('search') }}">
        <button type="submit">Cari</button>
    </form>

    <!-- Tampilan untuk Kasir (Menggunakan Card) -->
    @if(auth()->user()->role == 'Kasir')
    <div class="row">
        @forelse($produks as $produk)
            <div class="col-md-3 mb-4">
                <div class="card">
                    <img src="{{ $produk->Gambar ? asset('storage/'.$produk->Gambar) : asset('images/default.png') }}" class="card-img-top" alt="Product Image">
                    <div class="card-body">
                        <h5 class="card-title">{{ $produk->Nama_Produk }}</h5>
                        <p class="card-text">{{ number_format($produk->Harga, 2) }}</p>
                        <p class="card-text">
                            @if($produk->Stok == 0)
                                <span class="text-danger">Stok Habis</span>
                            @else
                                {{ $produk->Stok }} Stok
                            @endif
                        </p>
                        <p class="card-text">{{ $produk->Deskripsi }}</p>
                        <div class="d-flex justify-content-between">
                            <!-- Edit Button for Admin only -->
                            @if(auth()->user()->role == 'Admin')
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal-{{ $produk->ProdukID }}">
                                Edit
                            </button>
                            @endif

                            <!-- Delete Form for Admin only -->
                            <form action="{{ route('produks.destroy', $produk->ProdukID) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                @if(auth()->user()->role == 'Admin')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus produk ini?')">Hapus</button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">Belum ada produk.</p>
        @endforelse
    </div>

    @else
    <!-- Tampilan untuk Admin (Menggunakan Tabel) -->
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produks as $produk)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $produk->Nama_Produk }}</td>
                    <td>{{ number_format($produk->Harga, 2) }}</td>
                    <td>
                     @if($produk->Stok == 0)
                    <span class="text-danger">Stok Habis</span>
                      @else
                       {{ $produk->Stok }} Stok
                       @endif
                    </td>

                    <td>{{ $produk->Deskripsi }}</td>
                    <td>
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal-{{ $produk->ProdukID }}">
                                Edit
                            </button>
                        <form action="{{ route('produks.destroy', $produk->ProdukID) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus produk ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $produks->links() }}
    @endif

</div>

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('produks.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Tambah Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="Nama_Produk" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="Nama_Produk" name="Nama_Produk" value="{{ old('Nama_Produk') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="Harga" class="form-label">Harga</label>
                        <input type="number" step="0.01" class="form-control" id="Harga" name="Harga" value="{{ old('Harga') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="Stok" class="form-label">Stok</label>
                        <input type="number" class="form-control" id="Stok" name="Stok" value="{{ old('Stok') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="Deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="Deskripsi" name="Deskripsi" rows="3" required>{{ old('Deskripsi') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="Gambar" class="form-label">Gambar</label>
                        <input type="file" class="form-control" id="Gambar" name="Gambar">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
@foreach($produks as $produk)
<div class="modal fade" id="editModal-{{ $produk->ProdukID }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('produks.update', $produk->ProdukID) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="Nama_Produk" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="Nama_Produk" name="Nama_Produk" value="{{ old('Nama_Produk', $produk->Nama_Produk) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="Harga" class="form-label">Harga</label>
                        <input type="number" step="0.01" class="form-control" id="Harga" name="Harga" value="{{ old('Harga', $produk->Harga) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="Stok" class="form-label">Stok</label>
                        <input type="number" class="form-control" id="Stok" name="Stok" value="{{ old('Stok', $produk->Stok) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="Deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="Deskripsi" name="Deskripsi" rows="3" required>{{ old('Deskripsi', $produk->Deskripsi) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="Gambar" class="form-label">Gambar</label>
                        <input type="file" class="form-control" id="Gambar" name="Gambar">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection
