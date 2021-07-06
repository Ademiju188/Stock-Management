<?php

namespace App\Http\Controllers;

use App\Models\stock;


use Illuminate\Http\Client\Response;


use Illuminate\Http\Request;

class PagesControllers extends Controller
{
    public function showuser()
    {
        return view('user.profile');
    }
}
