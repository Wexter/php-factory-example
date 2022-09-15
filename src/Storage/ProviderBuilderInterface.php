<?php

    namespace Lib\Storage;

    interface ProviderBuilderInterface {
        public function createProvider(): ProviderInterface;
    }