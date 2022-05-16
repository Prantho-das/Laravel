<?php

namespace App\Http\Middleware;

use App\Models\visitor;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class visitorCount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $ip = request()->ip();
        $visitor = visitor::where('ip', $ip)->first();
        if (!$visitor) {
            $address = (array) json_decode(Http::get('http://ip-api.com/json/' . $ip));
            if ($address['status'] === 'success') {
                visitor::create([
                    'ip' => $ip,
                    'location' => $address['city']
                ]);
            } else {
                visitor::create([
                    'ip' => $ip,
                    'location' => "Dhaka"
                ]);
            }
            return $next($request);
        }
        return $next($request);
    }
}
