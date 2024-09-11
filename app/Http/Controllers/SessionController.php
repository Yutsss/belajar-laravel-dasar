<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function createSession(Request $request): string
    {
        $request->session()->put('userId', 'Yuta');
        $request->session()->put('isMember', 'true');

        return 'Session created';
    }

    public function getSession(Request $request): string
    {
        $userId = $request->session()->get('userId');
        $isMember = $request->session()->get('isMember');

        return "User ID: $userId, Member: $isMember";
    }
}
