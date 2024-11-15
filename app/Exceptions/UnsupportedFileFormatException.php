<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class UnsupportedFileFormatException extends BusinessLogicException
{
    protected $code = Response::HTTP_INTERNAL_SERVER_ERROR;
    protected string $scope = 'E_ACT';
    protected string $textCode = 'E_ACT_NOT_UPDATE';
    protected $message;

    public function __construct()
    {
        $this->message = __('errors.unsupported_file_format');
        parent::__construct($this->message, $this->code);
    }
}
