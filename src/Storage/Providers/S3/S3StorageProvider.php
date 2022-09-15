<?php

    namespace Lib\Storage\Providers\S3;

    use Lib\Storage\AbstractStorageProvider;

    class S3StorageProvider extends AbstractStorageProvider {
        public function __construct()
        {
            
        }

        public function saveFile(string $filePath, string $file): void
        {
            
        }

        public function fileExists(string $filePath): bool
        {
            return true;
        }
        
        public function getFile(string $filePath): string
        {
            return '';
        }

        public function deleteFile(string $filePath): void
        {
            
        }

        public function listFiles(string $path): array
        {
            return [];
        }
    }