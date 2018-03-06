<?php

namespace App\Http\Middleware;

use Closure;
//thêm thư viện Auth
use Illuminate\Support\Facades\Auth;

class AdminLoginMiddleware
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
        if(Auth::check())
        {   
            $user = Auth::user();
            //nếu user->quyen bằng 1 thì được vào trang admin
            if($user->quyen == 1)
            {
                 return $next($request);
            }else
            {   //ngược lại chuyển hướng dăng nhập
                return redirect("admin/dangnhap");
            }
           
        }else 
        {
            return redirect("admin/dangnhap");
        }
     
    }
}
