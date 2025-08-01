<?php

namespace App\Http\Controllers\IP2SIP;

use App\Http\Controllers\Controller;
use App\Models\mBSIP;
use App\Models\mIP2SIP;
use App\Models\PemanfaatanSIP;
use App\Models\PemanfaatanSipDokumentasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PemanfaatanSIPController extends Controller
{
    public function index(Request $request) 
    {
        $pemanfaatan_sip = new PemanfaatanSIP();
        if ($request->bsip_id) {
            $ip2sip_id = mIP2SIP::where('bsip_id', $request->bsip_id)->distinct()->pluck('id');
            $pemanfaatan_sip = PemanfaatanSIP::whereIn('ip2sip_id', $ip2sip_id);
        }
        
        // Load relasi dokumentasi untuk checking di view
        $pemanfaatan_sip = $pemanfaatan_sip->with('dokumentasi')->paginate(5);

        $all_bsip = mBSIP::select(['id', 'name'])->get();
        return view('lp2tp.pemanfaatan.pemanfaatan_kp', [
            'pemanfaatan_sip' => $pemanfaatan_sip,
            'all_bsip' => $all_bsip,
        ]);
    }

    public function create() 
    {
        $existed_ip2sip = PemanfaatanSIP::distinct()->pluck('id');
        $ip2sip = mIP2SIP::whereNotIn('id', $existed_ip2sip)->get();
        return view('lp2tp.pemanfaatan.create', [
            'ip2sip' => $ip2sip,
        ]);
    }

    public function store(Request $request) 
    {
        $request->validate([
            'ip2sip_id' => 'required|integer|unique:pemanfaatan_sip',
            'luas_sip' => 'required|numeric',
            'jumlah_sdm' => 'required|numeric',
            'agro_ekosistem' => 'required|string|max:255',
            'pemanfaatan_diseminasi' => 'required|array',
            'pemanfaatan_diseminasi.*.name' => 'required|string',
            'pemanfaatan_diseminasi.*.luas' => 'required|numeric',
            // ===== TAMBAHAN VALIDASI UNTUK DOKUMENTASI =====
            'dokumentasi' => 'nullable|array|max:10', // Max 10 files
            'dokumentasi.*' => 'file|mimes:jpg,jpeg,png,gif,pdf,doc,docx|max:10240', // Max 10MB per file
            'dokumentasi_descriptions' => 'nullable|array',
            'dokumentasi_descriptions.*' => 'nullable|string|max:255',
        ], [
            'ip2sip_id.required' => 'ID IP2SIP tidak boleh kosong',
            'ip2sip_id.integer' => 'ID IP2SIP harus berupa angka',
            'ip2sip_id.unique' => 'ID IP2SIP sudah digunakan',
            'luas_sip.required' => 'Luas SIP tidak boleh kosong',
            'luas_sip.numeric' => 'Luas SIP harus berupa angka',
            'jumlah_sdm.required' => 'Jumlah SDM tidak boleh kosong',
            'jumlah_sdm.numeric' => 'Jumlah SDM harus berupa angka',
            'agro_ekosistem.required' => 'Agro Eksosistem tidak boleh kosong',
            'agro_ekosistem.max' => 'Agro Eksosistem tidak boleh melebihi 255 karakter',
            'pemanfaatan_diseminasi.array' => 'Pemanfaatan Bangunan harus bertipe array',
            'pemanfaatan_diseminasi.*.name.required' => 'Nama Pemanfaatan diseminasi tidak boleh kosong',
            'pemanfaatan_diseminasi.*.luas.required' => 'Luas Pemanfaatan diseminasi tidak boleh kosong',
            // ===== TAMBAHAN VALIDASI MESSAGES =====
            'dokumentasi.max' => 'Maksimal 10 file dokumentasi yang dapat diupload',
            'dokumentasi.*.file' => 'File dokumentasi harus berupa file',
            'dokumentasi.*.mimes' => 'File dokumentasi harus berformat: jpg, jpeg, png, gif, pdf, doc, docx',
            'dokumentasi.*.max' => 'Ukuran file dokumentasi maksimal 10MB',
        ]);

        try {
            DB::beginTransaction();
            
            $pemanfaatan_sip = PemanfaatanSIP::create([
                'ip2sip_id' => $request->ip2sip_id,
                'luas_sip' => $request->luas_sip,
                'jumlah_sdm' => $request->jumlah_sdm,
                'agro_ekosistem' => $request->agro_ekosistem
            ]);

            $pemanfaatan_sip->pemanfaatan_diseminasi()->createMany($request->pemanfaatan_diseminasi);
            
            // ===== TAMBAHAN: HANDLE UPLOAD DOKUMENTASI =====
            if ($request->hasFile('dokumentasi')) {
                $this->handleDokumentasiUpload($request, $pemanfaatan_sip);
            }
            
            DB::commit();
            
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Data berhasil disimpan', 'data' => $pemanfaatan_sip], 201);
            }
            
            return redirect()->route('lp2tp.pemanfaatan_kp')->with('success', 'Data berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollback();
            
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
            }
            
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $pemanfaatan_sip = PemanfaatanSIP::with(['ip2sip.bsip', 'pemanfaatan_diseminasi', 'dokumentasi'])->findOrFail($id);
        $all_bsip = mBSIP::select(['id', 'name'])->get();
        $ip2sip = mIP2SIP::all(); // Untuk dropdown IP2SIP
        
        return view('lp2tp.pemanfaatan.edit', [
            'pemanfaatan_sip' => $pemanfaatan_sip,
            'all_bsip' => $all_bsip,
            'ip2sip' => $ip2sip,
        ]);
    }

    public function update(Request $request, $id)
    {
        $pemanfaatan_sip = PemanfaatanSIP::findOrFail($id);
        
        $request->validate([
            'ip2sip_id' => 'required|integer|unique:pemanfaatan_sip,ip2sip_id,' . $id,
            'luas_sip' => 'required|numeric',
            'jumlah_sdm' => 'required|numeric',
            'agro_ekosistem' => 'required|string|max:255',
            'pemanfaatan_diseminasi' => 'required|array',
            'pemanfaatan_diseminasi.*.name' => 'required|string',
            'pemanfaatan_diseminasi.*.luas' => 'required|numeric',
            // ===== TAMBAHAN VALIDASI UNTUK DOKUMENTASI =====
            'dokumentasi' => 'nullable|array|max:10', 
            'dokumentasi.*' => 'file|mimes:jpg,jpeg,png,gif,pdf,doc,docx|max:10240',
            'dokumentasi_descriptions' => 'nullable|array',
            'dokumentasi_descriptions.*' => 'nullable|string|max:255',
            'hapus_dokumentasi' => 'nullable|array', // Array ID dokumentasi yang akan dihapus
            'hapus_dokumentasi.*' => 'integer|exists:pemanfaatan_sip_dokumentasi,id',
        ], [
            'ip2sip_id.required' => 'ID IP2SIP tidak boleh kosong',
            'ip2sip_id.integer' => 'ID IP2SIP harus berupa angka',
            'ip2sip_id.unique' => 'ID IP2SIP sudah digunakan',
            'luas_sip.required' => 'Luas SIP tidak boleh kosong',
            'luas_sip.numeric' => 'Luas SIP harus berupa angka',
            'jumlah_sdm.required' => 'Jumlah SDM tidak boleh kosong',
            'jumlah_sdm.numeric' => 'Jumlah SDM harus berupa angka',
            'agro_ekosistem.required' => 'Agro Eksosistem tidak boleh kosong',
            'agro_ekosistem.max' => 'Agro Eksosistem tidak boleh melebihi 255 karakter',
            'pemanfaatan_diseminasi.array' => 'Pemanfaatan Bangunan harus bertipe array',
            'pemanfaatan_diseminasi.*.name.required' => 'Nama Pemanfaatan diseminasi tidak boleh kosong',
            'pemanfaatan_diseminasi.*.luas.required' => 'Luas Pemanfaatan diseminasi tidak boleh kosong',
            // ===== TAMBAHAN VALIDASI MESSAGES =====
            'dokumentasi.max' => 'Maksimal 10 file dokumentasi yang dapat diupload',
            'dokumentasi.*.file' => 'File dokumentasi harus berupa file',
            'dokumentasi.*.mimes' => 'File dokumentasi harus berformat: jpg, jpeg, png, gif, pdf, doc, docx',
            'dokumentasi.*.max' => 'Ukuran file dokumentasi maksimal 10MB',
        ]);

        try {
            DB::beginTransaction();
            
            // Update data utama
            $pemanfaatan_sip->update([
                'ip2sip_id' => $request->ip2sip_id,
                'luas_sip' => $request->luas_sip,
                'jumlah_sdm' => $request->jumlah_sdm,
                'agro_ekosistem' => $request->agro_ekosistem
            ]);

            // Hapus data pemanfaatan_diseminasi yang lama
            $pemanfaatan_sip->pemanfaatan_diseminasi()->delete();
            
            // Tambahkan data pemanfaatan_diseminasi yang baru
            $pemanfaatan_sip->pemanfaatan_diseminasi()->createMany($request->pemanfaatan_diseminasi);
            
            // ===== TAMBAHAN: HANDLE HAPUS DOKUMENTASI YANG DIPILIH =====
            if ($request->filled('hapus_dokumentasi')) {
                $this->handleDokumentasiDelete($request->hapus_dokumentasi, $pemanfaatan_sip);
            }
            
            // ===== TAMBAHAN: HANDLE UPLOAD DOKUMENTASI BARU =====
            if ($request->hasFile('dokumentasi')) {
                $this->handleDokumentasiUpload($request, $pemanfaatan_sip);
            }
            
            DB::commit();
            
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Data berhasil diperbarui', 'data' => $pemanfaatan_sip], 200);
            }
            
            return redirect()->route('lp2tp.pemanfaatan_kp')->with('success', 'Data berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollback();
            
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
            }
            
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            
            $pemanfaatan_sip = PemanfaatanSIP::findOrFail($id);
            
            // Hapus data pemanfaatan_diseminasi terlebih dahulu
            $pemanfaatan_sip->pemanfaatan_diseminasi()->delete();
            
            // ===== TAMBAHAN: HAPUS DOKUMENTASI (auto trigger delete file fisik) =====
            $pemanfaatan_sip->dokumentasi()->delete();
            
            // Kemudian hapus data utama
            $pemanfaatan_sip->delete();
            
            DB::commit();
            
            return redirect()->route('lp2tp.pemanfaatan_kp')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollback();
            
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $pemanfaatan_sip = PemanfaatanSIP::with(['ip2sip.bsip', 'pemanfaatan_diseminasi', 'dokumentasi'])->findOrFail($id);
        
        return view('lp2tp.pemanfaatan.show', [
            'pemanfaatan_sip' => $pemanfaatan_sip,
        ]);
    }

    // ===== TAMBAHAN: METHOD UNTUK VIEW DOKUMENTASI =====
    public function viewDokumentasi($id)
    {
        $pemanfaatan_sip = PemanfaatanSIP::with(['dokumentasi', 'ip2sip.bsip'])->findOrFail($id);
        
        if ($pemanfaatan_sip->dokumentasi->isEmpty()) {
            return redirect()->back()->with('info', 'Tidak ada dokumentasi yang tersedia');
        }
        
        return view('lp2tp.pemanfaatan.dokumentasi', [
            'pemanfaatan_sip' => $pemanfaatan_sip,
        ]);
    }

    // ===== TAMBAHAN: METHOD UNTUK HAPUS DOKUMENTASI INDIVIDUAL =====
    public function deleteDokumentasi($dokumentasi_id)
    {
        try {
            $dokumentasi = PemanfaatanSipDokumentasi::findOrFail($dokumentasi_id);
            $dokumentasi->delete(); // Auto delete file fisik juga
            
            return response()->json(['success' => true, 'message' => 'Dokumentasi berhasil dihapus']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus dokumentasi: ' . $e->getMessage()]);
        }
    }

    // ===== PRIVATE METHODS UNTUK HANDLE UPLOAD =====
    private function handleDokumentasiUpload(Request $request, PemanfaatanSIP $pemanfaatan_sip)
    {
        $files = $request->file('dokumentasi');
        $descriptions = $request->input('dokumentasi_descriptions', []);
        
        foreach ($files as $index => $file) {
            if ($file && $file->isValid()) {
                // Generate unique filename
                $originalName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '_' . Str::random(10) . '.' . $extension;
                
                // Store file
                $path = $file->storeAs('dokumentasi/pemanfaatan', $filename, 'public');
                
                // Save to database
                $pemanfaatan_sip->dokumentasi()->create([
                    'file_name' => $originalName,
                    'file_path' => $path,
                    'file_type' => $file->getMimeType(),
                    'file_size' => $file->getSize(),
                    'description' => $descriptions[$index] ?? null,
                ]);
            }
        }
    }

    private function handleDokumentasiDelete(array $dokumentasi_ids, PemanfaatanSIP $pemanfaatan_sip)
    {
        $dokumentasi_to_delete = $pemanfaatan_sip->dokumentasi()
                                                ->whereIn('id', $dokumentasi_ids)
                                                ->get();
        
        foreach ($dokumentasi_to_delete as $dokumentasi) {
            $dokumentasi->delete(); // Auto delete file fisik juga
        }
    }
}