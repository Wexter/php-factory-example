<?php

    require_once './vendor/autoload.php';

    use Lib\Timer;
    use Lib\Storage\FileStorage;
    use Lib\Storage\ProviderInterface;

    $timer = new Timer();

    $providers = FileStorage::getProviders();

    echo "Providers load time {$timer->elapsed()}s" . PHP_EOL;

    var_dump($providers);

    foreach ($providers as $providerName) {
        $timer->start();

        $fileStorage = new FileStorage($providerName);

        echo "Provider create time: {$timer->elapsed()}s" . PHP_EOL;

        $provider = $fileStorage->getProvider();

        var_dump($provider instanceof ProviderInterface);

        echo $provider->getName() . PHP_EOL;
    }