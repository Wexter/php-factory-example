<?php

    namespace Lib\Storage;

    abstract class AbstractStorageProvider implements ProviderInterface {
        public function getName(): string {
            return static::class;
        }
    }