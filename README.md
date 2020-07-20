# Yii2 Analytics Module Core

This is the core (business logic) for a super simple analytics api implementation

## Installation

```bash
composer require eluhr/yii2-analytics-core
```

## Configuration

```php
use eluhr\analytics\core\Module as AnalyticsCoreModule;

[
    'controllerMap' => [
        'migrate' => [
            'migrationPath' => [
                '@vendor/eluhr/yii2-analytics-core/src/migrations'
            ]
        ]
    ],
    'modules' => [
        'analytics-api' => [
            'class' => AnalyticsCoreModule::class
        ]
    ]
];
```

## (Re)Generating models

```bash
docker-compose run --rm -e PHP_USER_ID=0 php yii analytics-core-gii/models --appconfig=/app/vendor/eluhr/yii2-analytics-core/src/config/giiant.php
```