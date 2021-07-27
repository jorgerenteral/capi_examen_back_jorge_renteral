<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function get()
    {
        $users = User::with('domicilio')->get();

        return response()->json($users);
    }
}
