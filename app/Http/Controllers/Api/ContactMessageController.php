<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
            'consent_privacy' => ['accepted'], // obligatorio
            'consent_commercial' => ['nullable', 'boolean'],
            'lang' => ['nullable', 'in:es,en,fr'],
        ]);

        $contact = Contact::create([
            ...$data,
            'consent_commercial' => (bool)($data['consent_commercial'] ?? false),
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        $contact->notifyAdmin();

        return response()->json([
            'success' => true,
            'message' => 'Mensaje enviado correctamente.',
        ]);
    }
}
