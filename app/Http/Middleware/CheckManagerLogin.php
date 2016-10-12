<?php

namespace App\Http\Middleware;

use Closure;

class CheckManagerLogin
{
    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $admin = $request->session()->get('admin', '');
        if(!$admin || $admin->role != '管理员') {
            return redirect('/');
        }
        return $next($request);
    }
}
