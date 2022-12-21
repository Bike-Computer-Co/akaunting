<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;
use JetBrains\PhpStorm\ArrayShape;

class UploadFileRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['file' => 'array'])]
    public function rules(): array
    {
        return [
            'file' => ['required', File::types('pdf')],
        ];
    }
}
