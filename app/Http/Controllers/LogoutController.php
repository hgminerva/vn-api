<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    /**
     * Logout authenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // Revoke the user's current token...
        $request->user()->currentAccessToken()->delete();

        return response()->noContent();
    }
}
