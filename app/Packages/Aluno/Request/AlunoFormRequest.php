<?php
//
//namespace App\Packages\Aluno\Request;
//
//
//use Illuminate\Foundation\Http\FormRequest;
//use Illuminate\Http\Request;
//
//class AlunoFormRequest extends FormRequest
//{
//
//    public function authorize(): bool
//    {
//        return true;
//    }
//
//    public function rules(Request $request): array
//    {
//        return [
//            'nome' => ['required', $request->get('nome')],
//            'email' => ['required', $request->get('email')],
//            'telefone' => ['required', $request->get('telefone')]
//        ];
//    }
//}