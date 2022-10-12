<?php

namespace App\Packages\Prova\Request;

use Illuminate\Foundation\Http\FormRequest;

class ProvaFormRequest extends FormRequest
{
    public function rules()
    {
        return [
            'tema' => 'required|string',
        ];
    }
}