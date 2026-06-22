<div class="container mt-5">
    <div class="card" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title"><?= $data['brg']['nama_barang']; ?></h5>
        <h6 class="card-subtitle mb-2 text-body-secondary"><?=  $data['brg']['kategori']; ?></h6>
        <p class="card-text"><?= $data['brg']['stok']; ?></p>
        <a href="<?= BASEURL; ?>/barang" class="card-link">Kembali</a>
    </div>
    </div>
</div>