document.addEventListener('DOMContentLoaded', () => {

    const searchInput = document.getElementById('searchInput');
    const filterDepartemen = document.getElementById('filterDepartemen');
    const filterShift = document.getElementById('filterShift');
    const tableBody = document.getElementById('tableBody');
    const paginationContainer = document.getElementById('paginationContainer');
    const modalDetail = document.getElementById('modalDetail');
    const btnCloseModal = document.getElementById('btnCloseModal');
    const modalInner = modalDetail ? modalDetail.querySelector('.bg-white') : null;
    let debounceTimer;

    if (!tableBody) return;

    // ==========================================
    // FUNGSI BANTUAN: Untuk merender baris tabel
    // ==========================================
    const renderTableRows = (pegawais, isAdmin) => {
        tableBody.innerHTML = ''; 

        if (pegawais.length === 0) {
            tableBody.innerHTML = `<tr><td colspan="8" class="px-6 py-4 text-center text-gray-500 italic">Data tidak ditemukan</td></tr>`;
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
            
            let pelatihanHtml = '<div class="flex flex-wrap gap-1">';
            if (pegawai.pelatihans && pegawai.pelatihans.length > 0) {
                pelatihanHtml += pegawai.pelatihans.map(p => 
                    `<span class="inline-block bg-indigo-100 text-indigo-800 text-[10px] font-bold px-2 py-1 rounded-md border border-indigo-200">${p.nama_pelatihan}</span>`
                ).join('');
            } else {
                pelatihanHtml += `<span class="text-gray-400 italic text-xs">Belum ada</span>`;
            }
            pelatihanHtml += '</div>';
            
            let aksiHtml = `
                <button class="btn-detail bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded transition duration-200" data-id="${pegawai.id}">
                    Detail
                </button>

            `;
            if (isAdmin) {
                aksiHtml = `
                    <a href="/pegawai/${pegawai.id}/edit" class="bg-amber-500 hover:bg-amber-600 text-white py-1 px-3 rounded transition duration-200">Edit</a>
                <button class="btn-hapus bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded transition duration-200" data-id="${pegawai.id}">Hapus</button>
                `;
            } else {
                aksiHtml = `<span class="text-gray-400 italic">Tidak ada akses</span>`;
            }

            const tr = `
                <tr class="hover:bg-gray-50 transition duration-150">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${pegawai.id}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">${pegawai.nama}</td>
                    <td class="px-6 py-4 whitespace-nowrap">${foto}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">${departemen}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">${pegawai.posisi}</td>
                    <td class="px-6 py-4 whitespace-nowrap">${badgeShift}</td>
                    <td class="px-6 py-4 whitespace-normal">${pelatihanHtml}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex space-x-2">
                        ${aksiHtml}
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
            title: 'Yakin mau memecat pegawai ini?',
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
    const fetchData = async () => {
        const keyword = searchInput ? searchInput.value : '';
        const deptId = filterDepartemen ? filterDepartemen.value : '';
        const shift = filterShift ? filterShift.value : '';

        const url = `/pegawai?cari=${keyword}&departemen_id=${deptId}&shift=${shift}`;

        try {
            const response = await fetch(url, {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With' : 'XMLHttpRequest'
                }
            });
            if (!response.ok) throw new Error('Network response error');

            const data = await response.json();
            renderTableRows(data.pegawais, data.isAdmin);

            if (paginationContainer) {
                paginationContainer.innerHTML = data.pagination;
            }
        } catch (error) {
            console.log('Error saat fetch data:', error);
        }
    };
    if (searchInput || filterDepartemen || filterShift) {
        if (searchInput) {
            searchInput.addEventListener('input', () => {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(fetchData, 500);
            });
        }
        if (filterDepartemen) {
            filterDepartemen.addEventListener('change', fetchData);
        }
    
        if (filterShift) {
            filterShift.addEventListener('change', fetchData);
        }

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
                tableBody.innerHTML = `<tr><td colspan="8" class="px-6 py-4 text-center text-gray-500 font-medium animate-pulse">Membuat halaman...</td><tr>`;

                const response = await fetch(url, {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                if (!response.ok) throw new Error('Network response error');

                const data = await response.json();

                renderTableRows(data.pegawais, data.isAdmin);

                paginationContainer.innerHTML = data.pagination;

                window.history.pushState(null, '', url);
            } catch (error) {
                console.error('Error saat fetch pagination:', error);
            }
        });
    }

    // ==========================================
    // FITUR: MODAL DETAIL PROFIL PEGAWAI
    // ==========================================
    const closeModal = () => {
        modalDetail.classList.add('opacity-0');
        modalInner.classList.replace('scale-100', 'scale-95');
        setTimeout(() => modalDetail.classList.add('hidden'), 300);
    };

    if (modalDetail && tableBody) {
        btnCloseModal.addEventListener('click', closeModal);

        modalDetail.addEventListener('click', (e) => {
            if (e.target === modalDetail) closeModal();
        });

        tableBody.addEventListener('click', async (event) => {
            const btnDetail = event.target.closest('.btn-detail');

            if (btnDetail) {
                const id = btnDetail.dataset.id;

                document.getElementById('modalNama').innerText = 'Memuat data...';
                document.getElementById('modalPosisi').innerText = '....';

                modalDetail.classList.remove('hidden');
                setTimeout(() => {
                    modalDetail.classList.remove('opacity-0');
                    modalInner.classList.replace('scale-95', 'scale-100');
                }, 10);

                try {
                    const response = await fetch(`/pegawai/${id}/detail`, {
                        headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
                    });

                    if (!response.ok) throw new  Error('Gagal mengambil data');
                    const result = await response.json();
                    const p = result.data;

                    console.log('HASIL RESPONSE:', result);
console.log('DATA PEGAWAI:', p);
console.log('NAMA:', p.nama);
console.log('DEPARTEMEN:', p.departemen);
console.log('PELATIHANS:', p.pelatihans);

                    document.getElementById('modalNama').innerText = p.nama;
                    document.getElementById('modalPosisi').innerText = p.posisi;
                    document.getElementById('modalDepartemen').innerText = p.departemen?.nama_departemen ?? 'Belum ada';
                    document.getElementById('modalShift').innerText = p.shift;

                    const fotoContainer = document.getElementById('modalFoto');
                    if (p.foto) {
                        fotoContainer.innerHTML = `<img src="/storage/${p.foto}" alt="Foto" class="w-full h-full object-cover">`;
                    } else {
                        fotoContainer.innerHTML = `<span class="text-gray-400 text-xs">No Pic</span>`;
                    }

                    const pelatihanContainer = document.getElementById('modalPelatihan');
                    if (p.pelatihans && p.pelatihans.length > 0 ) {
                        pelatihanContainer.innerHTML = p.pelatihans.map(pel => 
                            `<span class="inline-block bg-indigo-100 text-indigo-800 text-[10px] font-bold px-2 py-1 rounded-md border border-indigo-200">${pel.nama_pelatihan}</span>`
                        ).join('');
                    } else {
                        pelatihanContainer.innerHTML = `<span class="text-gray-400 italic text-xs">Belum ada pelatihan</span>`;
                    }
                } catch (error) {
                        console.error('Error fetching detail:', error);
                        document.getElementById('modalNama').innerText = 'Gagal memuat data';
                }
            } 
        });
    }
});