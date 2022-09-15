<?php

    namespace Lib\Storage\Providers\Database;

    use Lib\Storage\Providers\Database\DatabaseStorageProvider;
    use Lib\Storage\StorageProviderBuilderInterface;
    use Lib\Storage\StorageProviderInterface;

    class DatabaseStorageProviderBuilder implements StorageProviderBuilderInterface {
        public function createProvider(): StorageProviderInterface
        {
            $provider = new DatabaseStorageProvider();

            return $provider;
        }
    }