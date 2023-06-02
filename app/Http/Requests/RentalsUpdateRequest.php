<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RentalsUpdateRequest extends FormRequest
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
            'user_id' => ['required', 'exists:users,id'],
            'video_id' => ['required', 'exists:videos,id'],
            'type' => ['required', 'max:255', 'string'],
            'total_value' => ['required', 'numeric'],
            'view_limit' => ['required', 'numeric'],
        ];
    }
}
