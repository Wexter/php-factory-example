<?php

    namespace Lib\Storage\Providers\Directory;

    use Lib\Storage\Providers\Directory\DirectoryStorageProvider;
    use Lib\Storage\ProviderBuilderInterface;
    use Lib\Storage\ProviderInterface;

    class DirectoryProviderBuilder implements ProviderBuilderInterface {
        public function createProvider(): ProviderInterface
        {
            $provider = new DirectoryProvider();

            return $provider;
        }
    }