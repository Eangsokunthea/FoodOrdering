<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class userController extends Controller
{
    public function manage(){
        $users = User::all();
        return view('BackEnd.user.user', compact('users'));
    }
}
