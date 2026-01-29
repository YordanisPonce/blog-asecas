<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class WorkWithUsMessageController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'speciality' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],

            'cv' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:5120'], // 5MB

            'consent_privacy' => ['accepted'],
            'consent_commercial' => ['nullable', 'boolean'],
            'lang' => ['nullable', 'in:es,en,fr'],
        ]);

        $cvPath = null;
        $cvOriginalName = null;
        $cvMime = null;

        if ($request->hasFile('cv')) {
            $file = $request->file('cv');
            $cvPath = $file->store('contact/cv', 'public');
            $cvOriginalName = $file->getClientOriginalName();
            $cvMime = $file->getMimeType();
        }

        $contact = Contact::create([
            'type' => 'work',
            'subject' => 'Trabaja con nosotros',
            ...$data,
            'consent_commercial' => (bool)($data['consent_commercial'] ?? false),
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'cv_path' => $cvPath,
            'cv_original_name' => $cvOriginalName,
            'cv_mime' => $cvMime,
        ]);

        $contact->notifyAdmin();

        return response()->json([
            'success' => true,
            'message' => 'Candidatura enviada correctamente.',
        ]);
    }
}
