<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactInfoRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'info_type' => 'required|in:email,phone,location',
            'info_value' => 'required|max:255',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
