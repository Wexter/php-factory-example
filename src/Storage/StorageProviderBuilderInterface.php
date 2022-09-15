<?php

    namespace Lib\Storage;

    interface StorageProviderBuilderInterface {
        public function createProvider(): StorageProviderInterface;
    }