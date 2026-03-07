<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Mail\ContactMessageMail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Throwable;

class ContactController extends Controller
{
    public function send(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nom'     => ['required', 'string', 'max:255'],
            'email'   => ['required', 'email', 'max:255'],
            'message' => ['required', 'string'],
        ]);

        try {
            Mail::to('emedisiku@gmail.com')
                ->send(new ContactMessageMail(
                    $validated['nom'],
                    $validated['email'],
                    $validated['message']
                ));
        } catch (Throwable $exception) {
            report($exception);

            return response()->json([
                'success' => false,
                'message' => 'Le message n\'a pas pu etre envoye pour le moment.',
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Message envoye avec succes.',
        ]);
    }
}
