<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function v1_auththenticate(Request $request)
    {
        $cek = DB::table('user_mains')->where('username', $request->username)->where('password', $request->token)->first();
        if ($cek) {
            return false;
        } else {
            return false;
        }

    }
}
