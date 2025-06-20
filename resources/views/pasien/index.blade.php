<!-- page Heading -->
<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-tasks mr-2"></i> {{ $title }}
</h1>

<div class="card shadow mb-4">
    <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
        <!-- Tombol Tambah -->
        <a href="{{ route('pasien.create') }}" class="btn btn-sm btn-light text-primary font-weight-bold">
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
                        <th>ID Pasien</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Tgl Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach($pasiens as $item)
                    <tr>
                        <td>{{ $item['id'] }}</td>
                        <td>{{ $item['nama'] }}</td>
                        <td>{{ $item['alamat'] }}</td>
                        <td>{{ $item['tanggal_lahir'] }}</td>
                        <td>{{$item['jenis_kelamin']}}</td>
                        <td  class="text-center">
                        <span class="badge badge-success badge-pill">
                        {{$item['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan'}}
                        </span></td>
                        <td>
                            <form action="{{ route('pasien.edit', $item['id']) }}" method="GET" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </button>
                            </form>
                            <form action="{{ route('pasien.destroy', $item['id']) }}" method="POST" class="d-inline">
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
