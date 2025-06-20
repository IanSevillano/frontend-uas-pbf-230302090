<div class="card shadow mb-4">

    <div class="card-header bg-primary text-white">

        <h6>Edit Pasien</h6>

    </div>

    <div class="card-body">

        <form action="{{ route('pasien.update', $pasien['id']) }}" method="POST">

            @csrf

            @method('PUT')



            <div class="mb-3">

                <label for="nama" class="form-label">Nama Pasien</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama', $pasien['nama']) }}" required>

            </div>

            <div class="mb-3">

                <label for="alamat" class="form-label">Alamat</label>

                <input type="text" name="alamat" class="form-control" value="{{ old('alamat', $pasien['alamat']) }}" required>

            </div>

            <div class="mb-3">

                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>

                <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $pasien['tanggal_lahir']) }}" required>

            </div>
            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control" required>
                    <option value="L" {{ $pasien['jenis_kelamin'] == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ $pasien['jenis_kelamin'] == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>



            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>

            <a href="{{ route('pasien.index') }}" class="btn btn-secondary">Batal</a>

        </form>

    </div>

</div>
