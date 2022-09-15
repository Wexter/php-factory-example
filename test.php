<?php

    require_once './vendor/autoload.php';

    use Lib\Storage\FileStorage;
    use Lib\Storage\StorageProviderInterface;

    $providers = FileStorage::getProviders();

    var_dump($providers);

    foreach ($providers as $providerName) {
        $fileStorage = new FileStorage($providerName);

        $provider = $fileStorage->getProvider();

        var_dump($provider instanceof StorageProviderInterface);

        echo $provider->getName() . PHP_EOL;
    }