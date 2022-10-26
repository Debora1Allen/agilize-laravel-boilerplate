<?php

namespace App\Packages\Aluno\Request;

use Illuminate\Foundation\Http\FormRequest;

class AlunoFormRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nome' => 'string|required',
        ];
    }

}