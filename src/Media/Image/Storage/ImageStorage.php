<?php

    namespace Lib\Media\Image\Storage;

    use ReflectionClass;
    use ReflectionException;
    use Lib\Media\Image\Storage\Exception\ProviderNotFoundException;

    class ImageStorage {
        private const INTERFACE = __NAMESPACE__ . '\ImageStorageInterface';
        private const PROVIDERS_NAMESPACE = __NAMESPACE__ . '\Providers\\'; 
        private static $providers = [];
        private static bool $__providersRegistered = false;

        /**
         * Checks if class is valid to be ImageStorage provider
         * @param string $className Name of class for validation
         * @return bool true if class is valid
         */
        private static function isValidClass(string $className): bool {
            try {
                $reflectionClass = new ReflectionClass(self::PROVIDERS_NAMESPACE . $className);

                if (!$reflectionClass->implementsInterface(self::INTERFACE)) // class not implemented required interface, skip
                    return false;
            } catch (ReflectionException $e) { // class not found, skip
                return false;
            }

            return true;
        }
        /**
         * Searches available storage providers
         * @return void
         */
        private static function registerProviders() {
            if (self::$__providersRegistered) return;

            foreach(glob(__DIR__ . '/Providers/*ImageStorage.php') as $file) {
                $providerClassName = str_replace('.php', '', basename($file));

                if (self::isValidClass($providerClassName))
                    self::$providers[] = str_replace('ImageStorage', '', $providerClassName);
            }

            self::$__providersRegistered = true;
        }

        /**
         * Returns array of available storage providers
         * @return array
         */
        public static function getRegisteredProviders(): array {
            if (!self::$__providersRegistered)
                self::registerProviders();

            return self::$providers;
        }

        /**
         * Returns instance of requested storage provider
         * @param string $storageProvider Name of required storage provider
         * @return ImageStorageInterface
         * @throws ProviderNotFoundException if provider class was not found
         */
        public static function getStorage(string $storageProvider): ?ImageStorageInterface {
            $className = __NAMESPACE__ . '\Providers\\'. $storageProvider . 'ImageStorage';

            try {
                $reflectionClass = new \ReflectionClass($className);

                if (!$reflectionClass->implementsInterface(self::INTERFACE))
                    throw new ProviderNotFoundException("Provider \"{$storageProvider}\" not found");
            } catch (ReflectionException $e) {
                throw new ProviderNotFoundException("Provider \"{$storageProvider}\" not found");
            }

            return new $className();
        }
    }