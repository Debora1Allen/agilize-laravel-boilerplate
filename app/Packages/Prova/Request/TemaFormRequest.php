<?php

namespace App\Packages\Prova\Request;

use Illuminate\Foundation\Http\FormRequest;

class TemaFormRequest extends FormRequest
{
    public function rules()
    {
        return [
            'nome' => 'required|string',
            'slugname' => 'required|string',
        ];
    }

}