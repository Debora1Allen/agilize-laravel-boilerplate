<?php

namespace App\Packages\Prova\Request;

use Illuminate\Foundation\Http\FormRequest;

class RespostaFormRequest extends FormRequest
{
    public function rules()
    {
        return [
            'alternativas' => 'required|array',
            'alternativas.*.alternativa' => 'required|string',
            'alternativas.*.isCorreta' => 'required|boolean',
        ];
    }
}