document.addEventListener('DOMContentLoaded', () => {

    const searchInput = document.getElementById('searchInput');
    const tableBody = document.getElementById('tableBody');
    const paginationContainer = document.getElementById('paginationContainer');
    let debounceTimer;

    if (!tableBody) return;

    // ==========================================
    // FUNGSI BANTUAN: Untuk merender baris tabel
    // ==========================================
    const renderTableRows = (pegawais) => {
        tableBody.innerHTML = ''; 

        if (pegawais.length === 0) {
            tableBody.innerHTML = `<tr><td colspan="7" class="px-6 py-4 text-center text-gray-500 italic">Data tidak ditemukan</td></tr>`;
            return;
        }

        pegawais.forEach(pegawai => {
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
    };

    // ==========================================
    // FITUR 1: DELETE PEGAWAI
    // ==========================================
    tableBody.addEventListener('click', async (event) => {
        const button = event.target.closest('.btn-hapus');
        if (!button) return;

        const id = button.dataset.id;
        const result = await Swal.fire ({
            title: 'Yakin mau memcat pegawai ini?',
            text: "Data yang dihapus tidak bisa dikembalikan lagi!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#9ca3af',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        });

        if (!result.isConfirmed) return;

        const tokenElement = document.querySelector('meta[name="csrf-token"]');
        if (!tokenElement) return alert('Error: Tag Meta CSRF-Token tidak ditemukan.');
        
        try {
            const response = await fetch(`/pegawai/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': tokenElement.getAttribute('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json' 
                }
            });

            if (!response.ok) throw new Error('Request gagal dengan status: ' + response.status);
            const data = await response.json();

            if (data.status === 'success') {
                const baris = button.closest('tr');
                baris.classList.add('opacity-0', 'transition', 'duration-500');
                setTimeout(() => baris.remove(), 500);

                Swal.fire({
                    title: 'Berhasil',
                    text: 'Pegawai telah resmi diberhentikan.',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false,
                });
            } else {
                Swal.fire('Gagal', data.pesan || 'Terjadi kesalahan internal.', 'error');
            }
        } catch (error) {
            console.error('Error saat hapus data:', error);
            Swal.fire('Oops!', 'Sistem ada yang error pas ngehapus data.', 'error');
        }
    });

    // ==========================================
    // FITUR 2: LIVE SEARCH
    // ==========================================
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(debounceTimer);
            const keyword = this.value;

            debounceTimer = setTimeout(async () => {
                try {
                    tableBody.innerHTML = `<tr><td colspan="7" class="px-6 py-4 text-center text-gray-500 font-medium animate-pulse">Membuat data...</td></tr>`;

                    const response = await fetch(`/pegawai?cari=${keyword}`, {
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });
                    if (!response.ok) throw new Error('Network response error');

                    const data = await response.json();
                    
                    renderTableRows(data.pegawais); 

                    if (paginationContainer) {
                        paginationContainer.innerHTML = data.pagination;
                    }
                } catch (error) {
                    console.error('Error saat fetch live search:', error);
                }
            }, 500); 
        });
    }

    // ==========================================
    // FITUR 3: AJAX PAGINATION (Tanpa Refresh)
    // ==========================================
    if (paginationContainer) {
        paginationContainer.addEventListener('click', async (event) =>  {
            const link = event.target.closest('a');
            if (!link) return;

            event.preventDefault();
            const url = link.href;

            try {
                tableBody.innerHTML = `<tr><td colspan="7" class="px-6 py-4 text-center text-gray-500 font-medium animate-pulse">Membuat halaman...</td><tr>`;

                const response = await fetch(url, {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                if (!response.ok) throw new Error('Network response error');

                const data = await response.json();

                renderTableRows(data.pegawais);

                paginationContainer.innerHTML = data.pagination;

                window.history.pushState(null, '', url);
            } catch (error) {
                console.error('Error saat fetch pagination:', error);
            }
        });
    }

// ==========================================
    // FITUR 4: SUBMIT FORM TAMBAH (AJAX + GAMBAR)
    // ==========================================
    const formTambah = document.getElementById('formTambah');
    
    if (formTambah) {
        formTambah.addEventListener('submit', async function(event) {
            event.preventDefault(); // Cegah reload halaman

            // Ambil tombol submit untuk dibikin efek loading
            const btnSubmit = this.querySelector('button[type="submit"]');
            const teksAsli = btnSubmit.innerHTML;
            btnSubmit.innerHTML = 'Menyimpan...';
            btnSubmit.disabled = true;

            // FormData otomatis membungkus semua inputan teks & file gambar sekaligus!
            const formData = new FormData(this);

            try {
                const response = await fetch('/pegawai', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                        // INGAT: JANGAN ADA 'Content-Type' DI SINI KARENA KITA PAKAI FORMDATA
                    },
                    body: formData
                });

                const data = await response.json();

                // Deteksi kalau Laravel menolak karena validasi error (HTTP Status 422)
                if (response.status === 422) {
                    let errorList = '';
                    // Looping pesan error dari Laravel untuk digabung
                    for (const field in data.errors) {
                        errorList += `${data.errors[field][0]}\n`;
                    }
                    Swal.fire('Validasi Gagal!', errorList, 'warning');
                    return;
                }

                if (!response.ok) throw new Error('Terjadi kesalahan server');

                // Kalau sukses, munculkan Swal lalu pindah ke halaman index
                if (data.status === 'success') {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: data.pesan,
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = '/pegawai'; // Arahkan kembali ke daftar pegawai
                    });
                }
            } catch (error) {
                console.error('Error Submit:', error);
                Swal.fire('Waduh!', 'Gagal mengirim data ke server.', 'error');
            } finally {
                // Kembalikan tombol seperti semula
                btnSubmit.innerHTML = teksAsli;
                btnSubmit.disabled = false;
            }
        });
    }


});