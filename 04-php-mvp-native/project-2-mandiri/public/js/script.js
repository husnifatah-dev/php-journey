$(function() {
    $('.tombolTambahData').on('click', function() {
        $('formModal').html('Tambah Data Mahasiswa');  
        $('.modal-footer button[type=submit]').html('Tambah Data');
        $('#formModal from').attr('action', 'http://localhost/project1/public/mahasiswa/tambah');
    });

    $('.tampilModalUbah').on('click', function() {
        $('#judulModal').html('Ubah Data Mahasiswa');
        $('.modal-footer button[type=submit]').html('Ubah Data');
        $('#formModal form').attr('action', 'http://localhost/project1/public/mahasiswa/ubah');

        const id = $(this).data('id');
        $.ajax({
            url: 'http://localhost/project1/public/mahasiswa/getubah',
            data: {id : id},
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#nama').val(data.nama);
                $('#nim').val(data.nim);
                $('#email').val(data.email);
                $('#prodi').val(data.prodi);
                $('#id').val(data.id);
            }
        });
    });
});
