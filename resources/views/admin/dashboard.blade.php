<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin PPLG 2</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
        }

        /* Glassmorphism Cards */
        .glass-card {
            background: linear-gradient(180deg, rgba(14, 33, 64, 0.95) 0%, rgba(7, 21, 46, 0.95) 100%);
            border: 1px solid rgba(56, 189, 248, 0.25);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .glass-card:hover {
            border-color: rgba(56, 189, 248, 0.6);
            box-shadow: 0 10px 30px -10px rgba(56, 189, 248, 0.35);
        }

        /* Scrollbar Biru Muda */
        .custom-scroll::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scroll::-webkit-scrollbar-track {
            background: rgba(8, 24, 52, 0.6);
        }
        .custom-scroll::-webkit-scrollbar-thumb {
            background: rgba(56, 189, 248, 0.4);
            border-radius: 10px;
        }
        .custom-scroll::-webkit-scrollbar-thumb:hover {
            background: rgba(56, 189, 248, 0.8);
        }

        /* =================================================== */
        /* ANIMASI GERAKAN IKON ALAT PEMBERSIH LATAR BELAKANG */
        /* =================================================== */
        @keyframes sweepMotion {
            0%, 100% { transform: rotate(-35deg) translate(0, 0); }
            50% { transform: rotate(-10deg) translate(25px, -15px); }
        }
        .anim-sweep {
            animation: sweepMotion 3.8s ease-in-out infinite;
            transform-origin: top left;
        }

        @keyframes mopBounce {
            0%, 100% { transform: translateY(0) rotate(10deg); }
            50% { transform: translateY(-28px) rotate(-8deg); }
        }
        .anim-mop {
            animation: mopBounce 4.5s ease-in-out infinite;
        }

        @keyframes sprayAction {
            0%, 100% { transform: translate(0, 0) rotate(-15deg) scale(1); }
            30% { transform: translate(15px, -10px) rotate(-5deg) scale(1.08); }
            60% { transform: translate(-10px, 8px) rotate(-22deg) scale(0.95); }
        }
        .anim-spray {
            animation: sprayAction 4.2s ease-in-out infinite;
        }

        @keyframes dusterWiggle {
            0%, 100% { transform: rotate(40deg); }
            50% { transform: rotate(70deg) translate(15px, -10px); }
        }
        .anim-duster {
            animation: dusterWiggle 3.2s ease-in-out infinite;
            transform-origin: bottom left;
        }

        @keyframes trashRock {
            0%, 100% { transform: rotate(-8deg) translateY(0); }
            50% { transform: rotate(12deg) translateY(-14px); }
        }
        .anim-trash {
            animation: trashRock 5s ease-in-out infinite;
            transform-origin: bottom center;
        }

        @keyframes rubMotion {
            0%, 100% { transform: translate(0, 0) rotate(10deg); }
            25% { transform: translate(20px, -15px) rotate(20deg); }
            75% { transform: translate(-15px, 15px) rotate(0deg); }
        }
        .anim-rub {
            animation: rubMotion 4s ease-in-out infinite;
        }

        @keyframes sparklePulse {
            0%, 100% { opacity: 0.15; transform: scale(0.85) rotate(0deg); }
            50% { opacity: 0.45; transform: scale(1.25) rotate(45deg); }
        }
        .anim-sparkle {
            animation: sparklePulse 2.8s ease-in-out infinite;
        }
    </style>
</head>
<body class="bg-[#051124] text-white min-h-screen p-6 sm:p-10 select-none relative overflow-x-hidden">

    <!-- ============================================== -->
    <!-- LATAR BELAKANG IKON PEMBERSIH BERGERAK AKTIF   -->
    <!-- ============================================== -->
    <div class="fixed inset-0 pointer-events-none z-0 overflow-hidden">
        <!-- Sapu Menyapu (Kiri Atas) -->
        <div class="absolute -top-2 left-6 text-sky-400/20 text-8xl sm:text-9xl anim-sweep">
            <i class="fa-solid fa-broom"></i>
        </div>

        <!-- Ember & Pel Membal (Kanan Atas) -->
        <div class="absolute top-10 right-8 text-sky-300/20 text-8xl sm:text-9xl anim-mop">
            <i class="fa-solid fa-bucket"></i>
        </div>

        <!-- Semprotan Pembersih Kaca (Kiri Tengah) -->
        <div class="absolute top-[40%] left-6 text-sky-400/20 text-7xl sm:text-8xl anim-spray">
            <i class="fa-solid fa-spray-can-sparkles"></i>
        </div>

        <!-- Kemoceng Mengibas (Tengah Atas Belakang Header) -->
        <div class="absolute top-16 left-[22%] text-sky-300/15 text-8xl sm:text-9xl anim-duster">
            <i class="fa-solid fa-feather-pointed"></i>
        </div>

        <!-- Tempat Sampah Bergoyang (Kanan Tengah) -->
        <div class="absolute top-[46%] right-8 text-sky-300/20 text-8xl sm:text-9xl anim-trash">
            <i class="fa-solid fa-trash-can"></i>
        </div>

        <!-- Lap / Spons Menggosok (Kiri Bawah) -->
        <div class="absolute bottom-16 left-12 text-sky-400/20 text-8xl anim-rub">
            <i class="fa-solid fa-rug"></i>
        </div>

        <!-- Sikat Pembersih (Kanan Bawah) -->
        <div class="absolute bottom-12 right-16 text-sky-300/20 text-8xl anim-sweep">
            <i class="fa-solid fa-brush"></i>
        </div>

        <!-- Sabun Cair Pompa (Tengah Bawah) -->
        <div class="absolute bottom-6 left-[48%] text-sky-400/15 text-7xl sm:text-8xl anim-mop">
            <i class="fa-solid fa-pump-soap"></i>
        </div>

        <!-- Kilauan Berkedip (Sparkles) -->
        <div class="absolute top-28 right-[28%] text-sky-300 text-5xl anim-sparkle">
            <i class="fa-solid fa-sparkles"></i>
        </div>
        <div class="absolute bottom-36 left-[26%] text-sky-400 text-4xl anim-sparkle" style="animation-delay: 1.4s;">
            <i class="fa-solid fa-sparkles"></i>
        </div>
    </div>

    <!-- ============================================== -->
    <!-- KONTEN UTAMA (DI DEPAN IKON BERGERAK)          -->
    <!-- ============================================== -->
    <div class="relative z-10 max-w-6xl mx-auto space-y-8">
        
        <!-- Notifikasi Sukses -->
        <?php if (session('success')): ?>
        <div class="fixed top-5 right-5 z-50 bg-sky-500/20 border border-sky-400 text-sky-200 px-4 py-2.5 rounded-2xl shadow-lg backdrop-blur-md text-sm flex items-center gap-2">
            <i class="fa-solid fa-circle-check text-sky-400"></i>
            <span><?= htmlspecialchars(session('success')) ?></span>
        </div>
        <?php endif; ?>

        <!-- HEADER TOP -->
        <div class="flex flex-wrap items-center justify-between gap-4 pb-6 border-b border-sky-500/20 backdrop-blur-sm">
            <div>
                <span class="text-xs font-bold tracking-widest uppercase text-sky-300 bg-sky-500/15 border border-sky-400/30 px-3.5 py-1 rounded-full">
                    Control Panel
                </span>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-white mt-2">
                    Dashboard <span class="text-sky-400">Admin PPLG 2</span>
                </h1>
                <p class="text-xs sm:text-sm text-sky-200/70 mt-1">Kelola data seluruh petugas piket, edit jadwal, dan reset mingguan.</p>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('piket.index') }}" class="px-4 py-2.5 rounded-2xl bg-sky-500/15 border border-sky-400/40 text-sky-200 hover:text-white hover:bg-sky-500/25 text-xs sm:text-sm font-semibold shadow-md transition flex items-center gap-2 cursor-pointer backdrop-blur-sm">
                    <i class="fa-solid fa-arrow-left text-sky-400"></i>
                    <span>Halaman Utama</span>
                </a>

                <form action="{{ route('piket.reset') }}" method="POST" onsubmit="return confirm('Reset status semua piket kembali ke awal untuk minggu baru?')">
                    @csrf
                    <button type="submit" class="px-4 py-2.5 rounded-2xl bg-amber-500/15 border border-amber-500/40 text-amber-300 hover:bg-amber-500/25 text-xs sm:text-sm font-semibold shadow-md transition flex items-center gap-2 cursor-pointer backdrop-blur-sm">
                        <i class="fa-solid fa-rotate-right"></i>
                        <span>Reset Mingguan</span>
                    </button>
                </form>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-2.5 rounded-2xl bg-rose-500/15 border border-rose-500/40 text-rose-300 hover:bg-rose-500/25 text-xs sm:text-sm font-semibold shadow-md transition flex items-center gap-2 cursor-pointer backdrop-blur-sm">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- STATS CARDS -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
            <div class="glass-card p-5 rounded-3xl flex items-center justify-between shadow-lg backdrop-blur-sm">
                <div>
                    <p class="text-xs font-bold text-sky-200/70">Total Petugas</p>
                    <p class="text-3xl font-black text-white mt-1"><?= $totalPetugas ?> <span class="text-sm font-semibold text-sky-300">Siswa</span></p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-sky-500/20 text-sky-300 border border-sky-400/40 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-users"></i>
                </div>
            </div>

            <div class="glass-card p-5 rounded-3xl flex items-center justify-between shadow-lg backdrop-blur-sm">
                <div>
                    <p class="text-xs font-bold text-sky-200/70">Sudah Piket</p>
                    <p class="text-3xl font-black text-sky-400 mt-1"><?= $totalSelesai ?> <span class="text-sm font-semibold text-sky-300">Siswa</span></p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-sky-400/20 text-sky-300 border border-sky-400/40 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
            </div>

            <div class="glass-card p-5 rounded-3xl flex items-center justify-between shadow-lg backdrop-blur-sm">
                <div>
                    <p class="text-xs font-bold text-sky-200/70">Petugas Hari Ini (<?= htmlspecialchars($hariIni) ?>)</p>
                    <p class="text-3xl font-black text-sky-300 mt-1"><?= count($petugasHariIni) ?> <span class="text-sm font-semibold text-sky-200">Siswa</span></p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-sky-500/20 text-sky-300 border border-sky-400/40 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-calendar-day"></i>
                </div>
            </div>
        </div>

        <!-- TABEL DATA PETUGAS (DIBATASI TINGGINYA + SCROLL) -->
        <div class="glass-card rounded-3xl overflow-hidden shadow-2xl backdrop-blur-sm">
            <!-- Header Kartu Tabel -->
            <div class="p-6 border-b border-sky-500/20 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <h2 class="text-lg font-bold text-white">Daftar Seluruh Anggota Piket</h2>
                    <span class="px-3 py-0.5 rounded-full text-xs font-bold bg-sky-500/20 text-sky-300 border border-sky-400/40">
                        <?= count($allPikets) ?> Data
                    </span>
                </div>

                <button type="button" onclick="bukaModalTambah()" class="px-5 py-2.5 rounded-xl bg-sky-400 hover:bg-sky-300 text-slate-950 text-xs font-extrabold shadow-lg shadow-sky-400/30 transition flex items-center gap-2 cursor-pointer">
                    <i class="fa-solid fa-plus"></i>
                    <span>Tambah Petugas</span>
                </button>
            </div>

            <!-- Wadah Scroll Tabel -->
            <div class="max-h-[460px] overflow-y-auto custom-scroll relative">
                <table class="w-full text-left text-xs border-collapse">
                    <!-- Sticky Header -->
                    <thead class="sticky top-0 z-10 bg-[#071630] border-b border-sky-500/25 text-sky-300 uppercase tracking-wider font-bold">
                        <tr>
                            <th class="py-3.5 px-6">Nama Siswa</th>
                            <th class="py-3.5 px-4">Hari</th>
                            <th class="py-3.5 px-4">Tugas</th>
                            <th class="py-3.5 px-4">Status</th>
                            <th class="py-3.5 px-6 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-sky-500/10 text-slate-200">
                        <?php if (count($allPikets) > 0): ?>
                            <?php foreach ($allPikets as $piket): ?>
                                <tr class="hover:bg-sky-500/10 transition">
                                    <td class="py-3 px-6">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-sky-500/20 text-sky-300 border border-sky-400/40 flex items-center justify-center text-[11px] font-black shrink-0">
                                                <?= strtoupper(substr($piket->nama, 0, 2)) ?>
                                            </div>
                                            <span class="font-semibold text-white <?= $piket->is_selesai ? 'line-through text-slate-500' : '' ?>">
                                                <?= htmlspecialchars($piket->nama) ?>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-4">
                                        <span class="px-2.5 py-1 rounded-lg text-[11px] font-bold bg-sky-500/15 text-sky-300 border border-sky-400/30">
                                            <?= htmlspecialchars($piket->hari) ?>
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 text-sky-200/80 font-medium">
                                        <?= htmlspecialchars($piket->tugas) ?>
                                    </td>
                                    <td class="py-3 px-4">
                                        <?php if ($piket->is_selesai): ?>
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-sky-400/20 text-sky-300 border border-sky-400/50">
                                                ● Selesai
                                            </span>
                                        <?php else: ?>
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-500/15 text-amber-300 border border-amber-500/30">
                                                ● Belum Selesai
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="py-3 px-6 text-right">
                                        <div class="inline-flex items-center gap-1.5">
                                            <!-- Tombol Ubah Status -->
                                            <form action="{{ route('piket.toggle', $piket->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" title="Ubah Status" class="w-7 h-7 rounded-lg bg-sky-500/15 hover:bg-sky-400 hover:text-slate-950 text-sky-300 border border-sky-400/20 flex items-center justify-center transition cursor-pointer">
                                                    <i class="fa-solid fa-arrows-rotate text-[11px]"></i>
                                                </button>
                                            </form>

                                            <!-- Tombol Edit Nama / Tugas -->
                                            <button type="button" 
                                                    onclick="bukaModalEdit('<?= $piket->id ?>', '<?= addslashes($piket->nama) ?>', '<?= $piket->hari ?>', '<?= addslashes($piket->tugas) ?>')" 
                                                    title="Edit Petugas" 
                                                    class="w-7 h-7 rounded-lg bg-amber-500/15 hover:bg-amber-400 hover:text-slate-950 text-amber-300 border border-amber-500/25 flex items-center justify-center transition cursor-pointer">
                                                <i class="fa-solid fa-pen text-[11px]"></i>
                                            </button>

                                            <!-- Tombol Hapus -->
                                            <form action="{{ route('piket.destroy', $piket->id) }}" method="POST" onsubmit="return confirm('Hapus siswa <?= addslashes($piket->nama) ?> dari daftar piket?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" title="Hapus" class="w-7 h-7 rounded-lg bg-rose-500/15 hover:bg-rose-500 hover:text-white text-rose-300 border border-rose-500/25 flex items-center justify-center transition cursor-pointer">
                                                    <i class="fa-regular fa-trash-can text-[11px]"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="py-8 text-center text-sky-200/50 italic">
                                    Belum ada data petugas piket.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- MODAL TAMBAH DATA -->
    <div id="modalTambah" class="hidden fixed inset-0 z-50 bg-black/85 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-[#0b1b38] border border-sky-400/50 rounded-3xl w-full max-w-md p-6 shadow-2xl relative">
            <div class="flex items-center justify-between pb-4 border-b border-sky-500/20">
                <h3 class="text-base font-bold text-white">Tambah Petugas Piket</h3>
                <button type="button" onclick="tutupModalTambah()" class="text-sky-300 hover:text-white p-1 cursor-pointer">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <form action="{{ route('piket.store') }}" method="POST" class="mt-4 space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-sky-200 mb-1">Nama Lengkap Siswa</label>
                    <input type="text" name="nama" required placeholder="Contoh: Siti Nur Shakila" class="w-full bg-[#051124] border border-sky-500/30 focus:border-sky-400 rounded-xl px-3.5 py-2.5 text-sm text-white focus:outline-none transition">
                </div>

                <div>
                    <label class="block text-xs font-bold text-sky-200 mb-1">Pilih Hari</label>
                    <select name="hari" required class="w-full bg-[#051124] border border-sky-500/30 focus:border-sky-400 rounded-xl px-3.5 py-2.5 text-sm text-white focus:outline-none transition">
                        <?php foreach ($daftarHari as $hari): ?>
                            <option value="<?= htmlspecialchars($hari) ?>"><?= htmlspecialchars($hari) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-sky-200 mb-1">Tugas / Area</label>
                    <input type="text" name="tugas" required placeholder="Contoh: Menyapu Lantai / Buang Sampah" class="w-full bg-[#051124] border border-sky-500/30 focus:border-sky-400 rounded-xl px-3.5 py-2.5 text-sm text-white focus:outline-none transition">
                </div>

                <div class="pt-3 flex justify-end gap-2">
                    <button type="button" onclick="tutupModalTambah()" class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-400 hover:bg-slate-800 cursor-pointer">
                        Batal
                    </button>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-sky-400 hover:bg-sky-300 text-slate-950 font-extrabold text-xs shadow-lg shadow-sky-400/30 transition cursor-pointer">
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL EDIT DATA -->
    <div id="modalEdit" class="hidden fixed inset-0 z-50 bg-black/85 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-[#0b1b38] border border-amber-500/40 rounded-3xl w-full max-w-md p-6 shadow-2xl relative">
            <div class="flex items-center justify-between pb-4 border-b border-amber-500/20">
                <h3 class="text-base font-bold text-white flex items-center gap-2">
                    <i class="fa-solid fa-pen-to-square text-amber-400"></i>
                    <span>Edit Petugas Piket</span>
                </h3>
                <button type="button" onclick="tutupModalEdit()" class="text-slate-400 hover:text-white p-1 cursor-pointer">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <form id="formEditPiket" action="" method="POST" class="mt-4 space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-xs font-bold text-amber-200 mb-1">Nama Siswa</label>
                    <input type="text" id="edit_nama" name="nama" required class="w-full bg-[#051124] border border-amber-500/30 focus:border-amber-400 rounded-xl px-3.5 py-2.5 text-sm text-white focus:outline-none transition">
                </div>

                <div>
                    <label class="block text-xs font-bold text-amber-200 mb-1">Pilih Hari</label>
                    <select id="edit_hari" name="hari" required class="w-full bg-[#051124] border border-amber-500/30 focus:border-amber-400 rounded-xl px-3.5 py-2.5 text-sm text-white focus:outline-none transition">
                        <?php foreach ($daftarHari as $hari): ?>
                            <option value="<?= htmlspecialchars($hari) ?>"><?= htmlspecialchars($hari) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-amber-200 mb-1">Tugas / Area</label>
                    <input type="text" id="edit_tugas" name="tugas" required class="w-full bg-[#051124] border border-amber-500/30 focus:border-amber-400 rounded-xl px-3.5 py-2.5 text-sm text-white focus:outline-none transition">
                </div>

                <div class="pt-3 flex justify-end gap-2">
                    <button type="button" onclick="tutupModalEdit()" class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-400 hover:bg-slate-800 cursor-pointer">
                        Batal
                    </button>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-amber-400 hover:bg-amber-300 text-slate-950 font-extrabold text-xs shadow-lg shadow-amber-400/30 transition cursor-pointer">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script>
        const modalTambah = document.getElementById('modalTambah');
        function bukaModalTambah() { modalTambah.classList.remove('hidden'); }
        function tutupModalTambah() { modalTambah.classList.add('hidden'); }

        const modalEdit = document.getElementById('modalEdit');
        const formEdit = document.getElementById('formEditPiket');
        const editNama = document.getElementById('edit_nama');
        const editHari = document.getElementById('edit_hari');
        const editTugas = document.getElementById('edit_tugas');

        function bukaModalEdit(id, nama, hari, tugas) {
            formEdit.action = '/piket/' + id;
            editNama.value = nama;
            editHari.value = hari;
            editTugas.value = tugas;
            modalEdit.classList.remove('hidden');
        }
        function tutupModalEdit() { modalEdit.classList.add('hidden'); }

        window.onclick = function(event) {
            if (event.target === modalTambah) tutupModalTambah();
            if (event.target === modalEdit) tutupModalEdit();
        };
    </script>
</body>
</html>