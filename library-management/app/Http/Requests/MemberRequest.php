<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $memberId = $this->route('member')?->id;

        return [
            'name'             => ['required', 'string', 'max:255'],
            'email'            => ['required', 'email', 'max:255', 'unique:members,email,' . $memberId],
            'phone'            => ['nullable', 'string', 'max:20'],
            'address'          => ['nullable', 'string', 'max:500'],
            'membership_start' => ['required', 'date'],
            'membership_end'   => ['required', 'date', 'after:membership_start'],
            'status'           => ['required', 'in:active,inactive,suspended'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'             => 'Member name is required.',
            'email.required'            => 'Email address is required.',
            'email.unique'              => 'This email is already registered.',
            'membership_start.required' => 'Membership start date is required.',
            'membership_end.required'   => 'Membership end date is required.',
            'membership_end.after'      => 'Membership end date must be after the start date.',
            'status.in'                 => 'Invalid status selected.',
        ];
    }
}
