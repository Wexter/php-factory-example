<?php

    require_once './vendor/autoload.php';

    use Lib\Storage\FileStorage;
    use Lib\Storage\ProviderInterface;

    $providers = FileStorage::getProviders();

    var_dump($providers);

    foreach ($providers as $providerName) {
        $fileStorage = new FileStorage($providerName);

        $provider = $fileStorage->getProvider();

        var_dump($provider instanceof ProviderInterface);

        echo $provider->getName() . PHP_EOL;
    }