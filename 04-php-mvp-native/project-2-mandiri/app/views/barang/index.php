<div class="container mt-4">
    <h3>Halaman Barang</h3>
    <hr>
    <ul>
        <?php foreach($data['brg'] as $brg) : ?>
            <li>
                <strong><?= $brg['nama_barang']; ?></strong>
                (Kategori: <?= $brg['kategori']; ?>) - Stok: <?= $brg['stok']; ?>
            </li>
        <?php endforeach; ?>
    </ul>
    <div class="row mb-3">
    <div class="col-lg-6">
        <button type="button" class="btn btn-primary tombolTambahData" data-bs-toggle="modal" data-bs-target="#formModal">
            Tambah Data Barang
        </button>
        </div>
    </div>
</div>

<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="judulModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="judulModal">Tambah Barang</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form action="<?= BASEURL; ?>/barang/tambah" method="post">
        <input type="hidden" name="id" id="id">
          <div class="modal-body">
                <div class="form-group">
                    <label for="nama_barang" class="form-label">Nama Barang</label>
                    <input type="text" class="form-control" id="nama_barang" name="nama_barang">
                </div>

                <div class="form-group">
                    <label for="kategori" class="form-label">Kategori</label>
                    <input type="text" class="form-control" id="kategori" name="kategori">
                </div>

                <div class="form-group">
                    <label for="stok" class="form-label">Stok</label>
                    <input type="number" class="form-control" id="stok" name="stok">
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Tambah Data</button>
          </div>
      </form> </div>
  </div>
</div>