<?php

    require_once './vendor/autoload.php';

    var_dump(\Lib\Media\Image\Storage\ImageStorageFactory::getRegisteredProviders());

    $imageStorage = \Lib\Media\Image\Storage\ImageStorageFactory::getStorage(\Lib\Media\Image\Storage\Type::DATABASE);

    // var_dump(get_class($imageStorage));

    // $imageStorage = \Lib\Media\Image\Storage\ImageStorageFactory::getStorage(\Lib\Media\Image\Storage\Type::DIRECTORY);

    // var_dump(get_class($imageStorage));

    // $imageStorage = \Lib\Media\Image\Storage\ImageStorageFactory::getStorage(\Lib\Media\Image\Storage\Type::S3);

    // var_dump(get_class($imageStorage));