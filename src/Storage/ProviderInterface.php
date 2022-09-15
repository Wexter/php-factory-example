<?php

    namespace Lib\Storage;

    interface ProviderInterface extends StorageInterface {
        /**
         * Returns provider name
         * @return string Provider name
         */
        public function getName(): string;
    }