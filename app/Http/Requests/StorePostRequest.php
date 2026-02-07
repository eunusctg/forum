<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'parent_id' => 'nullable|exists:posts,id',
            'body_markdown' => 'required|string|min:2|max:20000',
        ];
    }
}
