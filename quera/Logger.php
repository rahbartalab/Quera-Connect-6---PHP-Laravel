<?php

namespace Quera;

/**
 * Class for logging events and errors
 *
 * @package     quera Logger Class
 */
class Logger implements LoggerInterface
{

    /**
     * Absolute log file path or log file url
     * @var string
     */
    protected string $logPath;

    /**
     * log file
     * @var resource
     */
    protected $logFile;

    /**
     * Logger class constructor
     * @param string $logPath - path and filename of log
     * @param array $options - an array of logger writing options
     *
     * @throws LogException
     */
    public function __construct(string $logPath, array $options)
    {
    }

    // TODO: implement LoggerInterface methods

    /**
     * Class destructor
     */
    public function __destruct()
    {
        if ($this->logFile) {
            fclose($this->logFile);
        }
    }

    public function emergency($message, array $context = array())
    {
        // TODO: Implement emergency() method.
    }

    public function alert($message, array $context = array())
    {
        // TODO: Implement alert() method.
    }

    public function critical($message, array $context = array())
    {
        // TODO: Implement critical() method.
    }

    public function error($message, array $context = array())
    {
        // TODO: Implement error() method.
    }

    public function warning($message, array $context = array())
    {
        // TODO: Implement warning() method.
    }

    public function notice($message, array $context = array())
    {
        // TODO: Implement notice() method.
    }

    public function info($message, array $context = array())
    {
        // TODO: Implement info() method.
    }

    public function debug($message, array $context = array())
    {
        // TODO: Implement debug() method.
    }

    public function log($level, $message, array $context = array())
    {
        // TODO: Implement log() method.
    }
}
