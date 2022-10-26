<?php

namespace App\Packages\Prova\Request;

use Illuminate\Foundation\Http\FormRequest;


class RespostaFormRequest extends FormRequest
{
    public function rules()
    {
        return [
            'repostas' => 'required|array',
            'repostas.*.repostas' => 'required|string',
            'repostas.*.isCorreta' => 'required|boolean',
        ];
    }

}