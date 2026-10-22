<?php

namespace App\Http\Controllers;

use App\Models\Piket;
use App\Models\DokumentasiPiket;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PiketController extends Controller
{
    private function getHariIni(): string
    {
        Carbon::setLocale('id');
        $hariInggrisKeIndo = [
            'Monday'    => 'Senin',
            'Tuesday'   => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday'  => 'Kamis',
            'Friday'    => 'Jumat',
        ];

        $hariIniEng = Carbon::now()->format('l');
        return $hariInggrisKeIndo[$hariIniEng] ?? 'Senin';
    }

    public function index()
    {
        $hariIni = $this->getHariIni();
        $daftarHari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];

        $allPikets = Piket::all();
        $pikets = $allPikets->groupBy('hari');

        // Batas awal & akhir minggu berjalan (Senin s.d. Minggu)
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek   = Carbon::now()->endOfWeek();

        // Ambil semua dokumentasi untuk tempat penyimpanan arsip
        $semuaDokumentasi = DokumentasiPiket::orderBy('tanggal', 'desc')->orderBy('created_at', 'desc')->get();

        // Ambil dokumentasi KHUSUS MINGGU INI untuk kartu depan
        $dokumentasiMingguIni = DokumentasiPiket::whereBetween('tanggal', [$startOfWeek, $endOfWeek])
            ->orderBy('tanggal', 'desc')
            ->get()
            ->unique('hari')
            ->keyBy('hari');

        $totalPetugas = $allPikets->count();
        $totalSelesai = $allPikets->where('is_selesai', true)->count();
        $petugasHariIni = $allPikets->where('hari', $hariIni);

        return view('piket.index', compact(
            'pikets',
            'daftarHari',
            'hariIni',
            'dokumentasiMingguIni',
            'semuaDokumentasi',
            'startOfWeek',
            'endOfWeek',
            'totalPetugas',
            'totalSelesai',
            'petugasHariIni',
            'allPikets'
        ));
    }

    public function admin()
    {
        $hariIni = $this->getHariIni();
        $daftarHari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];

        $allPikets = Piket::orderBy('created_at', 'desc')->get();
        $pikets = $allPikets->groupBy('hari');

        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek   = Carbon::now()->endOfWeek();

        $semuaDokumentasi = DokumentasiPiket::orderBy('tanggal', 'desc')->orderBy('created_at', 'desc')->get();
        $dokumentasiMingguIni = DokumentasiPiket::whereBetween('tanggal', [$startOfWeek, $endOfWeek])
            ->orderBy('tanggal', 'desc')
            ->get()
            ->unique('hari')
            ->keyBy('hari');

        $totalPetugas = $allPikets->count();
        $totalSelesai = $allPikets->where('is_selesai', true)->count();
        $petugasHariIni = $allPikets->where('hari', $hariIni);

        return view('admin.dashboard', compact(
            'pikets',
            'daftarHari',
            'allPikets',
            'dokumentasiMingguIni',
            'semuaDokumentasi',
            'startOfWeek',
            'endOfWeek',
            'totalPetugas',
            'totalSelesai',
            'petugasHariIni',
            'hariIni'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'  => 'required|string|max:100',
            'hari'  => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat',
            'tugas' => 'required|string|max:100',
        ]);

        Piket::create([
            'nama'       => $request->nama,
            'hari'       => $request->hari,
            'tugas'      => $request->tugas,
            'is_selesai' => false,
        ]);

        return redirect()->back()->with('success', 'Petugas piket berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'  => 'required|string|max:100',
            'hari'  => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat',
            'tugas' => 'required|string|max:100',
        ]);

        $piket = Piket::findOrFail($id);
        $piket->update($request->only('nama', 'hari', 'tugas'));

        return redirect()->back()->with('success', 'Data petugas berhasil diperbarui!');
    }

    public function uploadDokumentasi(Request $request)
    {
        $request->validate([
            'hari'            => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat',
            'tanggal'         => 'required|date',
            'nama_perwakilan' => 'required|string|max:100',
            'foto'            => 'required|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        $path = $request->file('foto')->store('dokumentasi_piket', 'public');

        DokumentasiPiket::create([
            'hari'            => $request->hari,
            'tanggal'         => $request->tanggal,
            'nama_perwakilan' => $request->nama_perwakilan,
            'foto'            => $path,
        ]);

        return redirect()->back()->with('success', "Dokumentasi hari {$request->hari} berhasil diunggah! Status minggu ini: SELESAI.");
    }

    public function toggleStatus($id)
    {
        $piket = Piket::findOrFail($id);
        $piket->is_selesai = !$piket->is_selesai;
        $piket->save();

        return redirect()->back()->with('success', 'Status piket diperbarui!');
    }

    // Reset status checklist semua siswa kembali ke belum piket (untuk awal minggu)
    public function resetMingguan()
    {
        Piket::query()->update(['is_selesai' => false]);
        return redirect()->back()->with('success', 'Status piket mingguan berhasil direset ke awal!');
    }

    public function destroy($id)
    {
        $piket = Piket::findOrFail($id);
        $piket->delete();

        return redirect()->back()->with('success', 'Data petugas berhasil dihapus!');
    }
}