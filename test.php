<?php

    require_once './vendor/autoload.php';

    use Lib\Media\Image\Storage\ImageStorage;

    $providers = [
        'Database',
        'S3',
        'Directory',
        'NotFound',
        'NotImplemented'
    ];

    foreach ($providers as $provider) {
        echo "Test {$provider} provider" . PHP_EOL;
        try {
            $imageStorage = ImageStorage::getStorage($provider); // OK
    
            echo "Provider \"{$provider}\" OK" . PHP_EOL;
        } catch (Exception $e) { echo "Exception: {$e->getMessage()}" . PHP_EOL; }
        echo PHP_EOL;
    }

    echo "Test providers returned by ImageStorage::getRegisteredProviders()" . PHP_EOL . PHP_EOL;

    $providers = ImageStorage::getRegisteredProviders();

    var_dump($providers);

    foreach ($providers as $provider) {
        echo "Test {$provider} provider" . PHP_EOL;
        try {
            $imageStorage = ImageStorage::getStorage($provider); // OK
   
            var_dump(get_class($imageStorage));

            echo "Provider \"{$provider}\" OK" . PHP_EOL;
        } catch (Exception $e) { echo "Exception: {$e->getMessage()}" . PHP_EOL; }
        echo PHP_EOL;
    }
    // var_dump($providers);

    // foreach ($providers as $provider) {
    //     echo "Requesting storage provider: {$provider}" . PHP_EOL;

    //     $imageStorage = ImageStorage::getStorage($provider);

    //     var_dump(get_class($imageStorage));
    // }

    // $imageStorage = new \Lib\Media\Image\Storage\Providers\S3ImageStorage();

    // var_dump(get_declared_classes());