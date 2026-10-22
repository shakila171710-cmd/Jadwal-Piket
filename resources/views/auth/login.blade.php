<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Admin PPLG 2</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#071326] text-white min-h-screen flex items-center justify-center p-6 select-none">

    <div class="w-full max-w-md bg-[#0e1d38] border border-sky-500/30 rounded-3xl p-8 shadow-[0_0_40px_rgba(56,189,248,0.2)]">
        <div class="text-center space-y-2 mb-8">
            <div class="w-14 h-14 mx-auto rounded-2xl bg-sky-400 text-slate-950 flex items-center justify-center text-2xl font-bold shadow-lg shadow-sky-400/30">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
            <h2 class="text-2xl font-extrabold text-white tracking-wide">Admin PPLG 2</h2>
            <p class="text-xs text-slate-400">Silakan login untuk mengelola dan mengedit jadwal piket kelas.</p>
        </div>

        @if($errors->any())
        <div class="mb-5 bg-rose-500/10 border border-rose-500/40 text-rose-300 text-xs px-4 py-3 rounded-xl flex items-center gap-2">
            <i class="fa-solid fa-circle-exclamation"></i>
            <span>{{ $errors->first() }}</span>
        </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-slate-300 mb-1.5">Email Admin</label>
                <div class="relative">
                    <input type="email" name="email" value="{{ old('email') }}" required placeholder="genofpplg2@gmail.com"
                           class="w-full bg-[#081326] border border-slate-700 focus:border-sky-400 rounded-xl px-4 py-3 text-sm text-white focus:outline-none transition pl-10">
                    <i class="fa-regular fa-envelope absolute left-3.5 top-3.5 text-slate-500 text-sm"></i>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-300 mb-1.5">Password</label>
                <div class="relative">
                    <input type="password" name="password" required placeholder="••••••••"
                           class="w-full bg-[#081326] border border-slate-700 focus:border-sky-400 rounded-xl px-4 py-3 text-sm text-white focus:outline-none transition pl-10">
                    <i class="fa-solid fa-lock absolute left-3.5 top-3.5 text-slate-500 text-sm"></i>
                </div>
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full py-3.5 rounded-xl bg-sky-400 hover:bg-sky-300 text-slate-950 font-bold text-sm shadow-lg shadow-sky-400/30 transition cursor-pointer">
                    Masuk ke Dashboard
                </button>
            </div>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ route('piket.index') }}" class="text-xs text-slate-400 hover:text-sky-300 transition">
                ← Kembali ke Jadwal Piket
            </a>
        </div>
    </div>

</body>
</html>