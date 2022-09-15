<?php

    namespace Lib\Storage\Providers\S3;

    use Lib\Storage\Providers\S3\S3Provider;
    use Lib\Storage\ProviderBuilderInterface;
    use Lib\Storage\ProviderInterface;

    class S3ProviderBuilder implements ProviderBuilderInterface {
        public function createProvider(): ProviderInterface
        {
            $provider = new S3Provider();

            return $provider;
        }
    }