<?php
namespace src\app\Helpers;

trait Logger
{
    /**
     * Log a message with a specified level.
     */
    public function log(string $message, string $level = 'INFO'): void
    {
        $logFile = dirname(__DIR__, 3) . '/logs/app.log';

        $logEntry = sprintf(
            "[%s] [%s] %s%s",
            date('Y-m-d H:i:s'),
            strtoupper($level),
            $message,
            PHP_EOL
        );

        if (@file_put_contents($logFile, $logEntry, FILE_APPEND) === false) {
            error_log("Logger Error: Unable to write to log file at $logFile");
        }
    }

    /**
     * Log an INFO message.
     */
    public function logInfo(string $message): void
    {
        $this->log($message);
    }

    /**
     * Log a WARNING message.
     */
    public function logWarning(string $message): void
    {
        $this->log($message, 'WARNING');
    }

    /**
     * Log an ERROR message.
     */
    public function logError(string $message): void
    {
        $this->log($message, 'ERROR');
    }
}
