<?php

    namespace Lib\Storage\Providers\Database;

    use Lib\Storage\Providers\Database\DatabaseProvider;
    use Lib\Storage\ProviderBuilderInterface;
    use Lib\Storage\ProviderInterface;

    class DatabaseProviderBuilder implements ProviderBuilderInterface {
        public function createProvider(): ProviderInterface
        {
            $provider = new DatabaseProvider();

            return $provider;
        }
    }