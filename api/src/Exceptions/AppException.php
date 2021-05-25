<?php

declare(strict_types=1);

namespace App\Exceptions;

/**
 * Базовое исключение для приложения
 * Class AppException
 * @package App\Exceptions
 */
class AppException extends \Exception
{
    /**
     * AppException constructor.
     * @param string $message - сообщение о проблеме
     * @param int    $code    - код  ошибки
     */
    public function __construct(string $message, int $code = 500)
    {
        parent::__construct($message, $code);
    }
}
