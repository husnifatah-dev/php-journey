document.addEventListener('DOMContentLoaded', () => {
    const formTambah = document.getElementById('formTambah');

    // ==========================================
    // FITUR 4: SUBMIT FORM TAMBAH (AJAX + GAMBAR)
    // ==========================================

    if (formTambah) 
    {
        formTambah.addEventListener('submit', async function(event) {
            event.preventDefault();

            const btnSubmit = this.querySelector('button[type="submit"]');
            const teksAsli = btnSubmit.innerHTML;
            btnSubmit.innerHTML ='Menyimpan...';
            btnSubmit.disabled = true;

            const formData = new FormData(this);

            try {
                const response = await fetch('/pegawai', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                const data = await response.json();

                if (response.status === 422) {
                    let errorList = '';

                    for (const field in data.errors) {
                        errorList += `${data.errors[field][0]}\n`;
                    }
                    Swal.fire('Validasi Gagal!', errorList, 'warning');
                    return;
                }

                if (!response.ok) throw new Error('Terjadi kesalahan server');

                if (data.status === 'success') {
                    Swal.fire({
                        title: 'Berhasil',
                        text: data.pesan,
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = '/pegawai';
                    });
                }
            } catch (error) {
                console.error('Error Submit:', error);
                Swal.fire('Waduh!', 'Gagal mengirim data ke server.', 'error');
            } finally {
                btnSubmit.innerHTML = teksAsli;
                btnSubmit.disabled = false;
            }
        });
    }
})