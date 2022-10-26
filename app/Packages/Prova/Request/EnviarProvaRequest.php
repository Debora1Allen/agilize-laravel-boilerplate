<?php

namespace App\Packages\Prova\Request;

use Illuminate\Foundation\Http\FormRequest;

class EnviarProvaRequest extends FormRequest
{

    public function rules()
    {
        return [
            'respostas' => 'required|array',
            'respostas.*.questaoId' => 'required',
            'respostas.*.respostaAluno' => 'required|string',
        ];
    }

}