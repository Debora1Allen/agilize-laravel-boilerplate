<?php

namespace App\Packages\Prova\Request;

use Illuminate\Foundation\Http\FormRequest;

class QuestaoFormRequest extends FormRequest
{
    public function rules()
    {
        return [
            'tema' => 'required|string',
            'pergunta' => 'required|string',
        ];
    }
}