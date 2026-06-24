$(function() {
    $('.tombolTambahData').on('click', function() {
        $('#judulModal').html('Tambah Data Barang');  
        $('.modal-footer button[type=submit]').html('Tambah Data');
        $('#formModal form').attr('action', 'http://localhost/inventaris/public/barang/tambah');
        
        $('#id').val('');
        $('#nama_barang').val('');
        $('#kategori').val('');
        $('#stok').val('');
    
    });

    $('.tampilModalUbah').on('click', function() {
        $('#judulModal').html('Ubah Data Barang');
        $('.modal-footer button[type=submit]').html('Ubah Data');
        $('#formModal form').attr('action', 'http://localhost/inventaris/public/barang/ubah');

        const id = $(this).data('id');
        $.ajax({
            url: 'http://localhost/inventaris/public/barang/getUbah',
            data: {id : id},
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#nama_barang').val(data.nama_barang);
                $('#kategori').val(data.kategori);
                $('#stok').val(data.stok);
                $('#id').val(data.id);
            }
        });
    });
});
