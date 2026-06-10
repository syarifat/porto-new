<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = Certificate::orderBy('issued_date', 'desc')->get();
        return view('admin.certificates.index', compact('certificates'));
    }

    public function create()
    {
        return view('admin.certificates.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'          => 'required|string|max:255',
            'issued_by'      => 'nullable|string|max:255',
            'issued_date'    => 'nullable|date',
            'image'          => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'credential_id'  => 'nullable|string|max:255',
            'credential_url' => 'nullable|url|max:500',
        ], [
            'title.required'  => 'Judul sertifikat wajib diisi.',
            'image.required'  => 'Gambar sertifikat wajib diupload.',
            'image.image'     => 'File harus berupa gambar.',
            'image.max'       => 'Gambar maksimal 5MB.',
        ]);

        $imagePath = $request->file('image')->store('certificates', 'public');

        Certificate::create([
            'title'          => $request->title,
            'issued_by'      => $request->issued_by,
            'issued_date'    => $request->issued_date,
            'image_path'     => $imagePath,
            'credential_id'  => $request->credential_id,
            'credential_url' => $request->credential_url,
        ]);

        return redirect()->route('admin.certificates.index')->with('success', 'Sertifikat berhasil ditambahkan!');
    }

    public function edit(Certificate $certificate)
    {
        return view('admin.certificates.edit', compact('certificate'));
    }

    public function update(Request $request, Certificate $certificate)
    {
        $request->validate([
            'title'          => 'required|string|max:255',
            'issued_by'      => 'nullable|string|max:255',
            'issued_date'    => 'nullable|date',
            'image'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'credential_id'  => 'nullable|string|max:255',
            'credential_url' => 'nullable|url|max:500',
        ]);

        $data = $request->except(['image', '_method', '_token']);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($certificate->image_path);
            $data['image_path'] = $request->file('image')->store('certificates', 'public');
        }

        $certificate->update($data);

        return redirect()->route('admin.certificates.index')->with('success', 'Sertifikat berhasil diperbarui!');
    }

    public function destroy(Certificate $certificate)
    {
        Storage::disk('public')->delete($certificate->image_path);
        $certificate->delete();

        return redirect()->route('admin.certificates.index')->with('success', 'Sertifikat berhasil dihapus!');
    }
}
