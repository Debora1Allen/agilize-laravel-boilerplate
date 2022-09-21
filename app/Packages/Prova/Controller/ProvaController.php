<?php

namespace App\Packages\Prova\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProvaController extends Controller
{
    public function __construct()
    {

    }

    public function index(Request $request)
    {
        return 'aqui prova';
    }
}