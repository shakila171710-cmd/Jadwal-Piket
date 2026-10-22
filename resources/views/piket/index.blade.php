<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Piket & Arsip Dokumentasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
        }

        .day-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: linear-gradient(180deg, rgba(14, 33, 64, 0.95) 0%, rgba(7, 21, 46, 0.95) 100%);
        }
        .day-card:hover {
            transform: translateY(-4px);
            border-color: #38bdf8 !important;
            box-shadow: 0 14px 35px -10px rgba(56, 189, 248, 0.35) !important;
        }

        .card-active {
            border-color: #38bdf8 !important;
            background: linear-gradient(180deg, rgba(18, 48, 92, 0.95) 0%, rgba(10, 29, 64, 0.95) 100%) !important;
            box-shadow: 0 0 35px -5px rgba(56, 189, 248, 0.45) !important;
            transform: translateY(-4px);
        }

        .custom-scroll::-webkit-scrollbar {
            width: 5px;
        }
        .custom-scroll::-webkit-scrollbar-track {
            background: rgba(8, 24, 52, 0.6);
            border-radius: 10px;
        }
        .custom-scroll::-webkit-scrollbar-thumb {
            background: rgba(56, 189, 248, 0.4);
            border-radius: 10px;
        }
        .custom-scroll::-webkit-scrollbar-thumb:hover {
            background: rgba(56, 189, 248, 0.8);
        }

        /* Animasi Gerak Ikon Latar Belakang */
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
<body class="bg-[#051124] text-white min-h-screen flex flex-col justify-between p-6 sm:p-10 select-none relative overflow-x-hidden">

    <!-- Ikon Alat Kebersihan Bergerak -->
    <div class="fixed inset-0 pointer-events-none z-0 overflow-hidden">
        <div class="absolute -top-2 left-6 text-sky-400/20 text-8xl sm:text-9xl anim-sweep">
            <i class="fa-solid fa-broom"></i>
        </div>
        <div class="absolute top-10 right-8 text-sky-300/20 text-8xl sm:text-9xl anim-mop">
            <i class="fa-solid fa-bucket"></i>
        </div>
        <div class="absolute top-[40%] left-6 text-sky-400/20 text-7xl sm:text-8xl anim-spray">
            <i class="fa-solid fa-spray-can-sparkles"></i>
        </div>
        <div class="absolute top-16 left-[22%] text-sky-300/15 text-8xl sm:text-9xl anim-duster">
            <i class="fa-solid fa-feather-pointed"></i>
        </div>
        <div class="absolute top-[46%] right-8 text-sky-300/20 text-8xl sm:text-9xl anim-trash">
            <i class="fa-solid fa-trash-can"></i>
        </div>
        <div class="absolute bottom-16 left-12 text-sky-400/20 text-8xl anim-rub">
            <i class="fa-solid fa-rug"></i>
        </div>
        <div class="absolute bottom-12 right-16 text-sky-300/20 text-8xl anim-sweep">
            <i class="fa-solid fa-brush"></i>
        </div>
        <div class="absolute bottom-6 left-[48%] text-sky-400/15 text-7xl sm:text-8xl anim-mop">
            <i class="fa-solid fa-pump-soap"></i>
        </div>
        <div class="absolute top-28 right-[28%] text-sky-300 text-5xl anim-sparkle">
            <i class="fa-solid fa-sparkles"></i>
        </div>
        <div class="absolute bottom-36 left-[26%] text-sky-400 text-4xl anim-sparkle" style="animation-delay: 1.4s;">
            <i class="fa-solid fa-sparkles"></i>
        </div>
    </div>

    <!-- Konten Utama -->
    <div class="relative z-10 flex flex-col justify-between min-h-[calc(100vh-5rem)]">

        <?php if (session('success')): ?>
        <div class="fixed top-5 right-5 z-50 bg-sky-500/20 border border-sky-400 text-sky-200 px-4 py-2.5 rounded-2xl shadow-lg backdrop-blur-md text-sm flex items-center gap-2">
            <i class="fa-solid fa-circle-check text-sky-400"></i>
            <span><?= htmlspecialchars(session('success')) ?></span>
        </div>
        <?php endif; ?>

        <!-- Navigasi Atas -->
        <div class="max-w-6xl mx-auto w-full flex items-center justify-between gap-3">
            <button type="button" onclick="bukaModalGaleri()" class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl bg-sky-500/15 border border-sky-400/40 text-sky-200 hover:text-white hover:bg-sky-500/25 text-xs sm:text-sm font-semibold shadow-md transition cursor-pointer backdrop-blur-sm">
                <i class="fa-solid fa-box-archive text-sky-400"></i>
                <span>Tempat Penyimpanan (<?= count($semuaDokumentasi) ?> Arsip)</span>
            </button>

            <?php if (auth()->check()): ?>
                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl bg-sky-400 text-slate-950 hover:bg-sky-300 text-xs sm:text-sm font-bold shadow-lg shadow-sky-400/25 transition">
                        <i class="fa-solid fa-shield-halved"></i>
                        <span>Admin PPLG 2</span>
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" title="Logout" class="px-3 py-2 rounded-2xl bg-rose-500/15 hover:bg-rose-500/25 border border-rose-500/40 text-rose-300 text-xs sm:text-sm font-semibold transition cursor-pointer">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        </button>
                    </form>
                </div>
            <?php else: ?>
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl bg-sky-400 text-slate-950 hover:bg-sky-300 text-xs sm:text-sm font-bold shadow-lg shadow-sky-400/25 transition">
                    <i class="fa-solid fa-lock"></i>
                    <span>Admin PPLG 2</span>
                </a>
            <?php endif; ?>
        </div>

        <!-- Header -->
        <div class="text-center space-y-3 mt-4">
            <span class="inline-block px-5 py-1.5 rounded-full text-xs font-bold tracking-widest uppercase bg-sky-500/15 text-sky-300 border border-sky-400/30 backdrop-blur-sm">
                SISTEM INFORMASI KELAS XI PPLG 2
            </span>
            <h1 class="text-4xl sm:text-6xl font-black tracking-tight text-white">
                Jadwal <span class="text-sky-400">Piket</span>
            </h1>
            <p class="text-xs sm:text-sm text-sky-200/80 font-medium">
                <i class="fa-regular fa-calendar-days mr-1 text-sky-400"></i> Periode Minggu Ini: <?= $startOfWeek->format('d M') ?> – <?= $endOfWeek->format('d M Y') ?>
            </p>
        </div>

        <!-- Kartu Hari -->
        <div class="flex flex-wrap justify-center gap-6 max-w-6xl mx-auto w-full my-8">
            <?php foreach ($daftarHari as $index => $hari): ?>
                <?php
                    $isToday = ($hari === $hariIni);
                    $petugasList = isset($pikets[$hari]) ? $pikets[$hari] : collect();
                    $dokMingguIni = isset($dokumentasiMingguIni[$hari]) ? $dokumentasiMingguIni[$hari] : null;
                ?>

                <div onclick="selectCard(this)" 
                     class="day-card group rounded-3xl p-6 sm:p-7 cursor-pointer border relative flex flex-col justify-between w-full sm:w-[calc(50%-1.5rem)] lg:w-[calc(33.333%-1rem)] <?= $isToday ? 'card-active border-sky-400' : 'border-sky-500/20' ?> backdrop-blur-sm">

                    <div>
                        <div class="flex items-start justify-between mb-3">
                            <div>
                                <span class="text-xs font-bold uppercase tracking-wider text-sky-400 block mb-1">
                                    <?= $isToday ? '● HARI INI' : 'HARI KE-' . ($index + 1) ?>
                                </span>
                                <h2 class="text-3xl font-extrabold text-white tracking-wide"><?= htmlspecialchars($hari) ?></h2>
                            </div>

                            <div class="flex items-center gap-2" onclick="event.stopPropagation()">
                                <?php if ($dokMingguIni): ?>
                                    <button type="button" 
                                            onclick="lihatBukti('<?= asset('storage/' . $dokMingguIni->foto) ?>', '<?= $hari ?>', '<?= addslashes($dokMingguIni->nama_perwakilan) ?>', '<?= $dokMingguIni->tanggal ? $dokMingguIni->tanggal->format('d M Y') : '-' ?>')" 
                                            title="Lihat Foto Bukti Minggu Ini" 
                                            class="w-10 h-10 rounded-2xl bg-sky-400 text-slate-950 hover:bg-sky-300 flex items-center justify-center font-bold shadow-[0_0_15px_rgba(56,189,248,0.5)] transition cursor-pointer">
                                        <i class="fa-solid fa-camera text-sm"></i>
                                    </button>
                                <?php else: ?>
                                    <button type="button" 
                                            onclick="bukaModalUploadDok('<?= $hari ?>')" 
                                            title="Kirim Bukti Piket Minggu Ini" 
                                            class="w-10 h-10 rounded-2xl bg-sky-500/10 hover:bg-sky-400 hover:text-slate-950 text-sky-300 border border-sky-400/30 flex items-center justify-center transition cursor-pointer">
                                        <i class="fa-solid fa-cloud-arrow-up text-sm"></i>
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="mb-4 pb-3 border-b border-sky-500/20 flex items-center justify-between text-xs sm:text-sm">
                            <?php if ($dokMingguIni): ?>
                                <div class="min-w-0 pr-2">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold bg-sky-400/20 text-sky-300 border border-sky-400/50">
                                        <i class="fa-solid fa-circle-check text-[10px]"></i>
                                        <span>Selesai</span>
                                    </span>
                                    <p class="text-[11px] text-sky-200/70 mt-1 truncate" title="<?= htmlspecialchars($dokMingguIni->nama_perwakilan) ?>">
                                        Oleh: <span class="text-sky-300 font-semibold"><?= htmlspecialchars($dokMingguIni->nama_perwakilan) ?></span> (<?= $dokMingguIni->tanggal ? $dokMingguIni->tanggal->format('d/m') : '-' ?>)
                                    </p>
                                </div>
                                <button type="button" onclick="event.stopPropagation(); bukaModalUploadDok('<?= $hari ?>')" class="text-sky-300 hover:text-sky-100 underline text-xs shrink-0 cursor-pointer">Perbarui</button>
                            <?php else: ?>
                                <div>
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold bg-rose-500/20 text-rose-300 border border-rose-500/40">
                                        <i class="fa-regular fa-circle-xmark text-[10px]"></i>
                                        <span>Belum Selesai</span>
                                    </span>
                                    <p class="text-[11px] text-slate-400 mt-1">Minggu ini belum ada bukti</p>
                                </div>
                                <button type="button" onclick="event.stopPropagation(); bukaModalUploadDok('<?= $hari ?>')" class="text-sky-400 hover:underline font-semibold text-xs shrink-0 ml-2 cursor-pointer">+ Kirim</button>
                            <?php endif; ?>
                        </div>

                        <div class="space-y-3.5 max-h-[350px] overflow-y-auto pr-2 custom-scroll">
                            <?php if (count($petugasList) > 0): ?>
                                <?php foreach ($petugasList as $item): ?>
                                    <div class="flex items-center justify-between py-1 px-2 rounded-xl hover:bg-sky-500/10 transition">
                                        <div class="flex items-center gap-3 min-w-0">
                                            <div class="w-10 h-10 rounded-full bg-sky-500/20 text-sky-300 border border-sky-400/40 flex items-center justify-center text-xs font-black shrink-0">
                                                <?= strtoupper(substr($item->nama, 0, 2)) ?>
                                            </div>
                                            <div class="min-w-0">
                                                <p class="text-base font-bold text-white truncate <?= $item->is_selesai ? 'line-through text-slate-500' : '' ?>">
                                                    <?= htmlspecialchars($item->nama) ?>
                                                </p>
                                                <p class="text-xs text-sky-200/60 truncate mt-0.5"><?= htmlspecialchars($item->tugas) ?></p>
                                            </div>
                                        </div>

                                        <div class="shrink-0 ml-2">
                                            <?php if ($item->is_selesai): ?>
                                                <span class="w-7 h-7 rounded-xl bg-sky-400/20 text-sky-300 border border-sky-400/50 flex items-center justify-center text-xs" title="Sudah Melaksanakan">
                                                    <i class="fa-solid fa-check"></i>
                                                </span>
                                            <?php else: ?>
                                                <span class="w-7 h-7 rounded-xl bg-[#0a1e3f] border border-sky-500/20 text-slate-500 flex items-center justify-center text-[10px]" title="Belum">
                                                    <i class="fa-regular fa-circle"></i>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="text-sm text-sky-200/50 italic py-6 text-center">Belum ada anggota piket</p>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>

    </div>

    <!-- Modal Upload Dokumentasi -->
    <div id="modalUploadDok" class="hidden fixed inset-0 z-50 bg-black/85 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-[#0b1b38] border border-sky-400/50 rounded-3xl w-full max-w-md p-6 shadow-2xl relative">
            <div class="flex items-center justify-between pb-4 border-b border-sky-500/20">
                <h3 class="text-lg font-bold text-white flex items-center gap-2">
                    <i class="fa-solid fa-camera text-sky-400"></i>
                    <span>Kirim Dokumentasi Piket</span>
                </h3>
                <button type="button" onclick="tutupModalUploadDok()" class="text-sky-300 hover:text-white p-1 cursor-pointer">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <form action="{{ route('dokumentasi.upload') }}" method="POST" enctype="multipart/form-data" class="mt-4 space-y-4">
                @csrf
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-sky-200 mb-1">Hari Bertugas</label>
                        <input type="text" id="dok_hari" name="hari" readonly class="w-full bg-[#051124] border border-sky-500/30 rounded-xl px-3.5 py-2.5 text-sm text-sky-400 font-bold focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-sky-200 mb-1">Tanggal Piket</label>
                        <input type="date" name="tanggal" value="<?= date('Y-m-d') ?>" required class="w-full bg-[#051124] border border-sky-500/30 focus:border-sky-400 rounded-xl px-3.5 py-2.5 text-sm text-white focus:outline-none transition">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-sky-200 mb-1">Nama Perwakilan Pengirim</label>
                    <input type="text" name="nama_perwakilan" required placeholder="Nama kamu" class="w-full bg-[#051124] border border-sky-500/30 focus:border-sky-400 rounded-xl px-3.5 py-2.5 text-sm text-white focus:outline-none transition">
                </div>

                <div>
                    <label class="block text-xs font-bold text-sky-200 mb-1">Foto Bukti Ruang Kelas</label>
                    <input type="file" name="foto" required accept="image/*" class="w-full bg-[#051124] border border-sky-500/30 rounded-xl px-3 py-2 text-xs text-sky-200/80 file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-sky-500/20 file:text-sky-300 hover:file:bg-sky-500/30">
                </div>

                <div class="pt-3 flex justify-end gap-2">
                    <button type="button" onclick="tutupModalUploadDok()" class="px-5 py-2.5 rounded-xl text-sm font-semibold text-slate-400 hover:bg-slate-800 cursor-pointer">
                        Batal
                    </button>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-sky-400 hover:bg-sky-300 text-slate-950 font-extrabold text-sm shadow-lg shadow-sky-400/30 transition cursor-pointer">
                        Unggah Bukti
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Tempat Penyimpanan Arsip -->
    <div id="modalGaleri" class="hidden fixed inset-0 z-50 bg-black/90 backdrop-blur-md flex items-center justify-center p-4">
        <div class="bg-[#0b1b38] border border-sky-400/50 rounded-3xl w-full max-w-4xl p-6 shadow-2xl relative max-h-[85vh] flex flex-col">
            <div class="flex items-center justify-between pb-4 border-b border-sky-500/20 shrink-0">
                <div>
                    <h3 class="text-xl font-bold text-white flex items-center gap-2">
                        <i class="fa-solid fa-box-archive text-sky-400"></i>
                        <span>Tempat Penyimpanan Dokumentasi Piket</span>
                    </h3>
                    <p class="text-xs text-sky-200/70 mt-0.5">Semua rekaman foto bukti selesai piket yang tersimpan rapi dari minggu ke minggu.</p>
                </div>
                <button type="button" onclick="tutupModalGaleri()" class="text-sky-300 hover:text-white p-1 cursor-pointer">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>

            <div class="overflow-y-auto custom-scroll my-4 pr-2">
                <?php if (count($semuaDokumentasi) > 0): ?>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                        <?php foreach ($semuaDokumentasi as $dok): ?>
                            <div class="bg-[#07152d] border border-sky-500/20 hover:border-sky-400/50 rounded-2xl p-3.5 transition">
                                <img src="<?= asset('storage/' . $dok->foto) ?>" alt="Bukti Piket" class="w-full h-44 object-cover rounded-xl mb-3 border border-sky-500/20">
                                <div class="flex items-center justify-between text-xs">
                                    <span class="px-2.5 py-1 rounded-lg bg-sky-500/20 text-sky-300 font-bold border border-sky-400/30">
                                        <?= htmlspecialchars($dok->hari) ?>
                                    </span>
                                    <span class="text-sky-200/70 font-medium">
                                        <i class="fa-regular fa-calendar text-[10px] mr-1 text-sky-400"></i>
                                        <?= $dok->tanggal ? $dok->tanggal->format('d M Y') : '-' ?>
                                    </span>
                                </div>
                                <p class="text-xs font-semibold text-slate-300 mt-2 truncate">
                                    Oleh: <span class="text-sky-300 font-bold"><?= htmlspecialchars($dok->nama_perwakilan) ?></span>
                                </p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-16">
                        <i class="fa-regular fa-images text-4xl text-sky-500/30 mb-3 block"></i>
                        <p class="text-sm text-sky-200/60">Belum ada foto dokumentasi yang tersimpan di arsip.</p>
                    </div>
                <?php endif; ?>
            </div>

            <div class="pt-3 border-t border-sky-500/20 flex justify-end shrink-0">
                <button type="button" onclick="tutupModalGaleri()" class="px-5 py-2 rounded-xl text-xs font-semibold bg-sky-500/20 hover:bg-sky-500/30 text-sky-200 border border-sky-400/30 cursor-pointer">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Lihat Foto Bukti -->
    <div id="modalBukti" class="hidden fixed inset-0 z-50 bg-black/90 backdrop-blur-md flex items-center justify-center p-4" onclick="tutupBukti()">
        <div class="max-w-md w-full bg-[#0b1b38] border border-sky-400/50 rounded-3xl p-5 shadow-2xl relative" onclick="event.stopPropagation()">
            <div class="flex items-center justify-between pb-3 border-b border-sky-500/20 mb-3">
                <div>
                    <h4 id="judulBukti" class="text-base font-bold text-white">Dokumentasi Piket</h4>
                    <p id="subJudulBukti" class="text-xs text-sky-200/70 mt-0.5"></p>
                </div>
                <button type="button" onclick="tutupBukti()" class="text-sky-300 hover:text-white p-1 cursor-pointer">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>
            <img id="imgBukti" src="" alt="Bukti Piket" class="w-full h-64 object-cover rounded-2xl border border-sky-500/30">
        </div>
    </div>

    <!-- Script Kontrol Modal -->
    <script>
        function selectCard(clickedCard) {
            document.querySelectorAll('.day-card').forEach(card => {
                card.classList.remove('card-active');
            });
            clickedCard.classList.add('card-active');
        }

        const modalUploadDok = document.getElementById('modalUploadDok');
        const dokHari = document.getElementById('dok_hari');
        function bukaModalUploadDok(hari) {
            dokHari.value = hari;
            modalUploadDok.classList.remove('hidden');
        }
        function tutupModalUploadDok() { modalUploadDok.classList.add('hidden'); }

        const modalGaleri = document.getElementById('modalGaleri');
        function bukaModalGaleri() { modalGaleri.classList.remove('hidden'); }
        function tutupModalGaleri() { modalGaleri.classList.add('hidden'); }

        const modalBukti = document.getElementById('modalBukti');
        const imgBukti = document.getElementById('imgBukti');
        const judulBukti = document.getElementById('judulBukti');
        const subJudulBukti = document.getElementById('subJudulBukti');

        function lihatBukti(url, hari, perwakilan, tgl) {
            imgBukti.src = url;
            judulBukti.innerText = 'Dokumentasi Piket ' + hari;
            subJudulBukti.innerText = 'Tanggal: ' + tgl + ' • Pengirim: ' + perwakilan;
            modalBukti.classList.remove('hidden');
        }
        function tutupBukti() { modalBukti.classList.add('hidden'); }

        window.onclick = function(event) {
            if (event.target === modalUploadDok) tutupModalUploadDok();
            if (event.target === modalGaleri) tutupModalGaleri();
            if (event.target === modalBukti) tutupBukti();
        };
    </script>
</body>
</html>