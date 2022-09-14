<?php

    namespace Lib\Media\Image\Storage;

    interface ImageStorageInterface {
        /**
         * Returns requested image
         * @param string $path Path to image file
         * @return string Binary image
         */
        public function getImage(string $path): string;

        /**
         * Saves image to storage
         * @param string $path Path to image file
         * @param string $image Binary image
         * @return void
         */
        public function saveImage(string $path, string $image): void;

        /**
         * Removes image from storage
         * @param string $path Path to image file
         * @return void
         */
        public function deleteImage(string $path): void;
    }