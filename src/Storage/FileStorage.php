<?php

    namespace Lib\Storage;

    use Exception;
    use Lib\Storage\Exception\ClassNotFoundException;
    use Lib\Storage\Exception\ClassNotImplementedInterfaceException;
    use \ReflectionClass;
    use \ReflectionException;

    class FileStorage implements StorageInterface {
        private const STORAGE_PROVIDER_INTERFACE = __NAMESPACE__ . '\ProviderInterface';
        private const STORAGE_PROVIDER_BUILDER_INTERFACE = __NAMESPACE__ . '\ProviderBuilderInterface';
        private const PROVIDERS_NAMESPACE = __NAMESPACE__ . '\Providers';

        private static $providers = [];
        private static bool $__providersRegistered = false;
        private ProviderInterface $storageProvider;

        public function __construct(string $storageProvider)
        {
            $this->storageProvider = self::createProvider($storageProvider);
        }

        public function saveFile(string $filePath, string $file): void
        {
            $this->storageProvider->saveFile($filePath, $file);
        }

        public function fileExists(string $filePath): bool
        {
            return $this->storageProvider->fileExists($filePath);
        }

        public function getFile(string $filePath): string
        {
            return $this->storageProvider->getFile($filePath);
        }

        public function deleteFile(string $filePath): void
        {
            $this->storageProvider->deleteFile($filePath);
        }

        public function listFiles(string $path): array
        {
            return $this->storageProvider->listFiles($path);
        }

        public function getProvider(): ProviderInterface
        {
            return $this->storageProvider;
        }
        
        /**
         * Returns full class path of provider
         * @param string $providerName Name of provider
         * @return string Full class path of provider
         */
        private static function getProviderClass(string $providerName): string
        {
            return self::PROVIDERS_NAMESPACE . "\\{$providerName}\\{$providerName}Provider";
        }

        /**
         * Checks if provider class exists and implementing required interface
         * @param string $className Name of class for validation
         * @param string $interface Required interface
         * @return bool true if class is valid
         */
        private static function validateClass(string $className, string $interface): void
        {
            try {
                $reflectionClass = new ReflectionClass($className);

                if (!$reflectionClass->implementsInterface($interface)) // class not implemented required interface, skip
                    throw new ClassNotImplementedInterfaceException("Provider \"{$className}\" not implemented {$interface}");
            } catch (ReflectionException $e) { // class not found, skip
                throw new ClassNotFoundException("Provider \"{$className}\" not found");
            }
        }
        /**
         * Searches available storage providers
         * @return void
         */
        private static function loadProviders()
        {
            if (self::$__providersRegistered) return;

            foreach(glob(__DIR__ . '/Providers/*') as $providerPath) {
                $providerName = basename($providerPath);
                $providerClassName = self::getProviderClass($providerName);

                try {
                    self::validateClass($providerClassName, self::STORAGE_PROVIDER_INTERFACE);

                    self::$providers[] = $providerName;
                } catch (Exception $e) {}
            }

            self::$__providersRegistered = true;
        }

        /**
         * Returns list of available storage providers
         * @return array List of available storage providers
         */
        public static function getProviders(): array
        {
            self::loadProviders();

            return self::$providers;
        }

        /**
         * Returns instance of requested storage provider
         * @param string $storageProvider Name of required storage provider
         * @return StorageInterface
         * @throws StorageProviderNotFoundException if provider class was not found
         */
        public static function createProvider(string $storageProvider): StorageInterface
        {
            $providerClassName = self::getProviderClass($storageProvider);

            $providerBuilderClassName = $providerClassName . 'Builder';

            // check provider class
            self::validateClass($providerClassName, self::STORAGE_PROVIDER_INTERFACE);

            // check provider builder class
            self::validateClass($providerBuilderClassName, self::STORAGE_PROVIDER_BUILDER_INTERFACE);

            $builder = new $providerBuilderClassName();

            return $builder->createProvider();
        }
    }