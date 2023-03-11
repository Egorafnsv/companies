<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AddCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (Auth::user()){
            $perm = true;
        }
        else{
            $perm = false;
        }
        return $perm;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'INN' => 'required|digits:10',
            'gen_desc' => 'required',
            'director' => 'required|max:50',
            'address' => 'required|max:255',
            'number' => 'required|max:25|regex:/^^\+?\d+(-?\d+)*$/u',
        ];
    }

    public function messages(): array
    {
        return [
            'INN.digits' => 'Некорректный формат ИНН',
            'number.regex' => 'Ожидаемые форматы номера телефона: +7911000..., 7911000..., +7-911-000-...',
        ];
    }
}