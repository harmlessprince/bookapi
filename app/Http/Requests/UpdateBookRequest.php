<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['sometimes', 'string', 'max:200'],
            'isbn' => ['sometimes', 'string', 'max:10'],
            'authors' => ['sometimes', 'array'],
            'number_of_pages' => ['sometimes', 'integer', 'min:1'],
            'country' => ['sometimes', 'string', 'max:50'],
            'publisher' => ['sometimes', 'string', 'max:200'],
            'release_date' => ['sometimes', 'date', 'max:200'],
        ];
    }
}
