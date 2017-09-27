<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ManagementController extends Controller
{
    public function index()
    {
        $template = 'manage.admin';
        $users = User::all();
        return view($template)->with(compact('users'));
    }

    public function user($userId)
    {
        # code...
    }
}
