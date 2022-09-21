<?php

namespace App\Packages\Aluno\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    public function __construct()
    {

    }

    public function index(Request $request)
    {
        return 'aqui';
    }
    
}