<?php

    namespace Lib\Storage;

    abstract class AbstractStorageProvider implements StorageProviderInterface {
        public function getName(): string {
            return static::class;
        }
    }