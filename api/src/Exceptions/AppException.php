<?php
/**
 * Исключение выбрасываемое приложением в ситуациях когда не определено иное исключение приложения
 * Так же является базовым для других исключений приложения.
 * PHP version 7.4.1.
 *
 * @category Application
 *
 * @author  sanerrus <username@example.com>
 * @license MIT http://www.example.com/License.txt
 *
 * @see http://www.example.com/Document.txt
 */
declare(strict_types=1);

namespace App\Exceptions;

class AppException extends \Exception
{
    /**
     * AppException constructor.
     *
     * @param string $message - сообщение о проблеме
     * @param int    $code    - код  ошибки
     */
    public function __construct(string $message, int $code = 500)
    {
        parent::__construct($message, $code);
    }
}
