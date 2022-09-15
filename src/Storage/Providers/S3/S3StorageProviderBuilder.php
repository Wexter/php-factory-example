<?php

    namespace Lib\Storage\Providers\S3;

    use Lib\Storage\Providers\S3\S3StorageProvider;
    use Lib\Storage\StorageProviderBuilderInterface;
    use Lib\Storage\StorageProviderInterface;

    class S3StorageProviderBuilder implements StorageProviderBuilderInterface {
        public function createProvider(): StorageProviderInterface
        {
            $provider = new S3StorageProvider();

            return $provider;
        }
    }