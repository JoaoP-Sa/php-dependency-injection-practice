<?php

declare(strict_types=1);

use App\Container;
use App\Controllers\TestController;
use App\Services\TestService;

require_once __DIR__ . '/App/Autoloader.php';

// $container = new Container;

// $container->set('test_controller', function() {
//     return new TestService;
// });

// $testController = new TestController(
//     $container->get('test_controller')
// );

// $container->singleton('test_controller', function() {
//     return new TestService();
// });

// $testController = new TestController(
//     $container->get('test_controller')
// );

function getParamClassReference($dependencies): array
{
    static $count;
    $count = $count === null ? 1 : $count + 1;
    
    return array_map(function (ReflectionParameter $dependency) use ($count) {
        $dependencyName = $dependency->getType()->getName();

        $reflectedDependency = new ReflectionClass($dependencyName);
        $constructor = $reflectedDependency->getConstructor();
        $reflectedDependencyParams = $constructor ? $constructor->getParameters() : [];

        $instanceArgs = [];

        if (count($reflectedDependencyParams)) {
            $instanceArgs = getParamClassReference($reflectedDependencyParams);
        }

        echo $count;

        return $reflectedDependency->newInstanceArgs($instanceArgs);
    }, $dependencies);
}

$reflection = new ReflectionClass('App\Controllers\TestController');
$constructor = $reflection->getConstructor();
$dependencies = $constructor->getParameters();

$paramClassReference = getParamClassReference($dependencies);
$reflectedClass = $reflection->newInstanceArgs($paramClassReference);


echo "<pre>";
print_r($reflectedClass);
echo "</pre>";
