<?php

    namespace Lib\Storage\Providers\Database;

    use Lib\Storage\AbstractStorageProvider;

    class DatabaseStorageProvider extends AbstractStorageProvider {
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