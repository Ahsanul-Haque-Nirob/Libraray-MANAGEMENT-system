<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $authorId = $this->route('author')?->id;

        return [
            'name'        => ['required', 'string', 'max:255'],
            'email'       => ['nullable', 'email', 'max:255', 'unique:authors,email,' . $authorId],
            'bio'         => ['nullable', 'string', 'max:2000'],
            'nationality' => ['nullable', 'string', 'max:100'],
            'birth_date'  => ['nullable', 'date', 'before:today'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'      => 'Author name is required.',
            'email.email'        => 'Please enter a valid email address.',
            'email.unique'       => 'This email is already registered to another author.',
            'birth_date.before'  => 'Birth date must be in the past.',
        ];
    }
}
