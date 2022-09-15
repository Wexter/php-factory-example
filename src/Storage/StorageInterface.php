<?php

    namespace Lib\Storage;

    interface StorageInterface {
        public function saveFile(string $filePath, string $file): void;
        public function fileExists(string $filePath): bool;
        public function getFile(string $filePath): string;
        public function deleteFile(string $filePath): void;
        public function listFiles(string $path): array;
    }