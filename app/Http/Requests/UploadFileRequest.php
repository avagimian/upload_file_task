<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

class UploadFileRequest extends FormRequest
{
    const FILE = 'file';

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            self::FILE => [
                'required',
                'file',
                'mimes:csv,txt',
            ],
        ];
    }

    public function getFile(): UploadedFile
    {
        return $this->file(self::FILE);
    }
}
