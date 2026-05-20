<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CertificateController extends Controller
{
    public function index(): View
    {
        $certificates = Certificate::query()
            ->orderByDesc('issued_at')
            ->orderByDesc('id')
            ->get();

        return view('admin.certificates.index', [
            'certificates' => $certificates,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'issuer' => ['nullable', 'string', 'max:255'],
            'credential_id' => ['nullable', 'string', 'max:255', 'unique:certificates,credential_id'],
            'issued_at' => ['nullable', 'date'],
            'expires_at' => ['nullable', 'date', 'after_or_equal:issued_at'],
            'verify_url' => ['nullable', 'url', 'max:255'],
            'certificate_file' => ['nullable', 'file', 'max:10240', 'mimetypes:application/pdf,image/jpeg,image/png,image/webp'],
        ]);

        $file = $request->file('certificate_file');
        if ($file) {
            $validated['file_path'] = $file->store('certificates', 'public');
            $validated['file_original_name'] = $file->getClientOriginalName();
            $validated['file_mime_type'] = $file->getMimeType();
        }

        Certificate::query()->create($validated);

        return back()->with('status', 'Certificate added.');
    }

    public function edit(Certificate $certificate): View
    {
        return view('admin.certificates.edit', [
            'certificate' => $certificate,
        ]);
    }

    public function update(Request $request, Certificate $certificate): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'issuer' => ['nullable', 'string', 'max:255'],
            'credential_id' => ['nullable', 'string', 'max:255', 'unique:certificates,credential_id,'.$certificate->id],
            'issued_at' => ['nullable', 'date'],
            'expires_at' => ['nullable', 'date', 'after_or_equal:issued_at'],
            'verify_url' => ['nullable', 'url', 'max:255'],
            'certificate_file' => ['nullable', 'file', 'max:10240', 'mimetypes:application/pdf,image/jpeg,image/png,image/webp'],
            'remove_file' => ['nullable', 'boolean'],
        ]);

        if ($request->boolean('remove_file') && $certificate->file_path) {
            Storage::disk('public')->delete($certificate->file_path);
            $validated['file_path'] = null;
            $validated['file_original_name'] = null;
            $validated['file_mime_type'] = null;
        }

        $file = $request->file('certificate_file');
        if ($file) {
            if ($certificate->file_path) {
                Storage::disk('public')->delete($certificate->file_path);
            }

            $validated['file_path'] = $file->store('certificates', 'public');
            $validated['file_original_name'] = $file->getClientOriginalName();
            $validated['file_mime_type'] = $file->getMimeType();
        }

        $certificate->update($validated);

        return redirect()->route('admin.certificates.index')->with('status', 'Certificate updated.');
    }

    public function destroy(Certificate $certificate): RedirectResponse
    {
        if ($certificate->file_path) {
            Storage::disk('public')->delete($certificate->file_path);
        }

        $certificate->delete();

        return back()->with('status', 'Certificate deleted.');
    }
}
