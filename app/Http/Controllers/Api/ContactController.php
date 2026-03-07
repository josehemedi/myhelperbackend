<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Mail\ContactMessageMail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
            Log::error('Contact email send failed.', [
                'error' => $exception->getMessage(),
                'mailer' => config('mail.default'),
                'mail_host' => config('mail.mailers.smtp.host'),
                'mail_port' => config('mail.mailers.smtp.port'),
                'mail_username_configured' => filled(config('mail.mailers.smtp.username')),
                'mail_from' => config('mail.from.address'),
            ]);
            report($exception);

            $response = [
                'success' => false,
                'message' => 'Le message n\'a pas pu etre envoye pour le moment.',
            ];

            if (config('app.debug') || env('MAIL_DEBUG_EXCEPTIONS', false)) {
                $response['error'] = $exception->getMessage();
                $response['exception'] = $exception::class;
            }

            return response()->json($response, 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Message envoye avec succes.',
        ]);
    }
}
