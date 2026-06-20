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

</div>