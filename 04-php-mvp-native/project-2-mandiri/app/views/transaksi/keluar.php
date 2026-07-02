<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <?php Flasher::flash(); ?>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-6">
            
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Input Barang Keluar</h5>
                </div>
                
                <div class="card-body">
                    <form action="<?= BASEURL; ?>/transaksi/simpanKeluar" method="POST">
                        
                        <div class="mb-3">
                            <label for="barang_id" class="form-label">Pilih Barang:</label>
                            <select name="barang_id" id="barang_id" class="form-select" required>
                                <option value="">-- Pilih Barang --</option>
                                <?php foreach($data['brg'] as $brg) : ?>
                                    <option value="<?= $brg['id']; ?>">
                                        <?= $brg['nama_barang']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah Keluar:</label>
                            <input type="number" name="jumlah" id="jumlah" class="form-control" min="1" required>
                        </div>
                
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal Keluar:</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                        </div>
                
                        <button type="submit" class="btn btn-primary w-100 mt-3">Simpan Transaksi</button>
                        
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>