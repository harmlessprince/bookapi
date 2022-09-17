<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:200'],
            'isbn' => ['required', 'string', 'max:10'],
            'authors' => ['required', 'array'],
            'number_of_pages' => ['required', 'integer', 'min:1'],
            'country' => ['required', 'string', 'max:50'],
            'publisher' => ['required', 'string', 'max:200'],
            'release_date' => ['required', 'date', 'max:200'],
        ];
    }
}
