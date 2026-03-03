<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Position;
use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PegawaiController extends Controller
{
    /**
     * List pegawai
     */
    public function index()
    {
        $pegawais = Pegawai::with(['position', 'office'])->get();
        return view('pegawai.index', compact('pegawais'));
    }

    /**
     * Form tambah pegawai
     */
    public function create()
    {
        $positions = Position::all();
        $offices   = Office::all();

        return view('pegawai.create', compact('positions', 'offices'));
    }

    /**
     * Upload CV via Dropzone (AJAX)
     */
    public function uploadCv(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx|max:2048'
        ]);

        $path = $request->file('file')->store('cv', 'public');

        return response()->json([
            'path' => $path
        ]);
    }

    /**
     * Simpan data pegawai
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'position_id'   => 'required|exists:positions,id',
            'office_id'     => 'required|exists:offices,id',
            'tanggal_lahir' => 'required|date',
            'cv'            => 'nullable|string|max:255'
        ]);

        try {

            Pegawai::create([
                'name'          => $request->name,
                'position_id'   => $request->position_id,
                'office_id'     => $request->office_id,
                'tanggal_lahir' => $request->tanggal_lahir,
                'cv'            => $request->cv,
            ]);

            return redirect()
                ->route('pegawai.index')
                ->with('success', 'Pegawai berhasil ditambahkan');

        } catch (\Exception $e) {

            // Optional: hapus file jika gagal simpan
            if ($request->cv && Storage::disk('public')->exists($request->cv)) {
                Storage::disk('public')->delete($request->cv);
            }

            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }

    /**
     * Hapus CV jika user remove file (AJAX)
     */
    public function deleteCv(Request $request)
    {
        if ($request->path && Storage::disk('public')->exists($request->path)) {
            Storage::disk('public')->delete($request->path);
        }

        return response()->json([
            'status' => 'ok'
        ]);
    }
}