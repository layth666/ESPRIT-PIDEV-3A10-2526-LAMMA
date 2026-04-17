<?php

use App\Kernel;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

<<<<<<< HEAD
return static function (array $context) {
=======
return function (array $context) {
>>>>>>> 889c5b1 (Symfony blog project)
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
