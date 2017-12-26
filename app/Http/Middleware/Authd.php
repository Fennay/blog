<?php
/**
 * Created by PhpStorm.
 * Author: Fengguangyong
 * Date: 2017/12/15 - 14:13
 */

namespace App\Http\Middleware;

use Closure;

class Authd
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $username = session('username');
        $uid = session('uid');
        if(empty($username) || empty($uid)){
            return redirect('/login');
        }

        return $next($request);
    }
}