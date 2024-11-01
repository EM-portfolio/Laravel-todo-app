<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


// 既にログインしているユーザーがログインページ等にアクセスしたときのリダイレクト先を決める
// 既に認証しているユーザーが認証が必要なページにアクセスした場合の処理
class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // 既に認証しているユーザーが認証が必要なページにアクセスした場合の処理
        if (Auth::guard($guard)->check()) {
            return redirect('/');
        }
        // 認証されてない人の処理
        return $next($request);
    }
}
