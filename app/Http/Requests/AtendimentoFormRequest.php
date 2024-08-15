<?php

namespace App\Http\Requests;

use App\Helpers\Helpers;
use Illuminate\Foundation\Http\FormRequest;

class AtendimentoFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'cep' => 'required',
            'nome' => 'required',
            'cpf' => 'required',
            'whatsapp' => 'required',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'cep' => Helpers::removeSpecialCharacter($this->cep),
            'nome' => mb_strtoupper($this->nome),
            'cpf' => Helpers::removeSpecialCharacter($this->cpf),
            'whatsapp' => Helpers::removeSpecialCharacter($this->whatsapp),
            'contato' => Helpers::removeSpecialCharacter($this->contato),
        ]);
    }
}
