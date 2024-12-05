<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index () 
    {
        $webUsers = User::where("user_type", 'web_user')->get();
        return view("admin.users.index", compact('webUsers'));
    }
}
