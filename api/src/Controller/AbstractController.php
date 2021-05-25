<?php

namespace App\Controller;

use App\AbstractInjector;

/**
 * Класс предназначен в первую очередь для внедрения зависимостей в контроллерах
 * так же можно разместить специфичные методы для контроллеров
 * Class AbstractController
 * @package App\Controller
 */
abstract class AbstractController extends AbstractInjector
{
}
