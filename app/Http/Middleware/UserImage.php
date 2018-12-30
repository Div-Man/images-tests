<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\Image;
use Illuminate\Support\Facades\Auth;

class UserImage
{
    /**
     * Тут проверяется
     * принадлежит ли пост данному пользователю
     */
    public function handle($request, Closure $next)
    {
        $image = Image::find($request->id)->id_user;
        $user = Auth::user()->id;
        
        if($image == $user) {
            return $next($request);
        }
        abort(404);
    }
}
