<!-- page Heading -->
<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-tasks mr-2"></i> {{ $title }}
</h1>

<div class="card shadow mb-4">
    <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
        <!-- Tombol Tambah -->
        <a href="{{ route('obat.create') }}" class="btn btn-sm btn-light text-primary font-weight-bold">
            <i class="fas fa-plus mr-1"></i> Tambah Data
        </a>

        <!-- Tombol Export -->
        <div>
            <a href="" class="btn btn-sm btn-light text-success font-weight-bold mr-2">
                <i class="fas fa-file-excel mr-1"></i> Excel
            </a>
            <a href="" class="btn btn-sm btn-light text-danger font-weight-bold">
                <i class="fas fa-file-pdf mr-1"></i> PDF
            </a>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped table-sm" id="dataTable" width="100%">
                <thead class="bg-primary text-white text-center">
                    <tr>
                        <th>ID Obat</th>
                        <th>Nama Obat</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach($obats as $item)
                    <tr>
                        <td>{{ $item['id'] }}</td>
                        <td>{{ $item['nama_obat'] }}</td>
                        <td>{{ $item['kategori'] }}</td>
                        <td>{{ $item['stok'] }}</td>
                        <td>{{ $item['harga'] }}</td>
                        <td>
                            <form action="{{ route('obat.edit', $item['id']) }}" method="GET" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </button>
                            </form>
                            <form action="{{ route('obat.destroy', $item['id']) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus pasien ini?')">
                                    <i class="fas fa-trash mr-1"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
