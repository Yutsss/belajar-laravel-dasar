<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CookieController extends Controller
{
    public function createCookie(Request $request): Response
    {
        return response('Hello World')
            ->cookie('User-id', 'Yuta', 1000, '/')
            ->cookie('Is-Member', 'true', 1000, '/');
    }
}
