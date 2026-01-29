<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Http\JsonResponse;

class LoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        // Redirect admins to dashboard
        if (auth()->user()->role_id === 1) {
            return $request->wantsJson()
                ? new JsonResponse('', 200)
                : redirect()->route('admin.dashboard');
        }

        // Redirect others to home page
        return $request->wantsJson()
            ? new JsonResponse('', 200)
            : redirect()->route('home');
    }
}
