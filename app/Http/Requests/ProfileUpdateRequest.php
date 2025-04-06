<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:10000'],
        ];

        if ($this->filled('current_password')) {
            $rules += [
                'current_password' => ['required', 'string', 'current_password'],
                'password' => ['required', 'string', 'confirmed', 'different:current_password', 'min:8'],
                'password_confirmation' => ['required', 'string'],
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'current_password.current_password' => 'The current password is incorrect.',
            'password.different' => 'The new password must be different from your current password.',
        ];
    }
}
