<?php

namespace App\Services\User\Dto;

use App\Http\Requests\UploadFileRequest;
use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Data;

class UploadFileUserDto extends Data
{
    public UploadedFile $file;

    public static function fromRequest(UploadFileRequest $request): self
    {
        return self::from([
            'file' => $request->getFile(),
        ]);
    }
}
