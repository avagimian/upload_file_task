<?php

namespace App\Exceptions\Abstract\Parent;

use Exception as BaseException;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Throwable;

abstract class Exception extends BaseException implements HttpExceptionInterface
{
    protected string $environment;
    protected array $errors = [];
    protected array $headers = [
        'Access-Control-Allow-Origin' => '*',
        'Access-Control-Allow-Methods' => 'GET, POST, OPTIONS, PUT, DELETE, PATCH',
        'Access-Control-Allow-Credentials' => 'true',
        'Access-Control-Max-Age' => '86400',
        'Access-Control-Allow-Headers' => 'Content-Type, Authorization, X-Requested-With, Accept, Accept-Encoding, Accept-Language, Cache-Control, Connection, Host, Origin, Pragma, Referer, User-Agent, X-Powered-By',
        'Access-Control-Expose-Headers' => 'Content-Length, X-JSON',
    ];

    public function __construct(
        ?string $message = null,
        ?int $code = null,
        Throwable $previous = null
    ) {
        $this->environment = Config::get('app.env');

        parent::__construct($this->prepareMessage($message), $this->prepareStatusCode($code), $previous);
    }

    /**
     * @param string|null $message
     * @return string
     */
    private function prepareMessage(?string $message = null): string
    {
        return is_null($message) ? $this->message : $message;
    }

    private function prepareStatusCode(?int $code = null): int
    {
        return is_null($code) ? $this->code : $code;
    }

    /**
     * Help developers debug the error without showing these details to the end user.
     * Usage: `throw (new MyCustomException())->debug($e)`.
     *
     * @param $error
     * @param bool $force
     *
     * @return $this
     */
    public function debug($error, bool $force = false): Exception
    {
        if ($error instanceof BaseException) {
            $error = $error->getMessage();
        }

        if ($this->environment !== 'testing' || $force === true) {
            Log::error('[DEBUG] ' . $error);
        }

        return $this;
    }

    public function withErrors(array $errors, bool $override = true): Exception
    {
        if ($override) {
            $this->errors = $errors;
        } else {
            $this->errors = array_merge($this->errors, $errors);
        }

        return $this;
    }

    public function getErrors(): array
    {
        $translatedErrors = [];

        foreach ($this->errors as $key => $value) {
            $translatedValues = [];
            if (is_array($value)) {
                foreach ($value as $translationKey) {
                    $translatedValues[] = __($translationKey);
                }
            } else {
                $translatedValues[] = __($value);
            }

            $translatedErrors[$key] = $translatedValues;
        }

        return $translatedErrors;
    }

    public function getStatusCode(): int
    {
        return $this->code;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function setHeaders(array $headers): Exception
    {
        $this->headers = $headers;

        return $this;
    }
}
