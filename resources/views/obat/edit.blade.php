<div class="card shadow mb-4">

    <div class="card-header bg-primary text-white">

        <h6>Edit Obat</h6>

    </div>

    <div class="card-body">

        <form action="{{ route('obat.update', $obat['id']) }}" method="POST">

            @csrf

            @method('PUT')



            <div class="mb-3">

                <label for="nama_obat" class="form-label">Nama Obat</label>
                <input type="text" name="nama_obat" class="form-control" value="{{ old('nama_obat', $obat['nama_obat']) }}" required>

            </div>

            <div class="mb-3">

                <label for="kategori" class="form-label">Kategori</label>

                <input type="text" name="kategori" class="form-control" value="{{ old('kategori', $obat['kategori']) }}" required>

            </div>

            <div class="mb-3">

                <label for="stok" class="form-label">Stok</label>

                <input type="number" name="stok" class="form-control" value="{{ old('stok', $obat['stok']) }}" required>

            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" name="harga" class="form-control" value="{{ old('harga', $obat['harga']) }}" required>
            </div>



            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>

            <a href="{{ route('obat.index') }}" class="btn btn-secondary">Batal</a>

        </form>

    </div>

</div>
