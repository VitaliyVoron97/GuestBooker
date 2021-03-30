<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:2|max:255',
            'email' => 'required|email',
            'text' => 'required|string|min:1|max:3000',
            'url' => 'string|min:3|max:255|nullable',
            'notify_email' => 'boolean|nullable',
            'hidden_email' => 'boolean|nullable'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Введите своё имя',
            'name.min' => 'Имя слишком короткое',
            'name.max' => 'Имя слишком длинное',
            'email.required' => 'Введите свой email',
            'email.email' => 'Введите корректный email',
            'text.required' => 'Вы не ввели сообщение',
            'text.min' => 'Вы слишком короткое сообщение',
            'text.max' => 'Вы слишком длинное сообщение',
            'url.min' => 'Слишком короткая ссылка',
            'url.max' => 'Слишком длинная ссылка',
        ];
    }
}
