<?php

namespace App;

use App\Exceptions\AppException;
use bitExpert\Disco\BeanException;

abstract class AbstractInjector
{
    public function __construct()
    {
        $this->run();
    }

    /**
     * Получаем имя класса к которому обратились.
     */
    final protected function getNameOfClass(): string
    {
        return static::class;
    }

    private function run(): void
    {
        $ref = new \ReflectionClass($this->getNameOfClass());
        $conteiner = (new Kernel())->getContainer();

        $pattern = "/@Inject ([^\s]+)/";
        foreach ($ref->getProperties() as $refChild) {
            $comment = $refChild->getDocComment();
            preg_match($pattern, $comment, $matches);
            if ($matches) {
                $variable = $refChild->getName();
                if (!$conteiner->has($matches[1])) {
                    continue;
                }
                try {
                    $this->$variable = $conteiner->get($matches[1]);
                } catch (BeanException $e) {
                    throw new AppException('ERROR: AbstractInjector::run(): '.$e->getMessage());
                }
            }
        }
    }
}
