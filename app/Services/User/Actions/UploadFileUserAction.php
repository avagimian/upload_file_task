<?php

namespace App\Services\User\Actions;

use App\Enums\FileFormatsEnum;
use App\Exceptions\UnsupportedFileFormatException;
use App\Jobs\User\SaveUsersJob;
use App\Models\User;
use App\Services\FileParsers\CsvFileParser;
use App\Services\FileProcessorService;
use App\Services\User\Dto\UploadFileUserDto;

class UploadFileUserAction
{
    /**
     * @throws UnsupportedFileFormatException
     */
    public function run(UploadFileUserDto $dto): void
    {
        $fileExtension = $dto->file->getClientOriginalExtension();
        $parser = match ($fileExtension) {
            FileFormatsEnum::CSV->value => new CsvFileParser(),
            default => throw new UnsupportedFileFormatException(),
        };

        $fileProcessor = new FileProcessorService($parser);
        $parsedData = $fileProcessor->process($dto->file->getPathname());

        $chunks = array_chunk($parsedData, User::CHUNK_LIMIT);

        foreach ($chunks as $chunk) {
            SaveUsersJob::dispatch($chunk);
        }
    }
}
