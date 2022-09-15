<?php

    namespace Lib\Storage\Providers\Directory;

    use Lib\Storage\Providers\Directory\DirectoryStorageProvider;
    use Lib\Storage\StorageProviderBuilderInterface;
    use Lib\Storage\StorageProviderInterface;

    class DirectoryStorageProviderBuilder implements StorageProviderBuilderInterface {
        public function createProvider(): StorageProviderInterface
        {
            $provider = new DirectoryStorageProvider();

            return $provider;
        }
    }