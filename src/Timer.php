<?php

    namespace Lib;

    class Timer {
        private $startTime;

        public function __construct() {
            $this->start();
        }

        public function start() {
            $this->startTime = microtime(true);
        }

        public function elapsed() {
            return microtime(true) - $this->startTime;
        }
    }
