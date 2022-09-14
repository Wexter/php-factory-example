<?php

    namespace Lib\Media\Image\Storage;

    use Exception;

    class ImageStorageFactory {
        private static $providers = [];
        private static $__providersRegistered = false;

        private static function hasProvider(string $storageProvider) {
            if (!self::$__providersRegistered)
                self::registerProviders();

            return in_array($storageProvider, self::$providers);
        }

        private static function registerProviders() {
            if (self::$__providersRegistered) return;

            foreach(glob(__DIR__ . '/Providers/*.php') as $provider) {
                $className = str_replace('.php', '', basename($provider));

                if (!class_exists(__NAMESPACE__ . '\Providers\\' . $className))
                    continue;

                $interfaces = class_implements(__NAMESPACE__ . '\Providers\\' . $className);

                if (isset($interfaces[__NAMESPACE__ . '\ImageStorageInterface']))
                    self::$providers[] = str_replace('ImageStorage', '', $className);
            }

            self::$__providersRegistered = true;
        }

        public static function getRegisteredProviders(): array {
            if (!self::$__providersRegistered)
                self::registerProviders();

            return self::$providers;
        }

        public static function getStorage(string $storageProvider): ?ImageStorageInterface {
            if (!self::$__providersRegistered)
                self::registerProviders();

            if (!self::hasProvider($storageProvider))
                throw new Exception("Unknown storage provider");

            $className = __NAMESPACE__ . '\Providers\\'. $storageProvider . 'ImageStorage';

            return new $className();
        }
    }