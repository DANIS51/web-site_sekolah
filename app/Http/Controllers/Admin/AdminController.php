<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    // AdminController is now empty as methods have been moved to separate controllers
}
