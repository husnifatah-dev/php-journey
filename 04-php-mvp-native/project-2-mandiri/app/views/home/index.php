<div class="container mt-4">
    <h3>Daftar Inventaris Gudang</h3>
    <?php  var_dump($data['barang']);   ?>
    <hr>
    <ul>
        <?php foreach($data['barang'] as $brg) : ?>
            <li>
                <strong><?= $brg['nama_barang']; ?></strong>
                (Kategori: <?= $brg['kategori']; ?>) - Stok: <?= $brg['stok']; ?>
            </li>
        <?php endforeach; ?>
    </ul>

</div>