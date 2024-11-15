<?php

namespace App\Exceptions\Abstract;

use App\Exceptions\Abstract\Parent\Exception as AbstractException;

abstract class Exception extends AbstractException
{
    protected ?string $text = null;
    protected string $scope = 'E_COMMON';
    protected string $textCode = 'E_SOMETHING_WENT_WRONG';
    protected array $headers = [];

    public function getText(): ?string
    {
        return __($this->text);
    }

    public function getScope(): string
    {
        return $this->scope;
    }

    public function getTextCode(): string
    {
        return $this->textCode;
    }
}
