<?php
/**
 * Конфигурация контенера приложения
 * PHP version 7.4.
 *
 * @category Application
 *
 * @author  sanerrus <username@example.com>
 * @license MIT http://www.example.com/License.txt
 *
 * @see http://www.example.com/Document.txt
 */

namespace App\Configuration;

use App\Core\Tasks\Task;
use App\Core\Tasks\TasksInterface;
use App\Kernel;
use bitExpert\Disco\Annotations\Bean;
use bitExpert\Disco\Annotations\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

/**
 * Класс конфигурации контейнера
 * @Configuration
 */
class AppConfiguration
{
    /**
     * @var EntityManager
     */
    private static EntityManager $em;

    /**
     * @var TasksInterface
     */
    private static TasksInterface $tasks;

    /**
     * Бин конфигурационных данных приложения
     * @return array <string|array> - многомерный массив с параметрами указанных в config/config.yaml
     * @Bean
     */
    public function appConfig(): array
    {
        $config = \yaml_parse_file(
            __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.
            '..'.DIRECTORY_SEPARATOR.Kernel::CONFIG_DIR.DIRECTORY_SEPARATOR.Kernel::CONFIG_FILE
        );

        return $config;
    }


    /**
     * Сервис логирования.
     * @Bean
     */
    public function logger(): LoggerInterface
    {
        $logger = new Logger('App');
        $logger->pushHandler(new StreamHandler(__DIR__.'/../../var/log/app.log', Logger::DEBUG));

        return $logger;
    }

    /**
     * Менеджер управления сущностями БД.
     *
     * @Bean
     */
    public function entityManager(): EntityManager
    {
        if(!empty(AppConfiguration::$em)) {
            return AppConfiguration::$em;
        }

        $paramTasksdb = (new Kernel())->getParameters()['databases']['todolist'];
        $paths = [__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Entity'];
        $isDevMode = 'dev' === (new Kernel())->getParameters()['environment'] ? true : true; //TODO: разобраться почему с prod не работает

        $dbParams = [
            'driver' => 'pdo_mysql',
            'user' => $paramTasksdb['user'],
            'password' => $paramTasksdb['password'],
            'dbname' => $paramTasksdb['database'],
            'host' => $paramTasksdb['host'],
            'port' => $paramTasksdb['port'],
            'charset' => 'utf8',
        ];

        $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, null, null, false);
        AppConfiguration::$em = EntityManager::create($dbParams, $config);

        return AppConfiguration::$em;
    }

    /**
     * Сервис работы с задачами
     * @Bean
     */
    public function tasks(): TasksInterface
    {
        if(!empty(AppConfiguration::$tasks)) {
            return AppConfiguration::$tasks;
        }

        AppConfiguration::$tasks = new Task($this->entityManager());
        
        return AppConfiguration::$tasks;
    }
}
