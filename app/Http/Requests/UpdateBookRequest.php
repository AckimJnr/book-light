<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;


class UpdateBookRequest extends FormRequest
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
            'title' => 'sometimes|required|string|max:255',
            'total_pages' => 'sometimes|required|integer',
            'rating' => 'sometimes|required|numeric',
            'isbn' => 'sometimes|required|string|max:255',
            'publisher' => 'sometimes|required|string|max:255',
            'published_date' => 'sometimes|required|date',
            'book_url' => 'sometimes|required|string|max:255',
            'author_name' => 'sometimes|required|string|max:255',
            'author_id' => 'sometimes|required|integer|exists:authors,author_id',
        ];
    }
}