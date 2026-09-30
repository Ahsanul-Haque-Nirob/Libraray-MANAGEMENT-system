<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $bookId = $this->route('book')?->id;

        return [
            'title'          => ['required', 'string', 'max:255'],
            'isbn'           => ['required', 'string', 'max:20', 'unique:books,isbn,' . $bookId],
            'author_id'      => ['required', 'exists:authors,id'],
            'category_id'    => ['required', 'exists:categories,id'],
            'description'    => ['nullable', 'string', 'max:5000'],
            'publisher'      => ['nullable', 'string', 'max:255'],
            'published_year' => ['nullable', 'integer', 'min:1000', 'max:' . date('Y')],
            'total_copies'   => ['required', 'integer', 'min:1'],
            'available_copies' => ['required', 'integer', 'min:0', 'lte:total_copies'],
            'cover_image'    => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'status'         => ['required', 'in:available,unavailable'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'           => 'Book title is required.',
            'isbn.required'            => 'ISBN is required.',
            'isbn.unique'              => 'This ISBN already exists in the system.',
            'author_id.required'       => 'Please select an author.',
            'author_id.exists'         => 'Selected author does not exist.',
            'category_id.required'     => 'Please select a category.',
            'category_id.exists'       => 'Selected category does not exist.',
            'published_year.max'       => 'Published year cannot be in the future.',
            'available_copies.lte'     => 'Available copies cannot exceed total copies.',
            'cover_image.image'        => 'Cover must be an image file.',
            'cover_image.max'          => 'Cover image must be under 2MB.',
        ];
    }
}
