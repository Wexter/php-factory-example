<?php

    namespace Lib\Storage;

    use Lib\Storage\Exception\StorageProviderNotFoundException;
    use \ReflectionClass;
    use \ReflectionException;

    class FileStorage implements StorageInterface {
        private const PROVIDERS_INTERFACE = __NAMESPACE__ . '\StorageProviderInterface';
        private const PROVIDERS_NAMESPACE = __NAMESPACE__ . '\Providers\\'; 
        private static $providers = [];
        private static bool $__providersRegistered = false;
        private StorageProviderInterface $storageProvider;

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

        public function getProvider(): StorageProviderInterface
        {
            return $this->storageProvider;
        }
        
        /**
         * Checks if provider class exists and implementing required interface
         * @param string $className Name of class for validation
         * @return bool true if class is valid
         */
        private static function isValidProvider(string $className): bool
        {
            try {
                $reflectionClass = new ReflectionClass(self::PROVIDERS_NAMESPACE . $className);

                if (!$reflectionClass->implementsInterface(self::PROVIDERS_INTERFACE)) // class not implemented required interface, skip
                    return false;
            } catch (ReflectionException $e) { // class not found, skip
                echo 'Reflection exception:' . $e->getMessage() . PHP_EOL;
                return false;
            }

            return true;
        }
        /**
         * Searches available storage providers
         * @return void
         */
        private static function loadProviders()
        {
            if (self::$__providersRegistered) return;

            foreach(glob(__DIR__ . '/Providers/*StorageProvider.php') as $file) {
                $providerClassName = str_replace('.php', '', basename($file));

                var_dump($providerClassName);

                if (self::isValidProvider($providerClassName))
                    self::$providers[] = str_replace('StorageProvider', '', $providerClassName);
            }

            self::$__providersRegistered = true;
        }

        /**
         * Returns array of available storage providers
         * @return array
         */
        public static function getProviders(): array
        {
            if (!self::$__providersRegistered)
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
            $className = __NAMESPACE__ . '\Providers\\'. $storageProvider . 'StorageProvider';

            try {
                $reflectionClass = new \ReflectionClass($className);

                if (!$reflectionClass->implementsInterface(self::PROVIDERS_INTERFACE))
                    throw new StorageProviderNotFoundException("Provider \"{$storageProvider}\" not found 1");
            } catch (ReflectionException $e) {
                throw new StorageProviderNotFoundException("Provider \"{$storageProvider}\" not found 2");
            }

            return new $className();
        }
    }