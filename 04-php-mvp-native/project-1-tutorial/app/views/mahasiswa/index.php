<div class="container mt-3">
    <div class="row">
        <div class="col-lg-6">
            <?php Flasher::flash(); ?> 
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-lg-6">
            <button type="button" class="btn btn-primary tombolTambahData" data-bs-toggle="modal" data-bs-target="#formModal">
                Tambah Data Mahasiswa
            </button>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <form action="<?= BASEURL; ?>/mahasiswa/cari" method="post">
                <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="cari mahasiswa..." aria-describedby="button-addon2" name="keyword" id="keyword" autocomplete="off">
                <button class="btn btn-primary" type="sumbit" id="tombolCari">Cari</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <h3>Daftar Mahasiswa</h3>
            <ul class="list-group">
                <?php foreach($data['mhs'] as $mhs) : ?>
                    <li class="list-group-item ">
                        <?= $mhs['nama'] ?>
                        <a href="<?= BASEURL; ?>/mahasiswa/hapus/<?= $mhs['id']; ?>" class="badge rounded-pill text-bg-danger text-decoration-none fw-bold float-end ms-1" onclick="return confirm('Apakah anda yakin mau menghapus?');">hapus</a>
                        <a href="<?= BASEURL; ?>/mahasiswa/ubah/<?= $mhs['id']; ?>" class="badge rounded-pill text-bg-success text-decoration-none fw-bold float-end ms-1 tampilModalUbah" data-bs-toggle="modal" data-bs-target="#formModal" data-id="<?= $mhs['id']; ?>">ubah</a>
                        <a href="<?= BASEURL; ?>/mahasiswa/detail/<?= $mhs['id']; ?>" class="badge rounded-pill text-bg-primary text-decoration-none fw-bold float-end ms-1">detail</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>


</div>

<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="judulModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="judulModal">Tambah Data Mahasiswa</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form action="<?= BASEURL; ?>/mahasiswa/tambah" method="post">
        <input type="hidden" name="id" id="id">
          <div class="modal-body">
                <div class="form-group">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama">
                </div>

                <div class="form-group">
                    <label for="nim" class="form-label">NIM</label>
                    <input type="number" class="form-control" id="nim" name="nim">
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>

                <div class="form-group">
                    <label for="prodi">Prodi</label>
                    <select class="form-control" name="prodi" id="prodi">
                        <option value="Sistem Informasi">Sistem Informasi</option>
                        <option value="Teknik Informatika">Teknik Informatika</option>
                        <option value="Sains Data">Sains Data</option>
                        <option value="Teknologi Pangan">Teknologi Pangan</option>
                        <option value="Big Data">Big Data</option>
                        <option value="Cyber Security">Cyber Security</option>
                    </select>
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Tambah Data</button>
          </div>
      </form> </div>
  </div>
</div>