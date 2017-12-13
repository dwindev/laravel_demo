<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class PlayController extends Controller
{
    public function index(Request $request)
    {
        $users = User::with(['posts'])->get();
        // $users = $users->chunk(100, function ($users) {
        // });
        return view('play');
    }
}
