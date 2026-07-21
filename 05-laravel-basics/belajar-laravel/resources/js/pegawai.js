document.addEventListener('DOMContentLoaded', () => {

    const searchInput = document.getElementById('searchInput');
    const tableBody = document.getElementById('tableBody');
    let debounceTimer;

    // Pastikan elemen tableBody ada sebelum menjalankan script
    if (!tableBody) return;

    // FITUR 1: DELETE PEGAWAI (Event Delegation)
    tableBody.addEventListener('click', async (event) => {
        const button = event.target.closest('.btn-hapus');
        
        if (!button) return;

        const id = button.dataset.id;
        if (!confirm('Yakin ingin menghapus data ini?')) return;

        // Cek keberadaan token CSRF
        const tokenElement = document.querySelector('meta[name="csrf-token"]');
        if (!tokenElement) {
            alert('Error: Tag Meta CSRF-Token tidak ditemukan.');
            return;
        }
        const token = tokenElement.getAttribute('content');

        try {
            const response = await fetch(`/pegawai/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json' // Penting untuk request Fetch
                }
            });

            if (!response.ok) {
                throw new Error('Request gagal dengan status: ' + response.status);
            }

            const data = await response.json();

            if (data.status === 'success') {
                const baris = button.closest('tr');
                
                // Animasi fade-out sebelum dihapus dari DOM
                baris.classList.add('opacity-0', 'transition', 'duration-500');
                setTimeout(() => {
                    baris.remove();
                }, 500);

                // Opsional: ganti alert dengan toast notification jika ada
                // alert(data.pesan);
            } else {
                alert('Gagal menghapus: ' + (data.pesan || 'Terjadi kesalahan internal.'));
            }

        } catch (error) {
            console.error('Error saat hapus data:', error);
            alert('Waduh, ada sistem yang error pas ngehapus data.');
        }
    });

    // FITUR 2: LIVE SEARCH
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(debounceTimer);
            const keyword = this.value;

            debounceTimer = setTimeout(async () => {
                try {
                    const response = await fetch(`/pegawai?cari=${keyword}`, {
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    if (!response.ok) throw new Error('Network response error');

                    const data = await response.json();
                    tableBody.innerHTML = ''; // Kosongkan tabel saat ini

                    if (data.pegawais.length === 0) {
                        tableBody.innerHTML = `<tr><td colspan="7" class="px-6 py-4 text-center text-gray-500 italic">Data tidak ditemukan</td></tr>`;
                        return;
                    }

                    // Render ulang baris tabel
                    data.pegawais.forEach(pegawai => {
                        const departemen = pegawai.departemen ? pegawai.departemen.nama_departemen : 'Belum ada';
                        
                        const foto = pegawai.foto 
                            ? `<img src="/storage/${pegawai.foto}" alt="Foto" class="h-12 w-12 object-cover rounded shadow-sm">` 
                            : `<span class="text-sm text-gray-400 italic">Tidak ada</span>`;
                            
                        const badgeShift = pegawai.shift === 'Pagi' 
                            ? `<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-teal-100 text-teal-800">Pagi</span>` 
                            : pegawai.shift === 'Siang' 
                            ? `<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Siang</span>` 
                            : `<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">Malam</span>`;

                        const tr = `
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${pegawai.id}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">${pegawai.nama}</td>
                                <td class="px-6 py-4 whitespace-nowrap">${foto}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">${departemen}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">${pegawai.posisi}</td>
                                <td class="px-6 py-4 whitespace-nowrap">${badgeShift}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex space-x-2">
                                    <a href="/pegawai/${pegawai.id}/edit" class="bg-amber-500 hover:bg-amber-600 text-white py-1 px-3 rounded transition duration-200">Edit</a>
                                    <button class="btn-hapus bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded transition duration-200" data-id="${pegawai.id}">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                        `;
                        tableBody.insertAdjacentHTML('beforeend', tr);
                    });
                } catch (error) {
                    console.error('Error saat fetch live search:', error);
                }
            }, 500); // Debounce 500ms
        });
    }
});