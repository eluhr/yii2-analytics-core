<?php
/**
 * @link http://www.diemeisterei.de/
 * @copyright Copyright (c) 2020 diemeisterei GmbH, Stuttgart
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace eluhr\analytics\core;

use schmunk42\giiant\commands\BatchController;

$config = require dirname(__DIR__, 5) . '/config/main.php';


$config['controllerMap']['analytics-core-gii'] = [
    'class' => BatchController::class,
    'overwrite' => true,
    'interactive' => false,
    'modelNamespace' => __NAMESPACE__ . '\\models',
    'modelBaseClass' => __NAMESPACE__ . '\\models\\ActiveRecord',
    'modelQueryNamespace' => __NAMESPACE__ . '\\models\\query',
    'crudControllerNamespace' => __NAMESPACE__ . '\\controllers',
    'crudTidyOutput' => false,
    'useTranslatableBehavior' => false,
    'useTimestampBehavior' => false,
    'singularEntities' => false,
    'tablePrefix' => 'app_',
    'crudMessageCategory' => 'analytics',
    'modelMessageCategory' => 'analytics',
    'tables' => [
        'app_analytic_data'
    ]
];

return $config;
