document.addEventListener('DOMContentLoaded', () => {
    const tableBodyTrash = document.getElementById('tableBodyTrash');

    if (tableBodyTrash) {
        tableBodyTrash.addEventListener('click', async (event) => {
            const btnRestore = event.target.closest('.btn-restore');
            const btnForceDelete = event.target.closest('.btn-force-delete');

            // Ambil token CSRF
            const tokenElement = document.querySelector('meta[name="csrf-token"]');
            if (!tokenElement) return;
            const csrfToken = tokenElement.getAttribute('content');

            // A. LOGIKA RESTORE (PULIHKAN DATA)
            if (btnRestore) {
                const id = btnRestore.dataset.id;
                
                const result = await Swal.fire({
                    title: 'Kembalikan Pegawai?',
                    text: "Data akan aktif kembali di tabel utama.",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#22c55e',
                    confirmButtonText: 'Ya, Pulihkan!'
                });

                if (result.isConfirmed) {
                    try {
                        const response = await fetch(`/pegawai/${id}/restore`, {
                            method: 'POST',
                            headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }
                        });
                        const data = await response.json();

                        if (data.status === 'success') {
                            const baris = btnRestore.closest('tr');
                            baris.classList.add('opacity-0', 'transition', 'duration-500');
                            setTimeout(() => baris.remove(), 500);
                            Swal.fire({ title: 'Berhasil!', text: data.pesan, icon: 'success', timer: 2000, showConfirmButton: false });
                        }
                    } catch (error) {
                        Swal.fire('Error', 'Gagal memulihkan data', 'error');
                    }
                }
            }

            // B. LOGIKA HAPUS PERMANEN
            if (btnForceDelete) {
                const id = btnForceDelete.dataset.id;
                
                const result = await Swal.fire({
                    title: 'Musnahkan Selamanya?',
                    text: "Data dan foto akan terhapus dari server dan tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    confirmButtonText: 'Ya, Musnahkan!'
                });

                if (result.isConfirmed) {
                    try {
                        const response = await fetch(`/pegawai/${id}/force-delete`, {
                            method: 'DELETE',
                            headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }
                        });
                        const data = await response.json();

                        if (data.status === 'success') {
                            const baris = btnForceDelete.closest('tr');
                            baris.classList.add('opacity-0', 'transition', 'duration-500');
                            setTimeout(() => baris.remove(), 500);
                            Swal.fire({ title: 'Musnah!', text: data.pesan, icon: 'success', timer: 2000, showConfirmButton: false });
                        }
                    } catch (error) {
                        Swal.fire('Error', 'Gagal memusnahkan data', 'error');
                    }
                }
            }
        });
    }
})