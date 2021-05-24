<?php

declare(strict_types=1);

namespace App;

use App\Configuration\AppConfiguration;
use App\Services\Middleware\CorsMiddleware;
use bitExpert\Disco\AnnotationBeanFactory;
use bitExpert\Disco\BeanFactoryRegistry;
use Laminas\Diactoros\ResponseFactory;
use League\Route\Router;
use League\Route\Strategy\JsonStrategy;
use Narrowspark\HttpEmitter\SapiEmitter;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Ядро приложения
 */
final class Kernel
{
    public const CONFIG_FILE = 'config.yaml';
    public const CONFIG_DIR = 'config';

    /**
     * @var ContainerInterface - Контейнер приложения
     */
    private static ContainerInterface $container;

    /**
     * @var bool - признак определены ли web роуты
     */
    private static bool $router;

    /**
     * Запуск ядра в среде web.
     */
    public function runHttp(ServerRequestInterface $request): void
    {
        if(!empty(Kernel::$router) && Kernel::$router) {
            return;
        }

        Kernel::$router = true;

        $responseFactory = new ResponseFactory();
        $strategy = new JsonStrategy($responseFactory);
        $router = (new Router())->setStrategy($strategy);
        $router->middleware(new CorsMiddleware());

        // TODO: подумать как вынести роуты
        $router->map('GET', '/todo-list', 'App\Controller\TasksController::getTodoList');
        $router->map('PUT', '/status/{id:number}/{status:number}', 'App\Controller\TasksController::status');

        $response = $router->dispatch($request);

        $emitter = new SapiEmitter();
        $emitter->emit($response);
    }

    /**
     * Возвращает контейнер приложения.
     */
    public function getContainer(): ContainerInterface
    {
        if (isset(self::$container) && self::$container instanceof ContainerInterface) {
            return self::$container;
        }

        self::$container = new AnnotationBeanFactory(AppConfiguration::class);
        BeanFactoryRegistry::register(self::$container);

        return self::$container;
    }

    /**
     * Получаем конфигурационные параметры приложения.
     *
     * @return array <string|array> - многомерняй массив с параметрами указанных в config/config.yaml
     */
    public function getParameters(): array
    {
        return $this->getContainer()->get('appConfig');
    }
}
