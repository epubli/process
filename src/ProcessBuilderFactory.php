<?php

namespace Epubli\Process;

/**
 * Class ProcessBuilderFactory is a service that creates new instances of various ProcessBuilders.
 *
 * This comes in handy when we need to run external processes (which can conveniently be achieved with
 * the Symfony Process Component) and want these process objects to be mockable in unit test scenarios.
 *
 * @package Epubli\Process
 */
class ProcessBuilderFactory
{
    /** @var string The path where to find the executables. */
    private $prefix;

    private $registry = [];

    public function __construct($prefix = '')
    {
        $this->prefix = $prefix;
    }

    public function register($key, $className)
    {
        $this->registry[$key] = $className;
    }

    /**
     * @param string $key
     * @return ProcessBuilderInterface
     * @throws Exception
     */
    public function create($key)
    {
        if (!isset($this->registry[$key])) {
            throw new Exception("No process builder class registered for key $key.");
        }

        $className = $this->registry[$key];

        if (!class_exists($className)) {
            throw new Exception("Process builder class $className does not exist.");
        }

        return new $className($this->prefix);
    }
}
