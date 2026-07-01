<div class="container mt-4">
    <div class="row">
        <div class="col-lg-6">
            <?php Flasher::flash(); ?>
        </div>
    </div>

    <form action="<?= BASEURL; ?>/transaksi/simpanKeluar" method="POST">
        
        <label for="barang_id">Pilih Barang:</label>
        <select name="barang_id" id="barang_id" required>
            <option value="">-- Pilih Barang --</option>
            
            <?php foreach($data['brg'] as $brg) : ?>
                <option value="<?= $brg['id']; ?>">
                    <?= $brg['nama_barang']; ?>
                </option>
            <?php endforeach; ?>
            
        </select>

        <label for="jumlah">Jumlah Keluar:</label>
        <input type="number" name="jumlah" id="jumlah" min="1" required>

        <label for="tanggal">Tanggal Keluar:</label>
        <input type="date" name="tanggal" id="tanggal" required>

        <button type="submit">Simpan Transaksi</button>
        
    </form>
    
</div>