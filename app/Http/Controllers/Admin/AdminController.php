<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('pages.admin.tournament');
    }

    public function profile()
    {
        return view('pages.admin.profile');
    }

    public function config()
    {
        return view('pages.admin.config');
    }
}