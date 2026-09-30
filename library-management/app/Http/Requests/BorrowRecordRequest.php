<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BorrowRecordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // On update we only allow adjusting due_date and notes
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            return [
                'due_date' => ['required', 'date', 'after:today'],
                'notes'    => ['nullable', 'string', 'max:1000'],
            ];
        }

        return [
            'book_id'     => ['required', 'exists:books,id'],
            'member_id'   => ['required', 'exists:members,id'],
            'borrow_date' => ['required', 'date'],
            'due_date'    => ['required', 'date', 'after:borrow_date'],
            'notes'       => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'book_id.required'     => 'Please select a book.',
            'book_id.exists'       => 'Selected book does not exist.',
            'member_id.required'   => 'Please select a member.',
            'member_id.exists'     => 'Selected member does not exist.',
            'borrow_date.required' => 'Borrow date is required.',
            'due_date.required'    => 'Due date is required.',
            'due_date.after'       => 'Due date must be after the borrow date.',
        ];
    }
}
