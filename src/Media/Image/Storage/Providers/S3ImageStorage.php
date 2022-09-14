<?php

    namespace Lib\Media\Image\Storage\Providers;

    use Lib\Media\Image\Storage\ImageStorageInterface;

    class S3ImageStorage implements ImageStorageInterface {
        public function getImage(string $path): string
        {
            return '';
        }

        public function saveImage(string $path, string $image): void
        {
            
        }

        public function deleteImage(string $path): void
        {
            
        }
    }