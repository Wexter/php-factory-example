<?php

    namespace Lib\Storage;

    interface StorageProviderInterface extends StorageInterface {
        /**
         * Returns provider name
         * @return string Provider name
         */
        public function getName(): string;
    }