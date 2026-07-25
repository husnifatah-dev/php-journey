document.addEventListener('DOMContentLoaded', () => {
    const formEdit = document.getElementById('formEdit');

    // ==========================================
    // FITUR 5: SUBMIT FORM EDIT (AJAX + GAMBAR)
    // ==========================================

    if (formEdit) {
        formEdit.addEventListener('submit', async function(event) {
            event.preventDefault();

            const btnSubmit = this.querySelector('button[type="submit"]');
            const teksAsli = btnSubmit.innerHTML;
            btnSubmit.innerHTML = 'Memperbarui...';
            btnSubmit.disabled = true;

            const id = this.dataset.id;
            const formData = new FormData(this);

            try {
                const response = await fetch(`/pegawai/${id}`, {
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
                        showConfirmButton: false,
                    }).then(() => {
                        window.location.href = '/pegawai';
                    });
                }
            } catch (error) {
                console.error('Error Update:', error);
                Swal.fire('Waduh!', 'Gagal memperbarui data ke server.', 'error');
            } finally {
                btnSubmit.innerHTML = teksAsli;
                btnSubmit.disabled = false;
            }
        });
    }
})