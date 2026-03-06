<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response as LaravelResponse;
use Symfony\Component\HttpFoundation\Response;

class CorsMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $allowedOrigins = array_values(array_filter(array_map('trim', explode(',', (string) env(
            'CORS_ALLOWED_ORIGINS',
            'http://localhost:8080,https://myhelper-platform01.vercel.app'
        )))));

        $origin = $request->headers->get('Origin');
        $isAllowedOrigin = is_string($origin) && in_array($origin, $allowedOrigins, true);

        if ($request->getMethod() === 'OPTIONS') {
            $response = new LaravelResponse('', 204);
            return $this->withCorsHeaders($response, $origin, $isAllowedOrigin);
        }

        /** @var \Symfony\Component\HttpFoundation\Response $response */
        $response = $next($request);
        return $this->withCorsHeaders($response, $origin, $isAllowedOrigin);
    }

    private function withCorsHeaders(Response $response, ?string $origin, bool $isAllowedOrigin): Response
    {
        if ($isAllowedOrigin && $origin !== null) {
            $response->headers->set('Access-Control-Allow-Origin', $origin);
            $response->headers->set('Vary', 'Origin');
        }

        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With');
        $response->headers->set('Access-Control-Allow-Credentials', 'false');

        return $response;
    }
}

