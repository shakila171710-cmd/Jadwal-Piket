<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Piket Premium</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#0b1426] text-white min-h-screen flex flex-col justify-between p-6 sm:p-10 relative overflow-x-hidden">

    <!-- Notifikasi Sukses -->
    @if(session('success'))
    <div class="fixed top-5 right-5 z-50 bg-cyan-500/20 border border-cyan-400 text-cyan-200 px-4 py-2.5 rounded-xl shadow-lg backdrop-blur-md text-sm flex items-center gap-2">
        <i class="fa-solid fa-circle-check"></i>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    <!-- HEADER -->
    <div class="text-center space-y-3 mt-4">
        <span class="inline-block px-4 py-1.5 rounded-full text-[11px] font-semibold tracking-wider uppercase bg-[#14294b] text-cyan-400 border border-cyan-500/30">
            Sistem Informasi Kelas
        </span>
        <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight bg-gradient-to-r from-sky-300 via-cyan-400 to-blue-500 bg-clip-text text-transparent">
            Jadwal Piket
        </h1>
        <p class="text-sm text-slate-400 max-w-md mx-auto">
            Lingkungan bersih, belajar nyaman. Daftar petugas kebersihan ruang kelas.
        </p>
    </div>

    <!-- CARDS GRID -->
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6 max-w-7xl mx-auto w-full my-8">
        @foreach($daftarHari as $hari)
            @php
                $isToday = ($hari === $hariIni);
                $petugasList = $pikets[$hari] ?? collect();
            @endphp

            <div class="rounded-3xl p-6 transition duration-300 relative flex flex-col justify-between
                {{ $isToday 
                    ? 'bg-[#102445]/90 border-2 border-cyan-400 shadow-[0_0_30px_rgba(34,211,238,0.25)] ring-1 ring-cyan-400/50' 
                    : 'bg-[#101e38]/70 border border-slate-800/80 hover:border-slate-700' }}">

                <div>
                    <!-- Card Header -->
                    <div class="flex items-start justify-between mb-5">
                        <div>
                            <div class="flex items-center gap-2">
                                @if($isToday)
                                    <span class="w-2 h-2 rounded-full bg-cyan-400 animate-ping"></span>
                                    <span class="text-[10px] font-bold uppercase tracking-wider text-cyan-300">Hari Ini</span>
                                @else
                                    <span class="text-[10px] font-semibold uppercase tracking-wider text-slate-400">Jadwal</span>
                                @endif
                            </div>
                            <h2 class="text-2xl font-bold mt-1 text-white">{{ $hari }}</h2>
                        </div>
                        <div class="w-10 h-10 rounded-2xl flex items-center justify-center {{ $isToday ? 'bg-cyan-500 text-slate-950 shadow-md shadow-cyan-500/40' : 'bg-slate-800/60 text-slate-400' }}">
                            <i class="fa-solid fa-broom text-sm"></i>
                        </div>
                    </div>

                    <!-- List Anggota Piket -->
                    <div class="space-y-4">
                        @forelse($petugasList as $item)
                            <div class="flex items-center justify-between group">
                                <div class="flex items-center gap-3">
                                    <!-- Inisial Bulat -->
                                    <div class="w-9 h-9 rounded-full bg-cyan-900/60 text-cyan-300 border border-cyan-500/30 flex items-center justify-center text-xs font-bold shrink-0">
                                        {{ strtoupper(substr($item->nama, 0, 2)) }}
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-sm font-semibold text-slate-100 truncate {{ $item->is_selesai ? 'line-through text-slate-500' : '' }}">
                                            {{ $item->nama }}
                                        </p>
                                        <p class="text-[11px] text-slate-400 truncate">{{ $item->tugas }}</p>
                                    </div>
                                </div>

                                <!-- Action Buttons (Ceklis & Hapus) -->
                                <div class="flex items-center gap-1.5 opacity-60 group-hover:opacity-100 transition">
                                    <!-- Check Button -->
                                    <form action="{{ route('piket.toggle', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" title="Tandai Selesai" class="w-7 h-7 rounded-lg flex items-center justify-center {{ $item->is_selesai ? 'bg-emerald-500/20 text-emerald-400 border border-emerald-500/40' : 'bg-slate-800 text-slate-400 hover:text-cyan-300' }}">
                                            <i class="fa-solid fa-check text-xs"></i>
                                        </button>
                                    </form>

                                    <!-- Delete Button -->
                                    <form action="{{ route('piket.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus petugas ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Hapus" class="w-7 h-7 rounded-lg bg-slate-800 text-slate-400 hover:text-rose-400 flex items-center justify-center">
                                            <i class="fa-regular fa-trash-can text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <p class="text-xs text-slate-500 italic py-2">Belum ada petugas</p>
                        @endforelse
                    </div>
                </div>

            </div>
        @endforeach
    </div>

    <!-- TOMBOL TAMBAH JADWAL -->
    <div class="text-center mb-4">
        <button onclick="document.getElementById('modalTambah').classList.remove('hidden')" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-[#112446] border border-cyan-500/40 hover:border-cyan-400 text-cyan-300 hover:text-white hover:bg-cyan-600/20 transition shadow-lg shadow-cyan-500/10 text-xs font-bold tracking-wider uppercase">
            <i class="fa-solid fa-plus text-sm"></i>
            <span>Tambah Jadwal Baru</span>
        </button>
    </div>

    <!-- MODAL POP-UP TAMBAH PETUGAS -->
    <div id="modalTambah" class="hidden fixed inset-0 z-50 bg-slate-950/80 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-[#10203d] border border-cyan-500/30 rounded-3xl w-full max-w-md p-6 shadow-2xl relative">
            <div class="flex items-center justify-between pb-4 border-b border-slate-800">
                <h3 class="text-lg font-bold text-white">Tambah Petugas Piket</h3>
                <button onclick="document.getElementById('modalTambah').classList.add('hidden')" class="text-slate-400 hover:text-white">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <form action="{{ route('piket.store') }}" method="POST" class="mt-4 space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-medium text-slate-300 mb-1">Nama Lengkap</label>
                    <input type="text" name="nama" required placeholder="Contoh: Talita Dzakiran" class="w-full bg-[#0b1426] border border-slate-700 rounded-xl px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-cyan-400">
                </div>

                <div>
                    <label class="block text-xs font-medium text-slate-300 mb-1">Pilih Hari</label>
                    <select name="hari" required class="w-full bg-[#0b1426] border border-slate-700 rounded-xl px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-cyan-400">
                        @foreach($daftarHari as $hari)
                            <option value="{{ $hari }}">{{ $hari }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-medium text-slate-300 mb-1">Tugas / Area</label>
                    <input type="text" name="tugas" required placeholder="Contoh: Menyapu Lantai / Buang Sampah" class="w-full bg-[#0b1426] border border-slate-700 rounded-xl px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-cyan-400">
                </div>

                <div class="pt-3 flex justify-end gap-2">
                    <button type="button" onclick="document.getElementById('modalTambah').classList.add('hidden')" class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-400 hover:bg-slate-800">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-cyan-500 hover:bg-cyan-400 text-slate-950 font-bold text-xs shadow-lg shadow-cyan-500/25 transition">
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>