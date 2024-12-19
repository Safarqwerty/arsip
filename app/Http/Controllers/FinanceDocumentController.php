<?php

namespace App\Http\Controllers;

use App\Models\FinanceDocument;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FinanceDocumentController extends Controller
{
    public function dashboard()
    {
        $totalArchives = FinanceDocument::count();
        $totalCategories = Kategori::count();

        return view('dashboard', compact('totalArchives', 'totalCategories'));
    }

    public function index(Request $request)
    {
        $query = FinanceDocument::query();

        // Filter berdasarkan kategori
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // Pencarian berdasarkan nama arsip atau kode arsip
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_arsip', 'like', '%' . $request->search . '%')
                  ->orWhere('kode_arsip', 'like', '%' . $request->search . '%');
            });
        }

        $categories = Kategori::all(); // Untuk dropdown kategori
        $documents = $query->paginate(10);

        return view('finance-documents.index', compact('documents', 'categories'));
    }

    public function create()
    {
        // Ambil semua data kategori dari tabel 'kategoris'
        $kategoris = Kategori::all();

        // Pass data kategoris ke tampilan create
        return view('finance-documents.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_arsip' => 'required|string|unique:finance_documents,kode_arsip',
            'nama_arsip' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx,csv,xls,xlsx|max:2048',
        ]);

        // Create the finance document record and assign user_id
        $document = new FinanceDocument();
        $document->kode_arsip = $request->kode_arsip;
        $document->nama_arsip = $request->nama_arsip;
        $document->kategori = $request->kategori;
        $document->keterangan = $request->keterangan;

        // Handle the file upload
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('documents', 'public');
            $document->file_path = $filePath;
        }

        // Assign the user_id of the currently authenticated user
        $document->user_id = Auth::id();

        // Save the document
        $document->save();

        return redirect()->route('finance-documents.index')->with('success', 'Arsip berhasil ditambahkan!');
    }

    public function edit($id)
    {
        // Mengambil data dokumen berdasarkan ID
        $document = FinanceDocument::findOrFail($id);

        return view('finance-documents.edit', compact('document'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'kode_arsip' => 'required|string|max:255',
            'nama_arsip' => 'required|string|max:255',
            'kategori' => 'required|string',
            'keterangan' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:10240', // Sesuaikan dengan jenis file yang diinginkan
        ]);

        // Ambil data dokumen berdasarkan ID
        $document = FinanceDocument::findOrFail($id);

        // Mengupdate data dokumen
        $document->kode_arsip = $validated['kode_arsip'];
        $document->nama_arsip = $validated['nama_arsip'];
        $document->kategori = $validated['kategori'];
        $document->keterangan = $validated['keterangan'];

        // Jika ada file yang diupload
        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($document->file_path) {
                Storage::disk('public')->delete($document->file_path);
            }

            // Simpan file baru
            $filePath = $request->file('file')->store('documents', 'public');
            $document->file_path = $filePath;
        }

        // Simpan perubahan ke database
        $document->save();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('finance-documents.index')->with('success', 'Dokumen berhasil diperbarui!');
    }

    public function show($id)
    {
        $document = FinanceDocument::findOrFail($id);
        return view('finance-documents.show', compact('document'));
    }

    public function destroy($id)
    {
        // Ambil data dokumen berdasarkan ID
        $document = FinanceDocument::findOrFail($id);

        // Hapus file yang ada di storage jika ada
        if ($document->file) {
            unlink(storage_path('app/public/' . $document->file));
        }

        // Hapus dokumen dari database
        $document->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('finance-documents.index')->with('success', 'Dokumen berhasil dihapus!');
    }

    public function download(FinanceDocument $financeDocument)
    {
        $filePath = Storage::disk('public')->path($financeDocument->file_path);

        // Check if the file exists before attempting to download it
        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            return redirect()->route('finance-documents.index')->with('error', 'File not found.');
        }
    }

}
