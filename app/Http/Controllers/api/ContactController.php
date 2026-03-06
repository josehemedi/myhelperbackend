<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Mail\ContactMessageMail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nom'     => ['required', 'string', 'max:255'],
            'email'   => ['required', 'email', 'max:255'],
            'message' => ['required', 'string'],
        ]);

        Mail::to('emedisiku@gmail.com')
            ->queue(new ContactMessageMail(
                $validated['nom'],
                $validated['email'],
                $validated['message']
            ));

        return response()->json([
            'success' => true,
            'message' => 'Message envoyé avec succès.',
        ]);
    }
}

