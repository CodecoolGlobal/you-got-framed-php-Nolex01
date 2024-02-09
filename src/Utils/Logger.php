<?php

namespace app\Utils;

class Logger implements LoggerInterface {
    private $logFile;

    public function __construct($logFile) {
        $this->logFile = $logFile;
    }

    public function log($level, $message, array $context = []) {
        $logMessage = sprintf("[%s] %s: %s %s\n", date('Y-m-d H:i:s'), strtoupper($level), $message, json_encode($context));
        file_put_contents($this->logFile, $logMessage, FILE_APPEND);
    }

    public function emergency($message, array $context = []) {
        $this->log('emergency', $message, $context);
    }

    public function alert($message, array $context = []) {
        $this->log('alert', $message, $context);
    }

    public function critical($message, array $context = []) {
        $this->log('critical', $message, $context);
    }

    public function error($message, array $context = []) {
        $this->log('error', $message, $context);
    }

    public function warning($message, array $context = []) {
        $this->log('warning', $message, $context);
    }

    public function notice($message, array $context = []) {
        $this->log('notice', $message, $context);
    }

    public function info($message, array $context = []) {
        $this->log('info', $message, $context);
    }

    public function debug($message, array $context = []) {
        $this->log('debug', $message, $context);
    }
}
