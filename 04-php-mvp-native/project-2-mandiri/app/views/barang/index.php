<div class="container mt-4">
    <div class="row">
        <div class="col-lg-6">
            <?php Flasher::flash(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <h3>Daftar Barang</h3>
            <ul class="list-group">
                <?php foreach($data['brg'] as $brg) : ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span><?= $brg['nama_barang'] ?></span>
                        
                        <div>
                            <a href="#" class="badge rounded-pill text-bg-success text-decoration-none fw-bold tampilModalUbah" data-bs-toggle="modal" data-bs-target="#formModal" data-id="<?= $brg['id'] ?>">ubah</a>
                            
                            <form action="<?= BASEURL; ?>/barang/hapus/<?= $brg['id'] ?>" method="post" class="d-inline m-0">
                                <button type="submit" class="badge rounded-pill text-bg-danger border-0 ms-1" onclick="return confirm('Apakah anda benar ingin menghapus barang ini?');">hapus</button>
                            </form>
                            
                            <a href="<?= BASEURL; ?>/barang/detail/<?= $brg['id']; ?>" class="badge rounded-pill text-bg-primary text-decoration-none fw-bold ms-1">detail</a>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    
    <div class="row mb-3">
        <div class="col-lg-6 mt-3">
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
      
      <form action="<?= BASEURL; ?>/barang/tambah" method="post" autocomplete="off">
        <input type="hidden" name="id" id="id">
        
        <div class="modal-body">
            <div class="form-group mb-3">
                <label for="nama_barang" class="form-label">Nama Barang</label>
                <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
            </div>

            <div class="form-group mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <input type="text" class="form-control" id="kategori" name="kategori" required>
            </div>

            <div class="form-group mb-3">
                <label for="stok" class="form-label">Stok</label>
                <input type="number" class="form-control" id="stok" name="stok" required>
            </div>
        </div>
        
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Tambah Data</button>
        </div>
      </form> 
    </div>
  </div>
</div>