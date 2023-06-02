<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoStoreRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'max:255', 'string'],
            'attributes' => ['required', 'max:255', 'string'],
            'original_language' => ['required', 'max:255', 'string'],
            'classification' => ['required', 'max:255', 'string'],
            'series_id' => ['nullable', 'exists:series,id'],
        ];
    }
}
