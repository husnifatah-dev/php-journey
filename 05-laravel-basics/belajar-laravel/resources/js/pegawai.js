document.addEventListener('DOMContentLoaded', () => {
    const tombolHapus = document.querySelectorAll('.btn-hapus');

    if (tombolHapus.length === 0) return;

    tombolHapus.forEach(button => {
        button.addEventListener('click', async () => {
            const id = button.dataset.id;
            if (!confirm('Yakin ingin menghapus data ini?')) {
                return;
            }

            const token = document 
                .querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            try {
                const response = await fetch(`/pegawai/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) {
                    throw new Error('Request gagal');
                }

                const data = await response.json();
                if (data.status === 'success') {
                    const baris = button.closest('tr');

                    baris.classList.add (
                        'opacity-0',
                        'transition',
                        'suration-500'
                    );

                    setTimeout(() => {
                        baris.remove();
                    }, 500);
                    alert(data.pesan);
                }
            } catch (error) {
                console.error(error);
                alert('Terjadi Kesalahan.');
            }
        });
    });
});







// function hapusPegawai(id, elemenTombol) {
//             if (!confirm('Yakin mau menghapus pegawai data pegawai ini?')) return;

//             const token = document.querySelector('input[name="_token"]').value;

//             fetch(`/pegawai/${id}`, {
//                 method: 'DELETE',
//                 headers: {
//                     'X-CSRF-TOKEN': token,
//                     'Accept': 'application/json',
//                     'Content-Type': 'application/json'
//                 }
//             })
//             .then(response => response.json())
//             .then(data => {
//                 if (data.status === 'success') {
//                     const barisTabel = elemenTombol.closest('tr');

//                     barisTabel.classList.add('opacity-0', 'transition', 'duration-500');
//                     setTimeout(() => {
//                         barisTabel.remove();
//                     }, 500);
//                 }
//             })
//             .catch(error => {
//                 console.error('Error:', error);
//                 alert('Waduh, ada sistem yang error pas ngehapus data bos.')
//             });
//         }