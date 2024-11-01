<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class sessionsMiddle
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $authID = Session::getId();

        $activesession = DB::table('sessions')
            ->where('id', '=', $authID)
            ->leftJoin('dbo_conecction_sys', 'sessions.id', '=', 'dbo_conecction_sys.sessions_id')
            ->select('sessions.ip_address', 'dbo_conecction_sys.conecction_ip')
            ->first();

        if ($activesession && $activesession->conecction_ip != $request->ip()) {
            return response()->json(['error' => 'Ya tienes una sesion abierta en otro dispositivo']);
        }

        return $next($request);
    }
}
